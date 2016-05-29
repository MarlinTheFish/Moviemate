<?php

class Config
{
    private static $settings;

    public static function set($key, $value)
    {
        self::$settings[$key] = $value;
    }

    public static function get($key)
    {
        if (isset(self::$settings[$key])) {
            return self::$settings[$key];
        }

        return null;
    }
}