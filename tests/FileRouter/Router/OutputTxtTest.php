<?php

namespace FileRouter\Router;

use FileRouter\Exception\Route\DoesNotExistException;

class OutputTxtTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var IncludeRouter
     */
    protected $router;

    /**
     * @var \SplFileInfo
     */
    protected $sourcePath;

    /**
     * @return void
     */
    public function setUp()
    {
        $this->sourcePath = new \SplFileInfo(__DIR__ . '/../../example/txt');
        $this->router = new OutputTxtRouter($this->sourcePath);
    }

    /**
     * @return void
     */
    public function testGetFileExtension()
    {
        // test default extension
        $this->assertEquals('txt', $this->router->getFileExtension());
    }

    /**
     * @return void
     */
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

        // existing file
        ob_start();
        $router->handleRoute('hello');
        $this->assertEquals('hello!', ob_get_clean());

        ob_start();
        $router->handleRoute('hello/world');
        $this->assertEquals('hello world!', ob_get_clean());
    }
}
