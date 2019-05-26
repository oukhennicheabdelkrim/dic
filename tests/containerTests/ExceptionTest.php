<?php


namespace oukhennicheabdelkrim\DIC\tests\containerTests;

use PHPUnit\Framework\TestCase;
use oukhennicheabdelkrim\DIC\Definition\Exceptions\NoDefaultParams;
use oukhennicheabdelkrim\DIC\Definition\Exceptions\NotFoundException;
use oukhennicheabdelkrim\DIC\Definition\Exceptions\NotInstantiableExecption;
use oukhennicheabdelkrim\DIC\DIC;

require_once dirname(__DIR__).'/TestClass/bootstrap.php';



class ExceptionTest extends  TestCase{

    private $container;

    protected function setUp()
    {
        $this->container=new DIC();
    }


    public function testNotFoundException()
    {

        $this->expectException(NotFoundException::class);
        $this->container->get('Ms');
    }

    public function testNotInstantiableException_Interface()
    {

        $this->expectException(NotInstantiableExecption::class);
        $this->container->get('MyInterface');

    }

    public function testNotInstantiableException_Trait()
    {
        $this->expectException(NotInstantiableExecption::class);
        $this->container->get('MyTrait');

    }

    public function testNoDefaultParamsException()
    {
        $this->expectException(NoDefaultParams::class);
        $this->container->get('ClassConstructorWithoutDefaultParams');
    }

}
