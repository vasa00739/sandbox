<?php
namespace lem\command;

/**
 * Created by PhpStorm.
 * User: Neo
 * Date: 27.02.2016
 * Time: 16:48
 */
class CommandContext
{
    private $_param = array();
    private $_error = "";

    function __construct()
    {
        $this->_param = $_REQUEST;
    }

    /**
     * @param $key
     * @param $val
     */
    function addParam($key, $val)
    {
        $this->_param[$key] = $val;
    }

    /**
     * @param $key
     * @return null
     */
    function get($key)
    {
        if (isset($this->_param[$key]))
            return $this->_param[$key];
        return null;
    }

    /**
     * @return string
     */
    public function getError()
    {
        return $this->_error;
    }

    /**
     * @param string $error
     */
    public function setError($error)
    {
        $this->_error = $error;
    }

}