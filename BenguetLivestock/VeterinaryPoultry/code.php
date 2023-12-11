<?php
session_start();
$connection = mysqli_connect("localhost", "root", "", "benguetlivestockdb");

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['savedata'])) {
    // Insert new data
    $combined_value = $connection->real_escape_string($_POST['zip']);
    list($municipality_id, $municipality_name) = explode('-', $combined_value);

    $number = $connection->real_escape_string($_POST['number']);
    $date = $connection->real_escape_string($_POST['date_updated']);

    try {
        $insert_query = "INSERT INTO veterinarypoultrysupplies (municipality_id, municipality_name, number, date_updated) 
        VALUES ('$municipality_id', '$municipality_name', '$number','$date')";

        // Execute the query
        $insert_query_run = $connection->query($insert_query);

        if ($insert_query_run === true) {
            $_SESSION['status'] = 'Created Successfully';
            header('location: index.php');
        } else {
            throw new Exception("Creation failed");
        }
    } catch (Exception $e) {
        $_SESSION['status'] = 'Failed to Add: Update or delete existing data. Error: ' . $e->getMessage();
        header('location: index.php');
    }
} elseif (isset($_POST['updateData'])) {
    // Update existing data
    $update_id = mysqli_real_escape_string($connection, $_POST['update_id']);
    $update_number = mysqli_real_escape_string($connection, $_POST['update_number']);
    $update_date = mysqli_real_escape_string($connection, $_POST['update_date']);

    $update_query = "UPDATE veterinarypoultrysupplies SET number=?, date_updated=? WHERE municipality_id=?";
    $stmt = mysqli_prepare($connection, $update_query);
    mysqli_stmt_bind_param($stmt, "isi", $update_number, $update_date, $update_id);

    $update_query_run = mysqli_stmt_execute($stmt);

    if ($update_query_run) {
        $_SESSION['status'] = 'Updated Successfully';
        header('location: index.php');
    } else {
        $_SESSION['status'] = 'Failed to Update: ' . mysqli_error($connection);
        header('location: index.php');
    }

} elseif (isset($_POST['deleteData'])) {
    // Delete data
    $id = mysqli_real_escape_string($connection, $_POST['id']);

    $delete_query = "DELETE FROM veterinarypoultrysupplies WHERE municipality_id='$id'";
    $delete_query_run = mysqli_query($connection, $delete_query);

    if ($delete_query_run) {
        $_SESSION['status'] = 'Deleted Successfully';
        exit(); // Stop further execution
    } else {
        $_SESSION['status'] = 'Failed to Delete: ' . mysqli_error($connection);
        exit(); // Stop further execution
    }
}

mysqli_close($connection);
?>