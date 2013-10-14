<?php

namespace jjok\Decomposer;

use jjok\Decomposer\Console\Command\KeepCommand;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\InputInterface;

class Decomposer extends Application
{
	
	protected $config;
	
	public function __construct($config, $version) {
		$this->config = $config;
		
		parent::__construct('Decomposer', $version);
	}
	
	
	public function getConfig() {
		return $this->config;
	}
}