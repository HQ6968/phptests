<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2018/5/10
 * Time: 上午10:15
 */

namespace app\entity;


use Symfony\Component\Console\Output\OutputInterface;

class FileInfo
{

    public $filepath = "" ;
    public $namespace = "";
    public $methodsUnit = [];
    public $methodsBatch = [];

    /**
     * @var OutputInterface
     */
    public $out;

    public static function with($file)
    {
        $instance = new self();
        $instance->filepath = $file ;
        $content = file_get_contents($file);

        preg_match('/namespace\s+([\w\\\\]+);/', $content, $match);
        if (count($match) == 2) {
            $instance->namespace = $match[1];
        }

        preg_match_all('/function\s+(test\w+)\(.*\)/Umi', $content, $match);
        if (count($match) == 2) {
            $instance->methodsUnit = $match[1];
        }

        preg_match_all('/function\s+(batch\w+)\(.*\)/Umi', $content, $match);
        if (count($match) == 2) {
            $instance->methodsBatch = $match[1];
        }


        return $instance;
    }

    public function callFunc($method){
        if ( !in_array($method , $this->methodsUnit) && !in_array($method , $this->methodsBatch)) {
            return ;
        }

        if ($this->namespace) {
            $method = "\\" . str_replace("/","\\", $this->namespace) ."\\". $method ;
        }

        Config::$out->writeln("");
        Config::$out->writeln("<info>[{$method}]</info> {$this->filepath}");

        $t = new Test();
        try{
            $method($t);
            $profile = $t->profile();
        }catch (\Exception $e){
            $profile = $t->profile();
            $profile->ok = false ;
            if ($e instanceof Exception){
                $profile->error = $e->getMessage() ;
            }else{
                throw $e ;
            }
        }

        Config::$out->writeln($profile->toString());
        Config::$out->writeln("");
    }

    public function callUnit()
    {
        foreach ($this->methodsUnit as $method) {
            $this->callFunc($method);
        }
    }

    public function callBatch()
    {
        foreach ($this->methodsBatch as $method) {
            $this->callFunc($method);
        }
    }
}