<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../func/helper.php';
include '../models/MaterialLocation.php';

$materialLocation = new MaterialLocation();
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {

        $materialId = $_POST['material_id'];

        $price = $_POST['price'];
        $locationId = $_POST['location_id'];
        $availabilityId = $_POST['availability_id'];
        $materialLocationStatuId = $_POST['material_location_status_id'];

        if($price ==  "") {
            array_push($errors,"Price cannot be empty");
        }
        
        if($price != "" && $price <=  0) {
            array_push($errors,"Price must be greater than 0");
        }
        
        if($materialLocation->checkIfMaterialLocationAlreadyExists($materialId,$locationId) > 0) {
            array_push($errors,"Material with the same location is already exists");
        }
        
        
        if(empty($errors)) {

            $values = [
                'material_id' => $materialId,
                'price' => $price,
                'location_id' => $locationId,
                'availability_id' => $availabilityId,
                'material_location_status_id' => $materialLocationStatuId
            ];

            $result = $materialLocation->create($values);

            if($result) {
                header("Location: /dashboard/materials/material-location.php?id={$materialId}");
            } 
        } else {
            $serializedErrors = serialize($errors);
            header("Location: /dashboard/materials/add-material-to-location.php?id=".$materialId."&errors=".urlencode($serializedErrors));
            exit();
        }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {

        $mLocationData = $materialLocation->getById(($_GET['material_location_id']));
    
        $materialId = $_POST['material_id'];
        $id = $_POST['id'];
        $price = $_POST['price'];
        $locationId = $_POST['location_id'];
        $availabilityId = $_POST['availability_id'];
        $materialLocationStatuId = $_POST['material_location_status_id'];
        
        if($price <=  0) {
            array_push($errors,"Price must be greater than 0");
        }

        
        if($mLocationData->location_id != $locationId) {
            if($materialLocation->checkIfMaterialLocationAlreadyExists($materialId,$locationId) > 0) {
                array_push($errors,"Material with the same location is already exists");
            }
        }


        if(empty($errors)) {
            $values = [
                'material_id' => $materialId,
                'price' => $price,
                'location_id' => $locationId,
                'availability_id' => $availabilityId,
                'material_location_status_id' => $materialLocationStatuId
            ];

            $result = $materialLocation->update($id,$values);

            if($result) {
                header("Location: /dashboard/materials/material-location.php?id={$materialId}");
            }
        } else {
            $serializedErrors = serialize($errors);
            header("Location: /dashboard/materials/edit-material-to-location.php?material_id=".$materialId. "&material_location_id=" . $id . "&errors=".urlencode($serializedErrors));
            exit();
        }

}