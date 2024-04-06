<?php 
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    
    include '../../models/MaterialLocationStatus.php';
    include '../../models/Location.php';
    include '../../models/Material.php';

    $material = new Material();
    $location = new Location();
    $materials = $material->fetchAll();

    $materialLocationStatus = new MaterialLocationStatus();
?>


<?php include '../../partials/header.php'; ?>


<div class="main">

    <?php include '../../partials/sidebar.php'; ?>
    
    <div class="container"> <!-- container -->
        <h1 class="text-dark">Generate Report</h1>

        <br/>

        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="GET">

            <input type="hidden" name="material_id" id="material_id">

            <div class="field d-flex flex-col gap-3 mt-12">
                    <label>Location</label>
                    <select class="select-input" name="location_id" id="location_id">
                        <?php foreach($location->fetchAll() as $row): ?>
                            <option value="<?= $row->id?>"><?= $row->description ?></option>
                        <?php endforeach; ?>
                    </select>
            </div>

            <div class="field d-flex flex-col gap-3 mt-12">
                    <label>Status</label>
                    <select class="select-input" name="material_location_status_id" id="material_location_status_id">
                        <?php foreach($materialLocationStatus->fetchAll() as $row): ?>
                            <option value="<?= $row->id?>"><?= $row->description ?></option>
                        <?php endforeach; ?>
                    </select>
            </div>


            <br/>

            <div class="mt-12">
                <button type="button" id="generate" class="btn btn-dark" name="submit">Generate</button>
            </div>

        </form>

        <div class="table-container">
            <table class="table-bordered">
                <thead>
                    <tr>
                        <th>Material ID</th>
                        <th>Barcode</th>
                        <th>Category</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Location</th>
                        <th>Status</th>
                        <th>Availability</th>
                    </tr>
                </thead>
                <tbody id="tbody-data"></tbody>
            </table>
        </div>

    </div> <!-- end container -->
    
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
            let locationId = $("#location_id").val();
            
            let results = await getMaterialsWithLocation(locationId,materialLocationStatusId);

            $("#tbody-data").empty();

            if(results.length > 0) {
                results.forEach(row => {
                    let newRow = $("<tr>");
                    newRow.append(`<td>${row.id}</td>`);
                    newRow.append(`<td>${row.barcode}</td>`);
                    newRow.append(`<td>${row.category}</td>`);
                    newRow.append(`<td>${row.description}</td>`);
                    newRow.append(`<td>${row.price}</td>`);
                    newRow.append(`<td>${row.location}</td>`);
                    newRow.append(`<td>${row.status}</td>`);
                    newRow.append(`<td>${row.availability}</td>`);
                    $("#tbody-data").append(newRow);
                })
            } else {
                console.log('no data');
            }

        });

        async function getMaterialsWithLocation(locationId,statusId) {
            let url = `/controllers/material-controller.php?status_id=${statusId}&location_id=${locationId}`;

            try {
                const response = await fetch(url);
                const res = await response.json();
                console.log(res);
                return res;
            } catch (err) {
                console.log(err);
                throw err;
            }

        }
    });
</script>


<?php include '../../partials/footer.php'; ?>
