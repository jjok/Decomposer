<?php

namespace jjok\Decomposer\Finder\Adapter;

use PHPUnit_Framework_TestCase;

class ChildFirstPhpAdapterTest extends PHPUnit_Framework_TestCase {
	
	/**
	 * @covers jjok\Decomposer\Finder\Adapter\ChildFirstPhpAdapter::searchInDirectory
	 */
	public function testFileIteratorCanBeCreated() {
		$adapter = new ChildFirstPhpAdapter();
		$iterator = $adapter->searchInDirectory('./');
		$this->assertInstanceOf(
			'Symfony\Component\Finder\Iterator\PathFilterIterator',
			$iterator
		);
	}
	
	/**
	 * @covers jjok\Decomposer\Finder\Adapter\ChildFirstPhpAdapter::getName
	 */
	public function testGetName() {
		$adapter = new ChildFirstPhpAdapter();
		$this->assertSame('child-first', $adapter->getName());
	}
}
