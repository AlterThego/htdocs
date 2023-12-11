<?php
session_start();
$connection = mysqli_connect("localhost", "root", "", "benguetlivestockdb");

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['savedata'])) {
    $year = $connection->real_escape_string($_POST['year']);
    $poultry = $connection->real_escape_string($_POST['poultry_farms']);
    $cattle = $connection->real_escape_string($_POST['cattle_farms']);
    $pig = $connection->real_escape_string($_POST['piggery_farms']);
    $date = mysqli_real_escape_string($connection, $_POST['date_updated']);

    try {
        $insert_query = "INSERT INTO commercialpoultry (year, poultry_count, cattle_count, piggery_count, date_updated) 
        VALUES ('$year', '$poultry', '$cattle', '$pig', '$date')";

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
    $update_year = mysqli_real_escape_string($connection, $_POST['update_year']);
    $update_poultry_farms = mysqli_real_escape_string($connection, $_POST['update_poultry_farms']);
    $update_cattle_farms = mysqli_real_escape_string($connection, $_POST['update_cattle_farms']);
    $update_piggery_farms = mysqli_real_escape_string($connection, $_POST['update_piggery_farms']);
    $update_date = mysqli_real_escape_string($connection, $_POST['update_date']);

    $update_query = "UPDATE commercialpoultry SET poultry_count=?, cattle_count=?, piggery_count=?, date_updated=? WHERE year=?";
    $stmt = mysqli_prepare($connection, $update_query);
    mysqli_stmt_bind_param($stmt, "iiisi", $update_poultry_farms, $update_cattle_farms, $update_piggery_farms, $update_date, $update_year);

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

    $delete_query = "DELETE FROM commercialpoultry WHERE year='$id'";
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