Decomposer
==========

[![Build Status](https://travis-ci.org/jjok/Decomposer.png?branch=master)](https://travis-ci.org/jjok/Decomposer)

Deletes all the junk out of your project.

Usage
-----

Keep only the files listed in the Decomposer config.

	php path/to/decomposer.phar keep

See which files will be removed.

	php path/to/decomposer.phar keep -d -v

TODO
----

- [ ] Add `config` file option?
- [x] Add Factory to get Finder instance.
- [ ] Rename Keep command to Clean or something.
- [ ] Add Remove functionality.
- [ ] Add Validate command.
- [ ] Rename `jjok\Decomposer\Config\Paths` to something more useful.


Copyright (c) 2013 Jonathan Jefferies
