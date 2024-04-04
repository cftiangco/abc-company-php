<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../func/helper.php';
include '../models/Location.php';

$location = new Location();

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
        $description = $_POST['description'];
        

        if($description === "") {
            array_push($errors,"Description is required field");
        }

        
        if(validateString($description)) {
            array_push($errors,"Description cannot accept special characters");
        }
        
        if($location->checkIfLocationAlreadyExists($description)) {
            array_push($errors,"Location is already exists");
        }
        
        if(empty($errors)) {

            $result = $location->create(['description' => $description]);

            if($result) {
                header('Location: /abc/dashboard/settings/locations/list.php');
            }
        } else {
            $serializedErrors = serialize($errors);
            header("Location: /abc/dashboard/settings/locations/create.php?errors=" . urlencode($serializedErrors));
            exit();
        }

}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {

        $description = $_POST['description'];
        $id = $_POST['id'];

        $data = $location->getById($_GET['id']);

        if($description === "") {
            array_push($errors,"Description is required field");
        }

        if(validateString($description)) {
            array_push($errors,"Description cannot accept special characters");
        }

        if($description !== $data->description) {
            if($location->checkIfLocationAlreadyExists($description)) {
                array_push($errors,"Location is already exists");
            }
        } 

        if(empty($errors)) {
            $values = ['description' => $description];
            $result = $location->update($id,$values);

            if($result) {
                header('Location: /abc/dashboard/settings/locations/list.php');
            }
        } else {
            $serializedErrors = serialize($errors);
            header("Location: /abc/dashboard/settings/locations/edit.php?id=".$id."&errors=".urlencode($serializedErrors));
            exit();
        }
}
