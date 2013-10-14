<?php

namespace jjok\Decomposer\Config;

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
	
	public function __construct($start, $paths = array()) {
		$this->start = $start;
		$this->paths = $paths;
	}
	
	public function getStart() {
		return $this->start;
	}
	
	public function getPaths() {
		return $this->paths;
	}
	
	public function addPath(Path $path) {
		$this->paths[] = $path;
	}
}
