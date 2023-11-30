<?php
session_start();
$connection = mysqli_connect("localhost", "root", "", "studentrecord");

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['add_course'])) {
    // Add new course
    $course_id = mysqli_real_escape_string($connection, $_POST['course_id']);
    $course_name = mysqli_real_escape_string($connection, $_POST['course_name']);
    $instructor_id = mysqli_real_escape_string($connection, $_POST['instructor_id']);
    $credits = mysqli_real_escape_string($connection, $_POST['credits']);

    $insert_course_query = "INSERT INTO course(CourseID, CourseName, InstructorID, Credits) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($connection, $insert_course_query);
    mysqli_stmt_bind_param($stmt, "issi", $course_id, $course_name, $instructor_id, $credits);
    $insert_course_query_run = mysqli_stmt_execute($stmt);

    handleQueryResult($connection, $insert_course_query_run, 'Course added successfully');
    
} elseif (isset($_POST['update_course'])) {
    // Update existing course
    $update_course_id = mysqli_real_escape_string($connection, $_POST['update_course_id']);
    $update_course_name = mysqli_real_escape_string($connection, $_POST['update_course_name']);
    $update_instructor_id = mysqli_real_escape_string($connection, $_POST['update_instructor_id']);
    $update_credits = mysqli_real_escape_string($connection, $_POST['update_credits']);

    $update_course_query = "UPDATE course SET CourseName=?, Credits=?, InstructorID=? WHERE CourseID=?";
    $stmt = mysqli_prepare($connection, $update_course_query);
    mysqli_stmt_bind_param($stmt, "ssii", $update_course_name, $update_credits, $update_instructor_id, $update_course_id);
    $update_course_query_run = mysqli_stmt_execute($stmt);

    handleQueryResult($connection, $update_course_query_run, 'Course updated successfully');
} elseif (isset($_GET['delete_course'])) {
    // Delete course
    $delete_course_id = mysqli_real_escape_string($connection, $_GET['delete_course']);

    $delete_course_query = "DELETE FROM course WHERE CourseID=?";
    $stmt = mysqli_prepare($connection, $delete_course_query);
    mysqli_stmt_bind_param($stmt, "i", $delete_course_id);
    $delete_course_query_run = mysqli_stmt_execute($stmt);

    handleQueryResult($connection, $delete_course_query_run, 'Course deleted successfully');
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