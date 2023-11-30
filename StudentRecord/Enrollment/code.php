<?php
session_start();
$connection = mysqli_connect("localhost", "root", "", "studentrecord");

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['save_enrollment'])) {
    // Insert new enrollment record
    $student_id = mysqli_real_escape_string($connection, $_POST['student_id']);
    $course_id = mysqli_real_escape_string($connection, $_POST['course_id']);

    // Check if the combination of student_id and course_id already exists
    $check_duplicate_query = "SELECT * FROM enrollment WHERE StudentID='$student_id' AND CourseID='$course_id'";
    $check_duplicate_result = mysqli_query($connection, $check_duplicate_query);

    if (mysqli_num_rows($check_duplicate_result) > 0) {
        $_SESSION['status'] = 'Enrollment record with the same Student ID and Course ID already exists.';
        header('location: index.php');
    } else {
        // If not, proceed with the insertion
        $enrollment_date = mysqli_real_escape_string($connection, $_POST['enrollment_date']);
        $grade = mysqli_real_escape_string($connection, $_POST['grade']);

        $insert_enrollment_query = "INSERT INTO enrollment(StudentID, CourseID, EnrollmentDate, Grade) 
                                    VALUES ('$student_id', '$course_id', '$enrollment_date', '$grade')";
        $insert_enrollment_query_run = mysqli_query($connection, $insert_enrollment_query);

        handleQueryResult($connection, $insert_enrollment_query_run, 'Enrollment record added successfully');
        header('location: index.php');
    }
} elseif (isset($_POST['update_enrollment'])) {
    // Update existing enrollment record
    $update_enrollment_id = mysqli_real_escape_string($connection, $_POST['update_enrollment_id']);
    $update_student_id = mysqli_real_escape_string($connection, $_POST['update_student_id']);
    $update_course_id = mysqli_real_escape_string($connection, $_POST['update_course_id']);

    // Check if the updated combination of student_id and course_id already exists
    $check_duplicate_query = "SELECT * FROM enrollment WHERE StudentID='$update_student_id' AND CourseID='$update_course_id' AND EnrollmentID <> '$update_enrollment_id'";
    $check_duplicate_result = mysqli_query($connection, $check_duplicate_query);

    if (mysqli_num_rows($check_duplicate_result) > 0) {
        $_SESSION['status'] = 'Enrollment record with the same Student ID and Course ID already exists.';
        header('location: index.php');
    } else {
        // If not, proceed with the update
        $update_enrollment_date = mysqli_real_escape_string($connection, $_POST['update_enrollment_date']);
        $update_grade = mysqli_real_escape_string($connection, $_POST['update_grade']);

        $update_enrollment_query = "UPDATE enrollment 
                                    SET EnrollmentDate='$update_enrollment_date', Grade='$update_grade' 
                                    WHERE EnrollmentID='$update_enrollment_id'";
        $update_enrollment_query_run = mysqli_query($connection, $update_enrollment_query);

        handleQueryResult($connection, $update_enrollment_query_run, 'Enrollment record updated successfully');
        header('location: index.php');
    }
} elseif (isset($_GET['delete_enrollment'])) {
    // Delete enrollment record
    $delete_enrollment_id = mysqli_real_escape_string($connection, $_GET['delete_enrollment']);

    $delete_enrollment_query = "DELETE FROM enrollment WHERE EnrollmentID=?";
    $stmt = mysqli_prepare($connection, $delete_enrollment_query);
    mysqli_stmt_bind_param($stmt, "i", $delete_enrollment_id);
    mysqli_stmt_execute($stmt);

    handleQueryResult($connection, $stmt, 'Enrollment record deleted successfully');
}


mysqli_close($connection);

// Function to handle query result and redirect
function handleQueryResult($connection, $result, $successMessage)
{
    if ($result) {
        $_SESSION['status'] = $successMessage;
    } else {
        $_SESSION['status'] = 'Operation failed: ' . mysqli_error($connection);
    }
    header('location: index.php');
}
?>