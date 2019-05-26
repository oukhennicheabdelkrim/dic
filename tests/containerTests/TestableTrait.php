<?php

namespace oukhennicheabdelkrim\DIC\tests\containerTests;

use oukhennicheabdelkrim\DIC\DIC;




trait TestableTrait
{
    /**
     * @var DIC
     */


    public $container;

    public function __construct()
    {
        parent::__construct();
        require_once dirname(__DIR__).'/TestClass/bootstrap.php';
    }

    protected function setUp()
    {
        parent::setUp();
        $this->container=new DIC();
    }
}
