<?php

namespace jjok\Decomposer\Config;

use jjok\Decomposer\Factory;

/**
 * Loads a configuration file.
 * @author Jonathan Jefferies
 */
class Loader {
	
	/**
	 * 
	 * @var Factory
	 */
	protected $factory;
	
	/**
	 * Set dependencies.
	 * @param Factory $factory
	 */
	public function __construct(Factory $factory) {
		$this->factory = $factory;
	}
	
	/**
	 * Load a configuration file.
	 * @param string $filename The name of the config file to load.
	 * @return \jjok\Decomposer\Config\Config
	 */
	public function load($filename) {
		$xml = $this->factory->createDOMDocument();
		$xml->load($filename);
		
		$path_maps = array();
		foreach($xml->getElementsByTagName('keep') as $keep) {
			$path_map = $this->factory->createPaths($keep->getAttribute('start'));
				
			# Get the paths to keep
			foreach($keep->getElementsByTagName('path') as $path) {
				$path_map->addPath($this->factory->createPath($path->nodeValue));
			}
			$path_maps[] = $path_map;
		}

		return $this->factory->createConfig($path_maps);
	}
}
