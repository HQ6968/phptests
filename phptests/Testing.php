<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2018/5/10
 * Time: 下午2:14
 */

namespace phptests ;

interface Testing
{
    public function log($v) ;
    public function logf($format, ...$v) ;
    public function fatal($v) ;
    public function fatalf($format , ...$v) ;
}