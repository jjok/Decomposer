#!/usr/bin/env php
<?php

printf("Building...\n");

require_once __DIR__.'/../vendor/autoload.php';

try {
// 	echo __DIR__, PHP_EOL;
	$filename = 'decomposer.phar';

	if(file_exists($filename)) {
		printf("Deleting %s\n", $filename);
		unlink($filename);
	}
	
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
	
// 	printf("Adding files...\n");
// 	$max = 79;
// 	foreach($files as $key => $file) {
// 		if(strlen($key) > $max) {
// 			printf("%s...\n", substr($key, 0, $max - 3));
// 		}
// 		else {
// 			printf("%s\n", $key);
// 		}
// 	}

	$phar->setStub(file_get_contents(__DIR__.'/stub.php'));
}
catch(Exception $e) {
	echo $e;
	exit(1);
}

printf("Done\n");
