<?php

namespace FileController\Controller;

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
     * @param string $request
     * @return void
     */
    public function handleRequest($request)
    {
        $requestedFile = $this->getFileByRequest($request);

        echo file_get_contents($requestedFile->getRealPath());
    }

}
