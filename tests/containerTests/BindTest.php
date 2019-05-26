<?php


namespace oukhennicheabdelkrim\DIC\tests\containerTests;


use PHPUnit\Framework\TestCase;
use oukhennicheabdelkrim\DIC\DIC;
use C,Foo,Bar;
require_once dirname(__DIR__).'/TestClass/bootstrap.php';

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
