<?php
/**
 * Created by PhpStorm.
 * User: Crxzy
 * Date: 2020/1/10
 * Time: 12:02
 */

namespace SimplePhp;

class  Config
{
    /**
     * @return string of config file contents
     * @throws \Exception
     */
    private static function getConfig()
    {
        if (isset($_SESSION["SIMPLEPHP_CONFIG"])) { //Judge whether server was recorded config!
            return $_SESSION["SIMPLEPHP_CONFIG"];
        } else {
            $file_contents = file_get_contents(CONFIG_FILE);
            if (!$file_contents) {
                throw new \Exception("config_file is not exist! config_file:" . CONFIG_FILE);
            } else {
                $_SESSION["SIMPLEPHP_CONFIG"] = $file_contents;// set cache of config
                return $file_contents;
            }
        }

    }

    /**
     * @param string $key
     * @return mixed results of config search by $key_source
     * @throws \Exception
     */
    public static function get(string $key)
    {
        $config_json = json_decode(self::getConfig());
        $key_copy = $key;
        foreach ($config_json->alias as $k => $v) { //use source name to replace the alias
            $key_copy = str_replace($v, $k, $key_copy);
        }
        $key_arr = explode(".", $key_copy);
        $config_value = $config_json;
        foreach ($key_arr as $k) {//search the contents of config by key
            if (!property_exists($config_value, $k)) {
                throw new \Exception("config is not exist! config:$key");
            }
            $config_value = $config_value->$k;
        }
        return $config_value;
    }
}