<?php


namespace oukhennicheabdelkrim\DIC\tests\containerTests;


use PHPUnit\Framework\TestCase;

use C,Foo,Bar;

class ResolvesTest extends TestCase
{

    use TestableTrait;

    public function testBindInstance_usingInstanceInjection()
    {

        $this->container->bind('bar_',new Bar(new Foo()));
        $this->assertInstanceOf(Bar::class,$this->container->get('bar_'));

    }

    public function testBindInstance_usingDicInjection()
    {
        $this->container->bind('bar_',$this->container->get('Bar'));
        $this->assertInstanceOf('Bar',$this->container->get('bar_'));

    }

    public function testBindInstance_usingResolve()
    {
        $this->container->bind('bar_',function (){
            return new Bar(new Foo());
        });
        $this->assertInstanceOf('Bar',$this->container->get('bar_'));
    }


    public function testBindInstance_usingResolveWithDic()
    {

        $this->container->bind('bar_',function ($container){
            return $container->get('Bar');
        });
        $this->assertInstanceOf(Bar::class,$this->container->get('bar_'));

    }


    public function testBindInstnaceWithConstructWithOutParams()
    {

        $this->container->bind('myCInstance',function ($container){
            return $container->get('C');
        });
        $this->assertInstanceOf(C::class,$this->container->get('myCInstance'));
    }


    public function testBindValue()
    {

        $this->container->bind('a',5);
        $this->assertEquals(5,$this->container->get('a'));
    }

    public function testBindInstanceWithOutConstruct()
    {
        $this->container->bind('F_Instnace',function (){
            return new C();
        });
        $this->assertInstanceOf('C',$this->container->get('F_Instnace'));

    }

}
