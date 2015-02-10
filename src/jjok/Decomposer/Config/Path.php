<?php

namespace jjok\Decomposer\Config;

/**
 * 
 * @author Jonathan Jefferies
 */
class Path {

	/**
	 * The path name.
	 * @var string
	 */
	protected $name;
	
	/**
	 * Set the path name.
	 * @param string $name
	 */
	public function __construct($name) {
		$this->name = $name;
	}
	
	/**
	 * Get the path name.
	 * @return string
	 */
	public function __toString() {
		return $this->name;
	}
	
	/**
	 * Convert the path name to a regular expression.
	 * @return string
	 */
	public function toRegEx() {
		return sprintf('/^%s/', str_replace('/', '\/', $this->name));
	}
}
