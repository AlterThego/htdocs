<?php
session_start();

?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <title>Poultry Population</title>
</head>

<body>

    <!-- Modal for Add data -->
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
                            <label for="type">Type</label>
                            <select class="form-control" name="type">
                                <?php
                                $connection = mysqli_connect("localhost", "root", "", "benguetlivestockdb");
                                $fetch_types_query = "SELECT * FROM poultrytype ORDER BY poultry_type_id ASC";
                                $fetch_types_query_run = mysqli_query($connection, $fetch_types_query);

                                while ($type_row = mysqli_fetch_array($fetch_types_query_run)) {
                                    // Concatenate type ID and type name with a separator for readability
                                    $option_value = $type_row['poultry_type_id'] . ' - ' . $type_row['poultry_type_name'];
                                    echo "<option value='" . $type_row['poultry_type_id'] . "'>" . $option_value . "</option>";
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


    <!-- Container for the table -->
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <?php
                if (isset($_SESSION['status']) && $_SESSION['status'] != '') {
                    ?>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
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
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                            data-target="#exampleModal">
                            Add data
                        </button>
                    </div>
                    <table class="table table-bordered rounded">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Type</th>
                                <th scope="col">Date Updated</th>
                                <th scope="col">Count</th>
                                <th scope="col">Update</th>
                                <th scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
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
                                            <?php echo $row['date_updated']; ?>
                                        </td>
                                        <td>
                                            <?php echo number_format($row['count'], 0, '.', ' '); ?>
                                        </td>
                                        <td>
                                            <button class="btn btn-update btn-success" data-toggle="modal"
                                                data-target="#updateModal" data-id="<?php echo $row['poultry_type_id']; ?>"
                                                data-type="<?php echo $row['poultry_type_name']; ?>"
                                                data-count="<?php echo $row['count']; ?>"
                                                data-date="<?php echo $row['date_updated']; ?>">
                                                Update
                                            </button>

                                        </td>
                                        <td>
                                            <form action="code.php" method="post">
                                                <input type="hidden" name="id" value="<?php echo $row['poultry_type_id']; ?>">
                                                <button type="button" class="btn btn-danger btn-delete" data-toggle="modal"
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
                                    <td colspan="6">No Record Available</td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>

                    </table>
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
                            <label for="update_type">Type</label>
                            <input type="text" class="form-control" id="update_type" readonly>
                        </div>

                        <div class="form-group mb-3">
                            <label for="update_count">Count</label>
                            <input type="number" class="form-control" name="update_count" id="update_count">
                        </div>

                        <div class="form-group mb-3">
                            <label for="update_date">Date Updated</label>
                            <input type="date" class="form-control" name="update_date" id="update_date">
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


    <!-- JS for Update and Delete -->
    <script>
        $(document).ready(function () {

            // Function to handle update button click
            $('.btn-update').click(function () {
                // Get data attributes from the clicked button
                var id = $(this).data('id');
                var type = $(this).data('type');
                var count = $(this).data('count');
                var dateUpdated = $(this).data('date');

                // Set the values in the update modal fields
                $('#update_id').val(id);
                $('#update_type').val(type);
                $('#update_count').val(count);
                $('#update_date').val(dateUpdated);

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


    <!-- <script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script> -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>