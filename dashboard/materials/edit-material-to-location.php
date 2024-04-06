<?php 
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

    $data = $material->getById($_GET['material_id']);

    $mLocationData = $materialLocation->getById(($_GET['material_location_id']));

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

        <h2>Edit Location [<?= $data->description ?>]</h2>
        <br>

        <form action="/controllers/material-location-controller.php?material_id=<?= $data->id ?>&material_location_id=<?= $mLocationData->id ?>" method="POST">
            
            <input type="hidden" name="material_id" value="<?= $data->id ?>" />
            <input type="hidden" name="id" value="<?= $mLocationData->id ?>" />

            <div class="field d-flex flex-col gap-3">
                    <label>Price</label>
                    <input type="number" class="text-input" placeholder="Price" name="price" value="<?= $mLocationData->price ?>">
            </div>

            <div class="field d-flex flex-col gap-3 mt-12">
                    <label>Location</label>
                    <select class="select-input" name="location_id">
                        <?php foreach($locations as $row): ?>
                            <option value="<?= $row->id?>" <?= $mLocationData->location_id === $row->id ? 'selected':'' ?>><?= $row->description ?></option>
                        <?php endforeach; ?>
                    </select>
            </div>

            <div class="field d-flex flex-col gap-3 mt-12">
                    <label>Availability</label>
                    <select class="select-input" name="availability_id">
                        <?php foreach($availabilities as $row): ?>
                            <option value="<?= $row->id?>" <?= $mLocationData->availability_id === $row->id ? 'selected':'' ?>><?= $row->description ?></option>
                        <?php endforeach; ?>
                    </select>
            </div>

            <div class="field d-flex flex-col gap-3 mt-12">
                    <label>Status</label>
                    <select class="select-input" name="material_location_status_id">
                        <?php foreach($status as $row): ?>
                            <option value="<?= $row->id?>" <?= $mLocationData->material_location_status_id === $row->id ? 'selected':'' ?>><?= $row->description ?></option>
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
