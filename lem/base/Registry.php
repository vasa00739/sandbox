<?php
/**
 * Created by PhpStorm.
 * User: Neo
 * Date: 27.02.2016
 * Time: 15:38
 */

namespace lem\base;


abstract class Registry
{
    abstract protected function get($key);

    abstract protected function set($key, $value);
}