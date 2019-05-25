<?php


namespace oukhennicheabdelkrim\DIC\tests;


use PHPUnit\Framework\TestCase;
use oukhennicheabdelkrim\DIC\DIC;
require_once 'TestClass/Bar.php';
require_once 'TestClass/Foo.php';
require_once 'TestClass/Classes.php';
use C,Foo,Bar;
class ResolvesTest extends TestCase
{



    public function testBindInstance_usingInstanceInjection()
    {
        $dic = new DIC();
        $dic->bind('bar_',new Bar(new Foo()));
        $this->assertInstanceOf(Bar::class,$dic->get('bar_'));

    }

    public function testBindInstance_usingDicInjection()
    {
        $dic = new DIC();
        $dic->bind('bar_',$dic->get('Bar'));
        $this->assertInstanceOf('Bar',$dic->get('bar_'));

    }

    public function testBindInstance_usingResolve()
    {
        $dic = new DIC();
        $dic->bind('bar_',function (){
            return new Bar(new Foo());
        });
        $this->assertInstanceOf('Bar',$dic->get('bar_'));
    }


    public function testBindInstance_usingResolveWithDic()
    {
        $dic = new DIC();
        $dic->bind('bar_',function ($dic){
            return $dic->get('Bar');
        });
        $this->assertInstanceOf(Bar::class,$dic->get('bar_'));

    }


    public function testBindInstnaceWithConstructWithOutParams()
    {
        $dic = new DIC();
        $dic->bind('myCInstance',function ($dic){
            return $dic->get('C');
        });
        $this->assertInstanceOf(C::class,$dic->get('myCInstance'));
    }


    public function testBindValue()
    {
        $dic = new DIC();
        $dic->bind('a',5);
        $this->assertEquals(5,$dic->get('a'));
    }

    public function testBindInstanceWithOutConstruct()
    {
        $dic = new DIC();
        $dic->bind('F_Instnace',function (){
            return new C();
        });
        $this->assertInstanceOf('C',$dic->get('F_Instnace'));

    }

}
