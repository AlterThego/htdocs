<?php
include 'connect.php';

// Fetch available types for the dropdown
$type_query = "SELECT type_id, type_name FROM poultry_type";
$type_result = $con->query($type_query);
$types = $type_result->fetch_all(MYSQLI_ASSOC);

if (isset($_POST['submit'])) {
    $type_id = $_POST['type_id'];
    $count = $_POST['count'];
    $date_updated = $_POST['date_updated'];

    // Remove the trailing comma in the column list
    $sql = "INSERT INTO `poultry_population` (type_id, count, date_updated) 
            VALUES ('$type_id', '$count', '$date_updated')";

    $result = $con->query($sql);

    if ($result) {
        header('location:read.php');
    } else {
        die($con->error);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container m-5">
        <form method="post">
            <div class="form-group">
                <label>Type ID (Foreign Key)</label>
                <select class="form-control" name="type_id">
                    <option value="" disabled selected>Select Layer</option>
                    <?php foreach ($types as $type) : ?>
                        <option value="<?= $type['type_id'] ?>"><?= $type['type_name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label>Count</label>
                <input type="number" class="form-control" placeholder="Enter count" name="count" autocomplete="off">
            </div>

            <div class="form-group">
                <label>Date Updated</label>
                <input type="date" class="form-control" name="date_updated" value="<?= date('Y-m-d') ?>" autocomplete="off">
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
