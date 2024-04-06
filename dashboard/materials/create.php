<?php 
    include '../../models/Category.php';
    $category = new Category();
    $categories = $category->fetchAll();
?>


<?php include '../../partials/header.php'; ?>

<div class="main">

    <?php include '../../partials/sidebar.php'; ?>
    
    <div class="container"> <!-- container -->

        <?php if(isset($_GET['errors'])): ?>
            <?php $unserializedErrors = unserialize($_GET['errors']); ?>
            <?php foreach($unserializedErrors as $error): ?>
                <div class="error-container">
                    <p><?= $error ?></p>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>

        <h2>Create Material</h2>
        <br>

        <form action="/controllers/material-controller.php" method="POST">

            <div class="field d-flex flex-col gap-3">
                    <label>Barcode</label>
                    <input type="number" class="text-input" placeholder="Barcode" name="barcode">
            </div>

            <div class="field d-flex flex-col gap-3 mt-12">
                    <label>Description</label>
                    <input type="text" class="text-input" placeholder="Description" name="description">
            </div>

            <div class="field d-flex flex-col gap-3 mt-12">
                    <label>Category</label>
                    <select class="select-input" name="category_id">
                        <?php foreach($categories as $row): ?>
                            <option value="<?= $row->id?>"><?= $row->description ?></option>
                        <?php endforeach; ?>
                    </select>
            </div>

            <br/>

            <div class="mt-12">
                <button type="submit" class="btn btn-dark" name="submit">Submit</button>
            </div>

        </form>

    </div> <!-- end container -->
    
</div>


<?php include '../../partials/footer.php'; ?>
