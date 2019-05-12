<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\I18n\FrozenTime;
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
        $this->Tokens = TableRegistry::getTableLocator()->get('Tokens');
        $this->Users = $this->Tokens->EmailSends->Users;
        $this->NotificationTypes = TableRegistry::getTableLocator()->get('NotificationTypes');

        /** @var \App\Model\Entity\User $user */
        $user = $this->Users->get($userId);

        $now = FrozenTime::now();

        $notificationType = $this->NotificationTypes->find()->where(['notification_type' => 'Password Reset'])->first();
        $notificationTypeId = $notificationType->id;

        $data = [
            'token' => 'Password Reset Token for ' . $user->full_name,
            'email_send' => [
                'sent' => $now,
                'user_id' => $user->id,
                'subject' => 'Password Reset for ' . $user->full_name,
                'notification_type_id' => $notificationTypeId,
                'notification' => [
                    'notification_header' => 'User Password Reset',
                    'notification_type_id' => $notificationTypeId,
                    'user_id' => $user->id,
                    'new' => true,
                    'notification_source' => 'User',
                    'text' => 'User Password Reset Email Sent for user ' . $user->full_name,
                ]
            ],
            'token_header' => [
                'redirect' => [
                    'controller' => 'Users',
                    'action' => 'token',
                    'prefix' => false,
                ],
                'authenticate' => false,
            ]
        ];

        $tokenEntity = $this->Tokens->newEntity($data);
        debug($tokenEntity);

        if ($this->Tokens->save($tokenEntity, ['associated' => 'EmailSends.Notifications'])) {
            $tokenId = $tokenEntity->get('id');

            $token = $this->Tokens->buildToken($tokenId);

            $this->getMailer('User')->send('passwordReset', [$user, $token]);

            return true;
        }

        return false;
    }
}
