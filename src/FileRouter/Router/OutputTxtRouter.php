<?php

namespace FileRouter\Router;

/**
 * Output files with the extension "txt" in the given source path
 *
 * @author Pierre Klink <dev@klinks.info>
 * @license MIT See LICENSE file for more information
 */
class OutputTxtRouter extends AbstractRouter
{

    /**
     * Create instance and set the file extension txt
     *
     * @param \SplFileInfo $sourcePath
     */
    public function __construct(\SplFileInfo $sourcePath)
    {
        parent::__construct($sourcePath, 'txt');
    }

    /**
     * Handle the given route $route
     *
     * @param string $route
     * @return void
     */
    public function handleRoute($route)
    {
        $routingFile = $this->getFileByRoute($route);
        echo file_get_contents($routingFile->getRealPath());
    }
}
