<?php 
    include '../../models/Category.php';
    include '../../models/Material.php';

    $category = new Category();
    $material = new Material();

    $data = $material->getById($_GET['id']);

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

        <h2>Edit Material</h2>
        <br>

        <form action="/controllers/material-controller.php?id=<?= $data->id ?>" method="POST">
            
            <input type="hidden" value="<?= $data->id ?>" name="id">

            <div class="field d-flex flex-col gap-3">
                    <label>Barcode</label>
                    <input type="number" class="text-input" placeholder="Barcode" name="barcode" value="<?= $data->barcode ?>">
            </div>

            <div class="field d-flex flex-col gap-3 mt-12">
                    <label>Description</label>
                    <input type="text" class="text-input" placeholder="Barcode" name="description" value="<?= $data->description ?>">
            </div>

            <div class="field d-flex flex-col gap-3 mt-12">
                    <label>Category</label>
                    <select class="select-input" name="category_id">
                        <?php foreach($categories as $row): ?>
                            <option <?= $data->category_id === $row->id ? 'selected':'' ?>  value="<?= $row->id?>">
                                <?= $row->description ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
            </div>

            <br/>

            <div class="mt-12">
                <button type="submit" class="btn btn-dark" name="update">Update</button>
            </div>

        </form>

    </div> <!-- end container -->
    
</div>


<?php include '../../partials/footer.php'; ?>
