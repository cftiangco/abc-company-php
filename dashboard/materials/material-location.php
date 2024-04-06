<?php 
    include '../../models/Material.php';
    include '../../models/MaterialLocation.php';
    
    $material = new Material();
    $materialLocation = new MaterialLocation();

    $materialLocationData = $materialLocation->fetchAllByMaterialId($_GET['id']);
    $data = $material->fetchOneWithCategory($_GET['id']);
?>


<?php include '../../partials/header.php'; ?>


<div class="main">

    <?php include '../../partials/sidebar.php'; ?>
    
    <div class="container"> <!-- container -->

        <div class="title flex items-center justify-between">
            <h2 class="text-dark">Material Location</h2>
            <!-- <button class="action-button" id="btn-add">Add Location</button> -->
            <a href="/dashboard/materials/add-material-to-location.php?id=<?= $_GET['id'] ?>" class="action-button">Add Location</a>
        </div>

        <br/>


        <div class="key-value flex">
            <p>Material ID:</p>
            <h4><?= $data->id ?></h4>
        </div>

        <div class="key-value flex">
            <p>Barcode:</p>
            <h4><?= $data->barcode ?></h4>
        </div>

        <div class="key-value flex">
            <p>Description:</p>
            <h4><?= $data->description ?></h4>
        </div>

        <div class="key-value flex">
            <p>Category:</p>
            <h4><?= $data->category ?></h4>
        </div>

        <div class="table-container">
            <table class="table-bordered">
                <thead>
                    <tr>
                        <th>Location</th>
                        <th>Price</th>
                        <th>Availability</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="table-body">
                    <?php foreach($materialLocationData as $row): ?>                        
                        <tr>
                            <td><?= $row->location ?></td>
                            <td><?= $row->price ?></td>
                            <td><?= $row->availability ?></td>
                            <td><?= $row->status ?></td>
                            <td>
                                <a href="/dashboard/materials/edit-material-to-location.php?material_id=<?=$data->id?>&material_location_id=<?= $row->id ?>" class="li-none">Edit</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>    
                </tbody>
            </table>
        </div>

    
    </div> <!-- end container -->
    
</div>

<?php include '../../partials/footer.php'; ?>
