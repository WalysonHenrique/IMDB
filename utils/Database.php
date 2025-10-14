<?php

namespace Utils;

class Database{
    private static $SERVER = 'localhost';
    private static $USER = 'root';
    private static $PASSWORD = 'rootroot'; //Mudar o password
    private static $DATABASE = 'imdb';
    private static $conn = null;
    

    public static function getConn(){
        if (self::$conn === null) {
            self::$conn = mysqli_connect(self::$SERVER, self::$USER, self::$PASSWORD, self::$DATABASE);
        }
        return self::$conn;
    }


}


