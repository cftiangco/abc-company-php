<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    include '../../../models/Category.php';

    $category = new Category();
    $data = $category->getById($_GET['id']);

?>


<?php include '../../../partials/header.php'; ?>


<div class="main">

    <?php include '../../../partials/sidebar.php'; ?>
    
    <div class="container"> <!-- container -->

        <?php if(isset($_GET['errors'])): ?>
            <?php $unserializedErrors = unserialize($_GET['errors']); ?>
            <?php foreach($unserializedErrors as $error): ?>
                <div class="error-container">
                    <p><?= $error ?></p>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>

        <h2>Edit Category</h2>
        <br>

        <form action="/controllers/category-controller.php?id=<?= $data->id ?>" method="POST">
            
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
