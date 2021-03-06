<?php

namespace FileRouter\Router;

use FileRouter\Exception\Directory;
use FileRouter\Exception\Route\DoesNotExistException;
use FileRouter\Exception\Route\IsNotInSourcePathException;
use FileRouter\Router;

/**
 * @author Pierre Klink <dev@klinks.info>
 * @license MIT See LICENSE file for more information
 */
abstract class AbstractRouter implements Router
{

    /**
     * Allowed file extension of the routing files.
     * Only files with this extension are relevant for routing
     *
     * @var string
     */
    protected $fileExtension = 'php';

    /**
     * Source path for routing.
     * Only files in this path are relevant for routing.
     *
     * @var \SplFileInfo
     */
    protected $sourcePath;

    /**
     * Create instance and set source path and allowed file extension.
     *
     * @param \SplFileInfo $sourcePath
     * @param string $fileExtension default is "php"
     */
    public function __construct(\SplFileInfo $sourcePath, $fileExtension = 'php')
    {
        $this->setSourcePath($sourcePath);
        $this->setFileExtension($fileExtension);
    }

    /**
     * Get the mapped file for the given route $route.
     *
     * @param string $route
     * @return \SplFileInfo
     * @throws \FileRouter\Exception\Route\IsNotInSourcePathException
     * @throws \FileRouter\Exception\Route\DoesNotExistException
     * @throws \UnexpectedValueException
     */
    protected function getFileByRoute($route)
    {
        // check if $request is scalar
        if (!is_scalar($route)) {
            throw new \UnexpectedValueException('$route has to be scalar');
        }

        // create file
        $file = new \SplFileInfo(sprintf('%s/%s.%s', $this->sourcePath->getRealPath(), $route, $this->fileExtension));

        // check file/route is exist
        if (!file_exists($file->getPathname())) {
            throw new DoesNotExistException($route);
        }

        // check if path of file in the sourcepath
        $sourcePathPartOfFile = substr($file->getRealPath(), 0, strlen($this->sourcePath->getRealPath()));
        if ($sourcePathPartOfFile != $this->sourcePath->getRealPath()) {
            $pathname = $file->getPathname();
            $realpath = $this->sourcePath->getRealPath();
            $message = sprintf('File "%s" is not in the source path "%s', $pathname, $realpath);
            throw new IsNotInSourcePathException($message);
        }

        return $file;
    }

    /**
     * Get the allowed file extension.
     *
     * @see self::$fileExtension
     * @return string
     */
    public function getFileExtension()
    {
        return $this->fileExtension;
    }

    /**
     * Get the source path
     *
     * @see self::$sourcePath
     * @return \SplFileInfo
     */
    public function getSourcePath()
    {
        return $this->sourcePath;
    }

    /**
     * Set the allowed file extension
     *
     * @see self::$fileExtension
     * @param string $extension
     * @return void
     * @throws \UnexpectedValueException
     */
    public function setFileExtension($extension = 'php')
    {
        // check extension is scalar
        if (!is_scalar($extension)) {
            throw new \UnexpectedValueException('$extension has to be scalar');
        }

        $this->fileExtension = $extension;
    }

    /**
     * Set the source path
     *
     * @see self::$sourcePath
     * @param \SplFileInfo $sourcePath
     * @throws \FileRouter\Exception\Directory\DoesNotExistException
     * @throws \FileRouter\Exception\Directory\IsNotReadableException
     */
    public function setSourcePath(\SplFileInfo $sourcePath)
    {
        // check if path is a directory
        if (!$sourcePath->isDir()) {
            throw new Directory\DoesNotExistException($sourcePath->getPathname());
        }

        // check if path readable
        if (!$sourcePath->isReadable()) {
            throw new Directory\IsNotReadableException($this->sourcePath->getPathname());
        }

        $this->sourcePath = $sourcePath;
    }
}
