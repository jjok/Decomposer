#!/usr/bin/env php
<?php

printf('Building...');

require_once '../vendor/autoload.php';

try {

	$filename = '../decomposer.phar';

	if(file_exists($filename)) {
		unlink($filename);
	}
	
	$finder = new Symfony\Component\Finder\Finder();
	$finder->ignoreVCS(true)
	       ->ignoreDotFiles(true)
	       ->ignoreUnreadableDirs(true)
	       ->files()
	       ->in('..')
	       ->path('src')
	       ->path('vendor');
	
	$phar = new Phar($filename);
	$phar->buildFromIterator($finder, '..');
	$phar->setStub(file_get_contents('decomposer.php'));
}
catch(Exception $e) {
	echo $e;
	exit(1);
}

printf("\rDone       ");
