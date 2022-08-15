<?php

class RoutesUtil
{
    private static array $routes = array();

    public static function route($pattern, $callback)
    {
        $pattern = '/^' . str_replace('/', '\/', $pattern) . '$/';
        self::$routes[$pattern] = $callback;
    }

    public static function execute()
    {
        foreach (self::$routes as $pattern => $callback)
        {
            if (preg_match($pattern, $_SERVER['REQUEST_URI']))
            {
                return $callback();
            }
        }
        NetUtil::sendError(NOT_FOUND_CODE, "Method not found");
    }
}