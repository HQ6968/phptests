#!/usr/bin/env php
<?php
// application.php

require __DIR__.'/vendor/autoload.php';

\app\entity\Config::$cwd = getcwd()."/";

use Symfony\Component\Console\Application;

$application = new Application();

// ... register commands

$application->addCommands([
        new \app\command\TestCommand(),
        new \app\command\RunCommand(),
]);

$application->run();