<?php

namespace Decomposer\Console\Command;

use Symfony\Component\Console\Command\Command;
// use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
// use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class KeepCommand extends Command {
	protected function configure()
	{
		$this->setName('keep')
		     ->setDescription('Keeps files.')
// 		->addArgument(
// 				'name',
// 				InputArgument::OPTIONAL,
// 				'Who do you want to greet?'
// 		)
// 		->addOption(
// 				'yell',
// 				null,
// 				InputOption::VALUE_NONE,
// 				'If set, the task will yell in uppercase letters'
// 		)
		;
	}
	
	protected function execute(InputInterface $input, OutputInterface $output)
	{
		$xml = new \DOMDocument('1.0', 'UTF-8');
		$xml->load('../decomposer.dist.xml');

		foreach($xml->getElementsByTagName('keep') as $keep) {

			$start = $keep->getAttribute('start');
			
			$paths = array();
			foreach($keep->getElementsByTagName('path') as $path) {
				$paths[] = $path->nodeValue;
			}
// 			$paths = array_map(function($path) {
// 				return $path->nodeValue;
// 			},
// 			$keep->getElementsByTagName('path'));
			print_r($start);
			print_r($paths);
		}
		
		$finder = new Finder();
		$finder->addAdapter(new Decomposer\Finder\Adapter\ChildFirstPhpAdapter())
		       ->setAdapter('child-first')
		       ->ignoreVCS(false)
		       ->ignoreDotFiles(false)
		       ->ignoreUnreadableDirs(true);
// 		$name = $input->getArgument('name');
// 		if ($name) {
// 			$text = 'Hello '.$name;
// 		} else {
// 			$text = 'Hello';
// 		}
	
// 		if ($input->getOption('yell')) {
// 			$text = strtoupper($text);
// 		}
	
// 		$output->writeln($text);
	}
}
