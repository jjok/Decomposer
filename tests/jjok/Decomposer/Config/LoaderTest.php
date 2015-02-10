<?php

namespace jjok\Decomposer\Config;

use jjok\Decomposer\Factory;
use PHPUnit_Framework_TestCase;

class LoaderTest extends PHPUnit_Framework_TestCase {
	
	/**
	 * @covers jjok\Decomposer\Config\Loader::load
	 */
	public function testLoaderLoadsTheGivenConfigFile() {
		$loader = new Loader(new Factory());
		$config = $loader->load(__DIR__.'/../../../dummies/dummy.xml');
		
		$this->assertInstanceOf('jjok\Decomposer\Config\Config', $config);
		$this->assertCount(1, $config->getPathsToKeep());
		
		$config = $loader->load(__DIR__.'/../../../dummies/dummy2.xml');
		
		$this->assertInstanceOf('jjok\Decomposer\Config\Config', $config);
		
		$paths_to_keep = $config->getPathsToKeep();
		$this->assertCount(3, $paths_to_keep);

		$this->assertSame('some-start-path', $paths_to_keep[0]->getStart());
		$this->assertCount(1, $paths_to_keep[0]->getPaths());
		$this->assertContainsOnlyInstancesOf('jjok\Decomposer\Config\Path', $paths_to_keep[0]->getPaths());
		
		$this->assertSame('some-start-path2', $paths_to_keep[1]->getStart());
		$this->assertCount(2, $paths_to_keep[1]->getPaths());
		$this->assertContainsOnlyInstancesOf('jjok\Decomposer\Config\Path', $paths_to_keep[1]->getPaths());
		
		$this->assertSame('some-start-path3', $paths_to_keep[2]->getStart());
		$this->assertCount(4, $paths_to_keep[2]->getPaths());
		$this->assertContainsOnlyInstancesOf('jjok\Decomposer\Config\Path', $paths_to_keep[2]->getPaths());
	}
}
