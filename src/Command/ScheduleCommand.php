<?php
declare(strict_types=1);

namespace App\Command;

use Cake\Console\Arguments;
use Cake\Console\Command;
use Cake\Console\ConsoleIo;
use Cake\Console\ConsoleOptionParser;
use Cake\Mailer\MailerAwareTrait;

/**
 * Class PasswordCommand
 *
 * @package App\Command
 *
 * @property \App\Model\Table\EventsTable $Events
 * @property \App\Model\Table\ReservationsTable $Reservations
 * @property \App\Model\Table\EmailSendsTable $EmailSends
 */
class ScheduleCommand extends Command
{
    use MailerAwareTrait;

    /**
     * Initialise method
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('Events');
        $this->loadModel('Reservations');
        $this->loadModel('EmailSends');
    }

    /**
     * @param \Cake\Console\ConsoleOptionParser $parser Parser Input
     *
     * @return \Cake\Console\ConsoleOptionParser
     */
    protected function buildOptionParser(ConsoleOptionParser $parser)
    {
        $parser->setDescription('Schedule Effector Job.');

        $parser
            ->addOption('all', [
                'short' => 'a',
                'help' => 'All Schedules',
                'boolean' => true,
            ])
            ->addOption('events', [
                'short' => 'e',
                'help' => 'Event Schedules',
                'boolean' => true,
            ])
            ->addOption('sends', [
                'short' => 's',
                'help' => 'Email Sends Dispatcher',
                'boolean' => true,
            ])
            ->addOption('reservations', [
                'short' => 'r',
                'help' => 'Reservation Schedules',
                'boolean' => true,
            ]);

        return $parser;
    }

    /**
     * Schedule Function for Events
     *
     * @param \Cake\Console\ConsoleIo $io The IO
     *
     * @return void
     *
     * @SuppressWarnings(PHPMD.ShortVariable)
     */
    private function scheduleEvents($io)
    {
        /** @var \App\Model\Entity\Event[] $events */
        $events = $this->Events->find('upcoming');
        $happenings = 0;

        foreach ($events as $event) {
            $io->out('Processing ' . $event->name);
            if ($this->Events->schedule($event->id)) {
                $happenings += 1;
            }
        }

        $io->info('Event Changes: ' . $happenings);
    }

    /**
     * Schedule Function for Reservations
     *
     * @param \Cake\Console\ConsoleIo $io The IO
     *
     * @return void
     *
     * @SuppressWarnings(PHPMD.ShortVariable)
     */
    private function scheduleReservations($io)
    {
        /** @var \App\Model\Entity\Reservation[] $reservations */
        $reservations = $this->Reservations->find('eventInProgress');
        $happenings = 0;

        foreach ($reservations as $reservation) {
            if ($this->Reservations->schedule($reservation->id)) {
                $happenings += 1;
            }
        }

        $io->info('Reservation Changes: ' . $happenings);
    }

    /**
     * Schedule Function for Email Sends
     *
     * @param \Cake\Console\ConsoleIo $io The IO
     *
     * @return void
     *
     * @SuppressWarnings(PHPMD.ShortVariable)
     */
    private function scheduleEmailSends($io)
    {
        /** @var \App\Model\Entity\EmailSend[] $toBeSent */
        $toBeSent = $this->EmailSends->find('unsent');
        $happenings = 0;

        foreach ($toBeSent as $email) {
            if ($this->EmailSends->send($email->id)) {
                $happenings += 1;
            }
        }

        $io->info('Emails Dispatched: ' . $happenings);
    }

    /**
     * @param \Cake\Console\Arguments $args Arguments for the Console
     * @param \Cake\Console\ConsoleIo $io The IO
     *
     * @return int|void|null
     *
     * @throws \Exception
     *
     * @SuppressWarnings(PHPMD.ShortVariable)
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     */
    public function execute(Arguments $args, ConsoleIo $io)
    {
        if ($args->getOption('all') || $args->getOption('events')) {
            $this->scheduleEvents($io);
        }

        if ($args->getOption('all') || $args->getOption('reservations')) {
            $this->scheduleReservations($io);
        }

        if ($args->getOption('all') || $args->getOption('sends')) {
            $this->scheduleEmailSends($io);
        }
    }
}
