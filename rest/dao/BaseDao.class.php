<?php
require_once __DIR__ . '/../config.php';
class BaseDao
{
    protected $conn;


    protected $table_name;


    /**
     * constructor of dao class
     */
    public function __construct($table_name)
    {
        $this->table_name = $table_name;
        $host = Config::$host;
        $username = Config::$username;
        $password = Config::$password;
        $schema = Config::$database;
        $port = Config::$port;
        $this->conn = new PDO("mysql:host=$host;port=$port;dbname=$schema", $username, $password);
        // set the PDO error mode to exception
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }


    /**
     * Method used to read all objects from database
     */
    public function get_all()
    {
        $stmt = $this->conn->prepare("SELECT * FROM " . $this->table_name);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function get_by_customer_id($customer_id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM " . $this->table_name . " WHERE customer_id = :customer_id");
        $stmt->execute(['customer_id' => $customer_id]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return reset($result);
    }


    /**
     * Delete record from the database
     */
    public function delete($customer_id)
    {
        $stmt = $this->conn->prepare("DELETE FROM " . $this->table_name . " WHERE customer_id=:customer_id");
        $stmt->bindParam(':customer_id', $customer_id); // SQL injection prevention
        $stmt->execute();
    }


    public function add($entity)
    {
        $query = "INSERT INTO " . $this->table_name . " (";
        foreach ($entity as $column => $value) {
            $query .= $column . ", ";
        }
        $query = substr($query, 0, -2);
        $query .= ") VALUES (";
        foreach ($entity as $column => $value) {
            $query .= ":" . $column . ", ";
        }
        $query = substr($query, 0, -2);
        $query .= ")";


        $stmt = $this->conn->prepare($query);
        $stmt->execute($entity); // sql injection prevention
        $entity['customer_id'] = $this->conn->lastInsertId();
        return $entity;
    }


    public function update($customer_id, $entity, $customer_id_column = "customer_id")
    {
        $query = "UPDATE " . $this->table_name . " SET ";
        foreach ($entity as $name => $value) {
            $query .= $name . "= :" . $name . ", ";
        }
        $query = substr($query, 0, -2);
        $query .= " WHERE ${customer_id_column} = :customer_id";


        $stmt = $this->conn->prepare($query);
        $entity['customer_id'] = $customer_id;
        $stmt->execute($entity);
    }


    protected function query($query, $params = [])
    {
        $stmt = $this->conn->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    protected function query_unique($query, $params)
    {
        $results = $this->query($query, $params);
        return reset($results);
    }


}
?>
