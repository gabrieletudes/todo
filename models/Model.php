<?php
namespace Model;
class Model{
    //returne rien ou PDO
    function connectDB(): ?\PDO
    {
        $dbConfig = @parse_ini_file(DB_INI_FILE);
        $dsn = sprintf(
            'mysql:dbname=%s;host=%s',
            $dbConfig['dbname'],
            $dbConfig['host']
        );
        try {
            return new \PDO(
                $dsn,
                $dbConfig['username'],
                $dbConfig['password'],
                [
                    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                    \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ
                ]
            );
        } catch (\PDOException $e) {
            return null;
        }
    }
}
