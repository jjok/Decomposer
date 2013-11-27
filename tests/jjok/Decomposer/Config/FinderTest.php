<?php

namespace jjok\Decomposer\Config;

use PHPUnit_Framework_TestCase;

class FinderTest extends PHPUnit_Framework_TestCase {
	
	/**
	 * @expectedException PHPUnit_Framework_Error
	 */
	public function testFileNameIsRequired() {
		$finder = new Finder();
	}

	/**
	 * @expectedException PHPUnit_Framework_Error
	 */
	public function testFileTypeIsRequired() {
		$finder = new Finder('some-name');
	}
	
	//TODO test setting different file names and extensions.
	public function testTodo() {
		$this->markTestIncomplete('This test has not been implemented yet.');
	}

	/**
	 * @expectedException jjok\Decomposer\Config\MissingConfigException
	 */
	public function testExceptionThrownIfNoConfigFileFound() {
		$finder = new Finder('test', 'xml');
		$finder->find();
	}
	
	public function testDist() {
		touch('test.dist.xml');
		$finder = new Finder('test', 'xml');
		$this->assertSame('test.dist.xml', $finder->find());
		unlink('test.dist.xml');
	}
	
	public function testLocalConfigHasPriorityOverDist() {
		touch('test.dist.xml');
		touch('test.xml');
		$finder = new Finder('test', 'xml');
		$this->assertSame('test.xml', $finder->find());
		unlink('test.dist.xml');
		unlink('test.xml');
	}
}
