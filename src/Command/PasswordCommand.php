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
 * @property \App\Model\Table\UsersTable $Users
 */
class PasswordCommand extends Command
{
    /**
     * Initialise method
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('Users');
    }

    /**
     * @param \Cake\Console\ConsoleOptionParser $parser Parser Input
     *
     * @return \Cake\Console\ConsoleOptionParser
     */
    protected function buildOptionParser(ConsoleOptionParser $parser)
    {
        $parser
            ->addArgument('name', [
                'help' => 'What is your name',
                'required' => true,
            ])
            ->addArgument('password', [
                'help' => 'Set the password',
                'required' => true,
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
        /** @var \App\Model\Entity\User $user */
        $user = $this->Users->findByUsername($args->getArgument('name'))->first();
        $user->set('password', $args->getArgument('password'));

        if (!$this->Users->save($user)) {
            $io->out('User Password Reset Failed.');

            return;
        }
        $io->out('User Password Set.');
    }
}
