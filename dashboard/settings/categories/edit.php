<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    include '../../../func/helper.php';
    include '../../../models/Category.php';

    $category = new Category();
    $data = $category->getById($_GET['id']);

    $errors = [];

    if(isset($_POST['update'])) {
        $description = $_POST['description'];
        $id = $_POST['id'];

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

        <h2>Edit Category</h2>
        <br>

        <form action="<?= $_SERVER['PHP_SELF']; ?>?id=<?= $data->id ?>" method="POST">
            
            <input type="hidden" name="id" value="<?= $data->id ?>">
                
            <div class="field d-flex flex-col gap-3 mt-12">
                    <label>Description</label>
                    <input type="text" class="text-input" placeholder="Category" name="description" value="<?= $data->description ?>">
            </div>

            <br/>

            <div class="mt-12">
                <button type="submit" class="btn btn-dark" name="update">Update</button>
            </div>

        </form>

    </div> <!-- end container -->
    
</div>


<?php include '../../../partials/footer.php'; ?>