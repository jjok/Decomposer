Decomposer
==========

Deletes all the junk out of your project.

Usage
-----

Keep only the files listed in the Decomposer config.

	php path/to/decomposer.phar keep

See which files will be removed.

	php path/to/decomposer.phar keep -d -v

TODO
----

* Add `config` file option.
* Add Decomposer\Config and Decomposer\ConfigLoader.
	* Check to see if config file exists.
* Add Factory to get Finder instance.
* Rename Keep command to Clean or something.
	* Add Remove functionality.
* Add Validate command.

Copyright (c) 2013 Jonathan Jefferies
