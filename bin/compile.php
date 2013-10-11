#!/usr/bin/env php
<?php

printf("Building...\n");

require_once '../vendor/autoload.php';

try {

	$filename = '../decomposer.phar';

	if(file_exists($filename)) {
		printf("Deleting %s\n", $filename);
		unlink($filename);
	}
	
	$finder = new Symfony\Component\Finder\Finder();
	$finder->ignoreVCS(true)
	       ->ignoreDotFiles(true)
	       ->ignoreUnreadableDirs(true)
	       ->files()
	       ->in('..')
	       ->path('src')
	       ->path('vendor')
	       ->path('bin/decomposer.php');
	
	$phar = new Phar($filename);
	$files = $phar->buildFromIterator($finder, '..');
	
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

	$phar->setStub(file_get_contents('stub.php'));
}
catch(Exception $e) {
	echo $e;
	exit(1);
}

printf("Done\n");
