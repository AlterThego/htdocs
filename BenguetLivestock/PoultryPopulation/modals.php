<!-- Add Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add data</h5>
                <button type="button " class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="code.php" method="POST">
                <!-- Body -->
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="type">Type</label>
                        <select class="form-control" name="type">
                            <?php
                            $connection = mysqli_connect("localhost", "root", "", "benguetlivestockdb");

                            // Modify the query to exclude existing poultry_type_id values from poultrypopulation
                            $existing_types_query = "SELECT DISTINCT poultry_type_id FROM poultrypopulation";
                            $existing_types_result = mysqli_query($connection, $existing_types_query);

                            $existing_types = [];
                            while ($existing_row = mysqli_fetch_array($existing_types_result)) {
                                $existing_types[] = $existing_row['poultry_type_id'];
                            }

                            $fetch_types_query = "SELECT * FROM poultrytype ORDER BY poultry_type_id ASC";
                            $fetch_types_query_run = mysqli_query($connection, $fetch_types_query);

                            $choices_available = false; // Flag to check if any choices are available
                            
                            while ($type_row = mysqli_fetch_array($fetch_types_query_run)) {
                                // Exclude existing types from the dropdown
                                if (!in_array($type_row['poultry_type_id'], $existing_types)) {
                                    $option_value = $type_row['poultry_type_id'] . ' - ' . $type_row['poultry_type_name'];
                                    echo "<option value='" . $type_row['poultry_type_id'] . "'>" . $option_value . "</option>";
                                    $choices_available = true; // Set the flag to true
                                }
                            }

                            // Check if there are no choices available
                            if (!$choices_available) {
                                echo "<option value='' disabled>No available choices</option>";
                            }
                            ?>
                        </select>
                    </div>





                    <div class="form-group mb-3">
                        <label for="count">Count</label>
                        <input type="number" class="form-control" name="count" placeholder="Enter Count">
                    </div>

                    <div class="form-group mb-3">
                        <label for="date_updated">Date Updated</label>
                        <input type="date" class="form-control" name="date_updated"
                            value="<?php echo date('Y-m-d'); ?>">
                    </div>
                </div>

                <!-- Buttons -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="savedata" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Update Modal -->
<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModal">Update Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="code.php" method="POST">
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="update_type">Type</label>
                        <input type="text" class="form-control" id="update_type" readonly>
                    </div>

                    <div class="form-group mb-3">
                        <label for="update_count">Count</label>
                        <input type="number" class="form-control" name="update_count" id="update_count">
                    </div>

                    <div class="form-group mb-3">
                        <label for="update_date">Date Updated</label>
                        <input type="date" class="form-control" name="update_date" id="update_date"
                            value="<?php echo date('Y-m-d'); ?>">
                    </div>
                </div>

                <div class="modal-footer">
                    <input type="hidden" name="update_id" id="update_id">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="updateData" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Delete Modal -->
<div class="modal fade" id="deleteConfirmationModal" tabindex="-1" role="dialog"
    aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteConfirmationModalLabel">Confirm Deletion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this data?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDelete">Delete</button>
            </div>
        </div>
    </div>
</div>

<!-- Advanced Options -->
<div class="modal" id="advancedOptionModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Advanced Options</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="container"></div>
            <div class="modal-body">
                <table class="display table-bordered" id="advanced-table">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Type</th>
                            <th scope="col">Count</th>
                            <th scope="col">Date Updated</th>
                            <th class="text-center" scope="col">Update</th>
                            <th class="text-center" scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $totalCount = 0;
                        $connection = mysqli_connect("localhost", "root", "", "benguetlivestockdb");

                        $fetch_query = "SELECT poultrypopulation.poultry_type_id, poultrytype.poultry_type_name, poultrypopulation.date_updated, poultrypopulation.count
                        FROM poultrypopulation
                        JOIN poultrytype ON poultrypopulation.poultry_type_id = poultrytype.poultry_type_id";

                        $fetch_query_run = mysqli_query($connection, $fetch_query);

                        if (mysqli_num_rows($fetch_query_run) > 0) {
                            while ($row = mysqli_fetch_array($fetch_query_run)) {
                                ?>
                                <tr>
                                    <td>
                                        <?php echo $row['poultry_type_id']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['poultry_type_name']; ?>
                                    </td>
                                    <td>
                                        <?php echo number_format($row['count'], 0, '.', ','); ?>
                                    </td>
                                    <td>
                                        <?php echo $row['date_updated']; ?>
                                    </td>

                                    <td class="text-center">
                                        <button class="btn btn-update btn-success btn-sm center" data-toggle="modal"
                                            data-target="#updateModal" data-id="<?php echo $row['poultry_type_id']; ?>"
                                            data-type="<?php echo $row['poultry_type_name']; ?>"
                                            data-count="<?php echo $row['count']; ?>"
                                            data-date="<?php echo $row['date_updated']; ?>">
                                            Update
                                        </button>

                                    </td>
                                    <td class="text-center">
                                        <form action="code.php" method="post">
                                            <input type="hidden" name="id" value="<?php echo $row['poultry_type_id']; ?>">
                                            <!-- <button type="button" class="btn btn-danger btn-delete btn-sm" data-toggle="modal"
                                                data-target="#deleteConfirmationModal">Delete</button> -->
                                            <a data-toggle="modal" href="#deleteConfirmationModal"
                                                class="btn btn-danger btn-sm">Delete</a>
                                        </form>
                                    </td>
                                </tr>
                                <?php
                                $totalCount += $row['count'];
                            }
                        } else {
                            ?>
                            <tr>
                                <td colspan="6">No Record Available</td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>

                </table>

            </div>
            <div class="modal-footer">
                <a href="#" data-dismiss="modal" class="btn">Close</a>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation -->
<div class="modal" id="myModal2" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">2nd Modal title</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="container"></div>
            <div class="modal-body">
                Content for the dialog / modal goes here.
                Content for the dialog / modal goes here.
                Content for the dialog / modal goes here.
                Content for the dialog / modal goes here.
                Content for the dialog / modal goes here.
            </div>
            <div class="modal-footer">
                <a href="#" data-dismiss="modal" class="btn">Close</a>
                <a href="#" class="btn btn-primary">Save changes</a>
            </div>
        </div>
    </div>
</div>

<style>
    .modal:nth-of-type(even) {
        z-index: 1052 !important;
    }

    .modal-backdrop.show:nth-of-type(even) {
        z-index: 1051 !important;
    }
</style>


<script>
    $zindex - dropdown: 1000;
    $zindex - sticky: 1020;
    $zindex - fixed: 1030;
    $zindex - modal - backdrop: 1040;
    $zindex - offcanvas: 1050;
    $zindex - modal: 1060;
    $zindex - popover: 1070;
    $zindex - tooltip: 1080;


</script>