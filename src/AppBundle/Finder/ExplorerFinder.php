<?php

/*
 * This file is part of the blog project.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Finder;

use Symfony\Component\Finder\Finder;

/**
 * Class ExplorerFinder.
 *
 * @author Michael COULLERET <michael@coulleret.pro>
 */
class ExplorerFinder
{
    /**
     * @var Finder
     */
    private $finder;

    /**
     * @var string
     */
    private $directoryData;

    /**
     * Constructor.
     *
     * @param Finder $finder
     * @param string $directoryData
     */
    public function __construct(Finder $finder, $directoryData)
    {
        if (null === trim($directoryData)) {
            throw new \InvalidArgumentException('Directory data cannot be null');
        }

        $this->finder = $finder;
        $this->directoryData = $directoryData;
    }

    /**
     * Get directories.
     *
     * @return Finder
     */
    public function getDirectories()
    {
        return $this->finder->in($this->directoryData)->exclude('.*')->directories();
    }

    /**
     * Get directory.
     *
     * @param string $relativePath
     *
     * @return Finder
     */
    public function getDirectory($relativePath)
    {
        return $this->finder->in(sprintf('%s/%s', $this->directoryData, $relativePath))->exclude('.*');
    }
}
