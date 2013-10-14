<?php

namespace jjok\Decomposer\Console\Command;

use jjok\Decomposer\Finder\Adapter\ChildFirstPhpAdapter;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Console\Output\Output;

class KeepCommand extends Command {
	
	protected function configure() {
		$this->setName('keep')
		     ->setDescription('Keeps files.')
		     ->addOption('config', 'c', InputOption::VALUE_REQUIRED, '')
		     ->addOption('dry-run', 'd', InputOption::VALUE_NONE, '');
	}
	
	protected function execute(InputInterface $input, OutputInterface $output) 
	{
// 		$xml = new \DOMDocument('1.0', 'UTF-8');
// 		$xml->load('decomposer.dist.xml');
// 		$paths_to_keep = $xml->getElementsByTagName('keep');
		$config = $this->getApplication()->getConfig();

		foreach($config->getPathsToKeep() as $paths) {

			# Get the start directory
// 			$start = $keep->getAttribute('start');
// 			$output->writeln('Cleaning up '.$start);
			
			# Get the paths to keep
// 			$paths = array();
// 			foreach($keep->getElementsByTagName('path') as $path) {
// 				$paths[] = sprintf('/%s/', str_replace('/', '\/', $path->nodeValue));
// 			}

			# Create the finder
			$finder = Finder::create();
			$finder->addAdapter(new ChildFirstPhpAdapter())
			       ->setAdapter('child-first')
			       ->ignoreVCS(false)
			       ->ignoreDotFiles(false)
			       ->ignoreUnreadableDirs(true)
			       ->in($paths->getStart());
			
			# Add paths to keep
			foreach($paths->getPaths() as $path) {
// 				$finder->path($path->toRegEx());
				$finder->notPath($path->toRegEx());
			}
			
// 			$this->deleteAll($finder, $output, true);
			$this->deleteAll($finder, $output, $input->getOption('dry-run'));
		}
		
		$output->writeln('Finished.');
	}
	
	/**
	 * Recursively delete all files found by the given Finder.
	 * @param Finder $finder
	 * @param OutputInterface $output
	 * @param boolean $dry_run
	 */
	private function deleteAll(Finder $finder, OutputInterface $output, $dry_run) {
		foreach ($finder as $file) {
				
			# Delete all files
			if($file->isFile()) {
				$output->writeln('Deleting '. $file->getPathname(), Output::VERBOSITY_VERBOSE);
				if(!$dry_run) {
					unlink($file->getPathname());
				}
				continue;
			}
			
			# Delete any empty directories
// 			else {
			//TODO Do this better
			# Keep non-empty directories
			foreach(scandir($file) as $i) {
				if(!in_array($i, array('.', '..'))) {
					$output->writeln('Keeping '. $file->getPathname(), Output::VERBOSITY_VERBOSE);
					continue 2;
				}
			}
			$output->writeln('Deleting '. $file->getPathname(), Output::VERBOSITY_VERBOSE);
			if(!$dry_run) {
				rmdir($file->getPathname());
			}
// 			}
		}
	}
}
