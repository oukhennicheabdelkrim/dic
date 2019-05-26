<?php


namespace oukhennicheabdelkrim\DIC\tests\containerTests;



use oukhennicheabdelkrim\DIC\DIC;
use PHPUnit\Framework\TestCase;
use Foo,Bar;

require_once dirname(__DIR__).'/TestClass/bootstrap.php';

class InstanceTest  extends TestCase
{
    private $container;

    protected function setUp()
    {
        $this->container=new DIC();
    }

    public function testInstanceOf()
    {
        $bar=$this->container->get('Bar');
        $this->assertInstanceOf('Bar',$bar);
    }


    public function testInstanceOfByAlias()
    {
        $this->container->bind('myBar',function ($container){
            return new Bar($container->get('Foo'));
        });
        $this->assertInstanceOf('Bar',$this->container->get('myBar'));

    }

    public function testInstanceOfByInjection()
    {
        $foo = new Foo();
        $this->container->bind('myFoo',$foo);
        $this->assertInstanceOf('Foo',$this->container->get('myFoo'));
    }

    public function testInstanceOfByResolve()
    {
        $this->container->bind('myFoo',function ($container){
            return $container->get('Foo');
        });
        $this->assertInstanceOf('Foo',$this->container->get('myFoo'));
    }

    public function testEqualByInjection()
    {
        $foo = new Foo();
        $this->container->bind('myfoo',$foo);
        $this->assertEquals($foo,$this->container->get('myfoo'));
    }



    public function testSingletonInstance1()
    {
        $bar=$this->container->get('Bar');
        $this->assertEquals($bar->foo,$this->container->get('Foo'));

    }

    public function testSingletonInstance2()
    {
        $id=$this->container->get('Bar')->id;
        $this->assertEquals($id,$this->container->get('Bar')->id);
    }

    public function testSingletonByAlias()
    {

        $this->container->bind('myFoo',function (){
            return new Foo();

        })->bind('MyBar',function ($container){

            return new Bar($container->get('myFoo'));
        });

        $foo = $this->container->get('myFoo');

        $this->assertEquals($foo,$this->container->get('MyBar')->foo);

    }

    public function testInitParams()
    {
        $this->assertEquals(44,$this->container->get('Bar')->foo->input);
    }


    public function testInstanceWithOutConstuct()
    {
        $this->assertInstanceOf('C',$this->container->get('C'));
    }



    /****************

      A
    |   |
    B   C
    |
     D
    | |
    E C



     *****/

    public function testDeepResolveSingleton1()
    {
        $a = $this->container->get('A');
        $this->assertEquals($a->b->d->c,$this->container->get('C'));

    }


    public function testDeepResolveSingleton2()
    {
        $a = $this->container->get('A');
        $this->assertEquals($a->b->d->c,$a->c);

    }


    public function testDeepResolveSingleton3()
    {
        $a = $this->container->get('A');
        $this->assertEquals($a->b->d,$this->container->get('B')->d);
    }


    public function testDeepResolveFactory()
    {
        $a = $this->container->get('A');
        $this->assertFalse($a===$this->container->getFactory('A'));
    }










}
