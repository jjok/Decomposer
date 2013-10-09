<?php

namespace Decomposer\Console\Command;

use Decomposer\Finder\Adapter\ChildFirstPhpAdapter;
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
		//TODO Do this somewhere else. Add a Config class
		$xml = new \DOMDocument('1.0', 'UTF-8');
		$xml->load('decomposer.dist.xml');

		foreach($xml->getElementsByTagName('keep') as $keep) {

			# Get the start directory
			$start = $keep->getAttribute('start');
			$output->writeln('Cleaning up '.$start);
			
			# Get the paths to keep
			$paths = array();
			foreach($keep->getElementsByTagName('path') as $path) {
				$paths[] = sprintf('/%s/', str_replace('/', '\/', $path->nodeValue));
			}

			# Create the finder
			$finder = Finder::create();
			$finder->addAdapter(new ChildFirstPhpAdapter())
			       ->setAdapter('child-first')
			       ->ignoreVCS(false)
			       ->ignoreDotFiles(false)
			       ->ignoreUnreadableDirs(true)
			       ->in($start);
			
			# Add paths to keep
			foreach($paths as $path) {
// 				$path = sprintf('/%s/', str_replace('/', '\/', $path));
				// 	$finder->path($path);
				$finder->notPath($path);
			}
			
			foreach ($finder as $file) {
				// 	print $file->getRelativePathname()."\n";
// 				printf('Deleting %s%s', $file->getRelativePathname(), PHP_EOL);
			
				# Delete all files
				if($file->isFile()) {
					$output->writeln('Deleting '. $file->getPathname());
// 					unlink($file->getPathname());
				}
				# Delete any empty directories
				else{
					//TODO Do this better
					foreach(scandir($file) as $i) {
						if(!in_array($i, array('.', '..'))) {
							$output->writeln('Keeping '. $file->getPathname());
							continue 2;
						}
					}
// 					print_r(scandir($file));
					$output->writeln('Deleting '. $file->getPathname());
// 					rmdir($file->getPathname());
				}
			}
			
			$output->writeln('Finished.');
		}
	}
}
