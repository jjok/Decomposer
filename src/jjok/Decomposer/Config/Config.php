<?php

namespace jjok\Decomposer\Config;

class Config {
	
	/**
	 * 
	 * @var Paths[]
	 */
	protected $keep = array();
	
	public function __construct(array $keep) {
		$this->keep = $keep;
	}
	
	public function getPathsToKeep() {
		return $this->keep;
	}
}
