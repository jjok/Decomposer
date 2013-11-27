<?php

require_once __DIR__.'/../vendor/autoload.php';

try {
	# Load configuration file
	$finder = new jjok\Decomposer\Config\Finder('decomposer', 'xml');
	$loader = new jjok\Decomposer\Config\Loader();
	$config = $loader->load($finder->find());
	
	# Run application
	$application = new jjok\Decomposer\Decomposer($config, '0.1.1');
	$application->add(new jjok\Decomposer\Console\Command\KeepCommand());
	$application->run();
}
catch(Exception $e) {
	echo $e->getMessage();
	exit(1);
}
