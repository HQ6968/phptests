<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2018/5/10
 * Time: 下午1:57
 */

namespace app\entity;


class Profile
{
    public $duration ;
    public $ok = true;
    public $error ;

    public function getDuration(){
        return number_format($this->duration * 1000, 2) . " ms" ;
    }


    public function toString(){

        if ($this->ok) {
            return "<info>success ==> </info>  {$this->getDuration()}" ;
        }
        return "<fg=red>fail ==> </><fg=red>{$this->error}</>" ;
    }
}