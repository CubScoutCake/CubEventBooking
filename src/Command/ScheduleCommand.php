<?php
namespace App\Command;

use Cake\Console\Arguments;
use Cake\Console\Command;
use Cake\Console\ConsoleIo;
use Cake\Console\ConsoleOptionParser;

/**
 * Class PasswordCommand
 *
 * @package App\Command
 *
 * @property \App\Model\Table\EventsTable $Events
 * @property \App\Model\Table\ReservationsTable $Reservations
 */
class ScheduleCommand extends Command
{
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
            ->addOption('reservations', [
                'short' => 'r',
                'help' => 'Reservation Schedules',
                'boolean' => true,
            ]);

        return $parser;
    }

    /**
     * @param \Cake\Console\Arguments $args Arguments for the Console
     * @param \Cake\Console\ConsoleIo $io The IO
     *
     * @return int|void|null
     *
     * @SuppressWarnings(PHPMD.ShortVariable)
     */
    public function execute(Arguments $args, ConsoleIo $io)
    {
        if ($args->getOption('all') || $args->getOption('events')) {
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

        if ($args->getOption('all') || $args->getOption('reservations')) {
            /** @var \App\Model\Entity\Reservation[] $reservations */
            $reservations = $this->Reservations->find('inProgress');
            $happenings = 0;

            foreach ($reservations as $reservation) {
                if ($this->Reservations->schedule($reservation->id)) {
                    $happenings += 1;
                }
            }

            $io->info('Reservation Changes: ' . $happenings);
        }
    }
}
