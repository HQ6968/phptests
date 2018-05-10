<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2018/5/10
 * Time: 上午10:13
 */

namespace app\entity;


use phptests\Testing;

class Test implements Testing
{
    public $startTime ;
    public function __construct()
    {
        $this->startTime = microtime(true);
    }

    public function profile()
    {
       $p =  new Profile() ;
       $p->duration = microtime(true) - $this->startTime ;
       return $p ;
    }

    public function log($v)
    {
        Config::$out->writeln($v);
    }

    public function logf($format, ...$v)
    {
        Config::$out->writeln(sprintf($format , ...$v));
    }

    public function fatal($v)
    {
        //Config::$out->writeln($v);
        throw new  Exception($v) ;
    }

    public function fatalf($format, ...$v)
    {
        throw new  Exception(sprintf($format , ...$v)) ;
    }
}