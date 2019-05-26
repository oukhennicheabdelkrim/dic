<?php

namespace oukhennicheabdelkrim\DIC\tests\containerTests;

use oukhennicheabdelkrim\DIC\DIC;

require_once dirname(__DIR__).'/TestClass/bootstrap.php';


trait TestableTrait
{
    /**
     * @var DIC
     */


    public $container;

    public function setUp()
    {
        $this->container=new DIC();
    }
}
