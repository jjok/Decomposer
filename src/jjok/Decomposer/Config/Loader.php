<?php

namespace jjok\Decomposer\Config;

use jjok\Decomposer\Factory;

/**
 * Loads a configuration file.
 * @author Jonathan Jefferies
 */
class Loader {

	/**
	 * Load a configuration file.
	 * @param string $filename The name of the config file to load.
	 * @return \jjok\Decomposer\Config\Config
	 */
	public function load($filename) {
		$xml = new \DOMDocument('1.0', 'UTF-8');
		$xml->load($filename);
		
		$path_maps = array();
		foreach($xml->getElementsByTagName('keep') as $keep) {
			$path_map = Factory::createPaths($keep->getAttribute('start'));
				
			# Get the paths to keep
			foreach($keep->getElementsByTagName('path') as $path) {
				$path_map->addPath(Factory::createPath($path->nodeValue));
			}
			$path_maps[] = $path_map;
		}

		return Factory::createConfig($path_maps);
	}
}
