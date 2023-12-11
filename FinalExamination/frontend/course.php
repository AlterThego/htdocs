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


    <title>Courses</title>
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
                    <a class="nav-link" href="enrollment.php">Enrollment <span
                            class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="student.php">Student</a>
                </li>
                <li class="nav-item active">
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

    <!-- MODAL FOR ADD COURSE -->
    <div class="modal fade" id="courseModal" tabindex="-1" role="dialog" aria-labelledby="courseModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="courseModalLabel">Add Course</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/finalexamination/setup.php" method="POST">
                    <div class="modal-body">

                        <div class="form-group mb-3">
                            <label for="course_id">Course ID</label>
                            <input type="text" class="form-control" name="course_id" placeholder="Enter course ID"
                                autocomplete="off">
                        </div>

                        <div class="form-group mb-3">
                            <label for="instructor_id">Instructor ID</label>
                            <select class="form-control" name="instructor_id">
                                <?php
                                $db = new mysqli("localhost", "root", "", "suaking");

                                if ($db->connect_error) {
                                    die("Connection failed: " . $db->connect_error);
                                }

                                $result = $db->query("SELECT InstructorID, LastName FROM instructor");

                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<option value='" . $row["InstructorID"] . "'>" . $row["InstructorID"] . " " . $row["LastName"] . "</option>";
                                    }
                                }
                                ?>  
                            </select>
                        </div>


                        <div class="form-group mb-3">
                            <label for="course_name">Course Name</label>
                            <input type="text" class="form-control" name="course_name" placeholder="Enter course name"
                                autocomplete="off">
                        </div>

                        <div class="form-group mb-3">
                            <label for="credits">Credits</label>
                            <input type="text" class="form-control" name="credits" placeholder="Enter credits"
                                autocomplete="off">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="add_course" class="btn btn-primary">Add Course</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- TABLES -->
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
                        <h4 class="text-center">Course</h4>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#courseModal">
                            Add Course
                        </button>
                    </div>
                    <div class="card-body">
                        <table id="courseTable" class="display table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Course ID</th>
                                    <th scope="col">Course Name</th>
                                    <th scope="col">Instructor ID</th>
                                    <th scope="col">Instructor Surname</th>
                                    <th scope="col">Credits</th>
                                    <th scope="col">Update</th>
                                    <th scope="col">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $connection = mysqli_connect("localhost", "root", "", "suaking");
                                $fetch_query = "SELECT course.CourseID, course.CourseName, course.Credits, course.InstructorID, instructor.LastName
                FROM course
                LEFT JOIN instructor ON course.InstructorID = instructor.InstructorID";


                                $fetch_query_run = mysqli_query($connection, $fetch_query);

                                if (mysqli_num_rows($fetch_query_run) > 0) {
                                    while ($row = mysqli_fetch_array($fetch_query_run)) {
                                        ?>
                                        <tr>
                                            <td>
                                                <?php echo $row['CourseID']; ?>
                                            </td>
                                            <td>
                                                <?php echo $row['CourseName']; ?>
                                            </td>
                                            <td>
                                                <?php echo $row['InstructorID']; ?>
                                            </td>

                                            <td>
                                                <?php echo $row['LastName']; ?>
                                            </td>

                                            <td>
                                                <?php echo $row['Credits']; ?>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-success btn-sm btn-update"
                                                    data-course-id="<?php echo $row['CourseID']; ?>"
                                                    data-course-name="<?php echo $row['CourseName']; ?>"
                                                    data-credits="<?php echo $row['Credits']; ?>">
                                                    Update
                                                </button>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-danger btn-sm btn-delete"
                                                    data-course-id="<?php echo $row['CourseID']; ?>" data-toggle="modal"
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

    <!-- UPDATE MODAL FOR COURSE -->
    <div class="modal fade" id="updateCourseModal" tabindex="-1" role="dialog" aria-labelledby="updateCourseModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateCourseModalLabel">Update Course</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/finalexamination/setup.php" method="POST">
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label for="update_course_id">Course ID</label>
                            <input type="text" class="form-control" name="update_course_id" id="update_course_id"
                                placeholder="Enter course ID" readonly>
                        </div>

                        <div class="form-group mb-3">
                            <label for="update_course_name">Course Name</label>
                            <input type="text" class="form-control" name="update_course_name" id="update_course_name"
                                placeholder="Enter course name" autocomplete="off">
                        </div>

                        <div class="form-group mb-3">
                            <label for="update_instructor_id">Instructor ID</label>
                            <select class="form-control" name="update_instructor_id">
                                <?php
                                // Assuming you have a database connection
                                $db = new mysqli("localhost", "root", "", "suaking");

                                // Check the connection
                                if ($db->connect_error) {
                                    die("Connection failed: " . $db->connect_error);
                                }

                                // Fetch instructor data from the database
                                $result = $db->query("SELECT InstructorID, LastName FROM instructor");

                                // Check if there are rows
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<option value='" . $row["InstructorID"] . "'>" . $row["InstructorID"] . " " . $row["LastName"] . "</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="update_credits">Credits</label>
                            <input type="text" class="form-control" name="update_credits" id="update_credits"
                                placeholder="Enter credits" autocomplete="off">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="update_course" class="btn btn-primary">Update Course</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- CONFIRM DELETE MODAL -->
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

    <!-- SCRIPTS -->
    <script>
        $(document).ready(function () {
            $('.nav-link').click(function () {
                var target = $(this).attr('href');
                $('html, body').animate({
                    scrollTop: $(target).offset().top
                }, 800);
            });

            $('.btn-update').click(function () {
                var course_id = $(this).data('course-id');
                var course_name = $(this).data('course-name');
                var instructor_id = $(this).data('instructor_id');
                var credits = $(this).data('credits');

                $('#update_course_id').val(course_id);
                $('#update_course_name').val(course_name);
                $('#update_instructor_id').val(instructor_id);
                $('#update_credits').val(credits);


                $('#updateCourseModal').modal('show');
            });

            $('.btn-delete').click(function () {
                var course_id = $(this).data('course-id');
                $('#confirmDelete').data('course-id', course_id);
            });

            $('#confirmDelete').click(function () {
                var course_id = $(this).data('course-id');
                window.location.href = '/finalexamination/setup.php?delete_course=' + course_id;
            });

            $(document).ready(function () {
                $('.nav-link').on('click', function (e) {
                    e.preventDefault();
                    var target = $(this).attr('href');
                    $(target).load(target + '.html');
                    $(this).tab('show');
                });
            });
        });
    </script>

    <script>
        $(document).ready(function () {
            $('#courseTable').DataTable();
        });
    </script>



    <!-- <script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script> -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>

</html>