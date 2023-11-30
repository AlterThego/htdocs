<?php
include 'connect.php';

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $password = $_POST['password'];

    $sql = "INSERT INTO `crud` (name, email, mobile, password) 
            VALUES ('$name', '$email', '$mobile', '$password')";

    $result = $con->query($sql);

    if ($result) {
        echo "success";
        exit;
    } else {
        echo "error";
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container m-5">
        <!-- Button to trigger the modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">
            Add User
        </button>

        <!-- Modal -->
        <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addUserModalLabel">Add User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Form inside the modal -->
                        <form id="addUserForm" method="post">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" placeholder="Enter name" name="name" autocomplete="off">
                            </div>

                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" placeholder="Enter email" name="email" autocomplete="off">
                            </div>

                            <div class="form-group">
                                <label>Mobile</label>
                                <input type="text" class="form-control" placeholder="Enter mobile" name="mobile" autocomplete="off">
                            </div>

                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" placeholder="Enter password" name="password" autocomplete="off">
                            </div>

                            <div class="form-group">
                                <button type="button" class="btn btn-primary" onclick="submitForm()">Submit</button>
                            </div>
                        </form>
                        <!-- End of Form inside the modal -->
                    </div>
                </div>
            </div>
        </div>
        <!-- End of Modal -->

        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            function submitForm() {
                $.ajax({
                    type: 'POST',
                    url: 'create.php',
                    data: $('#addUserForm').serialize(),
                    success: function(response) {
                        if (response === 'success') {
                            alert('User added successfully!');
                            $('#addUserModal').modal('hide');
                            // You can add more custom actions here if needed
                        } else {
                            alert('Error adding user. Please try again.');
                        }
                    }
                });
            }
        </script>
    </div>
</body>

</html>
