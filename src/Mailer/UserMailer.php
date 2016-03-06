<?

namespace App\Mailer;

use Cake\Mailer\Mailer;

class UserMailer extends Mailer
{
    public function welcome($user,$group,$notification) {
        // $email = new Email('default');
        $this->template('welcome', 'default')
            ->emailFormat('html')
            ->to([$user->email => $user->full_name])
            ->from(['info@hertscubs.uk' => 'HertsCubs Booking Site'])
            ->subject('Welcome to the Hertfordshire Cubs Booking System')
            ->setHeaders(['X-MC-Tags' => 'WelcomeEmail,Type1,Notification'
                    , 'X-MC-AutoText' => true
                    , 'X-MC-GoogleAnalytics' => 'hertscubs100.uk,hertscubs.uk,hcbooking.uk,booking.hertscubs100.uk,champions.hertscubs100.uk,booking.hertscubs.uk'
                    , 'X-MC-GoogleAnalyticsCampaign' => 'Welcome_Email'
                    , 'X-MC-TrackingDomain' => 'track.hertscubs.uk' ])
            ->viewVars(['username' => $user->username
                    , 'date_created' => $user->created
                    , 'full_name' => $user->full_name
                    , 'scoutgroup' => $group->scoutgroup
                    , 'link_controller' => $notification->link_controller
                    , 'link_action' => $notification->link_action
                    , 'link_id' => $notification->link_id
                    , 'link_prefix' => $notification->link_prefix
                    , 'notification_id' => $notification->id
                    ])
            ->helpers(['Html', 'Text', 'Time']);
            //->send();                          
    }

    public function resetPassword($user,$notification) {
        $this->template('pwreset', 'default')
            ->emailFormat('html')
            ->to([$user->email => $user->full_name])
            ->from(['info@hertscubs.uk' => 'HertsCubs Booking Site'])
            ->subject('Reset password')
            ->setHeaders(['X-MC-Tags' => 'PasswordReset,Type2,Request'
                    , 'X-MC-AutoText' => true
                    , 'X-MC-GoogleAnalytics' => 'hertscubs100.uk,hertscubs.uk,hcbooking.uk,booking.hertscubs100.uk,champions.hertscubs100.uk,booking.hertscubs.uk'
                    , 'X-MC-GoogleAnalyticsCampaign' => 'Welcome_Email'
                    , 'X-MC-TrackingDomain' => 'track.hertscubs.uk' ])
            ->viewVars(['username' => $user->username
                    , 'date_created' => $notification->created
                    , 'full_name' => $user->full_name
                    ])
            ->helpers(['Html', 'Text', 'Time'])
            ->set(['token' => $user->token]);
            //->send();
    }

    /*public function implementedEvents() {
        return [
            'Model.afterSave' => 'onRegistration'
        ];
    }

    public function onRegistration(Event $event, Entity $entity, ArrayObject $options) {
        if ($entity->isNew()) {
            $this->send('welcome', [$entity]);
        }
    }*/
}