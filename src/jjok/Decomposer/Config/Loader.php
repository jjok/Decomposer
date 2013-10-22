<?php

namespace jjok\Decomposer\Config;

use jjok\Decomposer\Factory;

class Loader {
	
	/**
	 * 
	 * @var string
	 */
	protected $name;
	
	/**
	 * The config file format.
	 * @var string
	 */
	protected $format = 'xml';
	
	/**
	 * 
	 * @var string[]
	 */
	protected $filename_formats = array(
		'%s.%s',
		'%s.dist.%s'
	);
	
	public function __construct($name = 'decomposer') {
		$this->name = $name;
	}
	
	/**
	 * Find the configuration file.
	 * @throws \Exception
	 * @return string
	 */
	public function findConfigFile() {
		foreach($this->filename_formats as $filename_format) {
			$file = sprintf($filename_format, $this->name, $this->format);
			if(file_exists($file)) {
				return $file;
			}
		}
		
		//TODO create MissingConfigException
		throw new \Exception('Config file not found.');
	}

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
