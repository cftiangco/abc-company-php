<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('Main.php');

class Availability extends Main { 
    public $table = "availability";

    public function __construct() {
        parent::__construct();
    }

}