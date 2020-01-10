<?php
/**
 * Created by PhpStorm.
 * User: Crxzy
 * Date: 2020/1/10
 * Time: 22:07
 */

namespace Models;

class ModelBase
{
    private $database;

    public function __construct()
    {
        $this->database = new \SimplePhp\Database("MongoDB");
    }
}