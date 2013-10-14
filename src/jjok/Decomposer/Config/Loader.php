<?php

namespace jjok\Decomposer\Config;

class Loader {
	
	protected $name = 'decomposer';
	
	/**
	 * The config file format.
	 * @var string
	 */
	protected $format = 'xml';
	
	public function findConfigFile() {
		$file = sprintf('%s.%s', $this->name, $this->format);
		if(file_exists($file)) {
			return $file;
		}
		
		$file = sprintf('%s.dist.%s', $this->name, $this->format);
		if(file_exists($file)) {
			return $file;
		}
		
		//TODO create MissingConfigException
		throw new \Exception('Config file not found.');
	}

	public function load() {
// 		echo $this->findConfigFile();
		
		$xml = new \DOMDocument('1.0', 'UTF-8');
		$xml->load($this->findConfigFile());
		
		$paths = array();
		foreach($xml->getElementsByTagName('keep') as $keep) {
			//TODO create Factory for Paths.
			$path_map = new Paths($keep->getAttribute('start'));
				
			# Get the paths to keep
			foreach($keep->getElementsByTagName('path') as $path) {
				//TODO create Factory for Path.
				$path_map->addPath(new Path($path->nodeValue));
			}
			$paths[] = $path_map;
		}

		//TODO create Factory for Config.
		return new Config($paths);
	}
}
