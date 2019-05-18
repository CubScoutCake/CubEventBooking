<?php

namespace App\Mailer;

use App\Model\Entity\Notification;
use App\Model\Entity\Scoutgroup;
use App\Model\Entity\User;
use Cake\Core\Configure;
use Cake\Mailer\Email;
use Cake\Mailer\Mailer;
use Cake\ORM\Entity;

class ReserveMailer extends Mailer
{
    /**
     * @param \App\Model\Entity\EmailSend $emailSend The Email Send Entity
     *
     * @return void
     */
    private function basic($emailSend)
    {
        $this
            ->setTo($emailSend->user->email, $emailSend->user->full_name)
            ->setLayout('default')
            ->setTransport('sparkpost')
            ->setEmailFormat('both')
            ->setSender('info@hertscubs.uk', 'HertsCubs County Cub Team')
            ->setHelpers(['Html', 'Text', 'Time']);
    }

    /**
     * @param \App\Model\Entity\EmailSend $emailSend The Email Send Entity
     * @param \App\Model\Entity\Reservation $reservation The Reservation Entity
     * @param string $token The Authorisation Token
     *
     * @return void
     */
    public function confirmation($emailSend, $reservation, $token)
    {
        $this->basic($emailSend);

        $this
            ->setTemplate('reservation')
            ->setSubject($emailSend->subject)
            ->setViewVars([
                'emailSend' => $emailSend,
                'reservation' => $reservation,
                'token' => $token,
            ]);
    }
}
