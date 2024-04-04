<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    include '../../../func/helper.php';
    include '../../../models/Location.php';

    $location = new Location();

    $errors = [];

    if(isset($_POST['submit'])) {

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
        }


    }

?>


<?php include '../../../partials/header.php'; ?>



<div class="main">

    <?php include '../../../partials/sidebar.php'; ?>
    
    <div class="container"> <!-- container -->

        <?php if(count($errors) > 0): ?>
            <?php foreach($errors as $error): ?>
                <div class="error-container">
                    <p><?= $error ?></p>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>

        <h2>Add Location</h2>
        <br>

        <form action="<?= $_SERVER['PHP_SELF']; ?>" method="POST">

            <div class="field d-flex flex-col gap-3 mt-12">
                    <label>Description</label>
                    <input type="text" class="text-input" placeholder="Location" name="description">
            </div>

            <br/>

            <div class="mt-12">
                <button type="submit" class="btn btn-dark" name="submit">Submit</button>
            </div>

        </form>

    </div> <!-- end container -->
    
</div>


<?php include '../../../partials/footer.php'; ?>
