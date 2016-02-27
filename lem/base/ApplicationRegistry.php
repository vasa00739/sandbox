<?php
namespace lem\base;


use lem\controller\Request;

class ApplicationRegistry extends Registry
{
    private static $_instance = null;
    private $_request = null;
    private $_freezedir =  __DIR__."\\data";
    private $_values = array();
    // Время последнего чтения файла
    private $_mtimes = array();

    private function __construct()
    {
    }

    static function instance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }


    protected function get($key)
    {
        // получаем директорию с фалом кэша
        $path = $this->_freezedir . DIRECTORY_SEPARATOR . $key;
        // если файл существует
        if (file_exists($path))
        {
            //Очищает кэш состояния файлов
            clearstatcache();
            // Возвращает время последнего изменения файла
            $mtime = filemtime($path);

            // проверяем время последнего чтения файла
            if (!isset($this->_mtimes))
            {
                $this->_mtimes = 0;
            }
            // если файл был изменен со временем последнего чтения
            // то считываем его содержимое
            if ($mtime > $this->_mtimes)
            {
                $data = file_get_contents($path);
                $this->_mtimes[$key] = $mtime;
                return ($this->_values[$key]=unserialize($data));
            }
        }
        if (isset($this->_values[$key]))
        {
            return $this->_values[$key];
        }
        return null;
    }

    protected function set($key, $value)
    {
        $this->_values[$key] =$value;
        $path = $this->_freezedir . DIRECTORY_SEPARATOR . $key;
        file_put_contents($path, serialize($value));
        $this->_mtimes[$key]=time();
    }


    // DSN = Data Source Name
    public function setDSN($dsn)
    {
        return self::instance()->set('dsn', $dsn);
    }

    public function getDSN()
    {
        return self::instance()->get('dsn');
    }

    public function getRequest() {
        $inst = self::instance();
        if (is_null($inst->_request))
        {
            $inst->_request = new Request();
        }
        return $this->_request;
    }
}
