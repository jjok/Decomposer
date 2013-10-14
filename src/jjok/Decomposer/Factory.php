<?php

namespace jjok\Decomposer;

use jjok\Decomposer\Config\Config;
use jjok\Decomposer\Config\Path;
use jjok\Decomposer\Config\Paths;
use jjok\Decomposer\Finder\Adapter\ChildFirstPhpAdapter;
use Symfony\Component\Finder\Finder;

class Factory {
	
	/**
	 * 
	 * @param string $path
	 * @return Path
	 */
	public function createPath($path) {
		return new Path($path);
	}
	
	/**
	 * 
	 * @param string $start
	 * @return Paths
	 */
	public function createPaths($start) {
		return new Paths($start);
	}
	
	/**
	 * 
	 * @param array $paths
	 * @return Config
	 */
	public function createConfig(array $paths) {
		return new Config($paths);
	}
	
	/**
	 * 
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
}
