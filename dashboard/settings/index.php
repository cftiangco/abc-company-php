<?php include '../../partials/header.php'; ?>


<div class="main">

    <?php include '../../partials/sidebar.php'; ?>
    
    <div class="container"> <!-- container -->
        <h1 class="text-dark">Settings</h1>
        <br>

        <div class="flex">
            <div class="box">
                <a href="/abc/dashboard/settings/locations/list.php" class="li-none">
                    <div class="box-content">
                        <span>Locations</span>
                    </div>
                </a>
            </div>
            <div class="box">
                <a href="/abc/dashboard/settings/locations/create.php" class="li-none">
                    <div class="box-content">
                        <span>Add Location</span>
                    </div>
                </a>
            </div>
        </div>
        <br>
        <div class="flex">
            <div class="box">
                <a href="/abc/dashboard/settings/categories/list.php" class="li-none">
                    <div class="box-content">
                        <span>Categories</span>
                    </div>
                </a>
            </div>
            <div class="box">
                <a href="/abc/dashboard/settings/categories/create.php" class="li-none">
                    <div class="box-content">
                        <span>Add Category</span>
                    </div>
                </a>
            </div>
        </div>

    </div> <!-- end container -->
    
</div>


<?php include '../../partials/footer.php'; ?>
