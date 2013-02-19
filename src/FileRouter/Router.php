<?php

namespace FileRouter;

/**
 * @author Pierre Klink <dev@klinks.info>
 * @license MIT See LICENSE file for more information
 */
interface Router
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
     * @param string $route
     * @return void
     */
    public function handleRoute($route);


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
