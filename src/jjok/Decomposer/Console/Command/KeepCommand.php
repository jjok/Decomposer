<?php

namespace jjok\Decomposer\Console\Command;

use jjok\Decomposer\Factory;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Console\Output\Output;

class KeepCommand extends Command {
	
	/**
	 * (non-PHPdoc)
	 * @see \Symfony\Component\Console\Command\Command::configure()
	 */
	protected function configure() {
		$this->setName('keep')
		     ->setDescription('Removes files as specified in config file.')
		     ->addOption('config', 'c', InputOption::VALUE_REQUIRED, '')
		     ->addOption('dry-run', 'd', InputOption::VALUE_NONE, '');
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \Symfony\Component\Console\Command\Command::execute()
	 */
	protected function execute(InputInterface $input, OutputInterface $output) 
	{
		$config = $this->getApplication()->getConfig();

		if(!$input->getOption('dry-run')) {
			$dialog = $this->getHelperSet()->get('dialog');
			if (!$dialog->askConfirmation(
					$output,
					'<question>Continue with this action? (y|n)</question>',
					false
				)) {
				return;
			}
		}
		
		foreach($config->getPathsToKeep() as $paths) {

			# Create the finder
			$finder = Factory::createFinder()
					->in($paths->getStart());
			
			# Add paths to keep
			foreach($paths->getPaths() as $path) {
// 				$finder->path($path->toRegEx());
				$finder->notPath($path->toRegEx());
			}
			
// 			$this->deleteAll($finder, $output, true);
			$this->deleteAll($finder, $output, $input->getOption('dry-run'));
		}
		
// 		foreach($config->getPathsToRemove() as $paths) {
		
// 			# Create the finder
// 			$finder = Factory::createFinder()
// 					->in($paths->getStart());
			
// 			# Add paths to remove
// 			foreach($paths->getPaths() as $path) {
// 				$finder->path($path->toRegEx());
// 			}
			
// 			$this->deleteAll($finder, $output, $input->getOption('dry-run'));
// 		}
		
		$output->writeln('Finished.');
	}
	
// 	private function something(array $paths_list, $remove, OutputInterface $output) {
// 		foreach($paths_list as $paths) {
		
// 			# Create the finder
// 			$finder = Factory::createFinder()
// 					->in($paths->getStart());
				
// 			# Add paths to remove
// 			foreach($paths->getPaths() as $path) {
// 				if($remove) {
// 					$finder->path($path->toRegEx());
// 				}
// 				else {
// 					$finder->notPath($path->toRegEx());
// 				}
// 			}
			
// 			$this->deleteAll($finder, $output, $input->getOption('dry-run'));
// 		}
// 	}
	
	/**
	 * Recursively delete all files found by the given Finder.
	 * @param Finder $finder
	 * @param OutputInterface $output
	 * @param boolean $dry_run
	 */
	private function deleteAll(Finder $finder, OutputInterface $output, $dry_run) {
		foreach($finder as $file) {
				
			# Delete all files
			if($file->isFile()) {
				if($output->getVerbosity() === Output::VERBOSITY_VERBOSE) {
					$output->writeln('Deleting '. $file->getPathname(), Output::VERBOSITY_VERBOSE);
				}
				if(!$dry_run) {
					unlink($file->getPathname());
				}
				continue;
			}
			
// 			else {
			//TODO Do this better
			# Keep non-empty directories
			foreach(scandir($file) as $i) {
				if(!in_array($i, array('.', '..'))) {
					if($output->getVerbosity() === Output::VERBOSITY_VERBOSE) {
						$output->writeln('Keeping '. $file->getPathname());
					}
					continue 2;
				}
			}

			# Delete any empty directories
			if($output->getVerbosity() === Output::VERBOSITY_VERBOSE) {
				$output->writeln('Deleting '. $file->getPathname());
			}
			if(!$dry_run) {
				rmdir($file->getPathname());
			}
// 			}
		}
	}
}
