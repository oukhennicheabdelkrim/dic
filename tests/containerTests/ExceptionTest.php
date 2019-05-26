<?php


namespace oukhennicheabdelkrim\DIC\tests\containerTests;

use PHPUnit\Framework\TestCase;
use oukhennicheabdelkrim\DIC\Definition\Exceptions\NoDefaultParams;
use oukhennicheabdelkrim\DIC\Definition\Exceptions\NotFoundException;
use oukhennicheabdelkrim\DIC\Definition\Exceptions\NotInstantiableExecption;
use oukhennicheabdelkrim\DIC\DIC;

require_once dirname(__DIR__).'/TestClass/bootstrap.php';



class ExceptionTest extends  TestCase{

    public function testNotFoundException()
    {
        $dic = new DIC();
        $this->expectException(NotFoundException::class);
        $dic->get('Ms');
    }

    public function testNotInstantiableException_Interface()
    {
        $dic = new DIC();
        $this->expectException(NotInstantiableExecption::class);
        $dic->get('MyInterface');

    }

    public function testNotInstantiableException_Trait()
    {
        $dic = new DIC();
        $this->expectException(NotInstantiableExecption::class);
        $dic->get('MyTrait');

    }

    public function testNoDefaultParamsException()
    {
        $dic = new DIC();
        $this->expectException(NoDefaultParams::class);
        $dic->get('ClassConstructorWithoutDefaultParams');
    }
}
