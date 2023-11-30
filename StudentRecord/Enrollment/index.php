<?php
session_start();
include('includes/header.php');


?>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">School Record</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="/StudentRecord/Enrollment/index.php">Enrollment <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
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

<!-- MODAL FOR ADD ENROLLMENT -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Enrollment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="code.php" method="POST">
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="student_id">Student ID</label>
                        <select class="form-control" name="student_id" >
                            <?php
                            $connection = mysqli_connect("localhost", "root", "", "studentrecord");

                            $fetch_students_query = "SELECT StudentID, LastName FROM student";
                            $fetch_students_query_run = mysqli_query($connection, $fetch_students_query);

                            if (mysqli_num_rows($fetch_students_query_run) > 0) {
                                while ($row = mysqli_fetch_array($fetch_students_query_run)) {
                                    echo "<option value='" . $row['StudentID'] . "'>" . $row['StudentID'] . " - " . $row['LastName'] . "</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="course_id">Course</label>
                        <select class="form-control" name="course_id">
                            <?php
                            $fetch_courses_query = "SELECT CourseID, CourseName FROM course";
                            $fetch_courses_query_run = mysqli_query($connection, $fetch_courses_query);

                            if (mysqli_num_rows($fetch_courses_query_run) > 0) {
                                while ($row = mysqli_fetch_array($fetch_courses_query_run)) {
                                    echo "<option value='" . $row['CourseID'] . "'>" . $row['CourseID'] . " - " . $row['CourseName'] . "</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="enrollment_date">Enrollment Date</label>
                        <input type="date" class="form-control" name="enrollment_date">
                    </div>

                    <div class="form-group mb-3">
                        <label for="grade">Grade</label>
                        <input type="text" class="form-control" name="grade" placeholder="Enter grade" autocomplete="off">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="save_enrollment" class="btn btn-primary">Save Record</button>
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
                    <h4 class="text-center">Enrollment Record</h4>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                        Add Enrollment Record
                    </button>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Enrollment ID</th>
                                <th scope="col">Student ID</th>
                                <th scope="col">Last Name</th>
                                <th scope="col">Course ID</th>
                                <th scope="col">Enrollment Date</th>
                                <th scope="col">Grade</th>
                                <th scope="col">Update</th>
                                <th scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $connection = mysqli_connect("localhost", "root", "", "studentrecord");

                            $fetch_query = "SELECT enrollment.EnrollmentID, enrollment.StudentID, student.LastName, enrollment.CourseID, enrollment.EnrollmentDate, enrollment.Grade FROM enrollment JOIN student ON enrollment.StudentID = student.StudentID";
                            $fetch_query_run = mysqli_query($connection, $fetch_query);



                            $fetch_query_run = mysqli_query($connection, $fetch_query);

                            if (mysqli_num_rows($fetch_query_run) > 0) {
                                while ($row = mysqli_fetch_array($fetch_query_run)) {
                                    ?>
                                    <tr>
                                        <td>
                                            <?php echo $row['EnrollmentID']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['StudentID']; ?>
                                        </td>

                                        <td>
                                            <?php echo $row['LastName']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['CourseID']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['EnrollmentDate']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['Grade']; ?>
                                        </td>

                                        <td>
                                            <button type="button" class="btn btn-success btn-sm btn-update"
                                                data-enrollment-id="<?php echo $row['EnrollmentID']; ?>"
                                                data-student-id="<?php echo $row['StudentID']; ?>"
                                                data-last-name="<?php echo $row['LastName']; ?>"
                                                data-course-id="<?php echo $row['CourseID']; ?>"
                                                data-enrollment-date="<?php echo $row['EnrollmentDate']; ?>"
                                                data-grade="<?php echo $row['Grade']; ?>">
                                                Update
                                            </button>
                                        </td>

                                        <td>
                                            <button type="button" class="btn btn-danger btn-sm btn-delete"
                                                data-enrollment-id="<?php echo $row['EnrollmentID']; ?>" data-toggle="modal"
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

<!-- UPDATE MODAL -->
<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel">Update Enrollment Record</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="code.php" method="POST">
                <div class="modal-body">
                    <!-- Keep the structure similar to the Add Enrollment modal -->
                    <div class="form-group mb-3">
                        <label for="update_enrollment_id">Enrollment ID</label>
                        <input type="text" class="form-control" name="update_enrollment_id" id="update_enrollment_id"
                            placeholder="Enter enrollment ID" readonly>
                    </div>

                    <div class="form-group mb-3">
                        <label for="student_id">Student ID</label>
                        <select class="form-control" name="student_id" disabled>
                            <?php
                            $connection = mysqli_connect("localhost", "root", "", "studentrecord");

                            $fetch_students_query = "SELECT StudentID, LastName FROM student";
                            $fetch_students_query_run = mysqli_query($connection, $fetch_students_query);

                            if (mysqli_num_rows($fetch_students_query_run) > 0) {
                                while ($row = mysqli_fetch_array($fetch_students_query_run)) {
                                    echo "<option value='" . $row['StudentID'] . "'>" . $row['StudentID'] . " - " . $row['LastName'] . "</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="course_id">Course</label>
                        <select class="form-control" name="course_id" disabled>
                            <?php
                            $fetch_courses_query = "SELECT CourseID, CourseName FROM course";
                            $fetch_courses_query_run = mysqli_query($connection, $fetch_courses_query);

                            if (mysqli_num_rows($fetch_courses_query_run) > 0) {
                                while ($row = mysqli_fetch_array($fetch_courses_query_run)) {
                                    echo "<option value='" . $row['CourseID'] . "'>" . $row['CourseID'] . " - " . $row['CourseName'] . "</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="update_enrollment_date">Enrollment Date</label>
                        <input type="date" class="form-control" name="update_enrollment_date"
                            id="update_enrollment_date">
                    </div>

                    <div class="form-group mb-3">
                        <label for="update_grade">Grade</label>
                        <input type="text" class="form-control" name="update_grade" id="update_grade"
                            placeholder="Enter grade" autocomplete="off">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="update_enrollment" class="btn btn-primary">Update
                        Record</button>
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

<!-- SCRIPTS  -->
<script>
    $(document).ready(function () {
        $('.nav-link').click(function () {
            var target = $(this).attr('href');
            $('html, body').animate({
                scrollTop: $(target).offset().top
            }, 800);
        });

        $('.btn-update').click(function () {
            var enrollment_id = $(this).data('enrollment-id');
            var student_id = $(this).data('student-id');
            var course_id = $(this).data('course-id');
            var enrollment_date = $(this).data('enrollment-date');
            var grade = $(this).data('grade');

            $('#update_enrollment_id').val(enrollment_id);
            $('#update_student_id').val(student_id);
            $('#update_course_id').val(course_id);
            $('#update_enrollment_date').val(enrollment_date);
            $('#update_grade').val(grade);

            $('#updateModal').modal('show');
        });

        $('.btn-delete').click(function () {
            var enrollment_id = $(this).data('enrollment-id');
            $('#confirmDelete').data('enrollment-id', enrollment_id);
        });

        $('#confirmDelete').click(function () {
            var enrollment_id = $(this).data('enrollment-id');
            window.location.href = 'code.php?delete_enrollment=' + enrollment_id;
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

<?php include('includes/footer.php'); ?>