<?php 
    include '../../../models/Location.php';
    $location = new Location();


?>


<?php include '../../../partials/header.php'; ?>


<header class="header"> 
    <div>
        <h1>ABC Company</h1>
    </div>
</header>


<div class="main">

    <?php include '../../../partials/sidebar.php'; ?>
    
    <div class="container"> <!-- container -->

        <h2>Location List</h2>

        <div class="table-container">
            <table class="table-bordered">
                <thead>
                    <tr>
                        <th>Location ID</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($location->fetchAll() as $row): ?>                        
                        <tr>
                            <td><?= $row->id ?></td>
                            <td><?= $row->description ?></td>
                            <td>
                                <a href="/abc/dashboard/settings/locations/edit.php?id=<?= $row->id ?>" class="li-none">Edit</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>    
                </tbody>
            </table>
        </div>
    
    </div> <!-- end container -->
    
</div>


<?php include '../../../partials/footer.php'; ?>
