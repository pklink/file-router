


# FileRouter

[![Build Status](https://travis-ci.org/pklink/file-router.png?branch=master)](https://travis-ci.org/pklink/file-router)
[![Dependency Status](https://www.versioneye.com/user/projects/5281e31a632baca88e000211/badge.svg?style=flat)](https://www.versioneye.com/user/projects/5281e31a632baca88e000211)

A library for mapping files in a directory to routes like `hello/world`

## Usage

### Router for including PHP files

We have the following file structure:
	
```bash
.
├── example.php
└── includes
	├── hello
	│   └── world.php
    └── hello.php
```

And here is our `example.php`

```php
// the source path for including files
$sourcePath = new SplFileInfo(__DIR__ . '/includes');

// create router
$router = new \FileRouter\Router\IncludeRouter($sourcePath);
```

Now you can load/include files in the `includes`-directory

```php
$router->handleRoute('hello'); // include includes/hello.php
$router->handleRoute('hello/world'); // include includes/hello/world.php
```

Or like this:

```php
$router->handleRoute($_GET['r']);
```


### Router for printing txt-files

We have the following file structure:
	
```bash
.
├── example.php
└── docs
	├── hello
	│   └── world.txt
    └── hello.txt
```

And here is our `example.php`

```php
// the source path for including files
$sourcePath = new SplFileInfo(__DIR__ . '/docs');

// create router
$router = new \FileRouter\Router\OutputTxtRouter($sourcePath);
```

Now you can print/output files in the `docs`-directory

```php
$router->handleRoute('hello'); // print includes/hello.txt
$router->handleRoute('hello/world'); // print includes/hello/world.txt
```


## Advanced Usage

### Write your own Router

It is no problem to write and add your own router. Implement the interface `\FileRouter\Router` or use the abtract implementation of `\FileRouter\Router\AbstractImpl`, so you only need to implement `Router::handleRoute()`

```php
class CustomRouter extends \FileRouter\Router\AbstractRouter
{

	public function handleRoute($router)
	{
		/* @var \SplFileInfo $routingFile */
		$routingFile = $this->getFileByRoute($route);
		
		// do something
	}

}	
```

## Run Tests

You can use PHPUnit from the vendor-folder.

```bash
php composer.phar install --dev
php vendor/bin/phpunit tests/
```

## License

This package is licensed under the MIT License. See the LICENSE file for details.