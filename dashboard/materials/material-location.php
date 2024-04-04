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
            <a href="/abc/dashboard/materials/add-material-to-location.php?id=<?= $_GET['id'] ?>" class="action-button">Add Location</a>
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
                                <a href="/abc/dashboard/materials/edit-material-to-location.php?material_id=<?=$data->id?>&material_location_id=<?= $row->id ?>" class="li-none">Edit</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>    
                </tbody>
            </table>
        </div>

    
    </div> <!-- end container -->
    
</div>

<div class="modal hidden" id="modal">
    <div class="modal-container">
        <div class="modal-content">
            
            <div class="modal-header flex justify-between items-center">
                <h3>Materials</h3>
                <button class="action-button" id="btn-close">Close</button>
            </div>

            <div class="modal-body">
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
                        <tbody id="table-body">
                            <?php foreach($material->fetchAllWithCategories() as $row): ?>                        
                                <tr>
                                    <td><?= $row->id ?></td>
                                    <td><?= $row->barcode ?></td>
                                    <td><?= $row->category ?></td>
                                    <td><?= $row->description ?></td>
                                    <td>
                                        <button class="action-button selected" id="btn-select" data-id="<?= $row->id ?>" data-description="<?= $row->description ?>">Select</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>    
                        </tbody>
                    </table>
                </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function() {

        $("#btn-add").click(function() {
            $("#modal").removeClass("hidden");
        });

        $("#btn-close").click(function() {
                $("#modal").removeClass("block");
                $("#modal").addClass("hidden");
        });

        $("#table-body").on("click", ".selected", function() {
                let id = $(this).data("id");
                let description = $(this).data("description");
                console.log(id,description)

                $("#material-description").val(description);
                $("#material-id").val(id);

                $("#modal").addClass("hidden");
            });
    });
</script>

<?php include '../../partials/footer.php'; ?>
