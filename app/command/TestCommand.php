<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2018/5/9
 * Time: 下午5:45
 */

namespace app\command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class TestCommand extends Command
{
    protected function configure()
    {
        $this
            // the name of the command (the part after "bin/console")
            ->setName('app:test')

            // the short description shown while running "php bin/console list"
            ->setDescription('this is test command')

            // the full command description shown when running the command with
            // the "--help" option
            ->setHelp('help ...');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln("test command exec..");
    }
}