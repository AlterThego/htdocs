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

    $carabao_count = $connection->real_escape_string($_POST['carabao_count']);
    $cattle_count = $connection->real_escape_string($_POST['cattle_count']);
    $swine_count = $connection->real_escape_string($_POST['swine_count']);
    $goat_count = $connection->real_escape_string($_POST['goat_count']);
    $dog_count = $connection->real_escape_string($_POST['dog_count']);
    $sheep_count = $connection->real_escape_string($_POST['sheep_count']);
    $horse_count = $connection->real_escape_string($_POST['horse_count']);
    $date_updated = $connection->real_escape_string($_POST['date_updated']);

    try {
        $insert_query = "INSERT INTO livestockpopulation (municipality_id, municipality_name, carabao_count, cattle_count, 
        swine_count, goat_count, dog_count, sheep_count, horse_count, date_updated) 
        VALUES ('$municipality_id', '$municipality_name', '$carabao_count', '$cattle_count', '$swine_count', '$goat_count',
        '$dog_count', '$sheep_count', '$horse_count', '$date_updated')";

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
    $update_carabao = mysqli_real_escape_string($connection, $_POST['update_carabao_count']);
    $update_cattle = mysqli_real_escape_string($connection, $_POST['update_cattle_count']);
    $update_swine = mysqli_real_escape_string($connection, $_POST['update_swine_count']);
    $update_goat = mysqli_real_escape_string($connection, $_POST['update_goat_count']);
    $update_dog = mysqli_real_escape_string($connection, $_POST['update_dog_count']);
    $update_sheep = mysqli_real_escape_string($connection, $_POST['update_sheep_count']);
    $update_horse = mysqli_real_escape_string($connection, $_POST['update_horse_count']);
    $update_date = mysqli_real_escape_string($connection, $_POST['update_date']);

    $update_query = "UPDATE livestockpopulation SET carabao_count=?, cattle_count=?, swine_count=?, goat_count=?, dog_count=?, sheep_count=?, horse_count=?, date_updated=? WHERE municipality_id=?";
    $stmt = mysqli_prepare($connection, $update_query);
    mysqli_stmt_bind_param($stmt, "iiiiiiisi", $update_carabao, $update_cattle, $update_swine, $update_goat, $update_dog, $update_sheep, $update_horse, $update_date, $update_id);

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

    $delete_query = "DELETE FROM livestockpopulation WHERE municipality_id='$id'";
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