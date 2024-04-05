<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('Main.php');

class MaterialLocation extends Main { 
    public $table = "material_location";

    public function __construct() {
        parent::__construct();
    }

    public function fetchAllByMaterialId($materialId) {
        try {
            return $this->db->query("SELECT material_location.*,
                locations.description as `location`,
                availability.description as `availability`,
                material_location_status.description as `status` 
                FROM material_location
                INNER JOIN locations ON locations.id = material_location.location_id
                INNER JOIN availability ON availability.id = material_location.availability_id
                INNER JOIN material_location_status ON material_location_status.id = material_location.material_location_status_id
                WHERE material_location.material_id = $materialId ORDER BY material_location.created_at DESC;")->fetchAll(PDO::FETCH_OBJ);
        } catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    public function checkIfMaterialLocationAlreadyExists($materialId,$locationId) {
        try {
            return $this->db->query("SELECT COUNT(*) FROM material_location WHERE material_id = $materialId AND location_id = $locationId")->fetchColumn();
        }catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function fetchAllByMaterialIdAndStatusId($materialId,$statusId) {
        try {
            return $this->db->query("SELECT material_location.*,
                locations.description as `location`,
                availability.description as `availability`,
                material_location_status.description as `status` 
                FROM material_location
                INNER JOIN locations ON locations.id = material_location.location_id
                INNER JOIN availability ON availability.id = material_location.availability_id
                INNER JOIN material_location_status ON material_location_status.id = material_location.material_location_status_id
                WHERE material_location.material_id = $materialId AND material_location.material_location_status_id = $statusId ORDER BY material_location.created_at DESC;")->fetchAll(PDO::FETCH_OBJ);
        } catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
}