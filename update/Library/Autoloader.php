<?php

namespace IpUpdate\Library;

/**
 * @package	ImpressPages
 * @copyright	Copyright (C) 2011 ImpressPages LTD.
 * @license see ip_license.html
 */


class Autoloader
{
    private static $dirs;
    
    public function __construct()
    {
        $this->register(IUL_BASE_DIR);
    }

    public function register($rootDir)
    {
        if (empty($dirs)) {
            spl_autoload_register('IpUpdate\Library\Autoloader::load');
        }
        static::$dirs[] = $rootDir;
    }

    public static function load($name)
    {
        if (strpos($name, 'IpUpdate\\Library\\') === 0) {
            $name = substr($name, 17);
        } else {
            return false;
        }
        
        $fileName = str_replace('\\', '/', $name) . '.php';
        if($fileName[0] == '/') { //in some environments required class starts with slash. In that case remove the slash.
            $fileName = substr($fileName, 1);
        }

        return self::tryFile($fileName);
    }

    private static function tryFile($fileName)
    {
        if (empty(static::$dirs)) {
            return false;
        }
        foreach(static::$dirs as $dir) {
            if (file_exists($dir.$fileName)) {
                require_once($dir.$fileName);
                return true;
            }
        }
    }
}



