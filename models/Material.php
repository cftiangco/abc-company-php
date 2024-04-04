<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('Main.php');

class Material extends Main { 
    public $table = "materials";

    public function __construct() {
        parent::__construct();
    }

    public function checkIfBarcodeAlreadyExists($barcode) {
        return $this->db->query("SELECT COUNT(*) FROM {$this->table} WHERE barcode = '{$barcode}'")->fetchColumn();
    }

    public function fetchAllWithCategories() {
        return $this->db->query("SELECT materials.*, categories.description as category FROM materials
        INNER JOIN categories ON materials.category_id = categories.id;")->fetchAll(PDO::FETCH_OBJ);
    }

    public function fetchOneWithCategory($id) {
        return $this->db->query("SELECT materials.*, categories.description as category FROM materials
        INNER JOIN categories ON materials.category_id = categories.id WHERE materials.id = '{$id}';")->fetch(PDO::FETCH_OBJ);
    }

}