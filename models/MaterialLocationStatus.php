<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('Main.php');

class MaterialLocationStatus extends Main { 
    public $table = "material_location_status";

    public function __construct() {
        parent::__construct();
    }

}