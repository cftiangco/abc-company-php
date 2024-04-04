<?php 
    include '../../models/Material.php';
    $material = new Material();


?>


<?php include '../../partials/header.php'; ?>


<div class="main">

    <?php include '../../partials/sidebar.php'; ?>
    
    <div class="container"> <!-- container -->

        <h2>Material List</h2>

        <div class="table-container">
            <table class="table-bordered">
                <thead>
                    <tr>
                        <th>Material ID</th>
                        <th>Barcode</th>
                        <th>Category</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($material->fetchAllWithCategories() as $row): ?>                        
                        <tr>
                            <td><?= $row->id ?></td>
                            <td><?= $row->barcode ?></td>
                            <td><?= $row->category ?></td>
                            <td><?= $row->description ?></td>
                            <td>
                                <a href="/abc/dashboard/materials/edit.php?id=<?= $row->id ?>" class="li-none">Edit</a>
                                <a href="/abc/dashboard/materials/material-location.php?id=<?= $row->id ?>" class="li-none">Locations</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>    
                </tbody>
            </table>
        </div>
    
    </div> <!-- end container -->
    
</div>


<?php include '../../partials/footer.php'; ?>
