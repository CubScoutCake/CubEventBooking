<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\I18n\Time;
use Cake\Mailer\MailerAwareTrait;
use Cake\ORM\TableRegistry;

/**
 * Password component
 */
class PasswordComponent extends Component
{
    public $components = ['Flash'];

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    use MailerAwareTrait;

    /**
     * Generate a Password Reset Token and Dispatch the Email.
     *
     * @param $userId
     *
     * @return bool
     */
    public function sendReset($userId)
    {
        $users = TableRegistry::get('Users');
        $tokens = TableRegistry::get('Tokens');
        $notificationTypes = TableRegistry::get('NotificationTypes');

        $user = $users->get($userId);

        $now = Time::now();

        $notification_type = $notificationTypes->findByNotificationType('Password Reset')->first();
        $notification_type_id = $notification_type->id;

        $data = [
            'token' => 'Password Reset Token for ' . $user->full_name,
            'user_id' => $user->id,
            'email_send' => [
                'sent' => $now,
                'user_id' => $user->id,
                'subject' => 'Password Reset for ' . $user->full_name,
                'notification_type_id' => $notification_type_id,
                'notification' => [
                    'notification_header' => 'User Password Reset'
                ]
            ]
        ];

        $tokenEntity = $tokens->newEntity($data);

        if ($tokens->save($tokenEntity, ['associated' => 'EmailSends.Notifications'])) {

            $tokenId = $tokenEntity->get('id');

            $tokens = TableRegistry::get('Tokens');
            $token = $tokens->buildToken($tokenId);

            $this->getMailer('User')->send('passwordReset', [$user, $token]);

            return true;
        }

        return false;
    }


}
