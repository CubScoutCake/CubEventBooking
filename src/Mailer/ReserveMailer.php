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
     * @param User $user The User Entity
     * @param Scoutgroup $group The Scoutgroup associated
     * @param Notification $notification The Notification Entity.
     *
     * @return void
     */
    public function welcome($user, $group, $notification)
    {
        // $email = new Email('default');
        $this
            ->transport('sparkpost')
            ->template('welcome', 'default')
            ->emailFormat('html')
            ->to([$user->email => $user->full_name])
            ->from(['info@hertscubs.uk' => 'HertsCubs Booking Site'])
            ->subject('Welcome to the Hertfordshire Cubs Booking System')
            ->setHeaders(['X-MC-Tags' => 'WelcomeEmail,Type1,Notification',
                 'X-MC-AutoText' => true,
                 'X-MC-GoogleAnalytics' => 'hertscubs100.uk,hertscubs.uk,hcbooking.uk,booking.hertscubs100.uk,champions.hertscubs100.uk,booking.hertscubs.uk',
                 'X-MC-GoogleAnalyticsCampaign' => 'Welcome_Email',
                 'X-MC-TrackingDomain' => 'track.hertscubs.uk'])
            ->viewVars(['username' => $user->username,
                 'date_created' => $user->created,
                 'full_name' => $user->full_name,
                 'scoutgroup' => $group->scoutgroup,
                 'link_controller' => $notification->link_controller,
                 'link_action' => $notification->link_action,
                 'link_id' => $notification->link_id,
                 'link_prefix' => $notification->link_prefix,
                 'notification_id' => $notification->id
            ])
            ->helpers(['Html', 'Text', 'Time']);
        //->send();
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
