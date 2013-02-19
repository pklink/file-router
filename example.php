<?php

require __DIR__ . '/vendor/autoload.php';


/********** EXAMPLE FOR INCLUDING PHP FILES **********/

// the source path for including files
$sourcePath = new SplFileInfo(__DIR__ . '/example/php');

// create router
$controller = new \FileController\Controller\Load($sourcePath);

// handle 'hello'-route
$controller->handleRequest('hello');

// handle 'hello/world'-route
$controller->handleRequest('hello/world');

// handle not existing file
try {
    $controller->handleRequest('not/existing/file');
} catch (InvalidArgumentException $e) {
    printf('<pre>%s</pre>', $e->getMessage());
}

// handle file outside of the source path
try {
    $controller->handleRequest('../../example');
} catch (OutOfBoundsException $e) {
    printf('<pre>%s</pre>', $e->getMessage());
}


/********** EXAMPLE FOR INCLUDING PHP FILES **********/

// the source path for including files
$sourcePath = new SplFileInfo(__DIR__ . '/example/txt');

// create router
$controller = new \FileController\Controller\OutputTxt($sourcePath);

// handle 'hello'-route
$controller->handleRequest('hello');

// handle 'hello/world'-route
$controller->handleRequest('hello/world');

// handle not existing file
try {
    $controller->handleRequest('not/existing/file');
} catch (InvalidArgumentException $e) {
    printf('<pre>%s</pre>', $e->getMessage());
}
