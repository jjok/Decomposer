Decomposer
==========

[![Build Status](https://travis-ci.org/jjok/Decomposer.png?branch=master)](https://travis-ci.org/jjok/Decomposer)

Deletes all the junk out of your project.

Add a config file called decomposer.xml to your project and list all the directories and files that you want to keep.

	<?xml version="1.0" encoding="UTF-8"?>
	<decomposer xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
	            xsi:noNamespaceSchemaLocation="https://raw.github.com/jjok/Decomposer/master/resource/schema.xsd">
	    <keep start="./">
	        <!-- Keep your source code. -->
	        <path>src</path>
	        
	        <!-- Keep the Composer autoload stuff. -->
	        <path>vendor/autoload.php</path>
	        <path>vendor/composer</path>
	        
	        <!-- Keep just the source code of some other package. -->
	        <path>vendor/some-vendor/some-package/src</path>
	        
	        <!-- Keep the source of all packages from a vendor -->
	        <path>vendor/some-other-vendor/([A-Za-z-]+)/src</path>
	    </keep>
	</decomposer>

Build
-----

	php resource/script/compile.php

Usage
-----

Keep only the files listed in the Decomposer config.

	php path/to/decomposer.phar keep

See which files will be removed.

	php path/to/decomposer.phar keep -d -v

TODO
----

- [ ] Change `Path` in config file to be one of Starts With, Ends With , Starts and Ends With?
- [ ] Add `config` file option?
- [x] Add Factory to get Finder instance.
- [ ] Rename Keep command to Clean or something?
- [ ] Add Remove functionality?
- [ ] Add Validate command?
- [ ] Rename `jjok\Decomposer\Config\Paths` to something more useful. 'Keep'?


Copyright (c) 2015 Jonathan Jefferies
