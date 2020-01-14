<?php
/**
 * Created by PhpStorm.
 * User: Crxzy
 * Date: 2020/1/10
 * Time: 22:16
 */

namespace SimplePhp;


class Database
{
    private $driver;

    public function __construct()
    {
        $args = func_get_args();
        switch (sizeof($args)) {
            case 1:
                $this->Driver($args[0]);
                break;
            case 2:
                $this->Driver($args[0]);
                $this->Database($args[1]);
                break;
        }
    }

    public function Driver($driver)
    {
        $class = new \ReflectionClass("Drivers\\$driver");
        $instance = $class->newInstance();
        $this->driver = $instance;
        return $this;
    }

    public function Database($database)
    {
        $this->driver->setDatabase($database);
        return $this;
    }

    public function Collection($collection)
    {
        $this->driver->setCollection($collection);
        return $this->driver;
    }
}