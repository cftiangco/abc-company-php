<?php 
    include '../../func/helper.php';
    include '../../models/Categories.php';
    include '../../models/Material.php';

    $category = new Categories();
    $material = new Material();

    $categories = $category->fetchAll();

    $errors = [];

    if(isset($_POST['submit'])) {
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
        }
    }

?>


<?php include '../../partials/header.php'; ?>


<header class="header"> 
    <div>
        <h1>ABC Company</h1>
    </div>
</header>


<div class="main">

    <?php include '../../partials/sidebar.php'; ?>
    
    <div class="container"> <!-- container -->

        <?php if(count($errors) > 0): ?>
            <?php foreach($errors as $error): ?>
                <div class="error-container">
                    <p><?= $error ?></p>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>

        <h2>Create Material</h2>
        <br>

        <form action="<?= $_SERVER['PHP_SELF']; ?>" method="POST">

            <div class="field d-flex flex-col gap-3">
                    <label>Barcode</label>
                    <input type="number" class="text-input" placeholder="Barcode" name="barcode">
            </div>

            <div class="field d-flex flex-col gap-3 mt-12">
                    <label>Description</label>
                    <input type="text" class="text-input" placeholder="Barcode" name="description">
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
