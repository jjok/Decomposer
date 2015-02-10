<?php

namespace jjok\Decomposer;

use PHPUnit_Framework_TestCase;

class FactoryTest extends PHPUnit_Framework_TestCase {
	
	/**
	 * @covers jjok\Decomposer\Factory::createPath
	 */
	public function testNewPathCanBeCreated() {
		$factory = new Factory();
		$path = $factory->createPath('some-path');
		$this->assertInstanceOf('jjok\Decomposer\Config\Path', $path);
		$this->assertSame('some-path', (string) $path);
	}
	
	/**
	 * @covers jjok\Decomposer\Factory::createPaths
	 */
	public function testNewPathsCanBeCreated() {
		$factory = new Factory();
		$paths = $factory->createPaths('some-start');
		$this->assertInstanceOf('jjok\Decomposer\Config\Paths', $paths);
		$this->assertSame('some-start', $paths->getStart());
	}
	
	/**
	 * @covers jjok\Decomposer\Factory::createConfig
	 */
	public function testNewConfigCanBeCreated() {
		$factory = new Factory();
		$config = $factory->createConfig(array('paths', 'more-paths'));
		$this->assertInstanceOf('jjok\Decomposer\Config\Config', $config);
		$this->assertCount(2, $config->getPathsToKeep());
	}
	
	/**
	 * @covers jjok\Decomposer\Factory::createFinder
	 */
	public function testNewFinderCanBeCreated() {
		$factory = new Factory();
		$finder = $factory->createFinder();
		$this->assertInstanceOf('Symfony\Component\Finder\Finder', $finder);
		
		$adapters = $finder->getAdapters();
		$this->assertInstanceOf('jjok\Decomposer\Finder\Adapter\ChildFirstPhpAdapter', $adapters[0]);
	}
	
	/**
	 * @covers jjok\Decomposer\Factory::createDOMDocument
	 */
	public function testNewDomDocumentCanBeCreated() {
		$factory = new Factory();
		$dom = $factory->createDOMDocument();
		$this->assertInstanceOf('DOMDocument', $dom);
	}
}
