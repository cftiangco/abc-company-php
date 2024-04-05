<?php 
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    
    include '../../models/MaterialLocationStatus.php';
    include '../../models/Material.php';

    $material = new Material();
    $materials = $material->fetchAll();

    $materialLocationStatus = new MaterialLocationStatus();
    $status = $materialLocationStatus->fetchAll();
?>


<?php include '../../partials/header.php'; ?>


<div class="main">

    <?php include '../../partials/sidebar.php'; ?>
    
    <div class="container"> <!-- container -->
        <h1 class="text-dark">Generate Report</h1>

        <br/>

        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="GET">

            <input type="hidden" name="material_id" id="material_id">

            <div class="field d-flex flex-col gap-3">
                    <label>Material</label>
                    <div class="flex items-center">
                        <input type="text" class="text-input" placeholder="Material" name="material" id="material" readonly>
                        <button type="button" class="action-button" id="btn-lookup">Look up</p>
                    </div>
            </div>

            <div class="field d-flex flex-col gap-3 mt-12">
                    <label>Status</label>
                    <select class="select-input" name="material_location_status_id" id="material_location_status_id">
                        <?php foreach($status as $row): ?>
                            <option value="<?= $row->id?>"><?= $row->description ?></option>
                        <?php endforeach; ?>
                    </select>
            </div>


            <br/>

            <div class="mt-12">
                <button type="button" id="generate" class="btn btn-dark" name="submit">Generate</button>
            </div>

        </form>

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

        $("#btn-lookup").click(function() {
            console.log(`test`)
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

                $("#material").val(description);
                $("#material_id").val(id);

                $("#modal").addClass("hidden");
        });

        $("#generate").click( async function() {
            let materialLocationStatusId = $("#material_location_status_id").val();
            await getMaterialsWithLocation(materialLocationStatusId);

        });

        async function getMaterialsWithLocation(statusId) {
            let url = `/abc/controllers/material-controller.php?status_id=${statusId}`;

            try {
                fetch(url).then(function (response) {
                    return response.json();
                }).then(function (res) {
                    console.log(res);
                });
            } catch(err) {
                console.log(err)
            }

        }
    });
</script>


<?php include '../../partials/footer.php'; ?>
