<?php

namespace App\Mailer;

use Cake\Mailer\Mailer;
use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;

class UserMailer extends Mailer
{
    /**
     * @param Entity $user The User Entity
     * @param Entity $group The Scoutgroup associated
     * @param Entity $notification The Notification Entity.
     *
     * @return void
     */
    public function welcome($user, $group, $notification)
    {
        // $email = new Email('default');
        $this->transport('sparkpost')
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
     * @param Entity $user The User Entity
     * @param Entity $group The Scoutgroup associated
     * @param Entity $notification The Notification Entity.
     *
     * @return void
     */
    public function validate($user, $group, $notification)
    {
        // $email = new Email('default');
        $this->setTransport('sparkpost')
            ->template('validate', 'default')
            ->emailFormat('html')
            ->to([$user->email => $user->full_name])
            ->from(['info@hertscubs.uk' => 'HertsCubs Booking Site'])
            ->subject('Hertfordshire Cubs Booking System - Please Validate your Email')
            ->viewVars(['username' => $user->username,
                'date_created' => $user->created,
                'full_name' => $user->full_name,
                'scoutgroup' => $group->scoutgroup,
                'link_controller' => $notification->link_controller,
                'link_action' => $notification->link_action,
                'link_id' => $notification->link_id,
                'link_prefix' => $notification->link_prefix,
                'notification_id' => $notification->id,
            ])
            ->helpers(['Html', 'Text', 'Time']);
        //->send();
    }

    /**
     * @param Entity $user The User Entity.
     * @param string $token The String of the Token Generated
     *
     * @return void
     */
    public function passwordReset($user, $token)
    {
        $this->setTo($user->email, $user->full_name)
            ->setTemplate('password_reset')
            ->setLayout('default')
            ->setTransport('sparkpost')
            ->setEmailFormat('both')
            ->setFrom('info@hertscubs.uk', 'HertsCubs Booking Site')
            ->setSubject('Password Reset for ' . $user->full_name)
            ->setViewVars(['username' => $user->username,
                'date_created' => $user->created,
                'full_name' => $user->full_name,
                'token' => $token,
                'uid' => $user->id,
            ])
            ->setHelpers(['Html', 'Text', 'Time']);
    }
}
