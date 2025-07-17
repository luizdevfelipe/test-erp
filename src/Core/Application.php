<?php

namespace App\Core;

class Application 
{
    private static ?Container $container = null;

    public static function getContainer(): Container
    {
        if (self::$container === null) {
            self::$container = new Container();
        }

        return self::$container;
    }
}
