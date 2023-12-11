<!-- Add Modal -->
<div class="modal fade p-0" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                        <label for="layers_count">Yearly <b>Layers</b></label>
                        <input type="number" class="form-control" name="layers_count"
                            placeholder="Enter yearly layers count">
                    </div>

                    <div class="form-group mb-3">
                        <label for="broiler_count">Yearly <b>Broiler</b></label>
                        <input type="number" class="form-control" name="broiler_count"
                            placeholder="Enter yearly broiler count">
                    </div>

                    <div class="form-group mb-3">
                        <label for="native_count">Yearly <b>Native/Range</b></label>
                        <input type="number" class="form-control" name="native_count"
                            placeholder="Enter yearly native count">
                    </div>

                    <div class="form-group mb-3">
                        <label for="fighting_count">Yearly <b>Fighting/Fancy Fowl</b></label>
                        <input type="number" class="form-control" name="fighting_count"
                            placeholder="Enter yearly fighting count">
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
                        <label for="update_layers">Yearly <b>Layers</b></label>
                        <input type="number" class="form-control" name="update_layers" id="update_layers">
                    </div>

                    <div class="form-group mb-3">
                        <label for="update_broiler">Yearly <b>Broiler</b></label>
                        <input type="number" class="form-control" name="update_broiler" id="update_broiler">
                    </div>

                    <div class="form-group mb-3">
                        <label for="update_native">Yearly <b>Native/Range</b></label>
                        <input type="number" class="form-control" name="update_native" id="update_native">
                    </div>

                    <div class="form-group mb-3">
                        <label for="update_fighting">Yearly <b>Fighting/Fancy Fowl</b></label>
                        <input type="number" class="form-control" name="update_fighting" id="update_fighting">
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