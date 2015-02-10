<?php

namespace jjok\Decomposer\Config;

/**
 * 
 * @author Jonathan Jefferies
 */
class Paths {

	/**
	 * 
	 * @var string
	 */
	protected $start;

	/**
	 * 
	 * @var Path[]
	 */
	protected $paths;
	
	/**
	 * Set the initial path and paths.
	 * @param string $start The initial path.
	 * @param Path[] $paths
	 */
	public function __construct($start, $paths = array()) {
		$this->start = $start;
		$this->paths = $paths;
	}
	
	/**
	 * Get the start path.
	 * @return string
	 */
	public function getStart() {
		return $this->start;
	}
	
	/**
	 * Get paths.
	 * @return Path[]
	 */
	public function getPaths() {
		return $this->paths;
	}
	
	/**
	 * Add a path.
	 * @param Path $path
	 */
	public function addPath(Path $path) {
		$this->paths[] = $path;
	}
}
