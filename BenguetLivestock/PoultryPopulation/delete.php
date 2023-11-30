<?php
include 'connect.php';

if (isset($_GET['deleteid'])) {
    $id = $_GET['deleteid'];

    $sql = "DELETE FROM `poultry_population` WHERE population_id=$id"; // Corrected variable name
    $result = $con->query($sql);

    if ($result) {
        header('location:read.php');
    } else {
        die($con->error);
    }
}
?>
