<?php
/**
 * Created by PhpStorm.
 * User: Kikim
 * Date: 25/05/2019
 * Time: 00:00
 */

class Bar
{
    public $foo;
    public $id;
    public function __construct(Foo $foo)
    {
        $this->foo=$foo;
        $this->id = uniqid();
    }

    public function setFoo(Foo $foo)
    {
        $this->foo=$foo;
    }
}
