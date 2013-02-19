<?php

namespace FileController;

class Controller
{

    /**
     * @var string
     */
    protected $sourcePath;


    /**
     * @var string
     */
    protected $routingParam = 'r';


    function __construct()
    {

    }


    /**
     * @return string
     */
    public function getRoutingParam()
    {
        return $this->routingParam;
    }


    /**
     * @return string
     */
    public function getSourcePath()
    {
        return $this->sourcePath;
    }


    /**
     * @param string $routingParam
     */
    public function setRoutingParam($routingParam)
    {
        $this->routingParam = $routingParam;
    }


    /**
     * @param string $sourcePath
     */
    public function setSourcePath($sourcePath)
    {
        $this->sourcePath = $sourcePath;
    }

}
