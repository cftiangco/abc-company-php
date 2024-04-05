<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../func/helper.php';
include '../models/Material.php';

$material = new Material();

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    
        $barcode = $_POST['barcode'];
        $description = $_POST['description'];
        $category_id = $_POST['category_id'];
        
        if($barcode === "") {
            array_push($errors,"Barcode is required field");
        }

        if($material->checkIfBarcodeAlreadyExists($barcode)) {
            array_push($errors,"The barcode is already exists");
        }

        if($description === "") {
            array_push($errors,"Description is required field");
        }

        if(validateString($description)) {
            array_push($errors,"Description cannot accept special characters");
        }

        if(empty($errors)) {

            $values = [
                'barcode' => $barcode,
                'description' => $description,
                'category_id' => $category_id
            ];

            $result = $material->create($values);

            if($result) {
                header('Location: /abc/dashboard/materials/list.php');
            }

        } else {
            $serializedErrors = serialize($errors);
            header("Location: /abc/dashboard/materials/create.php?errors=" . urlencode($serializedErrors));
            exit();
        }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {

        $id = $_POST['id'];
        $barcode = $_POST['barcode'];
        $description = $_POST['description'];
        $category_id = $_POST['category_id'];

        $data = $material->getById($_GET['id']);
        
        if($barcode === "") {
            array_push($errors,"Barcode is required field");
        }

        if($data->barcode !== $barcode) {
            if($material->checkIfBarcodeAlreadyExists($barcode)) {
                array_push($errors,"The barcode is already exists");
            }
        }

        if($description === "") {
            array_push($errors,"Description is required field");
        }

        if(validateString($description)) {
            array_push($errors,"Description cannot accept special characters");
        }

        if(empty($errors)) {

            $values = [
                'barcode' => $barcode,
                'description' => $description,
                'category_id' => $category_id
            ];

            $result = $material->update($id,$values);

            if($result) {
                header('Location: /abc/dashboard/materials/list.php');
            }
        } else {
            $serializedErrors = serialize($errors);
            header("Location: /abc/dashboard/materials/edit.php?id=".$id."&errors=".urlencode($serializedErrors));
            exit();
        }
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    echo json_encode($material->fetchMaterialsWithLocation($_GET['status_id']));
}