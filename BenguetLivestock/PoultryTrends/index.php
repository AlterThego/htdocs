<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="/BenguetLivestock/jquery.dataTables.min.css">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script> -->
    <script src="/BenguetLivestock/jquery.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">


    <!-- Export Buttons css -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">





    <!-- DataTables JS -->
    <!-- <script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script> -->
    <!-- <link href="BenguetLivestock/datatables.min.css" rel="stylesheet"> -->

    <script src="/BenguetLivestock/datatables.min.js"></script>



    <!-- Export -->
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>




    <link rel="stylesheet" href="../styles.css">
    <title>Poultry Trends</title>
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <?php include_once 'sidebar.php';
        ?>

        <!-- Main Component -->
        <div class="main" id="main-component">
            <nav class="navbar navbar-expand px-3 border-bottom">
                <!-- Button for sidebar toggle -->
                <button class="btn" type="button">
                    <i class="fa-solid fa-bars"></i>
                </button>
            </nav>
            <main class="content px-3 py-2 mb-5  table-responsive">
                <!-- Main Table -->
                <div class="container-fluid mt-3">
                    <div class="row justify-content-center ">
                        <div class="col-md-10">
                            <?php
                            if (isset($_SESSION['status']) && $_SESSION['status'] != '') {
                                ?>
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <?php echo $_SESSION['status']; ?>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <?php
                                unset($_SESSION['status']);
                            }
                            ?>
                            <div class="card p-3">
                                <div class="card-header mb-3">
                                    <h3 class="text-center font-weight-bold ">Poultry Trends</h3>
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#exampleModal">
                                        Add data
                                    </button>
                                    <a data-toggle="modal" href="#advancedOptionModal"
                                        class="btn btn-warning float-end">Advanced Options</a>
                                </div>
                                <div>
                                    <table class="display table-bordered table-responsive" id="main-table">
                                        <thead class="thead-light">
                                            <tr>
                                                <th scope="col">Year</th>
                                                <th scope="col">Layers</th>
                                                <th scope="col">Broiler</th>
                                                <th scope="col">Native/ Range</th>
                                                <th scope="col">Fighting/Fancy Fowl</th>
                                                <th scope="col">Total</th>
                                                <th scope="col">Date Updated</th>
                                                <th scope="col" class="text-center">Update</th>
                                                <th scope="col" class="text-center">Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $connection = mysqli_connect("localhost", "root", "", "benguetlivestockdb");

                                            $fetch_query = "SELECT * FROM poultry_trend";

                                            $fetch_query_run = mysqli_query($connection, $fetch_query);

                                            if (mysqli_num_rows($fetch_query_run) > 0) {
                                                while ($row = mysqli_fetch_array($fetch_query_run)) {

                                                    ?>

                                                    <tr>
                                                        <td>
                                                            <?php echo $row['poultry_year'] ?>
                                                        </td>
                                                        <td>
                                                            <?php echo number_format($row['layers_count'], 0, '.', ','); ?>
                                                        </td>
                                                        <td>
                                                            <?php echo number_format($row['broiler_count'], 0, '.', ','); ?>
                                                        </td>
                                                        <td>
                                                            <?php echo number_format($row['native_count'], 0, '.', ','); ?>
                                                        </td>
                                                        <td>
                                                            <?php echo number_format($row['fighting_count'], 0, '.', ','); ?>
                                                        </td>
                                                        <td>
                                                            <!-- Total of layers, broiler, native, and fighting -->
                                                            <?php
                                                            $total = $row['layers_count'] + $row['broiler_count'] + $row['native_count'] + $row['fighting_count'];
                                                            echo number_format($total, 0, '.', ',');
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $row['date_updated'] ?>
                                                        </td>


                                                        <td>
                                                            <button class="btn btn-update btn-success btn-sm"
                                                                data-toggle="modal" data-target="#updateModal"
                                                                data-year="<?php echo $row['poultry_year']; ?>"
                                                                data-layers="<?php echo $row['layers_count']; ?>"
                                                                data-broiler="<?php echo $row['broiler_count']; ?>"
                                                                data-native="<?php echo $row['native_count']; ?>"
                                                                data-fighting="<?php echo $row['fighting_count']; ?>"
                                                                data-date="<?php echo $row['date_updated']; ?>">
                                                                Update
                                                            </button>

                                                        </td>
                                                        <td>
                                                            <form action="code.php" method="post">
                                                                <input type="hidden" name="id"
                                                                    value="<?php echo $row['poultry_year']; ?>">
                                                                <button type="button" class="btn btn-danger btn-delete btn-sm"
                                                                    data-toggle="modal" data-target="#deleteConfirmationModal">
                                                                    Delete
                                                                </button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </tbody>

                                    </table>

                                </div>
                                <div class="mt-3 text-center">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Prediction -->
                <div class="container-fluid mt-5">
                    <div class="row justify-content-center ">
                        <div class="col-md-10">
                            <div class="card p-3">
                                <h4 class="text-center font-weight-bold mb-3">Linear Regression</h4>
                                <table class="display table-bordered table-responsive" id="predicted-table">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">Year</th>
                                            <th scope="col">Possible Layers Count</th>
                                            <th scope="col">Possible Broiler Count</th>
                                            <th scope="col">Possible Native/ Range</th>
                                            <th scope="col">Possible Fighting/Fancy Fowl</th>
                                            <th scope="col">Possible Total Poultry Count</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $connection = mysqli_connect("localhost", "root", "", "benguetlivestockdb");

                                        // Analyze trends and predict the next year's counts
                                        $max_year = 0;
                                        $counts = array();

                                        $fetch_query = "SELECT * FROM poultry_trend";
                                        $fetch_query_run = mysqli_query($connection, $fetch_query);

                                        if (mysqli_num_rows($fetch_query_run) > 0) {
                                            while ($row = mysqli_fetch_array($fetch_query_run)) {
                                                // Store counts for analysis
                                                $counts[$row['poultry_year']] = array(
                                                    'layers' => $row['layers_count'],
                                                    'broiler' => $row['broiler_count'],
                                                    'native' => $row['native_count'],
                                                    'fighting' => $row['fighting_count']
                                                );

                                                // Find the maximum year
                                                $max_year = max($max_year, $row['poultry_year']);
                                            }
                                        }

                                        // Linear regression for layers count
                                        $layers_values = array_column($counts, 'layers');
                                        $layers_regression = linearRegression(array_keys($counts), $layers_values);
                                        $predicted_layers = $layers_regression['slope'] * ($max_year + 1) + $layers_regression['intercept'];

                                        // Linear regression for broiler count
                                        $broiler_values = array_column($counts, 'broiler');
                                        $broiler_regression = linearRegression(array_keys($counts), $broiler_values);
                                        $predicted_broiler = $broiler_regression['slope'] * ($max_year + 1) + $broiler_regression['intercept'];

                                        // Linear regression for native count
                                        $native_values = array_column($counts, 'native');
                                        $native_regression = linearRegression(array_keys($counts), $native_values);
                                        $predicted_native = $native_regression['slope'] * ($max_year + 1) + $native_regression['intercept'];

                                        // Linear regression for fighting count
                                        $fighting_values = array_column($counts, 'fighting');
                                        $fighting_regression = linearRegression(array_keys($counts), $fighting_values);
                                        $predicted_fighting = $fighting_regression['slope'] * ($max_year + 1) + $fighting_regression['intercept'];

                                        // Predicted data for next year
                                        $predicted_year = $max_year + 1;
                                        ?>
                                        <tr>
                                            <td>
                                                <?php echo $predicted_year; ?>
                                            </td>
                                            <td>
                                                <?php echo number_format($predicted_layers, 0, '.', ','); ?>
                                            </td>
                                            <td>
                                                <?php echo number_format($predicted_broiler, 0, '.', ','); ?>
                                            </td>
                                            <td>
                                                <?php echo number_format($predicted_native, 0, '.', ','); ?>
                                            </td>
                                            <td>
                                                <?php echo number_format($predicted_fighting, 0, '.', ','); ?>
                                            </td>
                                            <td>
                                                <?php echo number_format($predicted_layers + $predicted_broiler + $predicted_native + $predicted_fighting, 0, '.', ','); ?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                <?php
                                // Function to calculate linear regression
                                function linearRegression($x, $y)
                                {
                                    $n = count($x);
                                    $sumX = array_sum($x);
                                    $sumY = array_sum($y);
                                    $sumXY = 0;
                                    $sumX2 = 0;

                                    for ($i = 0; $i < $n; $i++) {
                                        $sumXY += ($x[$i] * $y[$i]);
                                        $sumX2 += ($x[$i] * $x[$i]);
                                    }

                                    $slope = ($n * $sumXY - $sumX * $sumY) / ($n * $sumX2 - $sumX * $sumX);
                                    $intercept = ($sumY - $slope * $sumX) / $n;

                                    return array('slope' => $slope, 'intercept' => $intercept);
                                }
                                ?>

                            </div>
                        </div>
                    </div>
                </div>



                <!-- Visual Representation -->
                <div class="container-fluid mt-5">
                    <div class="row justify-content-center ">
                        <div class="col-md-10">
                            <div class="card p-3">
                                <h3 class="text-center font-weight-bold">Poultry Trends</h3>
                                <canvas class="canvas" id="PoultryTrends"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Automated Report Summary -->
                <div class="container-fluid mt-5">
                    <div class="row justify-content-center">
                        <div class="col-md-10">
                            <div class="card p-3">
                                <?php
                                $predictedYear = $max_year + 1;

                                $layersValues = array_column($counts, 'layers');
                                $layersRegression = linearRegression(array_keys($counts), $layersValues);
                                $predictedLayers = $layersRegression['slope'] * $predictedYear + $layersRegression['intercept'];

                                $broilerValues = array_column($counts, 'broiler');
                                $broilerRegression = linearRegression(array_keys($counts), $broilerValues);
                                $predictedBroiler = $broilerRegression['slope'] * $predictedYear + $broilerRegression['intercept'];

                                $nativeValues = array_column($counts, 'native');
                                $nativeRegression = linearRegression(array_keys($counts), $nativeValues);
                                $predictedNative = $nativeRegression['slope'] * $predictedYear + $nativeRegression['intercept'];

                                $fightingValues = array_column($counts, 'fighting');
                                $fightingRegression = linearRegression(array_keys($counts), $fightingValues);
                                $predictedFighting = $fightingRegression['slope'] * $predictedYear + $fightingRegression['intercept'];

                                $predictedTotal = $predictedLayers + $predictedBroiler + $predictedNative + $predictedFighting;

                                ?>

                                <h3 class="text-center font-weight-bold">Report Summary</h3>
                                <p class="text-center">
                                    This automated report provides a summary of the poultry trends, including
                                    historical data, predictions for the year
                                    <?php echo number_format($predictedYear, 0, '.', ','); ?>, and visual representation
                                    through a line graph.
                                </p>
                                <hr>

                                <h5 class="font-weight-bold">Historical Data:</h5>
                                <p>
                                    The historical data in the table represents the counts of different types of
                                    poultry (Layers, Broiler, Native/Range, Fighting/Fancy Fowl) over the years.
                                </p>

                                <h5 class="font-weight-bold">Linear Regression Predictions:</h5>
                                <p>
                                    Linear regression analysis has been applied to predict the counts for the year
                                    2023. The predictions include:
                                <ul>
                                    <li>Layers:
                                        <?php echo number_format($predictedLayers, 0, '.', ','); ?>
                                    </li>
                                    <li>Broiler:
                                        <?php echo number_format($predictedBroiler, 0, '.', ','); ?>
                                    </li>
                                    <li>Native/Range:
                                        <?php echo number_format($predictedNative, 0, '.', ','); ?>
                                    </li>
                                    <li>Fighting/Fancy Fowl:
                                        <?php echo number_format($predictedFighting, 0, '.', ','); ?>
                                    </li>
                                </ul>
                                </p>

                                <h5 class="font-weight-bold">Total Poultry Count Prediction:</h5>
                                <p>
                                    The predicted total poultry count for the year 2023 is
                                    <?php echo number_format($predictedTotal, 0, '.', ','); ?>.
                                </p>

                                <h5 class="font-weight-bold">Insights:</h5>
                                <p>
                                    The line graph visually represents the trends in poultry counts over the years.
                                    Emphasis has been given to the "Total Poultry Count" line, which provides an
                                    overview of the overall trend.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>


            </main>
        </div>
    </div>
    </div>

    <!-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> -->
    <script src="/BenguetLivestock/chart.umd.js"></script>


    <!-- Linear Regression Graph -->
    <script>
        const ctx = document.getElementById('PoultryTrends');

        const poultryData = {
            labels: [<?php echo implode(',', array_keys($counts)); ?>],
            layers: [<?php echo implode(',', array_column($counts, 'layers')); ?>],
            broiler: [<?php echo implode(',', array_column($counts, 'broiler')); ?>],
            native: [<?php echo implode(',', array_column($counts, 'native')); ?>],
            fighting: [<?php echo implode(',', array_column($counts, 'fighting')); ?>],
        };

        const predictedYear = <?php echo $predicted_year; ?>;
        const layersRegressionLine = calculateRegressionLine(poultryData.labels, poultryData.layers);
        const broilerRegressionLine = calculateRegressionLine(poultryData.labels, poultryData.broiler);
        const nativeRegressionLine = calculateRegressionLine(poultryData.labels, poultryData.native);
        const fightingRegressionLine = calculateRegressionLine(poultryData.labels, poultryData.fighting);

        // Calculate predicted values for 2023
        const predictedLayers = layersRegressionLine.slope * predictedYear + layersRegressionLine.intercept;
        const predictedBroiler = broilerRegressionLine.slope * predictedYear + broilerRegressionLine.intercept;
        const predictedNative = nativeRegressionLine.slope * predictedYear + nativeRegressionLine.intercept;
        const predictedFighting = fightingRegressionLine.slope * predictedYear + fightingRegressionLine.intercept;
        const predictedTotal = predictedLayers + predictedBroiler + predictedNative + predictedFighting;

        // Add the predicted data for 2023
        poultryData.labels.push(predictedYear.toString());
        poultryData.layers.push(predictedLayers);
        poultryData.broiler.push(predictedBroiler);
        poultryData.native.push(predictedNative);
        poultryData.fighting.push(predictedFighting);

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: poultryData.labels,
                datasets: [{
                    label: 'Total Poultry Count',
                    data: [<?php echo implode(',', array_map(function ($count) {
                        return array_sum($count);
                    }, $counts)); ?>, predictedTotal],
                    fill: false,
                    borderColor: 'rgb(75, 192, 192)',
                    tension: 0.1,
                    borderWidth: 4, // Increase the line width for emphasis
                    borderDash: [10, 10], // Use a dashed line for emphasis
                }, {
                    label: 'Layers',
                    data: poultryData.layers,
                    fill: false,
                    borderColor: 'rgb(255, 0, 0)',
                    tension: 0.1
                }, {
                    label: 'Broiler',
                    data: poultryData.broiler,
                    fill: false,
                    borderColor: 'rgb(0, 255, 0)',
                    tension: 0.1
                }, {
                    label: 'Native/Range',
                    data: poultryData.native,
                    fill: false,
                    borderColor: 'rgb(0, 0, 255)',
                    tension: 0.1
                }, {
                    label: 'Fighting/Fancy Fowl',
                    data: poultryData.fighting,
                    fill: false,
                    borderColor: 'rgb(255, 255, 0)',
                    tension: 0.1
                }]
            },
            options: {
                scales: {
                    x: {
                        type: 'linear',
                        position: 'bottom',
                        ticks: {
                            callback: function (value, index, values) {
                                return value % 1 === 0 ? value : '';
                            }
                        }
                    },
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Function to calculate linear regression
        function calculateRegressionLine(x, y) {
            const n = x.length;
            let sumX = 0;
            let sumY = 0;
            let sumXY = 0;
            let sumXSquare = 0;

            for (let i = 0; i < n; i++) {
                sumX += x[i];
                sumY += y[i];
                sumXY += x[i] * y[i];
                sumXSquare += x[i] * x[i];
            }

            const slope = (n * sumXY - sumX * sumY) / (n * sumXSquare - sumX * sumX);
            const intercept = (sumY - slope * sumX) / n;

            return { slope, intercept };
        }
    </script>


    <!-- Add, Delete, Update Modal -->
    <?php include 'modals.php'; ?>

    <!-- Main Table JS -->
    <script>
        var dataTable = new DataTable('#main-table', {
            lengthChange: false,
            columnDefs: [
                { targets: [7, 8], orderable: false },
                { "className": "dt-center", "targets": "_all" } // Disable sorting for columns with index 4 (Update) and 5 (Delete)
            ],
            columns: [
                { "width": "11.11%" },
                { "width": "11.11%" },
                { "width": "11.11%" },
                { "width": "11.11%" },
                { "width": "11.11%" },
                { "width": "11.11%" },
                { "width": "11.11%" },
                { "width": "11.11%" },
                { "width": "11.11%" }],
            autoWidth: false,
            search: true,
            paging: true,
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'copy',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 6]
                    }
                },
                {
                    extend: 'csv',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 6]
                    }
                },
                {
                    extend: 'excel',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 6]
                    }
                },
                {
                    extend: 'pdf',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 6]
                    }
                },
                'print'
            ],
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],

        });
    </script>


    <!-- Predict Table JS -->
    <script>
        var dataTable = new DataTable('#predicted-table', {
            lengthChange: false,
            columns: [
                { "width": "16.67%" },
                { "width": "16.67%" },
                { "width": "16.67%" },
                { "width": "16.67%" },
                { "width": "16.67%" },
                { "width": "16.67%" }
            ],
            autoWidth: false,
            searching: false,
            info: false,
            paging: false,
            ordering: false,
        });
    </script>

    <!-- Advanced Options JS -->
    <script>
        var dataTable = new DataTable('#advanced-table', {
            lengthChange: false,
            columnDefs: [
                { targets: [5, 6], orderable: false } // Disable sorting for columns with index 4 (Update) and 5 (Delete)
            ],
            autoWidth: false,
            search: true,
            // info: false,
            paging: false,
        });
    </script>







    <script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/buttons/2.1.3/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/buttons/2.1.3/js/buttons.html5.min.js"></script>
    <script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/buttons/2.1.3/js/buttons.print.min.js"></script>
    <script type="text/javascript" charset="utf8"
        src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/buttons/2.1.3/js/buttons.colVis.min.js"></script>


    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>


    <!-- JS for Update and Delete 'script.js'-->
    <script src="script.js"></script>
</body>

</html>