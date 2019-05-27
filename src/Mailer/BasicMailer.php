<?php

namespace App\Mailer;

use Cake\Mailer\Mailer;

class BasicMailer extends Mailer
{
    /**
     * @param \App\Model\Entity\EmailSend $emailSend The Email Send Entity
     * @param string|null $token The Encoded Token to be sent.
     * @param \Cake\ORM\Entity|null $entity The Subject Entity
     *
     * @return void
     */
    public function basic($emailSend, $token = null, $entity = null)
    {
        debug('basic');
        $this
            ->setTo($emailSend->user->email, $emailSend->user->full_name)
            ->setLayout('default')
            ->setTransport('sparkpost')
            ->setEmailFormat('both')
            ->setSender('info@hertscubs.uk', 'HertsCubs County Cub Team')
            ->setHelpers(['Html', 'Text', 'Time'])
            ->addHeaders([
                'X-Email-Gen-Code' => $emailSend->email_generation_code,
                'X-Gen-ID' => $emailSend->id,
            ])
            ->setTemplate($emailSend->email_template)
            ->setSubject($emailSend->subject);

        $viewVars = ['emailSend' => $emailSend];

        if (isset($token) && !is_null($token)) {
            $viewVars = array_merge($viewVars, ['token' => $token]);
        }

        if (isset($entity) && !is_null($entity)) {
            $viewVars = array_merge($viewVars, ['entity' => $entity]);
        }

        $this->setViewVars($viewVars);
    }
}
