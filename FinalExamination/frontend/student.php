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

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />

    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>


    <title>Student Record</title>
</head>

<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">School Record</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="enrollment.php">Enrollment <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="student.php">Student</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="course.php">Courses</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="instructor.php">Instructor</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link float-end" href="user.php">Account</a>
                </li>
            </ul>
        </div>
    </nav>




    <div class="modal fade" id="studentModal" tabindex="-1" role="dialog" aria-labelledby="studentModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="studentModalLabel">Add Student Record</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/finalexamination/setup.php" method="POST">
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label for="student_id">Student ID</label>
                            <input type="text" class="form-control" name="student_id" placeholder="Enter Student ID"
                                autocomplete="off">
                        </div>

                        <div class="form-group mb-3">
                            <label for="first_name">First Name</label>
                            <input type="text" class="form-control" name="first_name" placeholder="Enter First Name"
                                autocomplete="off">
                        </div>

                        <div class="form-group mb-3">
                            <label for="last_name">Last Name</label>
                            <input type="text" class="form-control" name="last_name" placeholder="Enter Last Name"
                                autocomplete="off">
                        </div>

                        <div class="form-group mb-3">
                            <label for="date_of_birth">Date of Birth</label>
                            <input type="date" class="form-control" name="date_of_birth">
                        </div>

                        <div class="form-group mb-3">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" name="email" placeholder="Enter Email"
                                autocomplete="off">
                        </div>

                        <div class="form-group mb-3">
                            <label for="phone">Phone Number</label>
                            <input type="text" class="form-control" name="phone" placeholder="Enter Phone"
                                autocomplete="off">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="save_student" class="btn btn-primary">Save Record</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="container-fluid mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <?php
                if (isset($_SESSION['status']) && $_SESSION['status'] != '') {
                    ?>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Result: </strong>
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
                        <h4 class="text-center">Student Record</h4>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#studentModal">
                            Add Student
                        </button>
                    </div>
                    <div class="card-body">
                        <table id="studentTable" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Student ID</th>
                                    <th scope="col">First Name</th>
                                    <th scope="col">Last Name</th>
                                    <th scope="col">Date of Birth</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Update</th>
                                    <th scope="col">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $connection = mysqli_connect("localhost", "root", "", "suaking");

                                $fetch_query = "SELECT * FROM student";
                                $fetch_query_run = mysqli_query($connection, $fetch_query);

                                if (mysqli_num_rows($fetch_query_run) > 0) {
                                    while ($row = mysqli_fetch_array($fetch_query_run)) {
                                        ?>
                                        <tr>
                                            <td>
                                                <?php echo $row['StudentID']; ?>
                                            </td>
                                            <td>
                                                <?php echo $row['FirstName']; ?>
                                            </td>
                                            <td>
                                                <?php echo $row['LastName']; ?>
                                            </td>
                                            <td>
                                                <?php echo $row['DateOfBirth']; ?>
                                            </td>
                                            <td>
                                                <?php echo $row['Email']; ?>
                                            </td>
                                            <td>
                                                <?php echo $row['Phone']; ?>
                                            </td>

                                            <td>
                                                <button type="button" class="btn btn-success btn-sm btn-update"
                                                    data-student-id="<?php echo $row['StudentID']; ?>"
                                                    data-first-name="<?php echo $row['FirstName']; ?>"
                                                    data-last-name="<?php echo $row['LastName']; ?>"
                                                    data-date-of-birth="<?php echo $row['DateOfBirth']; ?>"
                                                    data-email="<?php echo $row['Email']; ?>"
                                                    data-phone="<?php echo $row['Phone']; ?>">
                                                    Update
                                                </button>
                                            </td>

                                            <td>
                                                <button type="button" class="btn btn-danger btn-sm btn-delete"
                                                    data-student-id="<?php echo $row['StudentID']; ?>" data-toggle="modal"
                                                    data-target="#deleteConfirmationModal">
                                                    Delete
                                                </button>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateModalLabel">Update Student Record</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/finalexamination/setup.php" method="POST">
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label for="update_student_id">Student ID</label>
                            <input type="text" class="form-control" name="update_student_id" id="update_student_id"
                                placeholder="Enter student ID" readonly>
                        </div>

                        <div class="form-group mb-3">
                            <label for="update_first_name">First Name</label>
                            <input type="text" class="form-control" name="update_first_name" id="update_first_name"
                                placeholder="Enter first name">
                        </div>

                        <div class="form-group mb-3">
                            <label for="update_last_name">Last Name</label>
                            <input type="text" class="form-control" name="update_last_name" id="update_last_name"
                                placeholder="Enter last name">
                        </div>

                        <div class="form-group mb-3">
                            <label for="update_date_of_birth">Date of Birth</label>
                            <input type="date" class="form-control" name="update_date_of_birth"
                                id="update_date_of_birth">
                        </div>

                        <div class="form-group mb-3">
                            <label for="update_email">Email address</label>
                            <input type="email" class="form-control" name="update_email" id="update_email"
                                placeholder="Enter email">
                        </div>

                        <div class="form-group mb-3">
                            <label for="update_phone">Phone Number</label>
                            <input type="text" class="form-control" name="update_phone" id="update_phone"
                                placeholder="Enter phone">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="update_student" class="btn btn-primary">Update Record</button>
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

</body>

<script>
    $(document).ready(function () {
        $('.nav-link').click(function () {
            var target = $(this).attr('href');
            $('html, body').animate({
                scrollTop: $(target).offset().top
            }, 800);
        });

        $('.btn-update').click(function () {
            var student_id = $(this).data('student-id');
            var first_name = $(this).data('first-name');
            var last_name = $(this).data('last-name');
            var date_of_birth = $(this).data('date-of-birth');
            var email = $(this).data('email');
            var phone = $(this).data('phone');

            $('#update_student_id').val(student_id);
            $('#update_first_name').val(first_name);
            $('#update_last_name').val(last_name);
            $('#update_date_of_birth').val(date_of_birth);
            $('#update_email').val(email);
            $('#update_phone').val(phone);

            $('#updateModal').modal('show');
        });

        $('.btn-delete').click(function () {
            var student_id = $(this).data('student-id');
            $('#confirmDelete').data('student-id', student_id);
        });

        $('#confirmDelete').click(function () {
            var student_id = $(this).data('student-id');
            window.location.href = '/finalexamination/setup.php?delete_student=' + student_id;
        });
    });
</script>

<script>
    $(document).ready(function () {
        $('#studentTable').DataTable();
    });
</script>


<!-- <script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script> -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>


</html>