<?php
/**
 * Created by PhpStorm.
 * User: Kikim
 * Date: 25/05/2019
 * Time: 00:00
 */

class Foo
{
  public $input;
  public $id;
  public function __construct($input = 44)
  {
      $this->input=44;
      $this->id=uniqid();
  }
}
