<?php

namespace jjok\Decomposer;

use PHPUnit_Framework_TestCase;

class DecomposerTest extends PHPUnit_Framework_TestCase {
	
	private $config;
	
	public function setUp() {
		$this->config = new Config\Config(array());
	}
	/**
	 * @expectedException PHPUnit_Framework_Error
	 */
	public function testConfigIsRequired() {
		$decomposer = new Decomposer();
	}
	
	/**
	 * @expectedException PHPUnit_Framework_Error
	 */
	public function testVersionIsRequired() {
		$decomposer = new Decomposer($this->config);
	}
	
	/**
	 * @covers jjok\Decomposer\Decomposer::__construct
	 * @covers jjok\Decomposer\Decomposer::getConfig
	 */
	public function testConfigCanBeSet() {
		$decomposer = new Decomposer($this->config, 'my version');

		$this->assertSame($this->config, $decomposer->getConfig());
		$this->assertSame('Decomposer', $decomposer->getName());
		$this->assertSame('my version', $decomposer->getVersion());
	}
}
