<?php
/**
 * Created by PhpStorm.
 * User: Crxzy
 * Date: 2020/1/10
 * Time: 12:00
 */

namespace Drivers;
class MongoDB
{
    private $manager;
    private $db_config;
    private $uri;

    public function __construct()
    {
        $this->db_config = \SimplePhp\Config::get("db");
        $this->uri = "mongodb://{$this->db_config->username}:{$this->db_config->password}@{$this->db_config->host}:{$this->db_config->post}";
        $this->manager = new \MongoDB\Driver\Manager($this->uri);
    }
}