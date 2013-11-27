<?php

namespace jjok\Decomposer;

use PHPUnit_Framework_TestCase;

class FactoryTest extends PHPUnit_Framework_TestCase {
	
	/**
	 * @covers jjok\Decomposer\Factory::createPath
	 */
	public function testNewPathCanBeCreated() {
		$path = Factory::createPath('some-path');
		$this->assertInstanceOf('jjok\Decomposer\Config\Path', $path);
		$this->assertSame('some-path', (string) $path);
	}
	
	/**
	 * @covers jjok\Decomposer\Factory::createPaths
	 */
	public function testNewPathsCanBeCreated() {
		$paths = Factory::createPaths('some-start');
		$this->assertInstanceOf('jjok\Decomposer\Config\Paths', $paths);
		$this->assertSame('some-start', $paths->getStart());
	}
	
	/**
	 * @covers jjok\Decomposer\Factory::createConfig
	 */
	public function testNewConfigCanBeCreated() {
		$config = Factory::createConfig(array('paths', 'more-paths'));
		$this->assertInstanceOf('jjok\Decomposer\Config\Config', $config);
		$this->assertCount(2, $config->getPathsToKeep());
	}
	
	/**
	 * @covers jjok\Decomposer\Factory::createFinder
	 */
	public function testNewFinderCanBeCreated() {
		$finder = Factory::createFinder();
		$this->assertInstanceOf('Symfony\Component\Finder\Finder', $finder);
		
		$adapters = $finder->getAdapters();
		$this->assertInstanceOf('jjok\Decomposer\Finder\Adapter\ChildFirstPhpAdapter', $adapters[0]);
	}
}
