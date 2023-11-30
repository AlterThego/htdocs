<?php
session_start();
$connection = mysqli_connect("localhost", "root", "", "studentrecord");

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['save_student'])) {
    // Insert new student record
    $student_id = mysqli_real_escape_string($connection, $_POST['student_id']);
    $first_name = mysqli_real_escape_string($connection, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($connection, $_POST['last_name']);
    $date_of_birth = mysqli_real_escape_string($connection, $_POST['date_of_birth']);
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $phone = mysqli_real_escape_string($connection, $_POST['phone']);

    $insert_query = "INSERT INTO student(StudentID, FirstName, LastName, DateOfBirth, Email, Phone) 
                     VALUES ('$student_id','$first_name', '$last_name', '$date_of_birth', '$email', '$phone')";
    $insert_query_run = mysqli_query($connection, $insert_query);

    if ($insert_query_run) {
        $_SESSION['status'] = 'Student record added successfully';
        header('location: index.php');
    } else {
        $_SESSION['status'] = 'Failed to add student record: ' . mysqli_error($connection);
        header('location: index.php');
    }
} elseif (isset($_POST['update_student'])) {
    // Update existing student record
    $update_student_id = mysqli_real_escape_string($connection, $_POST['update_student_id']);
    $update_first_name = mysqli_real_escape_string($connection, $_POST['update_first_name']);
    $update_last_name = mysqli_real_escape_string($connection, $_POST['update_last_name']);
    $update_date_of_birth = mysqli_real_escape_string($connection, $_POST['update_date_of_birth']);
    $update_email = mysqli_real_escape_string($connection, $_POST['update_email']);
    $update_phone = mysqli_real_escape_string($connection, $_POST['update_phone']);

    $update_query = "UPDATE student 
                     SET FirstName='$update_first_name', LastName='$update_last_name', 
                         DateOfBirth='$update_date_of_birth', Email='$update_email', Phone='$update_phone' 
                     WHERE StudentID='$update_student_id'";
    $update_query_run = mysqli_query($connection, $update_query);

    if ($update_query_run) {
        $_SESSION['status'] = 'Student record updated successfully';
        header('location: index.php');
    } else {
        $_SESSION['status'] = 'Failed to update student record: ' . mysqli_error($connection);
        header('location: index.php');
    }
} elseif (isset($_GET['delete_student'])) {
    // Delete student record
    $delete_student_id = mysqli_real_escape_string($connection, $_GET['delete_student']);

    $delete_query = "DELETE FROM student WHERE StudentID='$delete_student_id'";
    $delete_query_run = mysqli_query($connection, $delete_query);

    if ($delete_query_run) {
        $_SESSION['status'] = 'Student record deleted successfully';
        header('location: index.php');
    } else {
        $_SESSION['status'] = 'Failed to delete student record: ' . mysqli_error($connection);
        header('location: index.php');
    }
}

mysqli_close($connection);
?>
