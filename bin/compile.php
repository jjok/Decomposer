#!/usr/bin/env php
<?php

/**
 * Compiles Decomposer to a Phar file.
 * @author Jonathan Jefferies
 */

require_once __DIR__.'/../vendor/autoload.php';

try {
	$filename = 'decomposer.phar';

	if(file_exists($filename)) {
		printf('Deleting %s%s', $filename, PHP_EOL);
		unlink($filename);
	}
	
	printf('Building %s%s', $filename, PHP_EOL);
	
	$finder = new Symfony\Component\Finder\Finder();
	$finder->ignoreVCS(true)
	       ->ignoreDotFiles(true)
	       ->ignoreUnreadableDirs(true)
	       ->files()
	       ->in(__DIR__.'/..')
	       ->path('src')
	       ->path('vendor')
	       ->path('bin/decomposer.php');
	
	$phar = new Phar($filename);
	$files = $phar->buildFromIterator($finder, __DIR__.'/..');
	
	$phar->setStub(file_get_contents(__DIR__.'/stub.php'));
}
catch(Exception $e) {
	echo $e;
	exit(1);
}

printf("Done\n");
