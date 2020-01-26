<?php
declare(strict_types=1);

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Core\Configure;
use Cake\Http\Client;
use Cake\I18n\Time;
use Cake\ORM\TableRegistry;
use Cake\Utility\Hash;
use Cake\Utility\Inflector;

/**
 * ScoutManager component
 *
 * @property \Cake\Controller\Component\FlashComponent $Flash
 * @property \Cake\Http\Client $http
 * @property \App\Model\Entity\User $Users
 */
class ScoutManagerComponent extends Component
{
    /**
     * Default configuration.
     *
     * @var array $_defaultConfig
     */
    protected $_defaultConfig = [];

    /**
     * @var \Cake\Http\Client $http
     */
    public $http;

    /**
     * @var array $components
     */
    public $components = ['Flash'];

    /**
     * ScoutManagerComponent constructor.
     *
     * @param \Cake\Controller\ComponentRegistry $registry The Registry Object
     * @param array $config The Config Array
     * @param \Cake\Http\Client|null $client The HTTP Client (specified for mockery)
     */
    public function __construct($registry, $config = [], $client = null)
    {
        if (is_null($client)) {
            $this->http = $client;
        }

        if (!is_null($client)) {
            $this->http = new Client([
                'host' => Configure::readOrFail('OSM.api_base'),
                'scheme' => 'https',
            ]);
        }

        $this->Users = TableRegistry::getTableLocator()->get('Users');

        parent::__construct($registry, $config);
    }

    /**
     * Return OSM Settings.
     *
     * @return bool|array
     */
    public function getOsmSettings()
    {
        $apiId = Configure::readOrFail('OSM.api_id');
        if (!$apiId) {
            return false;
        }
        $apiToken = Configure::readOrFail('OSM.api_token');
        if (!$apiToken) {
            return false;
        }
        $apiBase = Configure::readOrFail('OSM.api_base');
        if (!$apiBase) {
            return false;
        }

        return [
            'api_id' => $apiId,
            'api_base' => $apiBase,
            'api_token' => $apiToken,
        ];
    }

    /**
     * @param int $userId The user Id to be checked.
     *
     * @return array
     */
    public function checkOsmStatus($userId)
    {
        $atts = TableRegistry::get('Attendees');
        $now = Time::now();

        $user = $this->Users->get($userId);

        $termCurrent = false;
        $linked = false;
        $sectionSet = false;
        $attendeesPresent = false;
        $nextStep = 'link';

        if (!empty($user->osm_user_id) /*&& $session->check('OSM.Secret')*/) {
            $linked = true;
            $nextStep = 'section';
        }

        if (!empty($user->osm_section_id)) {
            $sectionSet = true;
            if ($nextStep == 'section') {
                $nextStep = 'term';
            }
        }

        if (!empty($user->osm_current_term) && $user->osm_term_end > $now) {
            $termCurrent = true;
            if ($nextStep == 'term') {
                $nextStep = 'sync';
            }
        }

        $attendeeCount = $atts->find('osm')->where(['user_id' => $userId])->count();

        if ($attendeeCount > 0 && isset($attendeeCount)) {
            $attendeesPresent = true;
        }

        $returnArray = [
            'linked' => $linked,
            'sectionSet' => $sectionSet,
            'termCurrent' => $termCurrent,
            'attendees_present' => $attendeesPresent,
            'attendee_count' => $attendeeCount,
            'next_step' => $nextStep,
        ];

        return $returnArray;
    }

    /**
     * Check Access
     *
     * @param int $userId The ID of the User
     *
     * @return void
     */
    public function checkAccess($userId)
    {
    }

    /**
     * @param string $secret The Secret to be stored.
     * @param int $userId The User ID associated.
     *
     * @return bool
     */
    public function storeUserSecret($secret, $userId)
    {
        /** @var \App\Model\Entity\User $user */
        $user = $this->Users->get($userId);

        $user->osm_secret = $secret;

        if ($this->Users->save($user, ['validation' => false])) {
            return true;
        } else {
            $errorMessage = 'Problem Storing User Secret in Database.';
            $this->log($errorMessage);
            $this->Flash->error($errorMessage);

            return false;
        }
    }

    /**
     * @param int $userId The User Id to have OSM Secret Retrieved.
     *
     * @return bool|string
     */
    public function retrieveUserSecret($userId)
    {
        $this->Users = TableRegistry::getTableLocator()->get('Users');

        /** @var \App\Model\Entity\User $user */
        $user = $this->Users->get($userId);

        if (isset($user->osm_secret)) {
            if (is_string($user->osm_secret)) {
                return $user->osm_secret;
            }
        }

        return false;
    }

    /**
     * @param array $authArray The array with parameters for the process.
     *
     * @return bool|\Cake\Http\Response|null
     */
    public function linkUser($authArray = null)
    {
        $controller = $this->_registry->getController();

        $settingsArray = $this->getOsmSettings();
        if (!$settingsArray) {
            $errorMessage = 'Error in retrieving OSM settings.';
            $this->log($errorMessage);

            if (isset($controller)) {
                $this->Flash->error(__($errorMessage));

                return $controller->redirect([ 'controller' => 'Osm', 'action' => 'section' ]);
            }

            return false;
        }

        $url = '/users.php?action=authorise';

        $response = $this->http->post($url, [
            'password' => $authArray['osm_password'],
            'email' => $authArray['osm_email'],
            'token' => $settingsArray['api_token'],
            'apiid' => $settingsArray['api_id'],
        ]);

        $FailMessage = 'Incorrect password - you have 5 more attempts before your account is locked for 15 minutes.';

        if ($response->isOk()) {
            $body = json_decode($response->getStringBody());

            if (isset($body->error)) {
                if ($body->error == $FailMessage) {
                    $errorMessage = 'Incorrect password - OSM will lock your account after 5 attempts.';
                } else {
                    $errorMessage = 'Unknown Error.';
                }
                $this->log($errorMessage);

                if (isset($controller)) {
                    $this->Flash->error(__($errorMessage));

                    return $controller->redirect([ 'controller' => 'Osm', 'action' => 'link' ]);
                } else {
                    return false;
                }
            }

            if (isset($authArray['user_id'])) {
                $secretStored = $this->storeUserSecret($body->secret, $authArray['user_id']);
            } else {
                return false;
            }

            if ($secretStored) {
                $this->Users = TableRegistry::getTableLocator()->get('Users');

                $now = Time::now();

                /** @var \App\Model\Entity\User $user */
                $user = $this->Users->get($authArray['user_id']);

                $user->osm_user_id = $body->userid;
                $user->osm_linkdate = $now;

                if (!isset($user->osm_linked)) {
                    $user->osm_linked = 1;
                }

                // SAVE ENTITY
                if ($this->Users->save($user, ['validation' => false])) {
                    if (isset($controller)) {
                        $this->Flash->success(__('You have linked your OSM account.'));
                        if (is_null($user->osm_section_id)) {
                            return $controller->redirect(['controller' => 'Osm', 'action' => 'section' ]);
                        } else {
                            return $controller->redirect(['controller' => 'Osm', 'action' => 'home' ]);
                        }
                    } else {
                        return true;
                    }
                } else {
                    $errorMessage = 'Unable to save user.';
                    $this->log($errorMessage);
                    if (isset($controller)) {
                        $this->Flash->error(__($errorMessage));

                        return $controller->redirect(['controller' => 'Osm', 'action' => 'link']);
                    } else {
                        return false;
                    }
                }
            }
        }

        return false;
    }

    /**
     * @param int $userId The User Id to be look up Sections.
     *
     * @return bool|array|\Cake\Http\Response
     */
    public function getSectionIds($userId)
    {
        $controller = $this->_registry->getController();

        $settingsArray = $this->getOsmSettings();
        if (!$settingsArray) {
            $errorMessage = 'Error retrieving OSM settings.';
            $this->log($errorMessage);

            if (isset($controller)) {
                $this->Flash->error(__($errorMessage));

                return $controller->redirect(['controller' => 'Osm', 'action' => 'section' ]);
            }

            return false;
        }

        $user = $this->Users->get($userId, ['contain' => 'Sections.SectionTypes']);

        $secret = $this->retrieveUserSecret($userId);

        if (!is_string($secret) || is_bool($secret)) {
            $errorMessage = 'Error retrieving OSM User Secret.';
            $this->log($errorMessage);

            if (isset($controller)) {
                $this->Flash->error(__($errorMessage));

                return $controller->redirect(['controller' => 'Osm', 'action' => 'section' ]);
            }

            return false;
        }

        $http = new Client([
            'host' => $settingsArray['api_base'],
            'scheme' => 'https',
        ]);

        $url = '/api.php?action=getUserRoles';

        if (!is_int($user->osm_user_id) || $user->osm_user_id == 0) {
            $errorMessage = 'Error retrieving OSM User Id.';
            $this->log($errorMessage);

            if (isset($controller)) {
                $this->Flash->error(__($errorMessage));

                return $controller->redirect(['controller' => 'Osm', 'action' => 'link' ]);
            }

            return false;
        }

        $response = $http->post($url, [
            'userid' => $user->osm_user_id,
            'secret' => $secret,
            'token' => $settingsArray['api_token'],
            'apiid' => $settingsArray['api_id'],
        ]);

        if ($response->isOk() && $response->body <> false) {
            $body = $response->json;

            $selectArray = $body;

            $sectionType = Inflector::pluralize(strtolower($user->section->section_type->section_type));

            $sectionArray = [];

            foreach ($selectArray as $key => $section) {
                if ($section['section'] == $sectionType) {
                    $sectionArray = Hash::insert(
                        $sectionArray,
                        $section['sectionid'],
                        $section['groupname'] . ': ' . $section['sectionname']
                    );
                    $sectionSelected = $section;
                }
            }

            if (count($sectionArray) == 1 && isset($controller) && isset($sectionSelected)) {
                $this->Flash->success(__(
                    'Only one section of section type '
                    . $sectionType
                    . ' found. Section assigned.'
                ));

                $user->osm_section_id = $sectionSelected['sectionid'];
                $user->osm_linked = 2;

                if ($this->Users->save($user, ['validation' => false])) {
                    return $controller->redirect([ 'action' => 'term' ]);
                }
            }

            return $sectionArray;
        } else {
            $errorMessage = 'Error Parsing OSM Response.';
            $this->log($errorMessage);

            if (isset($controller)) {
                $this->Flash->error(__($errorMessage));

                return $controller->redirect([ 'controller' => 'Osm', 'action' => 'home' ]);
            }

            return false;
        }
    }

    /**
     * @param int $userId The Id of the User to set OSM terms for.
     *
     * @return bool|\Cake\Http\Response
     */
    public function setTerm($userId)
    {
        $controller = $this->_registry->getController();

        $settingsArray = $this->getOsmSettings();
        if (!$settingsArray) {
            $errorMessage = 'Error retrieving OSM settings.';
            $this->log($errorMessage);

            if (isset($controller)) {
                $this->Flash->error(__($errorMessage));

                return $controller->redirect([ 'controller' => 'Osm', 'action' => 'section' ]);
            }

            return false;
        }

        $this->Users = TableRegistry::getTableLocator()->get('Users');

        /** @var \App\Model\Entity\User $user */
        $user = $this->Users->get($userId, ['contain' => 'Sections.SectionTypes']);

        $secret = $this->retrieveUserSecret($userId);

        if (!is_string($secret) || is_bool($secret)) {
            $errorMessage = 'Error retrieving OSM User Secret.';
            $this->log($errorMessage);

            if (isset($controller)) {
                $this->Flash->error(__($errorMessage));

                return $controller->redirect([ 'controller' => 'Osm', 'action' => 'section' ]);
            }

            return false;
        }

        if (!is_int($user->osm_user_id) || $user->osm_user_id == 0) {
            $errorMessage = 'Error retrieving OSM User Id.';
            $this->log($errorMessage);

            if (isset($controller)) {
                $this->Flash->error(__($errorMessage));

                return $controller->redirect([ 'controller' => 'Osm', 'action' => 'link' ]);
            }

            return false;
        }

        $url = '/api.php?action=getTerms';

        $response = $this->http->post($url, [
            'userid' => $user->osm_user_id,
            'secret' => $secret,
            'token' => $settingsArray['api_token'],
            'apiid' => $settingsArray['api_id'],
        ]);

        $now = Time::now();

        if ($response->isOk()) {
            $preBody = $response->json;
            $body = Hash::get($preBody, $user->osm_section_id);

            if (is_null($body)) {
                $errorMessage = 'No OSM Response Received - access confirmation required.';
                $this->log($errorMessage);

                if (isset($controller)) {
                    $this->Flash->error(__($errorMessage));

                    return $controller->redirect([ 'controller' => 'Osm', 'action' => 'access' ]);
                }

                return false;
            }

            $terms = Hash::combine($body, '{n}.termid', '{n}', '{n}.past');
            $term = Hash::get($terms, 1);

            foreach ($term as $term) {
                $startdate = Hash::get($term, 'startdate');
                $start = Time::parse($startdate);

                $enddate = Hash::get($term, 'enddate');
                $end = Time::parse($enddate);

                $count = 0;

                if ($start < $now && $end > $now) {
                    $count = $count + 1;
                    $termSel = $term;
                }
            }

            if ($count == 1) {
                $termId = Hash::get($termSel, 'termid');
                $user->osm_current_term = $termId;

                $termEndDate = Hash::get($termSel, 'enddate');
                $termEnd = Time::parse($termEndDate);
                $user->osm_term_end = $termEnd;

                $user->osm_linked = 3;

                if ($this->Users->save($user, ['validation' => false])) {
                    $successMessage = 'Your OSM Term has been set.';
                    $this->log($successMessage);

                    if (isset($controller)) {
                        $this->Flash->success(__($successMessage));
                    }

                    return true;
                } else {
                    $errorMessage = 'The user could not be saved. Please, try again.';
                    $this->log($errorMessage);

                    if (isset($controller)) {
                        $this->Flash->error(__($errorMessage));
                    }

                    return false;
                }
            }

            $errorMessage = 'More than 1 Term Applies.';
            $this->log($errorMessage);

            if (isset($controller)) {
                $this->Flash->error(__($errorMessage));
            }

            return false;
        }

        $errorMessage = 'There was a request error, please try again.';
        $this->log($errorMessage);

        if (isset($controller)) {
            $this->Flash->error(__($errorMessage));
        }

        return false;
    }

    /**
     * @param int $userId The UserID for the osm session
     *
     * @return array|bool|\Cake\Http\Response|null
     */
    public function getEventList($userId)
    {
        $controller = $this->_registry->getController();

        $settingsArray = $this->getOsmSettings();
        if (!$settingsArray) {
            $errorMessage = 'Error retrieving OSM settings.';
            $this->log($errorMessage);

            if (isset($controller)) {
                $this->Flash->error(__($errorMessage));

                return $controller->redirect([ 'controller' => 'Osm', 'action' => 'section' ]);
            }

            return false;
        }

        /** @var \App\Model\Entity\User $user */
        $user = $this->Users->get($userId, ['contain' => 'Sections.SectionTypes']);

        $secret = $this->retrieveUserSecret($userId);

        if (!is_string($secret) || is_bool($secret)) {
            $errorMessage = 'Error retrieving OSM User Secret.';
            $this->log($errorMessage);

            if (isset($controller)) {
                $this->Flash->error(__($errorMessage));

                return $controller->redirect([ 'controller' => 'Osm', 'action' => 'section' ]);
            }

            return false;
        }

        $http = new Client([
            'host' => $settingsArray['api_base'],
            'scheme' => 'https',
        ]);

        if (!is_int($user->osm_user_id) || $user->osm_user_id == 0) {
            $errorMessage = 'Error retrieving OSM User Id.';
            $this->log($errorMessage);

            if (isset($controller)) {
                $this->Flash->error(__($errorMessage));

                return $controller->redirect([ 'controller' => 'Osm', 'action' => 'link' ]);
            }

            return false;
        }

        $url = '/ext/events/summary/?action=get&sectionid=' . $user->osm_section_id
               . '&termid=' . $user->osm_current_term;

        $response = $http->post($url, [
            'userid' => $user->osm_user_id,
            'secret' => $secret,
            'token' => $settingsArray['api_token'],
            'apiid' => $settingsArray['api_id'],
        ]);

        if ($response->isOk()) {
            $preBody = $response->json;
            if (is_null($preBody)) {
                $errorMessage = 'No events found';
                $this->log($errorMessage . ' SM - EVENT LIST');

                if (isset($controller)) {
                    $this->Flash->error(__($errorMessage));
                }

                return [];
            }
            $body = Hash::get($preBody, 'items');

            $events = Hash::combine($body, '{n}.eventid', '{n}.name');

            return $events;
        }

        $errorMessage = 'Response Error - Try again.';
        $this->log($errorMessage);

        if (isset($controller)) {
            $this->Flash->error(__($errorMessage));

            return [];
        }

        return false;
    }

    /**
     * @param int $userId The ID of the Logged In User
     * @param int $osmEventId The OSM Internal Event ID
     *
     * @return array|bool|\Cake\Http\Response|null
     */
    public function getEventAttendees($userId, $osmEventId)
    {
        $controller = $this->_registry->getController();

        $settingsArray = $this->getOsmSettings();
        if (!$settingsArray) {
            $errorMessage = 'Error retrieving OSM settings.';
            $this->log($errorMessage);

            if (isset($controller)) {
                $this->Flash->error(__($errorMessage));

                return $controller->redirect([ 'controller' => 'Osm', 'action' => 'section' ]);
            }

            return false;
        }

        /** @var \App\Model\Entity\User $user */
        $user = $this->Users->get($userId, ['contain' => 'Sections.SectionTypes']);

        $secret = $this->retrieveUserSecret($userId);

        if (!is_string($secret) || is_bool($secret)) {
            $errorMessage = 'Error retrieving OSM User Secret.';
            $this->log($errorMessage);

            if (isset($controller)) {
                $this->Flash->error(__($errorMessage));

                return $controller->redirect([ 'controller' => 'Osm', 'action' => 'section' ]);
            }

            return false;
        }

        if (!is_int($user->osm_user_id) || $user->osm_user_id == 0) {
            $errorMessage = 'Error retrieving OSM User Id.';
            $this->log($errorMessage);

            if (isset($controller)) {
                $this->Flash->error(__($errorMessage));

                return $controller->redirect([ 'controller' => 'Osm', 'action' => 'link' ]);
            }

            return false;
        }

        $url = '/ext/events/event/?action=getAttendance&eventid='. $osmEventId
               . '&sectionid=' . $user->osm_section_id
               . '&termid=' . $user->osm_current_term;

        $response = $this->http->post($url, [
            'userid' => $user->osm_user_id,
            'secret' => $secret,
            'token' => $settingsArray['api_token'],
            'apiid' => $settingsArray['api_id'],
        ]);

        if ($response->isOk()) {
            $preBody = $response->getJson();
            if (is_array($preBody)) {
                $body = Hash::get($preBody, 'items');

                $items = [];
                foreach ($body as $item) {
                    if ($item['attending'] == 'Yes') {
                        array_push($items, $item);
                    }
                }

                return $items;
            }

            return false;
        }

        $errorMessage = 'Response Error - Try again.';
        $this->log($errorMessage);

        if (isset($controller)) {
            $this->Flash->error(__($errorMessage));

            return $controller->redirect([ 'controller' => 'Osm', 'action' => 'link' ]);
        }

        return false;
    }
}
