<?php
/**
 * Created by PhpStorm.
 * User: Crxzy
 * Date: 2020/1/14
 * Time: 11:37
 */

namespace Models;


class Gallery extends ModelBase
{

    protected function setDriver()
    {
        $this->driver = "MongoDB";
        // TODO: Implement setDriver() method.
    }

    public function get($query)
    {
        return $this->connect->Database("image_cloud")->Collection("image_pool")->find($query);
    }
}