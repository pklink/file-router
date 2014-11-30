<?php

namespace FileRouter\Router;

use FileRouter\Exception\Directory;
use FileRouter\Exception\Path;
use FileRouter\Exception\Route\DoesNotExistException;
use FileRouter\Exception\Route\IsNotInSourcePathException;
use FileRouter\Exception\RouteException;

class LoadTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var IncludeRouter
     */
    protected $router;

    /**
     * @var \SplFileInfo
     */
    protected $sourcePath;

    public function setUp()
    {
        $this->sourcePath = new \SplFileInfo(__DIR__. '/../../example/php');
        $this->router = new IncludeRouter($this->sourcePath);
    }


    public function testGetSetSourcePath()
    {
        $router = $this->router;
        $sourcePath = new \SplFileInfo(__DIR__);

        // get contructor source path
        $this->assertEquals($this->sourcePath, $router->getSourcePath());

        // set source path
        $router->setSourcePath($sourcePath);

        // get source path
        $this->assertEquals($sourcePath, $router->getSourcePath());

        // set non existing path
        $sourcePath = new \SplFileInfo('blblb');
        try {
            $router->setSourcePath($sourcePath);
            $this->assertTrue(false);
        } catch (Directory\DoesNotExistException $e) {
            $this->assertTrue(true);
        }

        // set file as source path
        $sourcePath = new \SplFileInfo(__FILE__);
        try {
            $router->setSourcePath($sourcePath);
            $this->assertTrue(false);
        } catch (Directory\DoesNotExistException $e) {
            $this->assertTrue(true);
        }
    }


    public function testGetSetFileExtension()
    {
        $router = $this->router;

        // test default extension
        $this->assertEquals('php', $router->getFileExtension());

        // set extension
        $router->setFileExtension('bla');

        // get extension
        $this->assertEquals('bla', $router->getFileExtension());

        // set non scalar values
        try {
            $router->setFileExtension(array());
            $this->assertTrue(false);
        } catch (\UnexpectedValueException $e) {
            $this->assertTrue(true);
        }
        try {
            $router->setFileExtension(new \stdClass());
            $this->assertTrue(false);
        } catch (\UnexpectedValueException $e) {
            $this->assertTrue(true);
        }
    }


    public function testHandleRoute()
    {
        $router = $this->router;

        // handle non scalar route
        try {
            $router->handleRoute(array());
            $this->assertTrue(false);
        } catch (\UnexpectedValueException $e) {
            $this->assertTrue(true);
        }
        try {
            $router->handleRoute(new \stdClass());
            $this->assertTrue(false);
        } catch (\UnexpectedValueException $e) {
            $this->assertTrue(true);
        }

        // handle non existing route
        try {
            $router->handleRoute('blblblbl');
            $this->assertTrue(false);
        } catch (DoesNotExistException $e) {
            $this->assertTrue(true);
        }

        // handle file outside of the source path
        try {
            $router->handleRoute('../../FileRouter/RouterTest');
            $this->assertTrue(false);
        } catch (IsNotInSourcePathException $e) {
            $this->assertTrue(true);
        }

        // existing file
        ob_start();
        $router->handleRoute('hello');
        $this->assertEquals('hello!', ob_get_clean());

        ob_start();
        $router->handleRoute('hello/world');
        $this->assertEquals('hello world!', ob_get_clean());
    }

}
