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
                        <label for="year">Year</label>
                        <?php
                        // Get the current year
                        $currentYear = date("Y");

                        // Set the default year to the next year
                        $defaultYear = $currentYear;
                        ?>
                        <input type="number" class="form-control" name="year" placeholder="Enter Year" min="1900"
                            max="2099" value="<?php echo $defaultYear; ?>">
                    </div>

                    <div class="form-group mb-3">
                        <label for="carabao_yearly">Yearly Carabao</label>
                        <input type="number" class="form-control" name="carabao_yearly"
                            placeholder="Enter Yearly Carabao Count">
                    </div>

                    <div class="form-group mb-3">
                        <label for="cattle_yearly">Yearly Cattle</label>
                        <input type="number" class="form-control" name="cattle_yearly"
                            placeholder="Enter Yearly Cattle Count">
                    </div>
                    <div class="form-group mb-3">
                        <label for="swine_yearly">Yearly Swine</label>
                        <input type="number" class="form-control" name="swine_yearly"
                            placeholder="Enter Yearly Swine Count">
                    </div>
                    <div class="form-group mb-3">
                        <label for="goat_yearly">Goat</label>
                        <input type="number" class="form-control" name="goat_yearly"
                            placeholder="Enter Yearly Goat Count">
                    </div>
                    <div class="form-group mb-3">
                        <label for="dog_yearly">Dog Count</label>
                        <input type="number" class="form-control" name="dog_yearly" placeholder="Enter Yearly DogCount">
                    </div>
                    <div class="form-group mb-3">
                        <label for="sheep_yearly">Sheep Count</label>
                        <input type="number" class="form-control" name="sheep_yearly"
                            placeholder="Enter Yearly Sheep Count">
                    </div>
                    <div class="form-group mb-3">
                        <label for="horse_yearly">Horse Count</label>
                        <input type="number" class="form-control" name="horse_yearly"
                            placeholder="Enter Yearly Horse Count">
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
                        <label for="update_year">Year</label>
                        <input type="number" class="form-control" name="update_year" id="update_year" readonly>
                    </div>
                    <div class="form-group mb-3">
                        <label for="update_carabao">Update Carabao Count</label>
                        <input type="number" class="form-control" name="update_carabao" id="update_carabao">
                    </div>
                    <div class="form-group mb-3">
                        <label for="update_cattle">Update Cattle Count</label>
                        <input type="number" class="form-control" name="update_cattle" id="update_cattle">
                    </div>
                    <div class="form-group mb-3">
                        <label for="update_swine">Update Swine Count</label>
                        <input type="number" class="form-control" name="update_swine" id="update_swine">
                    </div>
                    <div class="form-group mb-3">
                        <label for="update_goat">Update Goat Count</label>
                        <input type="number" class="form-control" name="update_goat" id="update_goat">
                    </div>
                    <div class="form-group mb-3">
                        <label for="update_dog">Update Dog Count</label>
                        <input type="number" class="form-control" name="update_dog" id="update_dog">
                    </div>
                    <div class="form-group mb-3">
                        <label for="update_sheep">Update Sheep Count</label>
                        <input type="number" class="form-control" name="update_sheep" id="update_sheep">
                    </div>
                    <div class="form-group mb-3">
                        <label for="update_horse">Update Horse Count</label>
                        <input type="number" class="form-control" name="update_horse" id="update_horse">
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