<?php

namespace lem\controller;

use lem\base\AppException;

class ApplicationHelper
{

    private static $_instance = null;
    private $_option_file = __DIR__ . "/data/options.xml";

    private function __construct()
    {
    }

    public function instance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }



    function getOptions()
    {
        if (!file_exists($this->_option_file))
        {
            throw new AppException(
                "Файл с параметрами не найден");
        }

        $options = simplexml_load_file($this->_option_file);

        return $options;
    }
}