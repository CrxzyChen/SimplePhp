<?php
/**
 * Created by PhpStorm.
 * User: Crxzy
 * Date: 2020/1/10
 * Time: 22:07
 */

namespace Models;

abstract class ModelBase
{
    protected $connect;
    protected $driver;

    public function __construct()
    {
        $this->setDriver();
        $this->connect = new \SimplePhp\Database($this->getDriver());
    }

    abstract protected function setDriver();

    private function getDriver(): string
    {
        return $this->driver;
    }
}