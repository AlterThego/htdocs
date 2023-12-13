<?php
session_start();
$connection = mysqli_connect("localhost", "root", "", "benguetlivestockdb");

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['savedata'])) {
    // Insert new data
    $combined_value = $connection->real_escape_string($_POST['zip']);
    list($municipality_id, $municipality_name) = explode('-', $combined_value);

    $livestock_year = $connection->real_escape_string($_POST['livestock_year']);
    $carabao_count = $connection->real_escape_string($_POST['carabao_count']);
    $cattle_count = $connection->real_escape_string($_POST['cattle_count']);
    $swine_count = $connection->real_escape_string($_POST['swine_count']);
    $goat_count = $connection->real_escape_string($_POST['goat_count']);
    $dog_count = $connection->real_escape_string($_POST['dog_count']);
    $sheep_count = $connection->real_escape_string($_POST['sheep_count']);
    $horse_count = $connection->real_escape_string($_POST['horse_count']);
    $date_updated = $connection->real_escape_string($_POST['date_updated']);

    try {
        $insert_query = "INSERT INTO livestockpopulation (municipality_id, municipality_name, livestock_year, carabao_count, cattle_count, 
        swine_count, goat_count, dog_count, sheep_count, horse_count, date_updated) 
        VALUES ('$municipality_id','$municipality_name', '$livestock_year', '$carabao_count', '$cattle_count', '$swine_count', '$goat_count',
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
} elseif (isset($_POST['submitData'])) {
    try {
        // Update variables with values from the form submission
        $Carabao = isset($_POST['totalCarabao']) ? $_POST['totalCarabao'] : 0;
        $Cattle = isset($_POST['totalCattle']) ? $_POST['totalCattle'] : 0;
        $Swine = isset($_POST['totalSwine']) ? $_POST['totalSwine'] : 0;
        $Goat = isset($_POST['totalGoat']) ? $_POST['totalGoat'] : 0;
        $Dog = isset($_POST['totalDog']) ? $_POST['totalDog'] : 0;
        $Sheep = isset($_POST['totalSheep']) ? $_POST['totalSheep'] : 0;
        $Horse = isset($_POST['totalHorse']) ? $_POST['totalHorse'] : 0;

        $livestockYear = isset($_POST['livestockYear']) ? $_POST['livestockYear'] : 0;
        $submitDateUpdated = isset($_POST['submitDateUpdated']) ? $_POST['submitDateUpdated'] : date('Y-m-d');

        // Perform the database insertion using prepared statements to prevent SQL injection
        $insertQuery = "INSERT INTO livestocktrend (livestock_year, carabao_count, cattle_count, swine_count, goat_count, dog_count, sheep_count, horse_count, date_updated) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = mysqli_prepare($connection, $insertQuery);
        mysqli_stmt_bind_param($stmt, "iiiiiiiss", $livestockYear, $Carabao, $Cattle, $Swine, $Goat, $Dog, $Sheep, $Horse, $submitDateUpdated);

        if (mysqli_stmt_execute($stmt)) {
            session_start();
            $_SESSION['status'] = 'Total Count Submitted Successfully';
            header('location: index.php');
            exit();
        } else {
            throw new Exception('Failed to execute the database insertion');
        }
    } catch (Exception $e) {
        session_start();
        $_SESSION['status'] = 'Failed: Year Already Exists!! '; //. $e->getMessage()
        header('location: index.php');
        exit();
    }
}


mysqli_close($connection);
?>