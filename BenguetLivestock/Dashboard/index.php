<?php include 'code.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="/benguetlivestock/styles.css">

    <title>Dashboard</title>
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <?php include 'sidebar.php'; ?>

        <!-- Main Component -->
        <div class="main">
            <nav class="navbar navbar-expand px-3 border-bottom">
                <!-- Button for sidebar toggle -->
                <button class="btn" type="button">
                    <i class="fa-solid fa-bars"></i>
                </button>
            </nav>

            <main class="content px-3 py-3">
                <button id="exportButton" class="btn btn-primary mt-3 mb-3">Export Data to CSV</button>
                <!-- Main Table -->
                <div style="width: 100%;" class="mr-2">
                    <div class="row justify-content-center">
                        <div class="chart-container col-md-7 " style="position: relative; height:40vh; width:80vw;">
                            <div class="card p-3">
                                <h4 class="text-left font-weight-bold ">Livestock Population</h4>
                                <div>
                                    <canvas id="myChart"></canvas>
                                </div>

                                <script>
                                    const ctx = document.getElementById('myChart');

                                    const chartOptions = {

                                        responsive: true,
                                        maintainAspectRatio: true,
                                        aspectRatio: 2,
                                        onResize: (chart, newSize) => {
                                            // Custom actions on resize if needed
                                            console.log('Chart resized!', newSize);
                                        },
                                        resizeDelay: 0, // Set your desired delay in milliseconds
                                    };

                                    new Chart(ctx, {
                                        type: 'bar',
                                        data: {
                                            labels: <?php echo json_encode($labels); ?>,
                                            datasets: [{
                                                label: 'Carabao Count',
                                                data: <?php echo json_encode($carabaoData); ?>,
                                                borderWidth: 1,
                                                borderColor: 'red',
                                                fill: false
                                            },
                                            {
                                                label: 'Cattle Count',
                                                data: <?php echo json_encode($cattleData); ?>,
                                                borderWidth: 1,
                                                borderColor: 'blue',
                                                fill: false
                                            },
                                            {
                                                label: 'Swine Count',
                                                data: <?php echo json_encode($swineData); ?>,
                                                borderWidth: 1,
                                                borderColor: 'blue',
                                                fill: false
                                            },
                                            {
                                                label: 'Goat Count',
                                                data: <?php echo json_encode($goatData); ?>,
                                                borderWidth: 1,
                                                borderColor: 'blue',
                                                fill: false
                                            },
                                            {
                                                label: 'Dog Count',
                                                data: <?php echo json_encode($dogData); ?>,
                                                borderWidth: 1,
                                                borderColor: 'blue',
                                                fill: false
                                            },
                                            {
                                                label: 'Sheep Count',
                                                data: <?php echo json_encode($sheepData); ?>,
                                                borderWidth: 1,
                                                borderColor: 'blue',
                                                fill: false
                                            },
                                            {
                                                label: 'Horse Count',
                                                data: <?php echo json_encode($horseData); ?>,
                                                borderWidth: 1,
                                                borderColor: 'blue',
                                                fill: false
                                            },
                                                // Add similar datasets for other livestock
                                            ]
                                        },
                                        options: chartOptions,
                                    });

                                </script>
                            </div>
                        </div>

                        <div class="col-md-5">
                            <div class="card p-3">
                                <h4 class="text-center font-weight-bold ">Number of Veterinary and Poultry Farm Supplies
                                </h4>
                                <div>
                                    <div style="width: 90%%;">
                                        <canvas id="myPieChart"></canvas>
                                    </div>

                                    <script>
                                        // Sample data for the pie chart
                                        const data = {
                                            labels: ['Red', 'Orange', 'Yellow', 'Green', 'Blue'],
                                            datasets: [{
                                                data: [12, 19, 3, 5, 2],
                                                backgroundColor: [
                                                    'red',
                                                    'orange',
                                                    'yellow',
                                                    'green',
                                                    'blue'
                                                ],
                                                borderColor: 'white',
                                                borderWidth: 2
                                            }]
                                        };

                                        // Configuration for the pie chart
                                        const config = {
                                            type: 'pie',
                                            data: data,
                                            options: {
                                                responsive: true,
                                                plugins: {
                                                    legend: {
                                                        position: 'top',
                                                    },
                                                    title: {
                                                        display: true,
                                                        text: 'Sample Pie Chart'
                                                    }
                                                }
                                            },
                                        };

                                        // Create the pie chart
                                        const myPieChart = new Chart(document.getElementById('myPieChart'), config);
                                    </script>


                                </div>
                            </div>
                        </div>




                    </div>
                </div>

            </main>
        </div>

    </div>


    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>

    <script src="script.js"></script>
    <script src="../sidebarFunctionality.js"></script>

    <script>
        document.getElementById('exportButton').addEventListener('click', function () {
            // Send an AJAX request to the PHP script that exports data to CSV
            $.ajax({
                url: 'export.php', // replace with the actual filename of your PHP script
                method: 'POST',
                success: function (response) {
                    alert(response); // display a message or handle the response as needed
                },
                error: function (error) {
                    console.error('Error exporting data:', error);
                }
            });
        });
    </script>

</body>

</html>