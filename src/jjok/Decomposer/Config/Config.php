<?php

namespace jjok\Decomposer\Config;

class Config {
	
	/**
	 * An array of paths to be kept.
	 * @var Paths[]
	 */
	protected $keep = array();
	
	/**
	 * 
	 * @param Paths[] $keep
	 */
	public function __construct(array $keep) {
		$this->keep = $keep;
	}
	
	/**
	 * 
	 * @return Paths[]
	 */
	public function getPathsToKeep() {
		return $this->keep;
	}
}
