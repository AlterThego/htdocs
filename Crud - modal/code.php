<?php
session_start();
$connection = mysqli_connect("localhost", "root", "", "crud_modal");

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['savedata'])) {
    // Insert new data
    $name = mysqli_real_escape_string($connection, $_POST['name']);
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $phone = mysqli_real_escape_string($connection, $_POST['phone']);

    $insert_query = "INSERT INTO test(name, email, phone) VALUES ('$name', '$email', '$phone')";
    $insert_query_run = mysqli_query($connection, $insert_query);

    if ($insert_query_run) {
        $_SESSION['status'] = 'success';
        header('location: index.php');
    } else {
        $_SESSION['status'] = 'failed: ' . mysqli_error($connection);
        header('location: index.php');
    }
} elseif (isset($_POST['updateData'])) {
    // Update existing data
    $update_id = mysqli_real_escape_string($connection, $_POST['update_id']);
    $update_name = mysqli_real_escape_string($connection, $_POST['update_name']);
    $update_email = mysqli_real_escape_string($connection, $_POST['update_email']);
    $update_phone = mysqli_real_escape_string($connection, $_POST['update_phone']);

    $update_query = "UPDATE test SET name='$update_name', email='$update_email', phone='$update_phone' WHERE id='$update_id'";
    $update_query_run = mysqli_query($connection, $update_query);

    if ($update_query_run) {
        $_SESSION['status'] = 'success';
        header('location: index.php');
    } else {
        $_SESSION['status'] = 'failed: ' . mysqli_error($connection);
        header('location: index.php');
    }
}

mysqli_close($connection);
?>
