<?php
include 'connect.php';

$id = $_GET['updateid'];

// Retrieve data from the LivestockPopulation table joined with municipalities
$sql = "SELECT LivestockPopulation.*, municipalities.MunicipalityName
        FROM LivestockPopulation
        JOIN municipalities ON LivestockPopulation.MunicipalityZIP = municipalities.MunicipalityZIPCode
        WHERE LivestockPopulation.ID = $id";

$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);

$species = $row['Species'];
$population = $row['Count'];
$dateUpdated = $row['DateUpdated'];
$municipalityZIP = $row['MunicipalityZIP'];
$municipalityName = $row['MunicipalityName']; // Updated variable name

// Fetch species from the 'LivestockPopulation' table
$speciesQuery = "SELECT DISTINCT Species FROM LivestockPopulation";
$speciesResult = $con->query($speciesQuery);

// Fetch ZIP Codes from the 'municipalities' table
$municipalityQuery = "SELECT MunicipalityZIPCode, MunicipalityName FROM municipalities";
$municipalityResult = $con->query($municipalityQuery);

// Check for errors in fetching data
if (!$speciesResult || !$municipalityResult) {
    die($con->error);
}

// Store the fetched species and ZIP Codes in arrays
$speciesOptions = [];
while ($speciesRow = $speciesResult->fetch_assoc()) {
    $speciesOptions[] = $speciesRow['Species'];
}

$zipCodes = [];
while ($zipRow = $municipalityResult->fetch_assoc()) {
    $zipCodes[$zipRow['MunicipalityZIPCode']] = $zipRow['MunicipalityName'];
}

if (isset($_POST['submit'])) {
    $species = $_POST['species'];
    $population = $_POST['population'];
    $dateUpdated = $_POST['dateUpdated'];
    $municipalityZIP = $_POST['municipalityZIP'];

    // Update data in the LivestockPopulation table
    $sql = "UPDATE `LivestockPopulation` SET Species='$species', Count='$population', DateUpdated='$dateUpdated', MunicipalityZIP='$municipalityZIP' WHERE ID=$id";

    $result = mysqli_query($con, $sql);

    if ($result) {
        header('location:display.php');
    } else {
        die(mysqli_error($con));
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Benguet Livestock CRUD - Update</title>
</head>

<body>
    <div class="container m-5">
        <form method="post">
            <div class="form-group">
                <label>Species</label>
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
                <input type="number" class="form-control" placeholder="Enter population" name="population" autocomplete="off" value="<?php echo $population; ?>">
            </div>

            <div class="form-group">
                <label>Date Updated</label>
                <input type="date" class="form-control" name="dateUpdated" value="<?php echo $dateUpdated; ?>">
            </div>

            <div class="form-group">
                <label>ZIP Code</label>
                <select class="form-control" name="municipalityZIP">
                    <?php
                    foreach ($zipCodes as $zipCode => $zipName) {
                        $selected = ($zipCode == $municipalityZIP) ? 'selected' : '';
                        echo "<option value='$zipCode' $selected>$zipCode - $zipName</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary" name="submit">Update</button>
            </div>
        </form>
    </div>

    <!-- Bootstrap core JavaScript and dependencies -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
