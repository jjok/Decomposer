#!/usr/bin/env php
<?php

$base = file_exists('vendor/Autoload.php')? '': '../';

require_once $base.'vendor/Autoload.php';
require_once $base.'src/jjok/Decomposer/Finder/Adapter/ChildFirstPhpAdapter.php';
require_once $base.'src/jjok/Decomposer/Console/Command/KeepCommand.php';
require_once $base.'src/jjok/Decomposer/Decomposer.php';

$application = new Decomposer\Decomposer();
$application->run();

__HALT_COMPILER();
