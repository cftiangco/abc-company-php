<?php 
    include '../../../models/Category.php';
    $category = new Category();


?>


<?php include '../../../partials/header.php'; ?>


<div class="main">

    <?php include '../../../partials/sidebar.php'; ?>
    
    <div class="container"> <!-- container -->

        <h2>Categories List</h2>

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
                    <?php foreach($category->fetchAll() as $row): ?>                        
                        <tr>
                            <td><?= $row->id ?></td>
                            <td><?= $row->description ?></td>
                            <td>
                                <a href="/dashboard/settings/categories/edit.php?id=<?= $row->id ?>" class="li-none">Edit</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>    
                </tbody>
            </table>
        </div>
    
    </div> <!-- end container -->
    
</div>


<?php include '../../../partials/footer.php'; ?>
