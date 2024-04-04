<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('Main.php');

class MaterialLocationStatus extends Main { 
    public $table = "material_location_status";

    public function __construct() {
        parent::__construct();
    }

    public function checkIfMaterialLocationAlreadyExists($materialId,$locationId) {
        return $this->db->query("SELECT COUNT(*) FROM material_location WHERE material_id = $materialId AND location_id = $locationId")->fetchColumn();
    }

}