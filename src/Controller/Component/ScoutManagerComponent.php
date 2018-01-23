<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\Core\Configure;
use Cake\Http\Client;
use Cake\I18n\Time;
use Cake\ORM\TableRegistry;
use Cake\Utility\Hash;
use Cake\Utility\Inflector;

/**
 * ScoutManager component
 */
class ScoutManagerComponent extends Component
{

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    public $components = ['Flash'];

    /**
     * Return OSM Settings.
     *
     * @return bool|array
     */
    public function getOsmSettings()
    {
        if (!($apiId = Configure::readOrFail('OSM.api_id'))) {
            return false;
        };
        if (!($apiToken = Configure::readOrFail('OSM.api_token'))) {
            return false;
        };
        if (!($apiBase = Configure::readOrFail('OSM.api_base'))) {
            return false;
        };

        $returnArray = [
            'api_id' => $apiId,
            'api_base' => $apiBase,
            'api_token' => $apiToken,
        ];

        return $returnArray;
    }

    /**
     * @param int $userId The user Id to be checked.
     *
     * @return array
     */
    public function checkOsmStatus($userId)
    {
        $users = TableRegistry::get('Users');
        $atts = TableRegistry::get('Attendees');
        $now = Time::now();

        $user = $users->get($userId);

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

        $return_array = [
            'linked' => $linked,
            'sectionSet' => $sectionSet,
            'termCurrent' => $termCurrent,
            'attendees_present' => $attendeesPresent,
            'attendee_count' => $attendeeCount,
            'next_step' => $nextStep,
        ];

        return $return_array;
    }

    /**
     * @param string $secret The Secret to be stored.
     * @param int $userId The User ID associated.
     *
     * @return bool
     */
    public function storeUserSecret($secret, $userId)
    {
        $users = TableRegistry::get('Users');

        $user = $users->get($userId);

        $user->osm_secret = $secret;

        if ($users->save($user)) {
            return true;
        } else {
            $error_message = 'Problem Storing User Secret in Database.';
            $this->log($error_message);
            $this->Flash->error($error_message);

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
        $users = TableRegistry::get('Users');

        $user = $users->get($userId);

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

        if (!($settingsArray = $this->getOsmSettings())) {
            $error_message = 'Error in retrieving OSM settings.';
            $this->log($error_message);

            if (isset($controller)) {
                $this->Flash->error(__($error_message));

                return $controller->redirect([ 'action' => 'section' ]);
            }

            return false;
        }

        $http = new Client([
            'host' => $settingsArray['api_base'],
            'scheme' => 'https'
        ]);

        $url = '/users.php?action=authorise';

        $response = $http->post($url, [
            'password' => $authArray['osm_password'],
            'email' => $authArray['osm_email'],
            'token' => $settingsArray['api_token'],
            'apiid' => $settingsArray['api_id'],
        ]);

        if ($response->isOk()) {
            $body = json_decode($response->body);

            if (isset($body->error)) {
                if ($body->error == 'Incorrect password - you have 5 more attempts before your account is locked for 15 minutes.') {
                    $error_message = 'Incorrect password - OSM will lock your account after 5 attempts.';
                } else {
                    $error_message = 'Unknown Error.';
                }
                $this->log($error_message);

                /*// KEEN IO REPORTING ENTRY

                $osmEnt = [
                    'Entity Id' => null,
                    'Controller' => 'OSM',
                    'Action' => 'Link',
                    'User Id' => $this->Auth->user('id'),
                    'Creation Date' => $now,
                    'Modified' => null,
                    'OSM' => [
                        'LinkStatus' => 'Fail'
                    ]
                ];

                $sets = TableRegistry::get('Settings');

                $jsonOSM = json_encode($osmEnt);
                $apiKey = $sets->get(13)->text;
                $projectId = $sets->get(14)->text;
                $eventType = 'Action';

                $keenURL = 'https://api.keen.io/3.0/projects/' . $projectId . '/events/' . $eventType . '?api_key=' . $apiKey;

                $http = new Client();
                $response = $http->post(
                    $keenURL,
                    $jsonOSM,
                    ['type' => 'json']
                );*/

                if (isset($controller)) {
                    $this->Flash->error(__($error_message));

                    return $controller->redirect([ 'action' => 'link' ]);
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
                $users = TableRegistry::get('Users');

                $now = Time::now();

                $user = $users->get($authArray['user_id']);

                $user->osm_user_id = $body->userid;
                $user->osm_linkdate = $now;

                if (!isset($user->osm_linked)) {
                    $user->osm_linked = 1;
                }

                // SAVE ENTITY

                if ($users->save($user)) {
                    // KEEN IO REPORTING ENTRY

                    /*$osmEnt = [
                        'Entity Id' => null,
                        'Controller' => 'OSM',
                        'Action' => 'Link',
                        'User Id' => $this->Auth->user('id'),
                        'Creation Date' => $now,
                        'Modified' => null,
                        'OSM' => [
                            'LinkStatus' => 'Success'
                        ]
                    ];

                    $sets = TableRegistry::get('Settings');

                    $jsonOSM = json_encode($osmEnt);
                    $apiKey = $sets->get(13)->text;
                    $projectId = $sets->get(14)->text;
                    $eventType = 'Action';

                    $keenURL = 'https://api.keen.io/3.0/projects/' . $projectId . '/events/' . $eventType . '?api_key=' . $apiKey;

                    $http = new Client();
                    $response = $http->post(
                        $keenURL,
                        $jsonOSM,
                        ['type' => 'json']
                    );*/

                    if (isset($controller)) {
                        $this->Flash->success(__('You have linked your OSM account.'));
                        if (is_null($user->osm_section_id)) {
                            return $controller->redirect([ 'action' => 'section' ]);
                        } else {
                            return $controller->redirect([ 'action' => 'home' ]);
                        }
                    } else {
                        return true;
                    }
                } else {
                    $error_message = 'Unable to save user.';
                    $this->log($error_message);
                    if (isset($controller)) {
                        $this->Flash->error(__($error_message));

                        return $controller->redirect(['action' => 'link']);
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

        if (!($settingsArray = $this->getOsmSettings())) {
            $error_message = 'Error retrieving OSM settings.';
            $this->log($error_message);

            if (isset($controller)) {
                $this->Flash->error(__($error_message));

                return $controller->redirect([ 'action' => 'section' ]);
            }

            return false;
        }

        $users = TableRegistry::get('Users');
        $user = $users->get($userId, ['contain' => 'Sections.SectionTypes']);

        $secret = $this->retrieveUserSecret($userId);

        if (!is_string($secret) || is_bool($secret)) {
            $error_message = 'Error retrieving OSM User Secret.';
            $this->log($error_message);

            if (isset($controller)) {
                $this->Flash->error(__($error_message));

                return $controller->redirect([ 'action' => 'section' ]);
            }

            return false;
        }

        $http = new Client([
            'host' => $settingsArray['api_base'],
            'scheme' => 'https'
        ]);

        $url = '/api.php?action=getUserRoles';

        if (!is_int($user->osm_user_id) || $user->osm_user_id == 0) {
            $error_message = 'Error retrieving OSM User Id.';
            $this->log($error_message);

            if (isset($controller)) {
                $this->Flash->error(__($error_message));

                return $controller->redirect([ 'action' => 'link' ]);
            }

            return false;
        }

        $response = $http->post($url, [
            'userid' => $user->osm_user_id,
            'secret' => $secret,
            'token' => $settingsArray['api_token'],
            'apiid' => $settingsArray['api_id']
        ]);

        if ($response->isOk() && $response->body <> false) {
            $body = $response->json;

            $selectArray = $body;

            $sectionType = Inflector::pluralize(strtolower($user->section->section_type->section_type));

            $sectionArray = [];

            foreach ($selectArray as $key => $section) {
                if ($section['section'] == $sectionType) {
                    $sectionArray = Hash::insert($sectionArray, $section['sectionid'], $section['groupname'] . ': ' . $section['sectionname']);
                }
            }

            if (count($sectionArray) == 1 && isset($controller)) {
                $this->Flash->error(__('Only one section of section type ' . $sectionType . ' found. Section assigned.'));

                $sectionSelected = $sectionArray[0];
                $user->osm_section_id = $sectionSelected['sectionid'];
                $user->osm_linked = 2;

                if ($users->save($user)) {
                    return $controller->redirect([ 'action' => 'term' ]);
                }
            }

            return $sectionArray;
        } else {
            $error_message = 'Error Parsing OSM Response.';
            $this->log($error_message);

            if (isset($controller)) {
                $this->Flash->error(__($error_message));

                return $controller->redirect([ 'action' => 'home' ]);
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

        if (!($settingsArray = $this->getOsmSettings())) {
            $error_message = 'Error retrieving OSM settings.';
            $this->log($error_message);

            if (isset($controller)) {
                $this->Flash->error(__($error_message));

                return $controller->redirect([ 'action' => 'section' ]);
            }

            return false;
        }

        $users = TableRegistry::get('Users');
        $user = $users->get($userId, ['contain' => 'Sections.SectionTypes']);

        $secret = $this->retrieveUserSecret($userId);

        if (!is_string($secret) || is_bool($secret)) {
            $error_message = 'Error retrieving OSM User Secret.';
            $this->log($error_message);

            if (isset($controller)) {
                $this->Flash->error(__($error_message));

                return $controller->redirect([ 'action' => 'section' ]);
            }

            return false;
        }

        $http = new Client([
            'host' => $settingsArray['api_base'],
            'scheme' => 'https'
        ]);

        if (!is_int($user->osm_user_id) || $user->osm_user_id == 0) {
            $error_message = 'Error retrieving OSM User Id.';
            $this->log($error_message);

            if (isset($controller)) {
                $this->Flash->error(__($error_message));

                return $controller->redirect([ 'action' => 'link' ]);
            }

            return false;
        }

        $url = '/api.php?action=getTerms';

        $response = $http->post($url, [
            'userid' => $user->osm_user_id,
            'secret' => $secret,
            'token' => $settingsArray['api_token'],
            'apiid' => $settingsArray['api_id']
        ]);

        $now = Time::now();

        if ($response->isOk()) {
            $preBody = $response->json;
            $body = Hash::get($preBody, $user->osm_section_id);

            if (is_null($body)) {
                $error_message = 'No OSM Response Received - access confirmation required.';
                $this->log($error_message);

                if (isset($controller)) {
                    $this->Flash->error(__($error_message));

                    return $controller->redirect([ 'action' => 'access' ]);
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

                if ($users->save($user)) {
                    $successMessage = 'Your OSM Term has been set.';
                    $this->log($successMessage);

                    if (isset($controller)) {
                        $this->Flash->success(__($successMessage));
                    }

                    return true;
                } else {
                    $error_message = 'The user could not be saved. Please, try again.';
                    $this->log($error_message);

                    if (isset($controller)) {
                        $this->Flash->error(__($error_message));
                    }

                    return false;
                }
            }

            $error_message = 'More than 1 Term Applies.';
            $this->log($error_message);

            if (isset($controller)) {
                $this->Flash->error(__($error_message));
            }

            return false;
        }

        $error_message = 'There was a request error, please try again.';
        $this->log($error_message);

        if (isset($controller)) {
            $this->Flash->error(__($error_message));
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

        if (!($settingsArray = $this->getOsmSettings())) {
            $error_message = 'Error retrieving OSM settings.';
            $this->log($error_message);

            if (isset($controller)) {
                $this->Flash->error(__($error_message));

                return $controller->redirect([ 'action' => 'section' ]);
            }

            return false;
        }

        $users = TableRegistry::get('Users');
        $user = $users->get($userId, ['contain' => 'Sections.SectionTypes']);

        $secret = $this->retrieveUserSecret($userId);

        if (!is_string($secret) || is_bool($secret)) {
            $error_message = 'Error retrieving OSM User Secret.';
            $this->log($error_message);

            if (isset($controller)) {
                $this->Flash->error(__($error_message));

                return $controller->redirect([ 'action' => 'section' ]);
            }

            return false;
        }

        $http = new Client([
            'host' => $settingsArray['api_base'],
            'scheme' => 'https'
        ]);

        if (!is_int($user->osm_user_id) || $user->osm_user_id == 0) {
            $error_message = 'Error retrieving OSM User Id.';
            $this->log($error_message);

            if (isset($controller)) {
                $this->Flash->error(__($error_message));

                return $controller->redirect([ 'action' => 'link' ]);
            }

            return false;
        }

        $url = '/ext/events/summary/?action=get&sectionid=' . $user->osm_section_id . '&termid=' . $user->osm_current_term;

        $response = $http->post($url, [
            'userid' => $user->osm_user_id,
            'secret' => $secret,
            'token' => $settingsArray['api_token'],
            'apiid' => $settingsArray['api_id']
        ]);

        if ($response->isOk()) {
            $preBody = $response->json;
            $body = Hash::get($preBody, 'items');

            $events = Hash::combine($body, '{n}.eventid', '{n}.name');

            return $events;
        }

        $error_message = 'Response Error - Try again.';
        $this->log($error_message);

        if (isset($controller)) {
            $this->Flash->error(__($error_message));

            return $controller->redirect([ 'action' => 'link' ]);
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

        if (!($settingsArray = $this->getOsmSettings())) {
            $error_message = 'Error retrieving OSM settings.';
            $this->log($error_message);

            if (isset($controller)) {
                $this->Flash->error(__($error_message));

                return $controller->redirect([ 'action' => 'section' ]);
            }

            return false;
        }

        $users = TableRegistry::get('Users');
        $user = $users->get($userId, ['contain' => 'Sections.SectionTypes']);

        $secret = $this->retrieveUserSecret($userId);

        if (!is_string($secret) || is_bool($secret)) {
            $error_message = 'Error retrieving OSM User Secret.';
            $this->log($error_message);

            if (isset($controller)) {
                $this->Flash->error(__($error_message));

                return $controller->redirect([ 'action' => 'section' ]);
            }

            return false;
        }

        $http = new Client([
            'host' => $settingsArray['api_base'],
            'scheme' => 'https'
        ]);

        if (!is_int($user->osm_user_id) || $user->osm_user_id == 0) {
            $error_message = 'Error retrieving OSM User Id.';
            $this->log($error_message);

            if (isset($controller)) {
                $this->Flash->error(__($error_message));

                return $controller->redirect([ 'action' => 'link' ]);
            }

            return false;
        }

        $url = '/ext/events/event/?action=getAttendance&eventid=' . $osmEventId . '&sectionid=' . $user->osm_section_id . '&termid=' . $user->osm_current_term;

        $response = $http->post($url, [
            'userid' => $user->osm_user_id,
            'secret' => $secret,
            'token' => $settingsArray['api_token'],
            'apiid' => $settingsArray['api_id']
        ]);

        if ($response->isOk()) {
            $preBody = $response->json;
            $body = Hash::get($preBody, 'items');

            $items = [];

            foreach ($body as $item) {
                if ($item['attending'] == 'Yes') {
                    array_push($items, $item);
                }
            }

            return $items;
        }

        $error_message = 'Response Error - Try again.';
        $this->log($error_message);

        if (isset($controller)) {
            $this->Flash->error(__($error_message));

            return $controller->redirect([ 'action' => 'link' ]);
        }

        return false;
    }
}
