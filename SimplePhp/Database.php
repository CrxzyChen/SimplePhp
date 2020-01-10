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

    private $conn;

    public function __construct($driver)
    {
        $class = new \ReflectionClass("Drivers\\$driver");
        $this->conn = $class->newInstance();
    }
}