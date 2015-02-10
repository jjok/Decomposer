<?php

namespace jjok\Decomposer;

use DOMDocument;
use jjok\Decomposer\Config\Config;
use jjok\Decomposer\Config\Path;
use jjok\Decomposer\Config\Paths;
use jjok\Decomposer\Finder\Adapter\ChildFirstPhpAdapter;
use Symfony\Component\Finder\Finder;

/**
 * 
 * @author Jonathan Jefferies
 */
class Factory {
	
	/**
	 * Create an instance of Path.
	 * @param string $path
	 * @return Path
	 */
	public function createPath($path) {
		return new Path($path);
	}
	
	/**
	 * Create an instance of Paths.
	 * @param string $start
	 * @return Paths
	 */
	public function createPaths($start) {
		return new Paths($start);
	}
	
	/**
	 * Create an instance of Config.
	 * @param array $paths
	 * @return Config
	 */
	public function createConfig(array $paths) {
		return new Config($paths);
	}
	
	/**
	 * Create an instance of Finder.
	 * @return Finder
	 */
	public function createFinder() {
		return Finder::create()
		       ->addAdapter(new ChildFirstPhpAdapter())
		       ->setAdapter('child-first')
		       ->ignoreVCS(false)
		       ->ignoreDotFiles(false)
		       ->ignoreUnreadableDirs(true);
	}
	
	/**
	 * Create an instance of DOMDocument.
	 * @return \DOMDocument
	 */
	public function createDOMDocument() {
		return new DOMDocument('1.0', 'UTF-8');
	}
}
