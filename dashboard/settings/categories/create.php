<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
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

        <h2>Add Category</h2>
        <br>

        <form action="/abc/controllers/category-controller.php" method="POST">

            <div class="field d-flex flex-col gap-3 mt-12">
                    <label>Category</label>
                    <input type="text" class="text-input" placeholder="Category" name="description">
            </div>

            <br/>

            <div class="mt-12">
                <button type="submit" class="btn btn-dark" name="submit">Submit</button>
            </div>

        </form>

    </div> <!-- end container -->
    
</div>


<?php include '../../../partials/footer.php'; ?>
