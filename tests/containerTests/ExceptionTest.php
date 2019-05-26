<?php


namespace oukhennicheabdelkrim\DIC\tests\containerTests;

use PHPUnit\Framework\TestCase;

use oukhennicheabdelkrim\DIC\Definition\Exceptions\NoDefaultParams;
use oukhennicheabdelkrim\DIC\Definition\Exceptions\NotFoundException;
use oukhennicheabdelkrim\DIC\Definition\Exceptions\NotInstantiableExecption;



class ExceptionTest extends  TestCase{

    use TestableTrait;

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
