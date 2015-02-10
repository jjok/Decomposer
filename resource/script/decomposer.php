<?php

/**
 * Decomposer bootstrap.
 * @author Jonathan Jefferies
 */

require_once __DIR__.'/../../vendor/autoload.php';

use jjok\Decomposer\Config\Finder;
use jjok\Decomposer\Config\Loader;
use jjok\Decomposer\Console\Command\KeepCommand;
use jjok\Decomposer\Decomposer;

try {
	$factory = new Factory();
	
	# Load configuration file
	$finder = new Finder('decomposer', 'xml');
	$loader = new Loader($factory);
	$config = $loader->load($finder->find());
	
	# Run application
	$application = new Decomposer($config, '0.1.1');
	$application->add(new KeepCommand($factory));
	$application->run();
}
catch(Exception $e) {
	echo $e->getMessage();
	exit(1);
}
