<?php
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'testdatabase';

$con = new mysqli($host, $username, $password, $database);

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
?>