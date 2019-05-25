<?php

namespace App\Mailer;

use Cake\Mailer\Mailer;

class BasicMailer extends Mailer
{
    /**
     * @param \App\Model\Entity\EmailSend $emailSend The Email Send Entity
     * @param string|null $token The Encoded Token to be sent.
     *
     * @return void
     */
    public function basic($emailSend, $token = null)
    {
        $this
            ->setTo($emailSend->user->email, $emailSend->user->full_name)
            ->setLayout('default')
            ->setTransport('sparkpost')
            ->setEmailFormat('both')
            ->setSender('info@hertscubs.uk', 'HertsCubs County Cub Team')
            ->setHelpers(['Html', 'Text', 'Time'])
            ->setTemplate($emailSend->email_template)
            ->setSubject($emailSend->subject);

        if (isset($token) && !is_null($token)) {
            $this->setViewVars([
                'emailSend' => $emailSend,
                'token' => $token,
            ]);
        } else {
            $this->setViewVars([
                'emailSend' => $emailSend
            ]);
        }
    }
}
