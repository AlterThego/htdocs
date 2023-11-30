<?php
session_start();
include('includes/header.php');
?>


<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">School Record</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="/StudentRecord/Enrollment/index.php">Enrollment <span
                        class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="/StudentRecord/Student/index.php">Student Record</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/StudentRecord/Courses/index.php">Courses</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/StudentRecord/Instructor/index.php">Instructors</a>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" href="#">Source Code</a>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
    </div>
</nav>




<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Student Record</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="code.php" method="POST">
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="student_id">Student ID</label>
                        <input type="text" class="form-control" name="student_id" placeholder="Enter student ID"
                            autocomplete="off">
                    </div>

                    <div class="form-group mb-3">
                        <label for="first_name">First Name</label>
                        <input type="text" class="form-control" name="first_name" placeholder="Enter first name"
                            autocomplete="off">
                    </div>

                    <div class="form-group mb-3">
                        <label for="last_name">Last Name</label>
                        <input type="text" class="form-control" name="last_name" placeholder="Enter last name"
                            autocomplete="off">
                    </div>

                    <div class="form-group mb-3">
                        <label for="date_of_birth">Date of Birth</label>
                        <input type="date" class="form-control" name="date_of_birth">
                    </div>

                    <div class="form-group mb-3">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" name="email" placeholder="Enter email"
                            autocomplete="off">
                    </div>

                    <div class="form-group mb-3">
                        <label for="phone">Phone Number</label>
                        <input type="text" class="form-control" name="phone" placeholder="Enter phone"
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
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                        Add Student
                    </button>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered">
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
                            $connection = mysqli_connect("localhost", "root", "", "studentrecord");

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
                            } else {
                                ?>
                                <tr colspan="8">No Record Available</tr>
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
            <form action="code.php" method="POST">
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
                        <input type="date" class="form-control" name="update_date_of_birth" id="update_date_of_birth">
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
            window.location.href = 'code.php?delete_student=' + student_id;
        });
    });
</script>

<?php include('includes/footer.php'); ?>