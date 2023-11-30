<?php
session_start();
$connection = mysqli_connect("localhost", "root", "", "poultrypopulation2");

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['savedata'])) {
    // Insert new data
    $type = mysqli_real_escape_string($connection, $_POST['type']);
    $count = mysqli_real_escape_string($connection, $_POST['count']);

    $insert_query = "INSERT INTO poultry_population(type, count) VALUES ('$type', '$count')";
    $insert_query_run = mysqli_query($connection, $insert_query);

    if ($insert_query_run) {
        $_SESSION['status'] = 'Created Successfully';
        header('location: index.php');
    } else {
        $_SESSION['status'] = 'Failed to Create: ' . mysqli_error($connection);
        header('location: index.php');
    }
} elseif (isset($_POST['updateData'])) {
    // Update existing data
    $update_id = mysqli_real_escape_string($connection, $_POST['update_id']);
    $update_type = mysqli_real_escape_string($connection, $_POST['update_type']);
    $update_count = mysqli_real_escape_string($connection, $_POST['update_count']);

    $update_query = "UPDATE poultry_population SET type=?, count=? WHERE id=?";
    $stmt = mysqli_prepare($connection, $update_query);
    mysqli_stmt_bind_param($stmt, "ssi", $update_type, $update_count, $update_id);
    $update_query_run = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    if ($update_query_run) {
        $_SESSION['status'] = 'Updated Successfully';
        header('location: index.php');
    } else {
        $_SESSION['status'] = 'Failed to Update: ' . mysqli_error($connection);
        header('location: index.php');
    }
} // Add this block for handling delete
elseif (isset($_POST['deleteData'])) {
    $id = mysqli_real_escape_string($connection, $_POST['id']);

    $delete_query = "DELETE FROM poultry_population WHERE id='$id'";
    $delete_query_run = mysqli_query($connection, $delete_query);

    if ($delete_query_run) {
        $_SESSION['status'] = 'Deleted Successfully';
        // No need to use header('location: index.php'); when using AJAX
        exit(); // Stop further execution
    } else {
        $_SESSION['status'] = 'Failed to Delete: ' . mysqli_error($connection);
        exit(); // Stop further execution
    }
}


mysqli_close($connection);
?>
