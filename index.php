<?php


use lem\base\ApplicationRegistry;

include 'autoload.php';

class Person
{
    public $name = "Вася";
    public $age = "Петя";
}

$p = new Person();

ApplicationRegistry::instance()->setDSN($p);
$test = ApplicationRegistry::instance()->getDSN();

var_dump($test);