<?php


class Database
{
    private $connection;
    private $stmt;
    public function __construct($dsn, $username, $password)
    {
        try
        {
            $this->connection = new PDO($dsn, $username, $password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        }
        catch(PDOException $exception) 
        {
            echo $exception->getMessage();
        }
    }
    public function connection()
    {
        return $this->connection;
    }
    public function insert($table, $data)
    {
        $placeholders = [];
        foreach ($data as $key => $value) {
            $placeholders[] = ':'.$key;
        }
        //$sql = 'INSERT INTO '.$table.' ('.implode(',', array_keys($data)).') VALUES('.implode(',', array_values($data)).')';
        //echo $sql;
        //$stmt = $this->connection->prepare($sql);
        $query = 'INSERT INTO '.$table.' ('.implode(',', array_keys($data)).') VALUES ('.implode(',', $placeholders).')';
        $stmt = $this->connection->prepare($query);
        foreach ($data as $placeholder => $val) {
            $stmt->bindValue(':'.$placeholder, $val);
        }
        return $stmt->execute();
    }


    public function select($table, $columns = '*', array $data = [])
    {
        $query = 'SELECT '.$columns.' FROM '.$table;

        if (! empty($data)) {
            $string = [];
            foreach ($data as $key => $value) {
                $string[] = "`{$key}` = :{$key}"; // placeholder will never be string
            }
            $query .= ' WHERE '.implode(',', $string);
        }

        $this->stmt = $this->connection->prepare($query);
        
        foreach ($data as $placeholder => $val) {
            $this->stmt->bindParam(':'.$placeholder, $val);
        }

        return $this->stmt;
    }

    public function delete($table, $id)
    {
        $sql = 'DELETE FROM '.$table.' WHERE id=:id';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':id',$id);
        return $stmt->execute();
    }
    
}


define('DSN','mysql:dbname=php-ecommerce;host=localhost');
define('DB_USER','php-ecommerce');
define('DB_PASSWORD','php-ecommerce-2019');

$connection = new Database(DSN, DB_USER, DB_PASSWORD);
/* $re = $connection->select('roles');
$re->execute();
$d = $re->fetch();
var_dump($d);die(); */



?>