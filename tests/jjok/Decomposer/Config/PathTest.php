<?php

namespace jjok\Decomposer\Config;

use PHPUnit_Framework_TestCase;

class PathTest extends PHPUnit_Framework_TestCase {
	
	/**
	 * @expectedException PHPUnit_Framework_Error
	 */
	public function testPathNameIsRequired() {
		$path = new Path();
	}
	
	public function testPathNameCanBeSet() {
		$this->assertSame('some-path', (string) new Path('some-path'));
		$this->assertSame('some-file.php', (string) new Path('some-file.php'));
	}
	
	public function testPathCanBeConvertedToRegEx() {
		$path = new Path('some-path');
		$this->assertSame('/^some-path/', $path->toRegEx());
		
		$path = new Path('some-path/some-dir/some-file.php');
		$this->assertSame('/^some-path\/some-dir\/some-file.php/', $path->toRegEx());
		
		$path = new Path('some-path\some-dir\some-file.php');
		$this->assertSame('/^some-path\some-dir\some-file.php/', $path->toRegEx());
	}
}
