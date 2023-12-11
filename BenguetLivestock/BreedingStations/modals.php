<!-- Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Add data</h5>
                <button type="button " class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="code.php" method="POST">
                <!-- Body -->
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="zip">ZIP Code and Municipality</label>
                        <select class="form-control" name="zip">
                            <?php
                            $connection = mysqli_connect("localhost", "root", "", "benguetlivestockdb");

                            // Modify the query to exclude existing municipality_id values
                            $existing_ids_query = "SELECT DISTINCT municipality_id FROM livestockvolume";
                            $existing_ids_result = mysqli_query($connection, $existing_ids_query);

                            $existing_ids = [];
                            while ($existing_row = mysqli_fetch_array($existing_ids_result)) {
                                $existing_ids[] = $existing_row['municipality_id'];
                            }

                            $fetch_types_query = "SELECT * FROM municipalities ORDER BY municipality_id ASC";
                            $fetch_types_query_run = mysqli_query($connection, $fetch_types_query);

                            $choices_available = false; // Flag to check if any choices are available
                            
                            while ($type_row = mysqli_fetch_array($fetch_types_query_run)) {
                                // Exclude existing ids from the dropdown
                                if (!in_array($type_row['municipality_id'], $existing_ids)) {
                                    $option_value = $type_row['municipality_id'] . ' - ' . $type_row['municipality_name'];
                                    echo "<option value='" . $option_value . "'>" . $option_value . "</option>";
                                    $choices_available = true; // Set the flag to true
                                }
                            }

                            // Check if there are no choices available
                            if (!$choices_available) {
                                echo "<option value='' disabled>No available choices anymore. Either update or delete</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="carabao_count">Carabao</label>
                        <input type="number" class="form-control" name="carabao_count"
                            placeholder="Enter Carabao Count">
                    </div>

                    <div class="form-group mb-3">
                        <label for="cattle_count">Cattle</label>
                        <input type="number" class="form-control" name="cattle_count" placeholder="Enter Cattle Count">
                    </div>


                    <div class="form-group mb-3">
                        <label for="swine_count">Swine</label>
                        <input type="number" class="form-control" name="swine_count" placeholder="Enter Swine Count">
                    </div>


                    <div class="form-group mb-3">
                        <label for="goat_count">Goat</label>
                        <input type="number" class="form-control" name="goat_count" placeholder="Enter Goat Count">
                    </div>


                    <div class="form-group mb-3">
                        <label for="dog_count">Dog</label>
                        <input type="number" class="form-control" name="dog_count" placeholder="Enter Dog Count">
                    </div>

                    <div class="form-group mb-3">
                        <label for="sheep_count">Sheep</label>
                        <input type="number" class="form-control" name="sheep_count" placeholder="Enter Sheep Count">
                    </div>

                    <div class="form-group mb-3">
                        <label for="horse_count">Horse</label>
                        <input type="number" class="form-control" name="horse_count" placeholder="Enter Horse Count">
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
                        <label for="update_name">ZIP Code and Municipality</label>
                        <input type="text" class="form-control" name="update_name" id="update_name" readonly>
                    </div>

                    <div class="form-group mb-3">
                        <label for="update_cattle_volume">Cattle Volume</label>
                        <input type="number" class="form-control" name="update_cattle_volume" id="update_cattle_volume"?>
                    </div>

                    <div class="form-group mb-3">
                        <label for="update_swine_volume">Swine Volume</label>
                        <input type="number" class="form-control" name="update_swine_volume" id="update_swine_volume">
                    </div>

                    <div class="form-group mb-3">
                        <label for="update_carabao_volume">Carabao Volume</label>
                        <input type="number" class="form-control" name="update_carabao_volume"
                            id="update_carabao_volume">
                    </div>

                    <div class="form-group mb-3">
                        <label for="update_goat_volume">Goat Volume</label>
                        <input type="number" class="form-control" name="update_goat_volume" id="update_goat_volume">
                    </div>

                    <div class="form-group mb-3">
                        <label for="update_chicken_volume">Chicken Volume</label>
                        <input type="number" class="form-control" name="update_chicken_volume"
                            id="update_chicken_volume">
                    </div>

                    <div class="form-group mb-3">
                        <label for="update_duck_volume">Duck Volume</label>
                        <input type="number" class="form-control" name="update_duck_volume" id="update_duck_volume">
                    </div>


                    <div class="form-group mb-3">
                        <label for="update_fish_volume">Fish Volume</label>
                        <input type="number" class="form-control" name="update_fish_volume" id="update_fish_volume">
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
    aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
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