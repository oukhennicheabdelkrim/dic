# _**﻿DiC**_ 

DIC is a simple **dependency-injection container** for **php**, allows developers to move object-creation logic out of their application logic.

[![Build Status](https://travis-ci.org/oukhennicheabdelkrim/DIC.svg?branch=master)](https://travis-ci.org/oukhennicheabdelkrim/DIC)
[![Latest Stable Version](https://poser.pugx.org/oukhennicheabdelkrim/dic/v/stable)](https://packagist.org/packages/oukhennicheabdelkrim/dic)
[![License](https://poser.pugx.org/oukhennicheabdelkrim/dic/license)](https://packagist.org/packages/oukhennicheabdelkrim/dic)

This package is compatible with 
[PSR-1](https://www.php-fig.org/psr/psr-1),
[PSR-4](https://www.php-fig.org/psr/psr-4) and
[PSR-11](https://www.php-fig.org/psr/psr-11), if you notice compliance oversights, please send me a patch via pull request.
## Requirements

The following versions of PHP are supported in this version:

- PHP 7.0
- PHP 7.1
- PHP 7.2

## Testing    

```
$ vendor/bin/phpunit
```
## Get started 

### Install the package via composer:

```
composer require oukhennicheabdelkrim/dic
````
### Simple usage 
To create a container, simply create an instance of the DIC class.

```
<?php
include 'vendor/autoload.php';

use oukhennicheabdelkrim\DIC\DIC;

$container = new DIC();

````
### Binding


You can bind any object with a key using ```bind``` method ,then you can retrieve instances by reffering them with their key using ```get``` method.
```
<?php

$container = new DIC();
$container->bind('myFoo',function(){
    return new Foo();
});

$myFoo = $container->get('myFoo');

````
**Note** : bind method returns the current container.

````get```` method creates a singleton instance by default, this means everytime you request a dependency it returns the same instance.

````
 $container = new DIC();
 $container->bind('myFoo',function(){
    return new Foo();
 });
  
 var_dump( $container->get('myFoo') === $container->get('myFoo')); //  true
````

Within any of your resolve callable, you always have access to the ```$container``` property which provides access to the current container:

```
$container = new DIC();

$container->bind('config',function(){
    return new DbConfig();
});

$container->bind('dbConnection',function($container){
    return new DbConnection($container->get('config'));
});

// $container->get('dbConnection') : get a singleton DbConnection

`````


You can also directly inject instance to bind it:

```
 $container->bind('myFoo',new Foo());
```

## Get a new instance 
You can also get a new instance using ```getFactory``` method
```
 $container = new DIC();
 $container->bind('myFoo',function(){
    return new Foo();
 });
 
  $container->get('myFoo') === $container->getFactory('myFoo') //  false
   
  $container->getFactory('myFoo') === $container->getFactory('myFoo') // false

```
## Resolving instance automatically

DIC can resolve any instantiable class without ```bind``` method, using the real ```class:name``` as an argument in ```get``` and ```getFactory``` methods

##### Example 1
```
/* Foo class */
class Foo{
  public $i;
  public function __construct($i = 44){
      $this->i=44;
  }
}
/* Bar class */
class Bar{
    public $foo;
    public function __construct(Foo $foo){
        $this->foo=$foo;
    }
}

$container = new DIC();
$bar=$container->get('Bar');

var_dump($bar->foo->i); // 44

//get method always returns a singleton instance.

var_dump($bar->foo === $container->get('Foo')); //  true

//getFactory method always returns a new instance.
var_dump($bar->foo === $container->getFactory('Foo')); // false

```
##### Exmaple 2
```
$container = new DIC();

$container->bind('bar1',function($container){
    // resolve Foo using class name
    return new Bar($container->get('Foo'));
});

$bar1 = $container->get('bar1');//singleton bar1

$bar  = $container->get('Bar'); //singleton Bar

var_dump($bar1 === $bar);  // false

var_dump($bar1->foo === $bar->foo) ; // true

```

With DIC you can also bind any variable : 

```
$container = new DIC();

$container->bind('a',5);
var_dump($container->get('a')); // 5
$container->bind('db.config',function(){
        $config = new Config(); // We can Also use $container->get('Config')
        return $config->getArray('db'); // Array of database configuration
})
->bind('dbConnexion',function($container){
        return new DbConnexion($container->get('db.config'));
});

var_dump($container->get('db.config')); //  Array of database configuration
var_dump($container->get('dbConnexion')); // singleton dbConnexion instance

```
**Note** : Since bind method return the current container, you can chain the binding process.

##### Example:
```
$myBar = $container->bind('myFoo',new Foo())
          ->bind('myBar',new Bar($container->get('myFoo'))->get('myBar');          
            
```

## has method

```has``` method returns true if the container can return an entry for the given identifier, returns false otherwise.
```
/* A class */
class A{
}
$container = new DIC();
var_dump($container->has('A')) ;// true
var_dump($container->has('b')); // false
var_dump($container->bind('b',new A())->has('b'));// true

```

