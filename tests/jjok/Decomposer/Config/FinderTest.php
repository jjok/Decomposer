<?php

namespace jjok\Decomposer\Config;

use jjok\Decomposer\Config\MissingConfigException;
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

	/**
	 * @expectedException jjok\Decomposer\Config\MissingConfigException
	 */
	public function testExceptionThrownIfNoConfigFileFound() {
		$finder = new Finder('test', 'xml');
		$finder->find();
	}
	
	public function testDefaultConfigFileNameCanBeUsed() {
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
	
	/**
	 * 
	 * @throws Exception
	 */
	public function testCustomConfigFileNameCanBeUsed() {
		
		try {
			$finder = new Finder('my', 'config');
			# This will throw an exception
			$finder->find();
			$this->assertTrue(false);
		}
		catch (MissingConfigException $e) {
			$this->assertTrue(true);
		}
		
		touch('my.dist.config');
		
		$finder = new Finder('my', 'config');
		$this->assertSame('my.dist.config', $finder->find());
		
		touch('my.config');

		$finder = new Finder('my', 'config');
		$this->assertSame('my.config', $finder->find());

		unlink('my.dist.config');
		unlink('my.config');
	}
}
