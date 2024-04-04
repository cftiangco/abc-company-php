<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../func/helper.php';
include '../models/Category.php';

$category = new Category();

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
   
        $description = $_POST['description'];

        if($description === "") {
            array_push($errors,"Description is required field");
        }

        
        if(validateString($description)) {
            array_push($errors,"Description cannot accept special characters");
        }
        
        if($category->checkIfCategoryAlreadyExists($description)) {
            array_push($errors,"Category is already exists");
        }
        
        if(empty($errors)) {

            $result = $category->create(['description' => $description]);

            if($result) {
                header('Location: /abc/dashboard/settings/categories/list.php');
            }
        } else {
            $serializedErrors = serialize($errors);
            header("Location: /abc/dashboard/settings/categories/create.php?errors=" . urlencode($serializedErrors));
            exit();
        }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {

        $description = $_POST['description'];
        $id = $_POST['id'];

        $data = $category->getById($_GET['id']);

        if($description === "") {
            array_push($errors,"Description is required field");
        }

        if(validateString($description)) {
            array_push($errors,"Description cannot accept special characters");
        }

        if($description !== $data->description) {
            if($category->checkIfCategoryAlreadyExists($description)) {
                array_push($errors,"Category is already exists");
            }
        } 

        if(empty($errors)) {
            $values = ['description' => $description];
            $result = $category->update($id,$values);

            if($result) {
                header('Location: /abc/dashboard/settings/categories/list.php');
            }
        } else {
            $serializedErrors = serialize($errors);
            header("Location: /abc/dashboard/settings/categories/edit.php?id=".$id."&errors=".urlencode($serializedErrors));
            exit();
        }
}