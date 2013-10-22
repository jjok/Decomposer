<?php

require_once __DIR__.'/../vendor/autoload.php';

try {
	# Load config file
	$loader = new jjok\Decomposer\Config\Loader();
	$config = $loader->load($loader->findConfigFile());
	
	# Run application
	$application = new jjok\Decomposer\Decomposer($config, '0.1.0');
	$application->add(new jjok\Decomposer\Console\Command\KeepCommand());
	$application->run();
}
catch(Exception $e) {
	echo $e->getMessage();
	exit(1);
}
