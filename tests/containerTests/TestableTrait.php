<?php

namespace oukhennicheabdelkrim\DIC\tests\containerTests;

use oukhennicheabdelkrim\DIC\DIC;




trait TestableTrait
{
    /**
     * @var DIC
     */
    public function __construct()
    {
        parent::__construct();
        require_once dirname(__DIR__).'/TestClass/bootstrap.php';
    }

    public $container;
    public function setUp()
    {
        $this->container=new DIC();
    }
}
