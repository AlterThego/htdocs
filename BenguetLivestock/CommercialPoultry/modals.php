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
                        <label for="year">Year</label>
                        <?php
                        // Get the current year
                        $currentYear = date("Y");

                        // Set the default year to the next year
                        $defaultYear = $currentYear;
                        ?>
                        <input type="number" class="form-control" name="year" placeholder="Enter Year"
                            min="<?php echo $currentYear - 6; ?>" max="2099" value="<?php echo $defaultYear; ?>">
                    </div>

                    <div class="form-group mb-3">
                        <label for="poultry_farms">Poultry</label>
                        <input type="number" class="form-control" name="poultry_farms"
                            placeholder="Enter Poultry Farms">
                    </div>

                    <div class="form-group mb-3">
                        <label for="cattle_farms">Cattle</label>
                        <input type="number" class="form-control" name="cattle_farms" placeholder="Enter Cattle Farms">
                    </div>


                    <div class="form-group mb-3">
                        <label for="piggery_farms">Piggery</label>
                        <input type="number" class="form-control" name="piggery_farms"
                            placeholder="Enter Piggery Farms">
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
                        <input type="text" class="form-control" name="update_year" id="update_year" readonly>
                    </div>

                    <div class="form-group mb-3">
                        <label for="update_poultry_farms">Poultry Farms</label>
                        <input type="number" class="form-control" name="update_poultry_farms" id="update_poultry_farms">
                    </div>

                    <div class="form-group mb-3">
                        <label for="update_cattle_farms">Cattle Farms</label>
                        <input type="number" class="form-control" name="update_cattle_farms" id="update_cattle_farms">
                    </div>

                    <div class="form-group mb-3">
                        <label for="update_piggery_farms">Piggery Farms</label>
                        <input type="number" class="form-control" name="update_piggery_farms" id="update_piggery_farms">
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