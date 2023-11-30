<?php
include 'connect.php';

// Check if the connection to the database is successful
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud Operation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <button class="btn btn-primary my-5"><a href="create.php" class="text-light">Create</a></button>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Population ID</th>
                    <th scope="col">Type Name</th>
                    <th scope="col">Count</th>
                    <th scope="col">Date Updated</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>

                <?php
                // Use a JOIN to fetch both type_id and type_name
                $sql = "SELECT pp.population_id, pp.type_id, pt.type_name, pp.count, pp.date_updated
                        FROM `poultry_population` pp
                        JOIN `poultry_type` pt ON pp.type_id = pt.type_id";
                $result = mysqli_query($con, $sql);

                // Check if the query was successful
                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $population_id = $row['population_id'];
                        $type_name = $row['type_name'];
                        $count = $row['count'];
                        $date_updated = $row['date_updated'];

                        echo '<tr>
                            <th scope="row">' . $population_id . '</th>
                            <td>' . $type_name . '</td>
                            <td>' . $count . '</td>
                            <td>' . $date_updated . '</td>
                            <td>
                                <button class="btn btn-primary"><a href="update.php?updateid=' . $population_id . '" class="text-light">Update</a></button>
                                <button class="btn btn-danger"><a href="delete.php?deleteid=' . $population_id . '" class="text-light">Delete</a></button>
                             </td>
                            </tr>';
                    }
                }
                ?>
            
            </tbody>
        </table>
    </div>
</body>

</html>
