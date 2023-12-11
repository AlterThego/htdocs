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

    $cattle = $connection->real_escape_string($_POST['cattle_volume']);
    $swine = $connection->real_escape_string($_POST['swine_volume']);
    $carabao = $connection->real_escape_string($_POST['carabao_volume']);
    $goat = $connection->real_escape_string($_POST['goat_volume']);
    $chicken = $connection->real_escape_string($_POST['chicken_volume']);
    $duck = $connection->real_escape_string($_POST['duck_volume']);
    $fish = $connection->real_escape_string($_POST['fish_volume']);
    $date = $connection->real_escape_string($_POST['date_updated']);

    try {
        $insert_query = "INSERT INTO livestockvolume (municipality_id, municipality_name, cattle_volume, swine_volume, 
        carabao_volume, goat_volume, chicken_volume, duck_volume, fish_volume, date_updated) 
        VALUES ('$municipality_id', '$municipality_name', '$cattle', '$swine', '$carabao', '$goat',
        '$chicken', '$duck', '$fish', '$date')";

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
    $update_cattle = mysqli_real_escape_string($connection, $_POST['update_cattle_volume']);
    $update_swine = mysqli_real_escape_string($connection, $_POST['update_swine_volume']);
    $update_carabao = mysqli_real_escape_string($connection, $_POST['update_carabao_volume']);
    $update_goat = mysqli_real_escape_string($connection, $_POST['update_goat_volume']);
    $update_chicken = mysqli_real_escape_string($connection, $_POST['update_chicken_volume']);
    $update_duck = mysqli_real_escape_string($connection, $_POST['update_duck_volume']);
    $update_fish = mysqli_real_escape_string($connection, $_POST['update_fish_volume']);
    $update_date = mysqli_real_escape_string($connection, $_POST['update_date']);

    $update_query = "UPDATE livestockvolume SET cattle_volume=?, swine_volume=?, carabao_volume=?, goat_volume=?, chicken_volume=?, duck_volume=?, fish_volume=?, date_updated=? WHERE municipality_id=?";
    $stmt = mysqli_prepare($connection, $update_query);
    mysqli_stmt_bind_param($stmt, "iiiiiiisi", $update_cattle, $update_swine, $update_carabao, $update_goat, $update_chicken, $update_duck, $update_fish, $update_date, $update_id);

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

    $delete_query = "DELETE FROM livestockvolume WHERE municipality_id='$id'";
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