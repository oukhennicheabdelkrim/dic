<?php

namespace oukhennicheabdelkrim\DIC\tests\containerTests;

use PHPUnit\Framework\TestCase;



use Bar,Foo;

class FactoryTest extends TestCase
{

    use TestableTrait;
    public function testFactory()
    {
        $bar1 = $this->container->getFactory('Bar');
        $bar2 = $this->container->getFactory('Bar');
        $this->assertNotEquals($bar1,$bar2);
    }

    public function testFactoryInjectionEqual_1()
    {
        $foo = $this->container->get('Foo');
        $bar = $this->container->getFactory('Bar');
        $this->assertEquals($foo,$bar->foo);
    }

    public function testFactoryInjectionEqual_2()
    {

        $bar1 = $this->container->getFactory('Bar');
        $bar2 = $this->container->getFactory('Bar');
        $this->assertEquals($bar1->foo,$bar2->foo);
    }


    public function testSingletonAfterGettingFactory()
    {
        $bar0 = $this->container->get('Bar');
        $newbar = $this->container->getFactory('Bar');
        $bar1 = $this->container->get('Bar');
        $this->assertEquals($bar0,$bar1);
    }

    public function testFactoryByResolve_1()
    {

        $this->container->bind('bar1',function ($container){
            return new Bar($container->getFactory('Foo'));
        });
        $this->assertNotEquals($this->container->getFactory('bar1'),$this->container->getFactory('bar1'));
    }

    public function testFactoryByResolve_2()
    {

        $this->container->bind('bar1',function ($container){
            return new Bar($this->container->getFactory('Foo'));
        });
        $this->assertNotEquals($this->container->getFactory('Bar'),$this->container->getFactory('bar1'));
    }

    public function testFactoryByInstnaceInjection()
    {
        $foo = new Foo();
        $this->container->bind('defaultFaut',$foo);
        $this->assertNotEquals($foo,$this->container->getFactory('Foo'));
    }

    public function testFactoryByDicInstnaceInjection()
    {
        $this->container->bind('foo1',$this->container->getFactory('Foo'));
        $this->container->bind('foo2',$this->container->getFactory('Foo'));
        $this->assertNotEquals($this->container->get('foo1'),$this->container->get('foo2'));
    }

}
