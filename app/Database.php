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

    public function select($table, $columns = '*', $data){
        $sql = 'SELECT '.$columns.' FROM '.$table;

        $string = [];
        foreach($data as $keys => $values){
            $string[] = "`{$keys}` = :{$keys}";   //placeholder will never ba string
        }

        $sql .= ' WHERE '.implode(',', $string);

        $this->stmt = $this->connection->prepare($sql);

        foreach ($data as $placeholder => $value) {
            $this->stmt->bindParam(':'.$placeholder, $value);
        }

        return $this->stmt;


    }
    
}


define('DSN','mysql:dbname=php-ecommerce;host=localhost');
define('DB_USER','php-ecommerce');
define('DB_PASSWORD','php-ecommerce-2019');

$connection = new Database(DSN, DB_USER, DB_PASSWORD);


?>