<?php

namespace jjok\Decomposer;

use jjok\Decomposer\Config\Config;
use Symfony\Component\Console\Application;

class Decomposer extends Application
{
	
	/**
	 * The application configuration.
	 * @var \jjok\Decomposer\Config\Config
	 */
	protected $config;
	
	/**
	 * Set the application configuration.
	 * @param \jjok\Decomposer\Config\Config $config
	 * @param string $version
	 */
	public function __construct(Config $config, $version) {
		$this->config = $config;
		
		parent::__construct('Decomposer', $version);
	}
	
	/**
	 * Get the application configuration.
	 * @return \jjok\Decomposer\Config\Config
	 */
	public function getConfig() {
		return $this->config;
	}
}
