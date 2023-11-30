<?php
include 'connect.php';

// Fetch ZIP Codes from the 'municipalities' table
$municipalityQuery = "SELECT MunicipalityZIPCode, MunicipalityName FROM municipalities";
$municipalityResult = $con->query($municipalityQuery);

// Fetch species from the 'LivestockPopulation' table
$speciesQuery = "SELECT DISTINCT Species FROM LivestockPopulation";
$speciesResult = $con->query($speciesQuery);

// Check for errors in fetching data
if (!$municipalityResult || !$speciesResult) {
    die($con->error);
}

// Store the fetched ZIP Codes and species in arrays
$zipCodes = [];
while ($row = $municipalityResult->fetch_assoc()) {
    $zipCodes[] = $row;
}

$speciesOptions = [];
while ($speciesRow = $speciesResult->fetch_assoc()) {
    $speciesOptions[] = $speciesRow['Species'];
}

if (isset($_POST['submit'])) {
    $species = $_POST['species'];
    $population = $_POST['population'];
    $dateUpdated = $_POST['dateUpdated'];
    $municipalityZIP = $_POST['municipalityZIP'];

    $sql = "INSERT INTO LivestockPopulation (Species, Count, DateUpdated, MunicipalityZIP) 
            VALUES ('$species', '$population', '$dateUpdated', '$municipalityZIP')";

    $result = $con->query($sql);

    if ($result) {
        header('location:fishsanc.php');
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
    <title>Benguet Livestock CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container m-5">
        <form method="post">
            <div class="form-group">
                <label for="species">Species</label>
                <!-- Dropdown for species -->
                <select class="form-control" id="species" name="species">
                    <option value="" disabled selected>--Select--</option>
                    <option value="Carabao">Carabao</option>
                    <option value="Cattle">Cattle</option>
                    <option value="Swine">Swine</option>
                    <option value="Goat">Goat</option>
                    <option value="Dog">Dog</option>
                    <option value="Sheep">Sheep</option>
                    <option value="Horse">Horse</option>
                </select>
            </div>

            <div class="form-group">
                <label>Population</label>
                <input type="number" class="form-control" placeholder="Enter population" name="population" autocomplete="off">
            </div>

            <div class="form-group">
                <label>Date Updated</label>
                <input type="date" class="form-control" name="dateUpdated" autocomplete="off">
            </div>

            <div class="form-group">
                <label>ZIP Code</label>
                <!-- Dropdown for ZIP Code -->
                <select class="form-control" name="municipalityZIP">
                    <option value="" disabled selected>--Select--</option>
                    <?php
                    foreach ($zipCodes as $zipCode) {
                        echo "<option value='{$zipCode['MunicipalityZIPCode']}'>{$zipCode['MunicipalityZIPCode']} - {$zipCode['MunicipalityName']}</option>";
                    }
                    ?>
                </select>
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
