<?php 
    include '../../func/helper.php';
    include '../../models/Material.php';
    include '../../models/Location.php';
    include '../../models/Availability.php';
    include '../../models/MaterialLocationStatus.php';
    include '../../models/MaterialLocation.php';

    $material = new Material();
    $location = new Location();
    $availability = new Availability();
    $materialLocationStatus = new MaterialLocationStatus();
    $materialLocation = new MaterialLocation();

    $locations = $location->fetchAll();
    $availabilities = $availability->fetchAll();
    $status = $materialLocationStatus->fetchAll();

    $data = $material->getById($_GET['id']);
    $materialLocationData = $materialLocation->fetchAllByMaterialId($_GET['id']);


    $errors = [];

    if(isset($_POST['submit'])) {
        echo print_r($_POST);
        
        $materialId = $_POST['material_id'];
        $price = $_POST['price'];
        $locationId = $_POST['location_id'];
        $availabilityId = $_POST['availability_id'];
        $materialLocationStatuId = $_POST['material_location_status_id'];
        
        if($price <=  0) {
            array_push($errors,"Price must be greater than 0");
        }


        if(empty($errors)) {

            $values = [
                'material_id' => $materialId,
                'price' => $price,
                'location_id' => $locationId,
                'availability_id' => $availabilityId,
                'material_location_status_id' => $materialLocationStatuId
            ];

            $result = $materialLocation->create($values);

            if($result) {
                header("Location: /abc/dashboard/materials/material-location.php?id={$data->id}");
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

        <h2>Add Location To: <?= $data->description ?></h2>
        <br>

        <form action="<?= $_SERVER['PHP_SELF']; ?>?id=<?= $data->id ?>" method="POST">
            
            <input type="hidden" name="material_id" value="<?= $data->id ?>" />

            <div class="field d-flex flex-col gap-3">
                    <label>Price</label>
                    <input type="number" class="text-input" placeholder="Price" name="price">
            </div>

            <div class="field d-flex flex-col gap-3 mt-12">
                    <label>Location</label>
                    <select class="select-input" name="location_id">
                        <?php foreach($locations as $row): ?>
                            <option value="<?= $row->id?>"><?= $row->description ?></option>
                        <?php endforeach; ?>
                    </select>
            </div>

            <div class="field d-flex flex-col gap-3 mt-12">
                    <label>Availability</label>
                    <select class="select-input" name="availability_id">
                        <?php foreach($availabilities as $row): ?>
                            <option value="<?= $row->id?>"><?= $row->description ?></option>
                        <?php endforeach; ?>
                    </select>
            </div>

            <div class="field d-flex flex-col gap-3 mt-12">
                    <label>Status</label>
                    <select class="select-input" name="material_location_status_id">
                        <?php foreach($status as $row): ?>
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
