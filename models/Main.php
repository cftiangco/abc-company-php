<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
class Main
{

    protected $servername = "mysql";
    protected $username = "root";
    protected $password = "root";
    public $db;
    protected $database = "a2e_exam";
    public $table = "";

    public function __construct()
    {
        try {
            $this->db = new PDO("mysql:host=$this->servername;dbname=$this->database", $this->username, $this->password);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function create($data) {

        try {
            $stmt = $this->db->prepare("INSERT INTO $this->table (".implode(', ', array_keys($data)).") VALUES (:".implode(', :', array_keys($data)).")");
            $stmt->execute($data);
            return $this->getById($this->getInsertedID());
        } catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }

    }

    public function update($id, $data) {
        try {
            $set = [];
            foreach ($data as $key => $value) {
                $set[] = "$key=:$key";
            }
            $set = implode(', ', $set);
            
            $stmt = $this->db->prepare("UPDATE $this->table SET $set WHERE id = :id");
            $data['id'] = $id;
            $stmt->execute($data);
            
            return $this->getById($id);
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function getInsertedID() {
        try {
            return $this->db->lastInsertId();
        } catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }

    }

    public function fetchAll($orderBy = "") {
        try {
            return $this->db->query("SELECT * FROM $this->table $orderBy")->fetchAll(PDO::FETCH_OBJ);
        } catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function getById($id) {
        try {
            return $this->db->query("SELECT * FROM $this->table WHERE id = $id")->fetch(PDO::FETCH_OBJ);
        } catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    
}