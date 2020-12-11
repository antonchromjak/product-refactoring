<?php

namespace App;

use \PDO;

final class DB
{
    private static $instance;

    private function __construct()
    {
    }

    public static function getInstance()
    {
        if (null === self::$instance) {
            $pdo = new PDO(
                "mysql:host=" . _DB_SERVER_ . ';port=3307;dbname=' . _DB_NAME_,
                _DB_USER_,
                _DB_PASSWD_
            );
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_SILENT);
            $pdo->query('SET NAMES utf8');
            $pdo->query('SET CHARACTER SET utf8');

            self::$instance = $pdo;
        }

        return self::$instance;
    }
}
