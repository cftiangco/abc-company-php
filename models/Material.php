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
        try {
            return $this->db->query("SELECT COUNT(*) FROM {$this->table} WHERE barcode = '{$barcode}'")->fetchColumn();
        } catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function fetchAllWithCategories() {
        try {
            return $this->db->query("SELECT materials.*, categories.description as category FROM materials
            INNER JOIN categories ON materials.category_id = categories.id;")->fetchAll(PDO::FETCH_OBJ);
        } catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
        
    }

    public function fetchOneWithCategory($id) {
        try {
            return $this->db->query("SELECT materials.*, categories.description as category FROM materials
            INNER JOIN categories ON materials.category_id = categories.id WHERE materials.id = '{$id}';")->fetch(PDO::FETCH_OBJ);
        } catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function fetchMaterialsWithLocation($statusId) {
        try {
            require_once('MaterialLocation.php');
            $materialLocation = new MaterialLocation();
            
            $materials = $this->fetchAll();

            foreach($materials as $m) {
                $locations = [];

                foreach($materialLocation->fetchAllByMaterialIdAndStatusId($m->id,$statusId) as $ml) {
                    if($m->id == $ml->material_id) {
                        $locations[] = $ml;
                    }
                }

                $m->locations = $locations;
            }

            return $materials;

        } catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

}