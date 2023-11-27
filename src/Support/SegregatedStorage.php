<?php

namespace Yeofan\Support;

class SegregatedStorage
{
    public static $data = [];

    private static function getCId()
    {
        $id = getmypid() > 0 ? getmypid() : getmypid();
        return "cid_" . $id;
    }

    public static function set($key, $val)
    {
        self::$data[self::getCId() . '_' . $key] = $val;
    }

    public static function get($key)
    {
        return self::$data[self::getCId() . '_' . $key] ?? '';
    }

    public static function del($key)
    {
        if (isset(self::$data[self::getCId() . '_' . $key])) {
            unset(self::$data[self::getCId() . '_' . $key]);
        }
    }

}