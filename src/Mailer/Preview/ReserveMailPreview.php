<?php
declare(strict_types=1);

// Create the file src/Mailer/Preview/UserMailPreview.php
namespace App\Mailer\Preview;

use DebugKit\Mailer\MailPreview;

/**
 * Class ReserveMailPreview
 *
 * @package App\Mailer\Preview
 *
 * @property \App\Model\Table\EmailSendsTable $EmailSends
 * @property \App\Model\Table\TokensTable $Tokens
 * @property \App\Model\Table\ReservationsTable $Reservations
 */
class ReserveMailPreview extends MailPreview
{
    /**
     * Password Reset Preview Mailer
     *
     * @return mixed
     */
    public function confirmation()
    {
        $this->loadModel('Reservations');
        $this->loadModel('EmailSends');
        $this->loadModel('Tokens');

        /** @var \App\Model\Entity\Token $token */
        $token = $this->Tokens->find()->contain(['EmailSends' => ['Users', 'Tokens', 'Notifications']])->first();
        $reservation = $this->Reservations->find()->contain('ReservationStatuses')->first();

        /** @var \App\Mailer\ReserveMailer $this */
        return $this
            ->getMailer('Reserve')
            ->confirmation($token->email_send, $reservation, $token);
    }
}
