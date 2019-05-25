<?php


namespace oukhennicheabdelkrim\DIC\tests;


use PHPUnit\Framework\TestCase;
use oukhennicheabdelkrim\DIC\DIC;

require_once 'TestClass/Bar.php';
require_once 'TestClass/Foo.php';
require_once 'TestClass/notInstanciable.php';

use Bar, Foo;

class resolveTest extends TestCase
{
    public function testHasForExistingClass()
    {
        $dic = new DIC();
        $this->assertTrue($dic->has('Foo'));
    }

    public function testHasForExistingAliasByInstanceInjection()
    {
        $dic = new DIC();
        $dic->bind('myFoo', new Foo());
        $this->assertTrue($dic->has('myFoo'));
    }


    public function testHasForExistingAliasByResolve()
    {
        $dic = new DIC();
        $dic->bind('myFoo', function ($dic) {
            return $dic->get('Foo');
        });

        $this->assertTrue($dic->has('myFoo'));
    }

    public function testHasForNotExsitingAlias()
    {
        $dic = new DIC();
        $this->assertNotTrue($dic->has('myFoo'));
    }

    public function testHasForInterface()
    {
        $dic = new DIC();
        $this->assertNotTrue($dic->has('MyInterface'));
    }

    public function testHasForTrait()
    {
        $dic = new DIC();
        $this->assertNotTrue($dic->has('Trait'));
    }
}
