<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('Main.php');

class Category extends Main { 
    public $table = "categories";

    public function __construct() {
        parent::__construct();
    }

    public function checkIfCategoryAlreadyExists($description) {
        return $this->db->query("SELECT COUNT(*) FROM categories WHERE description = '{$description}' ")->fetchColumn();
    }

}