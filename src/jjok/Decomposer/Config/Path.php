<?php

namespace jjok\Decomposer\Config;

class Path {

	protected $name;
	
	public function __construct($name) {
		$this->name = $name;
	}
	
	public function __toString() {
		return $this->name;
	}
	
	public function toRegEx() {
		return sprintf('/^%s/', str_replace('/', '\/', $this->name));
	}
}
