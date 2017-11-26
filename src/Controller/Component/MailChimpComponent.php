<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;

/**
 * MailChimp component
 */
class MailChimpComponent extends Component
{

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    /**
     * @param null $subscriptionArray Array The array for Subscribing.
     * @return bool
     */
    public function subscribeArray($subscriptionArray = null)
    {
        if (!isset($subscriptionArray)) {
            return false;
        }
    }

    /**
     * @param null $userId int UserId for the user to be subscribed.
     * @return bool
     */
    public function subscribeUser($userId = null)
    {
        if (!isset($userId)) {
            return false;
        }

        $api_key = $this->getConfig('OSM.api_key');
    }
}
