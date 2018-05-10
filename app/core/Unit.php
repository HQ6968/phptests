<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2018/5/9
 * Time: 下午6:34
 */


namespace app\core;

use app\command\RunCommand;
use app\entity\Config;
use app\entity\FileInfo;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Unit
{


    /**
     * @var RunCommand
     */
    private $cmd;
    /**
     * @var InputInterface
     */
    private $input;
    /**
     * @var OutputInterface
     */
    private $output;

    public function __construct(RunCommand $cmd , InputInterface $input, OutputInterface $output)
    {
        $this->cmd = $cmd;
        $this->input = $input;
        $this->output = $output;

        $this->testMethod();
    }


    public function testMethod()
    {
        $params = $this->cmd->params ;

        if ($params->bootstrap) {
            $fileinfo = $this->lookDir(Config::$cwd,'phptests');
            if ($fileinfo){
                include  $fileinfo->getRealPath() . "/bootstrap.php" ;
            }
        }

        if ($params->autoload) {
            include $this->getPath($params->autoload) ;
        }


        if ($params->file){
            $file =  $this->getPath($params->file);
            $this->testFile($file);
        }else{
            // 没有file 则读取目录下的所有文件
            $iterator = new \FilesystemIterator(Config::$cwd);
            foreach ($iterator as $file) {
                $this->testFile($file);
            }
        }
    }



    public function getPath($path){
        $p =  Config::$cwd.$path ;
        $this->output->writeln($p);
        return $p;
    }


    /**
     * @param $dir
     * @param $name
     * @return bool|\SplFileInfo
     */
    private function lookDir($dir,$name)
    {
        $current = $dir ;
        for ($i = 0 ; $i < 5 ; $i++) {

            if ($i > 0 ) {
                $current = $current . "../" ;
            }

            $file = $this->internalLookDir($current , $name) ;
            if ($file){
                return $file ;
            }
        }
        return false;
    }

    private function internalLookDir($dir,$name)
    {
        $iterator = new \FilesystemIterator($dir);
        foreach ($iterator as $file) {
            if ($file->isDir() && $file->getFilename() == $name) {
                return $file ;
            }
        }
        return false;
    }

    private function isTestFile(\SplFileInfo $file)
    {
        if ($file->isDir()) {
            return false ;
        }

        if ($file->getExtension() != 'php') {
            return false ;
        }

        $filename = $file->getFilename() ;

        if (strlen($filename) < 8) {
            return false ;
        }

        return substr($filename , -8, -4) == 'Test' ;
    }

    /**
     * @param $file string|\SplFileInfo
     */
    private function testFile($file)
    {

        $params = $this->cmd->params ;
        if (is_object($file)) {

            if (!$this->isTestFile($file)){
                return ;
            }
            $file = $file->getRealPath();
        }
        include $file ;
        $fileinfo =  FileInfo::with($file);


        if ($params->method){
            $fileinfo->callFunc($params->method);
        }else{
            $fileinfo->callUnit();
            $fileinfo->callbatch();
        }


    }
}