<?php

namespace jjok\Decomposer\Config;

class Config {
	
	protected $keep = array();
	
	public function __construct($keep) {
		$this->keep = $keep;
	}
	
	public function getPathsToKeep() {
		return $this->keep;
	}
}
