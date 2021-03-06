<?php

namespace FileRouter\Router;

/**
 * Include PHP files in the given source path
 *
 * @author Pierre Klink <dev@klinks.info>
 * @license MIT See LICENSE file for more information
 */
class IncludeRouter extends AbstractRouter
{

    /**
     * Create instance with source path and "php" as fileExtension
     *
     * @param \SplFileInfo $sourcePath
     */
    public function __construct(\SplFileInfo $sourcePath)
    {
        parent::__construct($sourcePath, 'php');
    }

    /**
     * Handle the route $route
     *
     * @param string $route
     * @return void
     */
    public function handleRoute($route)
    {
        $requestedFile = $this->getFileByRoute($route);
        /** @noinspection PhpIncludeInspection */
        include $requestedFile->getRealPath();
    }
}
