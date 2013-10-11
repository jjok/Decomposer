<?php

require_once __DIR__.'/../vendor/autoload.php';

// $application = new jjok\Decomposer\Decomposer('Decomposer', '0.1.0');
$application = new Symfony\Component\Console\Application('Decomposer', '0.1.0');
$application->add(new jjok\Decomposer\Console\Command\KeepCommand());
$application->run();
