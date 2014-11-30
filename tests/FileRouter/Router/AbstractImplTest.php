<?php

namespace FileRouter\Router;

class AbstractImplTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @return void
     */
    public function testIsAbstract()
    {
        $reflection = new \ReflectionClass('\FileRouter\Router\AbstractRouter');
        $this->assertTrue($reflection->isAbstract());
    }
}
