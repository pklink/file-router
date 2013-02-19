<?php

namespace FileController;

interface Controller
{

    /**
     * @return string
     */
    public function getFileExtension();

    /**
     * @return \SplFileInfo
     */
    public function getSourcePath();


    /**
     * @param string $request
     * @return void
     */
    public function handleRequest($request);


    /**
     * @param string $extension
     * @return void
     */
    public function setFileExtension($extension = 'php');


    /**
     * @param \SplFileInfo $sourcePath
     * @return void
     */
    public function setSourcePath(\SplFileInfo $sourcePath);

}
