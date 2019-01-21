<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\I18n\Time;
use Cake\Mailer\MailerAwareTrait;
use Cake\ORM\TableRegistry;

/**
 * Password component
 *
 * @property \App\Model\Table\TokensTable $Tokens
 * @property \App\Model\Table\NotificationTypesTable $NotificationTypes
 * @property \App\Model\Table\UsersTable $Users
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
     * @param int $userId The User ID to be Reset.
     *
     * @return bool
     */
    public function sendReset($userId)
    {
        $this->Users = TableRegistry::getTableLocator()->get('Users');
        $this->Tokens = TableRegistry::getTableLocator()->get('Tokens');
        $this->NotificationTypes = TableRegistry::getTableLocator()->get('NotificationTypes');

        $user = $this->Users->get($userId);

        $now = Time::now();

        $notification_type = $this->NotificationTypes->find()->where(['notification_type' => 'Password Reset'])->first();
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
                    'notification_header' => 'User Password Reset',
                    'notification_type_id' => $notification_type_id,
                    'user_id' => $user->id,
                    'new' => true,
                    'notification_source' => 'User',
                    'text' => 'User Password Reset Email Sent for user ' . $user->full_name,
                ]
            ]
        ];

        $tokenEntity = $this->Tokens->newEntity($data);

        if ($this->Tokens->save($tokenEntity, ['associated' => 'EmailSends.Notifications'])) {
            $tokenId = $tokenEntity->get('id');

            $token = $this->Tokens->buildToken($tokenId);

            $this->getMailer('User')->send('passwordReset', [$user, $token]);

            return true;
        }

        return false;
    }
}
