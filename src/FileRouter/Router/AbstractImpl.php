<?php

namespace FileRouter\Router;

/**
 * @author Pierre Klink <dev@klinks.info>
 * @license MIT See LICENSE file for more information
 */
abstract class AbstractImpl implements \FileRouter\Router
{

    /**
     * @var string
     */
    protected $fileExtension = 'php';

    /**
     * @var \SplFileInfo
     */
    protected $sourcePath;


    /**
     * @param \SplFileInfo $sourcePath
     * @param string $fileExtension
     */
    function __construct(\SplFileInfo $sourcePath, $fileExtension = 'php')
    {
        $this->setSourcePath($sourcePath);
        $this->setFileExtension($fileExtension);
    }


    /**
     * @param $route
     * @return \SplFileInfo
     * @throws \OutOfBoundsException if requested file not in source path
     * @throws \InvalidArgumentException if $request not scalar
     * @throws \UnexpectedValueException if requested file is not exist
     */
    protected function getFileByRoute($route)
    {
        // check if $request is scalar
        if (!is_scalar($route))
        {
            throw new \UnexpectedValueException('$route must be scalar');
        }

        // create file
        $file = new \SplFileInfo(sprintf('%s/%s.%s', $this->sourcePath->getRealPath(), $route, $this->fileExtension));

        // check file is exist
        if (!file_exists($file->getPathname()))
        {
            throw new \InvalidArgumentException(sprintf('file "%s" does not exist', $file->getPathname()));
        }

        // check if path of file in the sourcepath
        $sourcePathPartOfFile = substr($file->getRealPath(), 0, strlen($this->sourcePath->getRealPath()));
        if ($sourcePathPartOfFile != $this->sourcePath->getRealPath())
        {
            throw new \OutOfBoundsException(sprintf('requested file "%s" is not in the source path "%s', $file->getPathname(), $this->sourcePath->getRealPath()));
        }

        return $file;
    }


    /**
     * @return string
     */
    public function getFileExtension()
    {
        return $this->fileExtension;
    }


    /**
     * @param string $extension
     * @return void
     * @throws \UnexpectedValueException
     */
    public function setFileExtension($extension = 'php')
    {
        // check extension is scalar
        if (!is_scalar($extension))
        {
            throw new \UnexpectedValueException('$extension must be scalar');
        }

        $this->fileExtension = $extension;
    }


    /**
     * @return \SplFileInfo
     */
    public function getSourcePath()
    {
        return $this->sourcePath;
    }


    /**
     * @param \SplFileInfo $sourcePath
     * @throws \InvalidArgumentException
     */
    public function setSourcePath(\SplFileInfo $sourcePath)
    {
        // path must be a directory and readable
        if (!$sourcePath->isDir() || !$sourcePath->isReadable())
        {
            throw new \InvalidArgumentException(sprintf('%s must be a readable directory'));
        }

        $this->sourcePath = $sourcePath;
    }

}
