<?php include '../../partials/header.php'; ?>

<div class="main">

    <?php include '../../partials/sidebar.php'; ?>
    
    <div class="container"> <!-- container -->
        <h1 class="text-dark">Manage Materials</h1>
        <br>

        <div class="flex">
            <div class="box">
                <a href="/dashboard/materials/list.php" class="li-none">
                    <div class="box-content">
                        <span>Materials</span>
                    </div>
                </a>
            </div>
            <div class="box">
                <a href="/dashboard/materials/create.php" class="li-none">
                    <div class="box-content">
                        <span>Add Material</span>
                    </div>
                </a>
            </div>
        </div>

    </div> <!-- end container -->
    
</div>


<?php include '../../partials/footer.php'; ?>
