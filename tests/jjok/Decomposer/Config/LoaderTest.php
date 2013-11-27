<?php

namespace jjok\Decomposer\Config;

use PHPUnit_Framework_TestCase;

class LoaderTest extends PHPUnit_Framework_TestCase {
	
	/**
	 * @expectedException jjok\Decomposer\Config\MissingConfigException
	 */
	public function testExceptionThrownIfNoConfigFileFound() {
		$loader = new Loader('test');
		$loader->findConfigFile();
	}
	
	public function testDist() {
		touch('test.dist.xml');
		$loader = new Loader('test');
		$this->assertSame('test.dist.xml', $loader->findConfigFile());
		unlink('test.dist.xml');
	}
	
	public function testLocalConfigHasPriorityOverDist() {
		touch('test.dist.xml');
		touch('test.xml');
		$loader = new Loader('test');
		$this->assertSame('test.xml', $loader->findConfigFile());
		unlink('test.dist.xml');
		unlink('test.xml');
	}
}
