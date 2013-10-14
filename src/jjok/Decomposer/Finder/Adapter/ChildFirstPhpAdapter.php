<?php

namespace jjok\Decomposer\Finder\Adapter;

use Symfony\Component\Finder\Adapter\AbstractAdapter;
use Symfony\Component\Finder\Iterator;

/**
 * 
 * @author Jonathan Jefferies
 */
class ChildFirstPhpAdapter extends AbstractAdapter
{
    /**
     * {@inheritdoc}
     */
    public function searchInDirectory($dir)
    {
        $flags = \RecursiveDirectoryIterator::UNIX_PATHS;

        $iterator = new \RecursiveIteratorIterator(
            new Iterator\RecursiveDirectoryIterator($dir, $flags, $this->ignoreUnreadableDirs),
            \RecursiveIteratorIterator::CHILD_FIRST
        );

        return new Iterator\PathFilterIterator($iterator, $this->paths, $this->notPaths);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'child-first';
    }

    /**
     * {@inheritdoc}
     */
    protected function canBeUsed()
    {
        return true;
    }
}
