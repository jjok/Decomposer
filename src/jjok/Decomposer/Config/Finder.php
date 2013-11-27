<?php

namespace jjok\Decomposer\Config;

/**
 * 
 * @author Jonathan Jefferies
 */
class Finder {
	
	/**
	 * The base name of the file.
	 * @var string
	 */
	protected $name;
	
	/**
	 * The file format.
	 * @var string
	 */
	protected $format;
	
	/**
	 * Possible file name formats.
	 * @var string[]
	 */
	protected $filename_formats;

	/**
	 * 
	 * @param string $name
	 * @param string $format
	 * @param string[] $filename_formats
	 */
	public function __construct($name, $format, array $filename_formats = array(
		'%s.%s',
		'%s.dist.%s'
	)) {
		$this->name = $name;
		$this->format = $format;
		$this->filename_formats = $filename_formats;
	}
	
	/**
	 * Find the configuration file.
	 * @throws MissingConfigException
	 * @return string
	 */
	public function find() {
		foreach($this->filename_formats as $filename_format) {
			$file = sprintf($filename_format, $this->name, $this->format);
			if(file_exists($file)) {
				return $file;
			}
		}
	
		throw new MissingConfigException('Config file not found.');
	}
}
