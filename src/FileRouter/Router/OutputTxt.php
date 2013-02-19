<?php

namespace FileRouter\Router;

/**
 * @author Pierre Klink <dev@klinks.info>
 * @license MIT See LICENSE file for more information
 */
class OutputTxt extends AbstractImpl
{

    /**
     * @param \SplFileInfo $sourcePath
     */
    function __construct(\SplFileInfo $sourcePath)
    {
        parent::__construct($sourcePath, 'txt');
    }


    /**
     * @param string $route
     * @return void
     */
    public function handleRoute($route)
    {
        $routingFile = $this->getFileByRoute($route);
        echo file_get_contents($routingFile->getRealPath());
    }

}
