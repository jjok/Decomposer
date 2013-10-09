<?php

require_once '../vendor/Autoload.php';
require_once '../src/jjok/Decomposer/Finder/Adapter/ChildFirstPhpAdapter.php';
require_once '../src/jjok/Decomposer/Console/Command/KeepCommand.php';
require_once '../src/jjok/Decomposer/Decomposer.php';

use Decomposer\Decomposer;
use Decomposer\Console\Command\KeepCommand;
use Symfony\Component\Console\Application;

// $application = new Application();
$application = new Decomposer();
// $application->add(new KeepCommand());
$application->run();
