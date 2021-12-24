<?php

namespace App\Model;

class Conexao
{
    private static $conn = NULL;

    static function getConexao()
    {
        if (is_null(self::$conn)){
            $host     = 'localhost';
            $db       = 'products_db';
            $user     = 'root';
            $password = '';

            self::$conn = new \PDO('mysql:host=' . $host . ';dbname=' . $db . ';charset=UTF8', $user, $password);
        }

        return self::$conn;
    }
}