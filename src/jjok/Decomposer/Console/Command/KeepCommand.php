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
// 				$finder->path($path);
				$finder->notPath($path);
			}
			
			$this->delete($finder, $output, true);
// 			$this->delete($finder, $output, $input->getOption('dry-run'));
			
			$output->writeln('Finished.');
		}
	}
	
	/**
	 * 
	 * @param Finder $finder
	 * @param OutputInterface $output
	 * @param boolean $dry_run
	 */
	private function delete(Finder $finder, OutputInterface $output, $dry_run) {
		foreach ($finder as $file) {
				
			# Delete all files
			if($file->isFile()) {
				$output->writeln('Deleting '. $file->getPathname(), Output::VERBOSITY_VERBOSE);
				if(!$dry_run) {
					unlink($file->getPathname());
				}
			}
			# Delete any empty directories
			else {
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
			}
		}
	}
}
