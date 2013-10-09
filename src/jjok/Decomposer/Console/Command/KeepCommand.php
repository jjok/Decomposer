<?php

namespace Decomposer\Console\Command;

use Symfony\Component\Console\Command\Command;
// use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
// use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

use Symfony\Component\Finder\Finder;

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
// 				$paths[] = $path->nodeValue;
				$paths[] = sprintf('/%s/', str_replace('/', '\/', $path->nodeValue));
			}

			$finder = new Finder();
			$finder->addAdapter(new \Decomposer\Finder\Adapter\ChildFirstPhpAdapter())
			       ->setAdapter('child-first')
			       ->ignoreVCS(false)
			       ->ignoreDotFiles(false)
			       ->ignoreUnreadableDirs(true)
			       ->in($start);
			
			foreach($paths as $path) {
// 				$path = sprintf('/%s/', str_replace('/', '\/', $path));
				// 	$finder->path($path);
				$finder->notPath($path);
			}
			
			foreach ($finder as $file) {
				// 	print $file->getRelativePathname()."\n";
// 				printf('Deleting %s%s', $file->getRelativePathname(), PHP_EOL);
			
				if($file->isFile()) {
					$output->writeln('Deleting '. $file->getPathname());
// 					unlink($file->getPathname());
					
				}
				else{
// 					print_r($file);
// 				exit();
// 				// 	print_r($file->getChildren());
// 					if(!$file->hasChildren()) {
// 						printf('Deleting %s%s', $file->getPathname(), PHP_EOL);
// // 						rmdir($file->getPathname());
// 					}
// 					else {
// 						printf('Keeping %s%s', $file->getPathname(), PHP_EOL);
// 					}
				}
			}
		}
	}
}
