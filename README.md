Decomposer
==========

[![Build Status](https://travis-ci.org/jjok/Decomposer.png?branch=master)](https://travis-ci.org/jjok/Decomposer)

Deletes all the junk out of your project.

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
- [ ] Add Remove functionality.
- [ ] Add Validate command.
- [ ] Rename `jjok\Decomposer\Config\Paths` to something more useful. 'Keep'?


Copyright (c) 2015 Jonathan Jefferies
