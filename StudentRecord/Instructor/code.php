<?php
session_start();
$connection = mysqli_connect("localhost", "root", "", "studentrecord");

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['save_instructor'])) {
    $instructor_id = mysqli_real_escape_string($connection, $_POST['instructor_id']);
    $first_name = mysqli_real_escape_string($connection, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($connection, $_POST['last_name']);
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $phone = mysqli_real_escape_string($connection, $_POST['phone']);

    $insert_query = "INSERT INTO instructor(InstructorID, FirstName, LastName, Email, Phone) 
                     VALUES ('$instructor_id','$first_name', '$last_name', '$email', '$phone')";
    $insert_query_run = mysqli_query($connection, $insert_query);

    if ($insert_query_run) {
        $_SESSION['status'] = 'Instructor record added successfully';
        header('location: index.php');
    } else {
        $_SESSION['status'] = 'Failed to add instructor record: ' . mysqli_error($connection);
        header('location: index.php');
    }
} elseif (isset($_POST['update_instructor'])) {
    $update_instructor_id = mysqli_real_escape_string($connection, $_POST['update_instructor_id']);
    $update_first_name = mysqli_real_escape_string($connection, $_POST['update_first_name']);
    $update_last_name = mysqli_real_escape_string($connection, $_POST['update_last_name']);
    $update_email = mysqli_real_escape_string($connection, $_POST['update_email']);
    $update_phone = mysqli_real_escape_string($connection, $_POST['update_phone']);

    $update_query = "UPDATE instructor 
                     SET FirstName='$update_first_name', LastName='$update_last_name', Email='$update_email', Phone='$update_phone' 
                     WHERE InstructorID='$update_instructor_id'";
    $update_query_run = mysqli_query($connection, $update_query);

    if ($update_query_run) {
        $_SESSION['status'] = 'Instructor record updated successfully';
        header('location: index.php');
    } else {
        $_SESSION['status'] = 'Failed to update instructor record: ' . mysqli_error($connection);
        header('location: index.php');
    }
} elseif (isset($_GET['delete_instructor'])) {
    $delete_instructor_id = mysqli_real_escape_string($connection, $_GET['delete_instructor']);

    $delete_query = "DELETE FROM instructor WHERE InstructorID='$delete_instructor_id'";
    $delete_query_run = mysqli_query($connection, $delete_query);

    if ($delete_query_run) {
        $_SESSION['status'] = 'Instructor record deleted successfully';
        header('location: index.php');
    } else {
        $_SESSION['status'] = 'Failed to delete instructor record: ' . mysqli_error($connection);
        header('location: index.php');
    }
}

mysqli_close($connection);
?>
