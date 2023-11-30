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
    <title>Benguet Livestock CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <button class="btn btn-primary my-5"><a href="create.php" class="text-light">Add Livestock Data</a></button>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Species</th>
                    <th scope="col">Population</th>
                    <th scope="col">Date Updated</th>
                    <th scope="col">ZIP Code and Municipality</th> <!-- Updated column name -->
                    <th scope="col">Operations</th>
                </tr>
            </thead>
            <tbody>

                <?php
                // Updated SQL query to join LivestockPopulation with municipalities
                $sql = "SELECT LivestockPopulation.ID, LivestockPopulation.Species, LivestockPopulation.Count, LivestockPopulation.DateUpdated, municipalities.MunicipalityName, LivestockPopulation.MunicipalityZIP
                        FROM LivestockPopulation
                        JOIN municipalities ON LivestockPopulation.MunicipalityZIP = municipalities.MunicipalityZIPCode";
                $result = mysqli_query($con, $sql);

                // Check if the query was successful
                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $id = $row['ID'];
                        $species = $row['Species'];
                        $population = $row['Count'];
                        $dateUpdated = $row['DateUpdated'];
                        $municipalityName = $row['MunicipalityName']; // Updated variable name
                        $municipalityZIP = $row['MunicipalityZIP']; // Updated variable name

                        echo '<tr>
                            <th scope="row">' . $id . '</th>
                            <td>' . $species . '.</td>
                            <td>' . $population . '</td>
                            <td>' . $dateUpdated . '</td>
                            <td>' . $municipalityName . ' - ' . $municipalityZIP . '</td> <!-- Display both Municipality Name and ZIP Code -->
                            <td>
                            <button class="btn btn-primary"><a href="update.php?updateid='.$id.'" class="text-light">Update</a></button>
                            
                            <button class="btn btn-danger"><a href="delete.php?deleteid='.$id.'" class="text-light">Delete</a></button>
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
