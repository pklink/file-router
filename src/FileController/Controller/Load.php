<?php

namespace FileController\Controller;

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
     * @param string $request
     * @return void
     */
    public function handleRequest($request)
    {
        $requestedFile = $this->getFileByRequest($request);

        include $requestedFile->getRealPath();
    }

}
