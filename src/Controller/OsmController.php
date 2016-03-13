<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Form\LinkForm;
use App\Form\SectionForm;

use Cake\ORM\TableRegistry;
use Cake\Network\Http\Client;
use Cake\I18n\Time;
use Cake\Utility\Hash;
use Cake\Utility\Security;


class OsmController extends AppController
{

	public function index()
	{
		return $this->redirect(['action' => 'home']);
	}	

	public function home()
	{
		$now = Time::now();
		$users = TableRegistry::get('Users');

		$user = $users->get($this->Auth->user('id'));

		if ($user->osm_user_id > 0)
		{
			$linked = 1;
		} else {
			$linked = 0;
		}

		if ($user->osm_section_id > 0)
		{
			$sectionSet = 1;
		} else {
			$sectionSet = 0;
		}

		if ($user->osm_current_term > 0 && $user->osm_term_end > $now)
		{
			$termCurrent = 1;
		} else {
			$termCurrent = 0;
		}

		$this->set(compact('linked', 'sectionSet', 'termCurrent'));
	}

	public function link()
	{
		$settings = TableRegistry::get('Settings');
		$users = TableRegistry::get('Users');
		
		$linkForm = new LinkForm();
		$session = $this->request->session();
		
		$user = $users->get($this->Auth->user('id'));

		if ($this->request->is('post'))
		{
			$now = Time::now();

			$api_id = $settings->get('10')->text;
			$api_token = $settings->get('11')->text;
			$api_base = $settings->get('12')->text;

			$user_email = $this->request->data['osm_email'];//'jacob%404thletchworth.com';
			$user_password = $this->request->data['osm_password'];//'Rho9Sigma';

			/*$hashed = Security::hash('$user_password', 'sha256', true);
			//$hashed = substr($hashed,5 , 32);
			$encrypted = Security::encrypt($hashed, $api_token);

			$session->write('OSM.PWHash', $encrypted);*/

			$http = new Client([
			  'host' => $api_base,
			  'scheme' => 'https'
			]);

			$url = '/users.php?action=authorise';

			$response = $http->post($url, [
				'password' => $user_password, 
				'email' => $user_email, 
				'token' => $api_token, 
				'apiid' => $api_id
			]);


			if ($response->isOk())
			{
				$body = $response->body;
				if ($body == '{"error":"Incorrect password - you have 5 more attempts before your account is locked for 15 minutes."}')
				{
					$this->Flash->error(__('Incorrect password - OSM will lock your account after 5 attempts.'));

					// KEEN IO REPORTING ENTRY

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
					$api_key = $sets->get(13)->text;
					$projectId = $sets->get(14)->text;
					$eventType = 'Action';
					
					$keenURL = 'https://api.keen.io/3.0/projects/' . $projectId . '/events/' . $eventType . '?api_key=' . $api_key;
					
					$http = new Client();
					$response = $http->post(
					  $keenURL,
					  $jsonOSM,
					  ['type' => 'json']
					);

					return $this->redirect(['action' => 'link']);
				} else {

					$user_osm_id = str_replace("\"", "", substr($body, -8, 7));

					/*if ($session->check('OSM.PWHash')) {

						// Receive Password to Encrypt Secret
					    $pwHash = $session->read('OSM.PWHash');
					    $pw = Security::decrypt($pwHash, $api_token);

					    if ($pw == false) {
					    	$this->Flash->error(__('There was a magic error.'));
					    } else {
					    	// Use Password to Encrypt Secret*/
					    	$user_osm_secret = str_replace("\"", "", substr($body, 10, 34));
					    	/*$user_osm_secret = Security::encrypt($usr_osm_secret, $pwHash);
					    }					    
					}*/

					if (isset($user->osm_linked))
					{
						$osmLink = ['osm_user_id' => $user_osm_id, 'osm_secret' => $user_osm_secret, 'osm_linkdate' => $now];
					} else {
						$osmLink = ['osm_user_id' => $user_osm_id, 'osm_secret' => $user_osm_secret, 'osm_linked' => 1, 'osm_linkdate' => $now];
					}

					$users->patchEntity($user, $osmLink);

					// SAVE ENTITY

		            if ($users->save($user)) {
		                $this->Flash->success(__('You have linked your OSM account.'));

		                // KEEN IO REPORTING ENTRY

		                $osmEnt = [
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
		                $api_key = $sets->get(13)->text;
		                $projectId = $sets->get(14)->text;
		                $eventType = 'Action';
		                
		                $keenURL = 'https://api.keen.io/3.0/projects/' . $projectId . '/events/' . $eventType . '?api_key=' . $api_key;
		                
		                $http = new Client();
		                $response = $http->post(
		                  $keenURL,
		                  $jsonOSM,
		                  ['type' => 'json']
		                );

		                return $this->redirect(['action' => 'section']);
		            } else {
		                $this->Flash->error(__('The user could not be saved. Please, try again.'));
		            }
				}				
			} else {
				$this->Flash->error(__('There was a request error, please try again.'));
				return $this->redirect(['action' => 'link']);
			}
		}

		$this->set(compact('linkForm'));
	}

	public function section()
	{
		$settings = TableRegistry::get('Settings');
		$users = TableRegistry::get('Users');

		$sectionForm = new SectionForm();
		$session = $this->request->session();


		$user = $users->get($this->Auth->user('id'));

		if ($this->request->is('get'))
		{
			$now = Time::now();

			$api_id = $settings->get('10')->text;
			$api_token = $settings->get('11')->text;
			$api_base = $settings->get('12')->text;

			$user_osm_id = $user->osm_user_id;
			$user_osm_secret = $user->osm_secret;

			if (is_null($user_osm_secret)) {
				$this->Flash->error(__('Please link your account first'));
				return $this->redirect(['action' => 'link']);
			} /*elseif (!$session->check('OSM.PWHash')) {
				$this->Flash->error(__('Please enter your password again as it is not stored.'));
				return $this->redirect(['action' => 'link']);
			} else {

				// Receive Password to Decrypt Secret
			    $pwHash = $session->read('OSM.PWHash');
			    $pw = Security::decrypt($pwHash, $api_token);

			    // Use Password to Decrypt Secret
			    $decr_osm_secret = Security::decrypt($user_osm_secret, $pwHash);
			    if ($decr_osm_secret != false) {
			    	$secret = $decr_osm_secret;
			    } else {
			    	$this->Flash->error(__('There was a magic error.'));
			    }
			}*/

			$http = new Client([
			  'host' => $api_base,
			  'scheme' => 'https'
			]);

			$url = '/api.php?action=getUserRoles';

			$response = $http->post($url, [
				'userid' => $user_osm_id, 
				'secret' => $user_osm_secret, 
				'token' => $api_token, 
				'apiid' => $api_id
			]);


			if ($response->isOk())
			{
				$body = $response->json;

				$this->set(compact('body'));
				
				$body = Hash::remove($body, '{n}.sectionConfig');
				$body = Hash::remove($body, '{n}.permissions');

				$hsec = Hash::combine($body, '{n}.sectionid', '{n}.sectionname');

				$this->set(compact('hsec'));

			} else {
				$this->Flash->error(__('There was a request error, please try again.'));
				return $this->redirect(['action' => 'home']);
			}
		}

		if ($this->request->is('post'))
		{
			$osm_section = $this->request->data['osm_section'];

			$usr_data = ['osm_section_id' => $osm_section, 'osm_linked' => 2];

			$users->patchEntity($user, $usr_data);

            if ($users->save($user)) {
                $this->Flash->success(__('You have selected your OSM section.'));
                return $this->redirect(['action' => 'term']);
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
		}

		$this->set(compact('sectionForm'));
	} 

	public function term()
	{
		$settings = TableRegistry::get('Settings');
		$users = TableRegistry::get('Users');

		$user = $users->get($this->Auth->user('id'));

		$now = Time::now();

		$api_id = $settings->get('10')->text;
		$api_token = $settings->get('11')->text;
		$api_base = $settings->get('12')->text;

		$user_osm_id = $user->osm_user_id;
		$user_osm_secret = $user->osm_secret;
		$user_osm_section = $user->osm_section_id;

		if (is_null($user_osm_secret)) {
			$this->Flash->error(__('Please link your account first'));
			return $this->redirect(['action' => 'link']);
		} elseif (is_null($user->osm_section_id))
		{
			$this->Flash->error(__('Please set your section first'));
			return $this->redirect(['action' => 'section']);
		}

		$http = new Client([
		  'host' => $api_base,
		  'scheme' => 'https'
		]);

		$url = '/api.php?action=getTerms';

		$response = $http->post($url, [
			'userid' => $user_osm_id, 
			'secret' => $user_osm_secret, 
			'token' => $api_token, 
			'apiid' => $api_id
		]);


		if ($response->isOk())
		{
			$body = $response->json;

			$others = '[{n}!=' . $user->osm_section_id . ']';

			$body = Hash::remove($body, $others);

			$terms = Hash::combine($body, '{n}.termid', ['%s: %s: %s','{n}.past', '{n}.enddate', '{n}.startdate']);

			$term = Hash::extract($terms, '{n}.[past=/false/');
		
			$term_end = 12; //$term->enddate;
			$term_start = 12; //$term->startdate;

			$usr_data = ['osm_current_term' => $term, 'osm_term_end' => $term_end, 'osm_linked' => 3];

			$users->patchEntity($user, $usr_data);

	        if ($users->save($user)) {
	            $this->Flash->success(__('Your OSM Term has been set.'));
	            return $this->redirect(['action' => 'home']);
	        } else {
	            $this->Flash->error(__('The user could not be saved. Please, try again.'));
	            return $this->redirect(['action' => 'home']);
	        }
        } else {
			$this->Flash->error(__('There was a request error, please try again.'));
			return $this->redirect(['action' => 'home']);
		}
	}

		public function sync()
		{
			$settings = TableRegistry::get('Settings');
			$users = TableRegistry::get('Users');
			$atts = TableRegistry::get('Attendees');

			$session = $this->request->session();

			$user = $users->get($this->Auth->user('id'));

			$now = Time::now();

			$api_id = $settings->get('10')->text;
			$api_token = $settings->get('11')->text;
			$api_base = $settings->get('12')->text;

			$user_osm_id = $user->osm_user_id;
			$user_osm_secret = $user->osm_secret;
			$user_osm_section = $user->osm_section_id;
			$user_osm_term = $user->osm_current_term;

			if (is_null($user_osm_secret)) {
				$this->Flash->error(__('Please link your account first'));
				return $this->redirect(['action' => 'link']);
			} /*elseif (!$session->check('OSM.PWHash')) {
				$this->Flash->error(__('Please enter your password again as it is not stored.'));
				return $this->redirect(['action' => 'link']);
			} else {

				// Receive Password to Decrypt Secret
			    $pwHash = $session->read('OSM.PWHash');
			    $pw = Security::decrypt($pwHash, $api_token);

			    // Use Password to Decrypt Secret
			    $decr_osm_secret = Security::decrypt($user_osm_secret, $pwHash);
			    if ($decr_osm_secret != false) {
			    	$secret = $decr_osm_secret;
			    } else {
			    	$this->Flash->error(__('There was a magic error.'));
			    }
			}*/

			$http = new Client([
			  'host' => $api_base,
			  'scheme' => 'https'
			]);

			$url = '/ext/members/contact/'
				. '?action=getListOfMembers&sort=lastname' 
				. '&sectionid=' . $user_osm_section 
				. '&termid=' . $user_osm_term
				. '&section=cubs';

			$response = $http->post($url, [
				'userid' => $user_osm_id, 
				'secret' => $user_osm_secret, 
				'token' => $api_token, 
				'apiid' => $api_id
			]);


			if ($response->isOk())
			{
				$body = $response->json;
				
				$cubs = Hash::extract($body, 'items');
				$cubs = Hash::normalize($cubs);

				foreach ($cubs as $cub) {

					if ($cub->active == true) {
						$cub_data = [
							'firstname' => $cub->firstname,
							'lastname' => $cub->lastname,
							'osm_id' => $cub->scoutid,
							'user_id' => $user->id,
							'scoutgroup_id' => $user->scoutgroup_id,
							'dateofbirth' => '01/01/2016',
							'osm_generated' => true];

						$atts->newEntity($att, $cub_data);

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

				return $this->redirect(['action' => 'home']);
			} else {
				$this->Flash->error(__('There was a request error, please try again.'));
				return $this->redirect(['action' => 'home']);
			}
		}
}