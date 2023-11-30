<?php
session_start();

$connection = mysqli_connect("localhost", "root", "", "crud_modal");

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['deleteData'])) {
    $id = mysqli_real_escape_string($connection, $_POST['id']);

    $delete_query = "DELETE FROM test WHERE id='$id'";
    $delete_query_run = mysqli_query($connection, $delete_query);

    if ($delete_query_run) {
        $_SESSION['status'] = 'success';
        header('location: index.php');
    } else {
        $_SESSION['status'] = 'failed: ' . mysqli_error($connection);
        header('location: index.php');
    }
}

mysqli_close($connection);
?>
