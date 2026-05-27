<?php

namespace App\Core;

class Database{
    private ?\PDO $connection = null;
    private static ?self $instance = null;

    private function __construct(){
        $this->connect();
    }

    public static function getInstance():self
    {
        //checks if an instance already exists 
        // If it doesn't exist, create a new one and save it in $instance.
        // return $instance;
        if(self::$instance == null){
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function connect() : bool
    {
        $databaseConfig = \config('database');

        $dsn = "mysql: host={$databaseConfig['host']};dbname={$databaseConfig['dbname']};charset={$databaseConfig['charset']}";

        $options = [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
        ];

        try{
            $this->connection = new \PDO($dsn, $databaseConfig['username'], $databaseConfig['password'], $options);
            return true;
        }catch(\PDOException $e){
            throw new \Exception('Database connection error: ' . $e->getMessage());
        }
        return false;
    }
    // Returns an single query result
    public function fetch(string $sql, array $params =[]):array | false 
    {
        $stmt = $this->query($sql, $params);
        return $stmt->fetch();
    }

    // Returns an array with the query data
    public function fetchAll($sql, $params =[]):array
    {
        $stmt = $this->query($sql, $params);
        return $stmt->fetchAll();
    }

    //returns rowCount
    public function execute($sql, $params =[]): string
    {
        $stmt = $this->query($sql, $params);
        return $stmt->rowCount();
    }

    // Returns the last ID 
    public function lastInsertId(): string
    {
        return $this->connection->lastInsertId();
    }

    public function query(string $sql, array $params =[]): \PDOStatement
    {
        try{
            $stmt = $this->connection->prepare($sql);
            $stmt->execute($params);
            return $stmt;
        }catch(\PDOException $e){
            throw new \Exception('Database query error: ' . $e->getMessage());
        }
    }
}