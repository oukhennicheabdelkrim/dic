<?php
/**
 * Created by PhpStorm.
 * User: Kikim
 * Date: 25/05/2019
 * Time: 02:15
 */
/****************

    A
  |  |
  B  C
  |
  D
 | |
 E C



 *****/
class A
{
    public function __construct(B $b,C $c)
    {
        $this->b=$b;
        $this->c=$c;
    }
}
class B
{
    public function __construct(D $d)
    {
        $this->d=$d;
    }
}
class C
{

}
class D
{
    public function __construct(E $d,C $c)
    {
        $this->e=$d;
        $this->c=$c;
    }
}
class E
{
    public function __construct()
    {

    }
}

class F{}
