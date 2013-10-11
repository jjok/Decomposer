<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace jjok\Decomposer\Finder\Adapter;

use Symfony\Component\Finder\Adapter\AbstractAdapter;
use Symfony\Component\Finder\Iterator;

/**
 * PHP finder engine implementation.
 *
 * @author Jean-François Simon <contact@jfsimon.fr>
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
