<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\Core\Configure;
use Cake\Http\Client;
use Cake\I18n\Time;

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

	public function linkUser($authArray = null) {


		$apiId = Configure::readOrFail('OSM.api_id');
		$apiToken = Configure::readOrFail('OSM.api_token');
		$apiBase = Configure::readOrFail('OSM.api_base');

		$http = new Client([
			'host' => $apiBase,
			'scheme' => 'https'
		]);

		$url = '/users.php?action=authorise';

		$response = $http->post($url, [
			'password' => $authArray['osm_password'],
			'email' => $authArray['osm_email'],
			'token' => $apiToken,
			'apiid' => $apiId,
		]);

		if ($response->isOk()) {
			return true;
		}
			/*$body = $response->body;
			if ($body == '{"error":"Incorrect password - you have 5 more attempts before your account is locked for 15 minutes."}') {
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

				return $this->redirect(['action' => 'link']);
			} else {
				$userOsmId = str_replace("\"", "", substr($body, -8, 7));

				// Store Secret in Session
				$osmSecret = str_replace("\"", "", substr($body, 10, 34));
				$userOsmSecret = substr($osmSecret, 0, 17);
				$sessionOsmSecret = substr($osmSecret, 17);

				if (isset($user->osm_linked)) {
					$osmLink = ['osm_user_id' => $userOsmId, 'osm_secret' => $userOsmSecret, 'osm_linkdate' => $now];
				} else {
					$osmLink = ['osm_user_id' => $userOsmId, 'osm_secret' => $userOsmSecret, 'osm_linked' => 1, 'osm_linkdate' => $now];
				}

				$session->write('OSM.Secret', $sessionOsmSecret);

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

					if (is_null($user->osm_section_id)) {
						return $this->redirect(['action' => 'section']);
					} else {
						return $this->redirect(['action' => 'home']);
					}
				} else {
					$this->Flash->error(__('The user could not be saved. Please, try again.'));
				}
			}*/
	}
}
