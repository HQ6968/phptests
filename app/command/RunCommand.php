<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2018/5/9
 * Time: 下午5:45
 */

namespace app\command;

use app\core\Unit;
use app\entity\Config;
use app\entity\RunParams;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class RunCommand extends Command
{

    /**
     * @var RunParams
     */
    public $params = null;

    public function initialize(InputInterface $input, OutputInterface $output)
    {
        $this->params = RunParams::with($input , $output);
    }

    protected function configure()
    {
        $this
            // the name of the command (the part after "bin/console")
            ->setName('run')
            ->addOption("file", "f" , InputOption::VALUE_OPTIONAL)
            ->addOption("method", "m" , InputOption::VALUE_OPTIONAL)
            ->addOption("autoload", "a" , InputOption::VALUE_OPTIONAL)
            ->addOption("bootstrap", "b" , InputOption::VALUE_NONE)


            // the short description shown while running "php bin/console list"
            ->setDescription('this is test command')

            // the full command description shown when running the command with
            // the "--help" option
            ->setHelp('help ...');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        Config::$out = $output ;
        new Unit($this , $input , $output);
    }
}