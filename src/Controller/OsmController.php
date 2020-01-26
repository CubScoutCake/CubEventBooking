<?php
declare(strict_types=1);

namespace App\Controller;

use App\Form\LinkForm;
use App\Form\SectionForm;
use Cake\I18n\Time;
use Cake\Network\Http\Client;
use Cake\ORM\TableRegistry;
use Cake\Utility\Hash;

/**
 * Class OsmController
 *
 * @package App\Controller
 *
 * @property \App\Controller\Component\ScoutManagerComponent $ScoutManager
 */
class OsmController extends AppController
{
    /**
     * @throws \Exception
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('ScoutManager');
    }

    /**
     * @return \Cake\Http\Response
     */
    public function index()
    {
        return $this->redirect(['action' => 'home']);
    }

    /**
     * @return \Cake\Http\Response|void
     */
    public function home()
    {
        $checkArray = $this->ScoutManager->checkOsmStatus($this->Auth->user('id'));

        $this->set('linked', $checkArray['linked']);
        $this->set('sectionSet', $checkArray['sectionSet']);
        $this->set('termCurrent', $checkArray['termCurrent']);
        $this->set('synced', $checkArray['attendee_count']);
    }

    /**
     * @return \Cake\Http\Response|void
     */
    public function link()
    {
        $linkForm = new LinkForm();

        if ($this->request->is('post')) {
            $linkArray = [
                'osm_email' => $this->request->getData('osm_email'),
                'osm_password' => $this->request->getData('osm_password'),
                'user_id' => $this->Auth->user('id'),
            ];

            $linked = $this->ScoutManager->linkUser($linkArray);

            if ($linked) {
                $this->redirect(['action' => 'home']);
            } else {
                $this->redirect(['action' => 'link']);
            }
        }
        $this->set(compact('linkForm'));
    }

    /**
     * Select OSM Section.
     *
     * @return \Cake\Http\Response|null
     */
    public function section()
    {
        $checkArray = $this->ScoutManager->checkOsmStatus($this->Auth->user('id'));

        if (!$checkArray['linked']) {
            $this->Flash->error(__('Please link your account first'));

            return $this->redirect(['action' => 'link']);
        }

        $sectionForm = new SectionForm();

        $now = Time::now();

        if ($this->request->is('get')) {
            $sections = $this->ScoutManager->getSectionIds($this->Auth->user('id'));

            if (!is_array($sections)) {
                $this->Flash->error(__('There was a request error, please try again.'));

                return $this->redirect(['action' => 'home']);
            }

            $this->set(compact('sections'));
        }

        if ($this->request->is('post')) {
            $osmSection = $this->request->getData('osm_section');

            $users = TableRegistry::get('Users');
            $user = $users->get($this->Auth->user('id'));

            $user->osm_section_id = $osmSection;
            $user->osm_linked = 2;

            if ($users->save($user)) {
                $this->Flash->success(__('You have selected your OSM section.'));
                if (!empty($user->osm_current_term) && $user->osm_term_end > $now) {
                    return $this->redirect(['action' => 'home']);
                } else {
                    return $this->redirect(['action' => 'term']);
                }
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }

        $this->set(compact('sectionForm'));
    }

    /**
     * Set OSM Terms.
     *
     * @return \Cake\Http\Response|null
     */
    public function term()
    {
        $checkArray = $this->ScoutManager->checkOsmStatus($this->Auth->user('id'));

        if (!$checkArray['linked']) {
            $this->Flash->error(__('Please link your account first'));

            return $this->redirect(['action' => 'link']);
        }

        if (!$checkArray['sectionSet']) {
            $this->Flash->error(__('Please set your section first'));

            return $this->redirect(['action' => 'section']);
        }

        $terms = $this->ScoutManager->setTerm($this->Auth->user('id'));

        if ($terms) {
            return $this->redirect(['action' => 'home']);
        }

        return $this->redirect(['action' => 'home']);
    }

    /**
     * Sync OSM Users
     *
     * @return \Cake\Http\Response|void
     *
     * @throws \Exception
     */
    public function sync()
    {
        $settings = TableRegistry::get('Settings');
        $users = TableRegistry::get('Users');
        $atts = TableRegistry::get('Attendees');

        $session = $this->request->session();

        $user = $users->get($this->Auth->user('id'));

        $now = Time::now();

        $apiId = $settings->get('10')->text;
        $apiToken = $settings->get('11')->text;
        $apiBase = $settings->get('12')->text;

        if (empty($user->osm_secret) || !$session->check('OSM.Secret')) {
            $this->Flash->error(__('Please link your account first'));

            return $this->redirect(['action' => 'link']);
        } elseif (empty($user->osm_section_id)) {
            $this->Flash->error(__('Please select your section first'));

            return $this->redirect(['action' => 'section']);
        } elseif (empty($user->osm_current_term) && $user->osm_term_end > $now) {
            $this->Flash->error(__('Please choose your Term first'));

            return $this->redirect(['action' => 'term']);
        } else {
            $userOsmId = $user->osm_user_id;
            $userOsmSecret = $user->osm_secret . $session->read('OSM.Secret');
            $userOsmSection = $user->osm_section_id;
            $userOsmTerm = $user->osm_current_term;
        }

        if (!isset($successCnt)) {
            $successCnt = 0;
        }

        if (!isset($errCnt)) {
            $errCnt = 0;
        }

        $http = new Client([
          'host' => $apiBase,
          'scheme' => 'https',
        ]);

        $url = '/ext/members/contact/grid/' . '?action=getMembers';

        $response = $http->post($url, [
            'userid' => $userOsmId,
            'secret' => $userOsmSecret, //$user_osm_secret,
            'token' => $apiToken,
            'apiid' => $apiId,
            'section_id' => $userOsmSection,
            'term_id' => $userOsmTerm,
        ]);

        if ($response->isOk()) {
            $preBody = $response->json;
            //Debugger::dump($preBody);

            $status = Hash::get($preBody, 'status');

            if ($status == false) {
                $error = Hash::get($preBody, 'error');

                $message = Hash::get($error, 'message');

                $this->Flash->error(__($message . ' Please see instructions for granting access in OSM.'));

                return $this->redirect(['action' => 'access']);
            }

            $cubs = Hash::get($preBody, 'data');
            //Debugger::dump($cubs);

            //$cubs = Hash::extract($body, 'items');
            //$cubs = Hash::normalize($cubs);

            foreach ($cubs as $cub) {
                $active = Hash::get($cub, 'active');

                if ($active == true) {
                    //Debugger::dump($cub);

                    $firstname = Hash::get($cub, 'first_name');
                    $lastname = Hash::get($cub, 'last_name');
                    $osmId = Hash::get($cub, 'member_id');
                    $dateofbirth = Hash::get($cub, 'date_of_birth');
                    //$dateofbirth = Time::parse($dateofbirth);

                    $patrol = Hash::get($cub, 'patrol');

                    //Debugger::dump($patrol);

                    $customData = Hash::get($cub, 'custom_data');

                    if ($patrol == 'Leaders') {
                        $roleId = 19;

                        $address = Hash::get($customData, 6);
                        $phoneAddress = Hash::get($customData, 6);
                    } else {
                        $roleId = 1;

                        $address = Hash::get($customData, 1);
                        $phoneAddress = Hash::get($customData, 1);
                    }

                    // Debugger::dump($customData);

                    $address1 = Hash::get($address, 7);
                    $address2 = Hash::get($address, 8);
                    $city = Hash::get($address, 9);
                    $county = Hash::get($address, 10);
                    $postcode = Hash::get($address, 11);

                    if (empty($address1) && empty($address2) && empty($city) && empty($county) && empty($postcode)) {
                        $address = Hash::get($customData, 1);

                        $address1 = Hash::get($address, 7);
                        $address2 = Hash::get($address, 8);
                        $city = Hash::get($address, 9);
                        $county = Hash::get($address, 10);
                        $postcode = Hash::get($address, 11);

                        if (empty($address1) && empty($address2) && empty($city) && empty($county) && empty($postcode)) {
                            $address = Hash::get($customData, 2);

                            $address1 = Hash::get($address, 7);
                            $address2 = Hash::get($address, 8);
                            $city = Hash::get($address, 9);
                            $county = Hash::get($address, 10);
                            $postcode = Hash::get($address, 11);

                            if (empty($address1) && empty($address2) && empty($city) && empty($county) && empty($postcode)) {
                                $address = Hash::get($customData, 3);

                                $address1 = Hash::get($address, 7);
                                $address2 = Hash::get($address, 8);
                                $city = Hash::get($address, 9);
                                $county = Hash::get($address, 10);
                                $postcode = Hash::get($address, 11);

                                if (empty($address1) && empty($address2) && empty($city) && empty($county) && empty($postcode)) {
                                    $address = Hash::get($customData, 6);

                                    $address1 = Hash::get($address, 7);
                                    $address2 = Hash::get($address, 8);
                                    $city = Hash::get($address, 9);
                                    $county = Hash::get($address, 10);
                                    $postcode = Hash::get($address, 11);
                                }
                            }
                        }
                    }

                    $address1 = trim($address1);
                    $address2 = trim($address2);
                    $city = trim($city);
                    $county = trim($county);
                    $postcode = trim($postcode);

                    if (empty($city)) {
                        $city = $address2;
                        $address2 = null;
                    }

                    if (strtoupper($city) == 'HERTS' || strtoupper($city) == 'HERTFORDSHIRE') {
                        $county = $city;
                        $city = $address2;
                        $address2 = null;
                    }

                    if (strtoupper($county) == 'HERTS') {
                        $county = ucwords(strtolower('HERTFORDSHIRE'));
                    }

                    if (empty($county)) {
                        $county = ucwords(strtolower('HERTFORDSHIRE'));
                    }

                    $postcode = str_replace(' ', '', $postcode);
                    $postcode = str_replace('-', '', $postcode);
                    $postcode = str_replace('/', '', $postcode);
                    $postcode = str_replace('.', '', $postcode);
                    $postcode = str_replace(',', '', $postcode);
                    $postcode = substr($postcode, 0, -3) . ' ' . substr($postcode, -3);

                    // GET TELEPHONE VALUES

                    $phone1 = Hash::get($phoneAddress, 18);
                    $phone2 = Hash::get($phoneAddress, 20);

                    if (empty($phone1) && empty($phone2)) {
                        $phoneAddress = Hash::get($customData, 1);

                        $phone1 = Hash::get($phoneAddress, 18);
                        $phone2 = Hash::get($phoneAddress, 20);

                        if (empty($phone1) && empty($phone2)) {
                            $phoneAddress = Hash::get($customData, 2);

                            $phone1 = Hash::get($phoneAddress, 18);
                            $phone2 = Hash::get($phoneAddress, 20);

                            if (empty($phone1) && empty($phone2)) {
                                $phoneAddress = Hash::get($customData, 3);

                                $phone1 = Hash::get($phoneAddress, 18);
                                $phone2 = Hash::get($phoneAddress, 20);

                                if (empty($phone1) && empty($phone2)) {
                                    $phoneAddress = Hash::get($customData, 6);

                                    $phone1 = Hash::get($phoneAddress, 18);
                                    $phone2 = Hash::get($phoneAddress, 20);
                                }
                            }
                        }
                    }

                    $phone1 = trim($phone1);
                    $phone2 = trim($phone2);

                    if (empty($phone1) && empty($phone2)) {
                        $phone1 = 0700;
                    } elseif (empty($phone1)) {
                        $phone1 = $phone2;
                        $phone2 = null;
                    }

                    $phone1 = str_replace(' ', '', $phone1);
                    $phone1 = str_replace('-', '', $phone1);
                    $phone1 = str_replace('/', '', $phone1);
                    $phone1 = str_replace('+44', '0', $phone1);
                    $phone1 = substr($phone1, 0, 5) . ' ' . substr($phone1, 5);

                    if (!empty($phone2)) {
                        $phone2 = str_replace(' ', '', $phone2);
                        $phone2 = str_replace('-', '', $phone2);
                        $phone2 = str_replace('/', '', $phone2);
                        $phone2 = str_replace('+44', '0', $phone2);
                        $phone2 = substr($phone2, 0, 5) . ' ' . substr($phone2, 5);

                        if ($phone1 == $phone2) {
                            $phone2 = null;
                        }
                    }

                    //Debugger::dump($address);

                    $attsName = $atts->find('all')->where(['firstname' => $firstname, 'lastname' => $lastname, 'user_id' => $user->id]);

                    $attsID = $atts->find('all')->where(['osm_id' => $osmId, 'user_id' => $user->id]);

                    $count = MAX($attsID->count(), $attsName->count());

                    if ($count == 1) {
                        if ($attsID->count() == 1) {
                            $att = $attsID->first();
                        } else {
                            $att = $attsName->first();
                        }

                        $cubData = [
                            'osm_id' => $osmId,
                            'dateofbirth' => $dateofbirth,
                            'address_1' => ucwords(strtolower($address1)),
                            'address_2' => ucwords(strtolower($address2)),
                            'city' => ucwords(strtolower($city)),
                            'county' => ucwords(strtolower($county)),
                            'postcode' => strtoupper($postcode),
                            'phone' => strtoupper($phone1),
                            'phone2' => strtoupper($phone2),
                            'osm_sync_date' => $now,
                            'deleted' => null,
                        ];
                    } else {
                        $att = $atts->newEntity();

                        $cubData = [
                            'firstname' => ucwords(strtolower($firstname)),
                            'lastname' => ucwords(strtolower($lastname)),
                            'osm_id' => $osmId,
                            'user_id' => $user->id,
                            'scoutgroup_id' => $user->scoutgroup_id,
                            'dateofbirth' => $dateofbirth,
                            'role_id' => $roleId,
                            'osm_generated' => true,
                            'address_1' => ucwords(strtolower($address1)),
                            'address_2' => ucwords(strtolower($address2)),
                            'city' => ucwords(strtolower($city)),
                            'county' => ucwords(strtolower($county)),
                            'postcode' => strtoupper($postcode),
                            'phone' => strtoupper($phone1),
                            'phone2' => strtoupper($phone2),
                            'osm_sync_date' => $now,
                        ];
                    }

                    $att = $atts->patchEntity($att, $cubData);

                    if ($atts->save($att)) {
                        $successCnt = $successCnt + 1;
                    } else {
                        $errCnt = $errCnt + 1;
                    }
                }
            }

            if (isset($errCnt) && $errCnt > 0) {
                $this->Flash->error(__('There were ' . $errCnt . ' records which did not sync, please try again.'));
            }

            if (isset($successCnt) && $successCnt > 0) {
                $this->Flash->success(__('Synced ' . $successCnt . ' records sucessfully.'));
            }

            $osmEnt = [
                'Entity Id' => null,
                'Controller' => 'OSM',
                'Action' => 'Sync',
                'User Id' => $this->Auth->user('id'),
                'Creation Date' => $now,
                'Modified' => null,
                'OSM' => [
                    'ErrorNumber' => $errCnt,
                    'SuccessNumber' => $successCnt,
                    ],
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
            );

            return $this->redirect(['action' => 'home']);
        } else {
            $this->Flash->error(__('There was a request error, please try again.'));

            return $this->redirect(['action' => 'home']);
        }
    }
}
