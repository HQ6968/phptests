<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2018/5/9
 * Time: 下午6:19
 */

namespace app\entity;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class RunParams
{
    public $file ;
    public $method ;
    public $autoload;
    public $bootstrap;

    public static function with(InputInterface $input, OutputInterface $output)
    {
        $instance = new self() ;
        $instance->file = $input->getOption("file");
        $instance->method = $input->getOption("method");
        $instance->autoload = $input->getOption("autoload");
        $instance->bootstrap = $input->getOption("bootstrap");
        return $instance ;
    }
}