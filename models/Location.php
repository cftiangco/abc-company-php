<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('Main.php');

class Location extends Main { 
    public $table = "locations";

    public function __construct() {
        parent::__construct();
    }

}