<?php
include 'connect.php';

if (isset($_GET['deleteid'])) {
    $id = $_GET['deleteid'];

    $sql = "DELETE FROM `livestockpopulation` WHERE id=$id";
    $result = $con->query($sql);

    if ($result) {
        header('location:display.php');
    } else {
        die($con->error);
    }
}
?>
