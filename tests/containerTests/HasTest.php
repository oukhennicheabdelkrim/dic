<?php


namespace oukhennicheabdelkrim\DIC\tests\containerTests;


use oukhennicheabdelkrim\DIC\DIC;
use PHPUnit\Framework\TestCase;
use Foo;

require_once dirname(__DIR__).'/TestClass/bootstrap.php';

class resolveTest extends TestCase
{
    private $container;

    protected function setUp()
    {
        $this->container=new DIC();
    }

    public function testHasForExistingClass()
    {

        $this->assertTrue($this->container->has('Foo'));
    }

    public function testHasForExistingAliasByInstanceInjection()
    {
        $this->container->bind('myFoo', new Foo());
        $this->assertTrue($this->container->has('myFoo'));
    }


    public function testHasForExistingAliasByResolve()
    {

        $this->container->bind('myFoo', function ($container) {
            return $container->get('Foo');
        });
        $this->assertTrue($this->container->has('myFoo'));
    }

    public function testHasForNotExsitingAlias()
    {

        $this->assertFalse($this->container->has('myFoo'));
    }

    public function testHasForInterface()
    {
        $this->assertFalse($this->container->has('MyInterface'));
    }

    public function testHasForTrait()
    {

        $this->assertFalse($this->container->has('Trait'));
    }
}
