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
    }

    /**
     * @param \Cake\Console\ConsoleOptionParser $parser Parser Input
     *
     * @return \Cake\Console\ConsoleOptionParser
     */
    protected function buildOptionParser(ConsoleOptionParser $parser)
    {
        $parser
            ->addArgument('all', [
                'help' => 'All of the Schedules Configured.',
                'boolean' => true,
                'short' => 'a',
            ])
            ->addArgument('events', [
                'help' => 'Events Schedule.',
                'boolean' => true,
                'short' => 'e',
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
        if ($args->getArgument('all') || $args->getArgument('events')) {
            /** @var \App\Model\Entity\Event $event */
            $events = $this->Events->find('upcoming');

            $happenings = 0;

            foreach ($events as $event) {
                $io->out('Processing ' . $event->name);
                $happenings += $this->Events->schedule($event->id);
            }
        }
    }
}
