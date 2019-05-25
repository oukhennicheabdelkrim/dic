<?php


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
