<?php

namespace FileRouter\Router;

class Load extends AbstractImpl
{

    /**
     * @param \SplFileInfo $sourcePath
     */
    function __construct(\SplFileInfo $sourcePath)
    {
        parent::__construct($sourcePath, 'php');
    }


    /**
     * @param string $route
     * @return void
     */
    public function handleRoute($route)
    {
        $requestedFile = $this->getFileByRoute($route);

        include $requestedFile->getRealPath();
    }

}
