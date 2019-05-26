<?php


namespace oukhennicheabdelkrim\DIC\tests\containerTests;


use oukhennicheabdelkrim\DIC\DIC;
use PHPUnit\Framework\TestCase;
use Foo;

require_once dirname(__DIR__).'/TestClass/bootstrap.php';

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
        $this->assertFalse($dic->has('myFoo'));
    }

    public function testHasForInterface()
    {
        $dic = new DIC();
        $this->assertFalse($dic->has('MyInterface'));
    }

    public function testHasForTrait()
    {
        $dic = new DIC();
        $this->assertFalse($dic->has('Trait'));
    }
}
