<?php

namespace jjok\Decomposer\Console\Command;

use PHPUnit_Framework_TestCase;

class KeepCommandTest extends PHPUnit_Framework_TestCase {
	
	/**
	 * @covers jjok\Decomposer\Console\Command\KeepCommand::configure
	 */
	public function testCommandIsConfigured() {
		$command = new KeepCommand();
		$this->assertSame('keep', $command->getName());
		$this->assertSame('Removes files as specified in config file.', $command->getDescription());
		echo $command->getHelp();
	}
	
}
