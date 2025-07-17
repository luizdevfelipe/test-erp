<?php

namespace App\Core;

class Application 
{
    private static ?Container $container = null;
    private static ?DBConnection $DBConnection = null;

    public static function getContainer(): Container
    {
        if (self::$container === null) {
            self::$container = new Container();
        }

        return self::$container;
    }

    public static function getDBConnection(): DBConnection
    {
        if (self::$DBConnection === null) {
            self::$DBConnection = new DBConnection();
        }

        return self::$DBConnection;
    }
}

