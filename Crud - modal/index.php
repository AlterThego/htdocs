<?php
session_start();
include('includes/header.php') ?>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="code.php" method="POST">
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" placeholder="enter name">
                    </div>

                    <div class="form-group mb-3">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" name="email" placeholder="enter email">
                    </div>

                    <div class="form-group mb-3">
                        <label for="phone">Phone Number</label>
                        <input type="number" class="form-control" name="phone" placeholder="enter phone">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="savedata" class="btn btn-primary">Save changes</button>
                </div>
            </form>
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
                echo $_SESSION['status'];
                ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Hey!</strong>
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
                    <h4 class="text-center">Benguet Livestock</h4>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                        Add data
                    </button>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Update</th>
                                <th scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $connection = mysqli_connect("localhost", "root", "", "crud_modal");

                            $fetch_query = "SELECT * FROM test";
                            $fetch_query_run = mysqli_query($connection, $fetch_query);

                            if (mysqli_num_rows($fetch_query_run) > 0) {
                                while ($row = mysqli_fetch_array($fetch_query_run)) {
                                    // echo $row['id'];
                                    ?>
                                    <tr>
                                        <td>
                                            <?php echo $row['id']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['name']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['email']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['phone']; ?>
                                        </td>



                                        <td>
                                            <button type="button" class="btn btn-success btn-sm btn-update"
                                                data-id="<?php echo $row['id']; ?>" data-name="<?php echo $row['name']; ?>"
                                                data-email="<?php echo $row['email']; ?>"
                                                data-phone="<?php echo $row['phone']; ?>">
                                                Update
                                            </button>
                                        </td>



                                        <td>
                                            <form action="delete.php" method="post">
                                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                                <button type="submit" name="deleteData"
                                                    class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    <?php

                                }
                            } else {
                                ?>
                                <tr colspan="4">No Record Available</tr>
                                <?php

                            }
                            ?>

                        </tbody>

                    </table>
                </div>
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
                    <!-- Similar form fields as in the "Add data" modal -->
                    <div class="form-group mb-3">
                        <label for="update_name">Name</label>
                        <input type="text" class="form-control" name="update_name" id="update_name"
                            placeholder="enter name">
                    </div>

                    <div class="form-group mb-3">
                        <label for="update_email">Email address</label>
                        <input type="email" class="form-control" name="update_email" id="update_email"
                            placeholder="enter email">
                    </div>

                    <div class="form-group mb-3">
                        <label for="update_phone">Phone Number</label>
                        <input type="number" class="form-control" name="update_phone" id="update_phone"
                            placeholder="enter phone">
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


<script>
    $(document).ready(function () {
        // Function to handle update button click
        $('.btn-update').click(function () {
            // Get data attributes from the clicked button
            var id = $(this).data('id');
            var name = $(this).data('name');
            var email = $(this).data('email');
            var phone = $(this).data('phone');

            // Set the values in the update modal fields
            $('#update_id').val(id);
            $('#update_name').val(name);
            $('#update_email').val(email);
            $('#update_phone').val(phone);

            // Show the update modal
            $('#updateModal').modal('show');
        });
    });
</script>


<!-- Add these lines before the closing </body> tag -->



<?php include('includes/footer.php') ?>