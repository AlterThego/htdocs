<?php
session_start();
include('includes/header.php');
?>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="code.php" method="POST">
                <!-- Body -->
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="name">Type</label>
                        <input type="text" class="form-control" name="type" placeholder="Enter Type">
                    </div>

                    <div class="form-group mb-3">
                        <label for="phone">Count</label>
                        <input type="number" class="form-control" name="count" placeholder="Enter Count">
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

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <?php
            if (isset($_SESSION['status']) && $_SESSION['status'] != '') {
                
                ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <!-- <strong>Hey!</strong> -->
                    <?php echo $_SESSION['status']; ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php
                unset($_SESSION['status']);
            }
            ?>
            <div class="card">
                <div class="card-header">
                    <h4 class="text-center">Poultry Population</h4>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                        Add data
                    </button>
                </div>
                <!-- <div class="card-body"> -->
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <!-- <th scope="col">#</th> -->
                            <th scope="col">Type</th>
                            <th scope="col">Count</th>
                            <th scope="col">Update</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $connection = mysqli_connect("localhost", "root", "", "poultrypopulation2");

                        $fetch_query = "SELECT * FROM poultry_population";
                        $fetch_query_run = mysqli_query($connection, $fetch_query);

                        if (mysqli_num_rows($fetch_query_run) > 0) {
                            while ($row = mysqli_fetch_array($fetch_query_run)) {
                                ?>
                                <tr>
                                    <!-- <td><?php echo $row['id']; ?></td> -->
                                    <td>
                                        <?php echo $row['type']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['count']; ?>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-success btn-sm btn-update"
                                            data-id="<?php echo $row['id']; ?>" data-type="<?php echo $row['type']; ?>"
                                            data-count="<?php echo $row['count']; ?>">
                                            Update
                                        </button>
                                    </td>
                                    <td>
                                        <form action="code.php" method="post">
                                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                            <button type="button" class="btn btn-danger btn-sm btn-delete" data-toggle="modal"
                                                data-target="#deleteConfirmationModal">
                                                Delete
                                            </button>
                                        </form>

                                    </td>
                                </tr>
                                <?php
                            }
                        } else {
                            ?>
                            <tr>
                                <td colspan="5">No Record Available</td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
                <!-- </div> -->
            </div>
        </div>
    </div>
</div>

<!-- Update Modal -->
<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel">Update Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="code.php" method="POST">
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="update_name">Type</label>
                        <input type="text" class="form-control" name="update_type" id="update_type"
                            placeholder="Enter Type">
                    </div>
                    <div class="form-group mb-3">
                        <label for="update_count">Count</label>
                        <input type="number" class="form-control" name="update_count" id="update_count"
                            placeholder="Update Count">
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


<script>
    $(document).ready(function () {
        // Function to handle update button click
        $('.btn-update').click(function () {
            // Get data attributes from the clicked button
            var id = $(this).data('id');
            var type = $(this).data('type');
            var count = $(this).data('count');

            // Set the values in the update modal fields
            $('#update_id').val(id);
            $('#update_type').val(type);
            $('#update_count').val(count);

            // Show the update modal
            $('#updateModal').modal('show');
        });

        $(document).ready(function () {
            $('.btn-delete').click(function () {
                var id = $(this).closest('form').find('input[name="id"]').val();
                $('#confirmDelete').data('id', id);
                $('#deleteConfirmationModal').modal('show');
            });

            $('#confirmDelete').click(function () {
                var id = $(this).data('id');
                // Call the function to handle deletion in code.php
                deleteData(id);
            });
        });

        // Function to handle deletion
        function deleteData(id) {
            $.ajax({
                type: 'POST',
                url: 'code.php',
                data: { deleteData: true, id: id },
                success: function (response) {
                    // Redirect to index.php after successful deletion
                    window.location.href = 'index.php';
                },
                error: function (error) {
                    console.error('Error during deletion:', error);
                }
            });
        }

    });



</script>




<?php include('includes/footer.php'); ?>