<?php
// Create the file src/Mailer/Preview/UserMailPreview.php
namespace App\Mailer\Preview;

use DebugKit\Mailer\MailPreview;

class UserMailPreview extends MailPreview
{
    public function welcome()
    {
        $this->loadModel('Users');
        $user = $this->Users->find()->first();
        return $this->getMailer('User')
            ->welcome($user)
            ->set(['activationToken' => 'dummy-token']);
    }

    public function passres()
    {
        $this->loadModel('Users');
        $user = $this->Users->find()->first();
        $token = 'abcstringtokencba';
        return $this->getMailer('User')
            ->passres($user, $token);
            //->set(['activationToken' => 'dummy-token']);
    }
}