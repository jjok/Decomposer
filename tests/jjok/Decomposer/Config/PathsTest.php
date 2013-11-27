<?php

namespace jjok\Decomposer\Config;

use PHPUnit_Framework_TestCase;

class PathsTest extends PHPUnit_Framework_TestCase {
	
	/**
	 * @expectedException PHPUnit_Framework_Error
	 */
	public function testStartIsRequired() {
		$paths = new Paths();
	}
	
	public function testStartCanBeSet() {
		$paths = new Paths('my-start');
		$this->assertSame('my-start', $paths->getStart());
		$this->assertCount(0, $paths->getPaths());
	}
	
	public function testPathsCanBeSet() {
		$paths = new Paths('another-start', array(
			'dummy-path',
			'dummy-path2'
		));
		$this->assertCount(2, $paths->getPaths());
	}
	
	public function testPathsCanBeAdded() {
		$paths = new Paths('');
		$this->assertCount(0, $paths->getPaths());
		
		$paths->addPath(new Path(''));
		$this->assertCount(1, $paths->getPaths());
		
		$paths->addPath(new Path(''));
		$this->assertCount(2, $paths->getPaths());
	}
	
	public function testAdditionalPathsCanBeAdded() {
		$paths = new Paths('', array(
			'', ''
		));
		$this->assertCount(2, $paths->getPaths());
	
		$paths->addPath(new Path(''));
		$this->assertCount(3, $paths->getPaths());
	
		$paths->addPath(new Path(''));
		$this->assertCount(4, $paths->getPaths());
	}
}
