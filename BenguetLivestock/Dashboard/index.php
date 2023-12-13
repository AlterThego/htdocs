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

    <!-- DataTables JS -->
    <script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    <link href="/BenguetLivestock/datatables.min.css" rel="stylesheet">

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

            <div class="container-fluid">
                <div class="card text-center">
                    <div class="card-header text-center">
                        <h4><b>Contrasting Municipalities
                                <?php
                                $connection = mysqli_connect("localhost", "root", "", "benguetlivestockdb");

                                $query = "SELECT MAX(livestock_year) AS highest_year FROM livestocktrend";

                                // Perform the query
                                $result = mysqli_query($connection, $query);

                                // Check for errors
                                if (!$result) {
                                    die("Query failed: " . mysqli_error($connection));
                                }

                                // Fetch the result
                                $row = mysqli_fetch_assoc($result);

                                // Display the highest livestock_year
                                echo "Year: " . $row['highest_year'];

                                ?>



                            </b></h4>
                    </div>
                    <div class="row pl-3">

                        <?php include 'comparison.php'; ?>

                        <!-- First Container -->
                        <div id="first-container" class="col-md-3 mt-3 mb-3">
                            <div class="card text-center">
                                <div class="card-body">
                                    <p style="display: none;"></p>
                                </div>
                            </div>
                        </div>




                        <!-- SVG Map -->
                        <div class="col-md-6 p-3 justify-content-center">
                            <div class="card text-center mr-3">
                                <div class="card-body text-center">
                                    <svg width="415" version="1.1" viewBox="0 0 3072 4208"
                                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">

                                        <g>
                                            <image width="3072" height="4208" preserveAspectRatio="none"
                                                xlink:href="BenguetMap.svg">
                                        </g>
                                        <a href="#" id="itogon-link">
                                            <g>
                                                <path class="hoverable"
                                                    d="m1450.4 2461 155.53 42.633 582.13 313.73 149.31 125.31-24.885 154.64-233.74 4.4437-64.003 265.45-89.238 61.587 43.99 184.76-10.055 56.559-589.47 340.61-81.697-301.65-15.082-17.596 1.2569-23.88 6.2843-52.788 45.247-569.36-5.0275-12.569-31.422-36.449v-40.22l3.7706-8.7981v-33.936l22.624-95.522-16.339-70.385-5.0274-76.669-7.5413-84.21 46.504 1.2569 18.853 7.5412 26.394-67.871 35.192-30.165z"
                                                    style="fill-opacity:0;stroke-opacity:0" />
                                            </g>
                                        </a>

                                        <a href="#" id="kabayan-link">
                                            <g>
                                                <path class="hoverable"
                                                    d="m2902.6 1567.7 0.8887 16.886-1.7775 1.7774-3.5549 21.33-3.555 23.107-1.7775 24.885-7.1099 2.6663 1.7775 21.33-4.4437 12.442v12.442l-48.881 290.62-291.51-109.32-172.42 88.874-14.22-3.5549-24.885-3.555-33.772-2.6662-6.2211-2.6663-24.885-0.8887-5.3324-3.555-28.44-0.8887-24.885-6.2212-196.41-76.432-92.429-60.434 18.664-32.884 42.66-179.53 39.105-107.54-11.554-90.652 391.93-98.65 84.43 22.218h74.654l71.099 18.664 172.42 231.07 23.107 0.8887 7.9987-4.4437h39.105l7.1099-5.3324z"
                                                    style="fill-opacity:0;stroke-opacity:0" />
                                            </g>
                                        </a>

                                        <a href="#" id="buguias-link">
                                            <g>
                                                <path class="hoverable"
                                                    d="m2550.7 560.8-10.665 103.09-3.555 7.1099 1.7775 87.097-8.8874 6.2212 1.7775 39.993-5.3325 5.3324 3.555 25.773-5.3325 6.2212v21.33l-7.1099 5.3324 1.7775 24.885-3.555 5.3324 0.8888 46.215-5.3325 6.2212-0.8887 69.322-2.6662 72.877-5.3325 5.3324v57.768l-7.1099 6.2212 1.7775 39.105-4.4437 5.3325 2.6662 45.326-6.2212 5.3324 0.8887 38.216-3.5549 9.7761v18.664l-89.763-19.552-389.27 98.65-14.22-18.664-15.109-11.554-22.218-7.9987-46.214-173.3 65.767-98.65 118.2-156.42 64.878-105.76 48.881-81.764 39.993-81.764 60.434-51.547 57.768-9.7762 73.766-22.219 50.658-11.554h24.885z"
                                                    style="fill-opacity:0;stroke-opacity:0" />
                                            </g>
                                        </a>

                                        <a href="#" id="mankayan-link">
                                            <g>
                                                <path class="hoverable"
                                                    d="m1749 351.05-7.11 11.554-11.554 62.212 24.885 91.54 40.882 90.652 9.7762 85.319 119.98-31.995 82.653 141.31 72.877 79.098 14.22 8.8874 15.997 17.775 79.987-131.53 56.879-109.32 56.879-50.658 34.661-6.2212 117.31-31.995-51.547-31.106-0.8888-38.216 21.33-39.993-15.109-22.219-165.31-180.41-11.554 7.9987-19.552-2.6662-7.1099 8.8874-14.22-5.3324-23.107 6.2212-20.441 5.3324-7.9987 5.3324-184.86-99.539-13.331-3.555-7.9987 7.9987-23.996-0.88874-6.2212 6.2212-11.554-1.7775z"
                                                    style="fill-opacity:0;stroke-opacity:0" />
                                            </g>
                                        </a>

                                        <a href="#" id="bakun-link">
                                            <g>
                                                <path class="hoverable"
                                                    d="m986.5 903.85 78.209 7.1099 66.656-15.997 94.206 55.991 120.87 29.328 37.327-7.1099 89.763 21.33 80.876-46.215 148.42 167.08 171.53 79.098 16.886-3.555h15.997l202.63-284.4-69.322-66.656-50.658-71.099-65.767-108.43-115.54 28.44-15.997-89.763-35.55-80.875-26.662-94.207 16.886-72.877-78.209 7.1099-8.8874-7.9987-103.09 5.3324-1.7775-6.2212h-107.54l-0.8887-3.555-109.32 2.6662-1.7775-6.2212h-52.436l-85.319 50.658-17.775 107.54-37.327 48.881-127.09 50.658-61.323 196.41z"
                                                    style="fill-opacity:0;stroke-opacity:0" />
                                            </g>
                                        </a>

                                        <a href="#" id="kibungan-link">
                                            <g>
                                                <path class="hoverable"
                                                    d="m986.5 907.4-97.762 48.881-2.6662 15.997 23.107 33.772 12.442 47.103-3.555 15.109-19.552 34.661-1.7775 29.328 11.554 7.1099 0.88874 2.6663 1.7775 10.665 7.9987 11.554v11.554l-15.109 9.7762-17.775 4.4437-9.7762 6.2212 25.774 26.662-2.6662 24.885-14.22 15.109 57.768 130.64 231.96-6.2212 159.97 123.54 47.992 43.548 39.993 30.217 10.665 17.775 11.554 7.1099 150.2-83.542 190.19-83.542 166.19-75.543-41.771-176.86-22.218 1.7775-13.331 1.7775-144.86-70.211-21.33-4.4437-154.64-171.53-81.764 47.992-84.43-21.33-48.881 5.3324-119.98-30.217-85.319-55.102-69.322 16.886-37.327-0.88874-7.9987-4.4437z"
                                                    style="fill-opacity:0;stroke-opacity:0" />
                                            </g>
                                        </a>

                                        <a href="#" id="atok-link">
                                            <g>
                                                <path class="hoverable"
                                                    d="m1951.7 1368.7-394.6 174.19-108.43 62.212-23.107 58.657-51.547 28.44-19.552 46.215-26.662 131.53v35.55l-21.33 62.212 106.65 117.31 35.55 53.324 78.209 119.09 21.33 3.555 46.214-17.775h26.662l51.547-99.539 113.76-136.87 92.429-106.65 62.212-122.65 33.772-163.53 42.66-113.76-12.442-104.87-23.107-19.552z"
                                                    style="fill-opacity:0;stroke-opacity:0" />
                                            </g>
                                        </a>

                                        <a href="#" id="tublay-link">
                                            <g>
                                                <path class="hoverable"
                                                    d="m970.51 2029.9 334.17-58.657 115.54 122.65 101.32 159.97 31.995 1.7775 55.102 247.07-151.09-39.105-167.08-88.874-53.324-69.322-106.65-60.434-136.87-49.77z"
                                                    style="fill-opacity:0;stroke-opacity:0" />
                                            </g>
                                        </a>

                                        <a href="#" id="sablan-link">
                                            <g>
                                                <path class="hoverable"
                                                    d="m476.35 2347.8 47.761-119.4 263.94-330.56 184.76 130.71 15.082 168.42-13.826 35.192-8.7981 35.192-16.339 31.422-40.22 74.155-20.11 41.477-7.5412 33.936 1.2569 30.165 5.0275 50.275 2.5137 23.88-23.881-12.569-20.11-37.706-18.853-11.312-10.055-15.082-277.77 87.981 2.5137-67.871-6.2844-8.7981 2.5137-65.357-11.312-15.082-20.11-23.88z"
                                                    style="fill-opacity:0;stroke-opacity:0" />
                                            </g>
                                        </a>
                                        <a href="#" id="latrinidad-link">
                                            <g>
                                                <path class="hoverable"
                                                    d="m1451.7 2461-70.385 65.357-10.055 17.596-17.596 50.275-26.394-5.0275-30.165-6.2843h-46.504l-95.522-18.853-49.018-2.5137-62.844-6.2843-32.679 10.055-52.789-7.5412-65.357-6.2844-12.569-100.55 10.055-45.247 35.192-56.559 31.422-65.357 33.935-86.724 38.963 7.5412 69.128 27.651 49.018 21.367 75.412 46.504 38.963 37.706 31.422 37.706 55.302 28.908z"
                                                    style="fill-opacity:0;stroke-opacity:0" />
                                            </g>
                                        </a>

                                        <a href="#" id="baguio-link">
                                            <g>
                                                <path class="hoverable"
                                                    d="m1293.3 2917.2-289.08-65.357-114.38-301.65 129.46 12.569 40.22-10.055 43.99 8.7981 51.532 1.2569 30.165 5.0274 26.394 8.7981 80.44 7.5413-1.2568 71.642 6.2843 11.312v47.761l18.853 105.58z"
                                                    style="fill-opacity:0;stroke-opacity:0" />
                                            </g>
                                        </a>

                                        <a href="#" id="tuba-link">
                                            <g>
                                                <path class="hoverable"
                                                    d="m544.22 2564-118.15 222.47 133.23 287.82 130.71 158.37 31.422 294.11 355.69 394.66 295.36 89.238-84.21-304.16-13.826-18.853 51.532-648.54-36.449-49.018 5.0275-76.669-291.59-59.073-113.12-305.42-20.11-3.7706-12.569-15.082-6.2844-20.11-16.339-13.826-15.082-18.853z"
                                                    style="fill-opacity:0;stroke-opacity:0" />
                                            </g>
                                        </a>

                                        <a href="#" id="bokod-link">
                                            <g>
                                                <path class="hoverable"
                                                    d="m2540 1886.8-63.101 352.83 30.217 189.3v129.76l-87.985 242.63-80.876 143.98-39.993-36.438-107.54-90.652-582.13-314.61-54.213-244.4 31.106-14.22 15.109-0.8887 10.665-2.6662h7.9987l46.214-89.763 23.996-33.772 119.98-137.75 55.102-62.212 55.102-102.21 35.55 23.996 44.437 28.44 72.877 28.44 55.991 23.107 66.656 25.774 20.441 7.9986 18.664 3.555 26.662 2.6662 6.2211 1.7775 25.774 0.8887 9.7762 4.4437h21.33l9.7761 4.4438h20.441l13.331 2.6662z"
                                                    style="fill-opacity:0;stroke-opacity:0" />
                                            </g>
                                        </a>

                                        <a href="#" id="kapangan-link">
                                            <g>
                                                <path class="hoverable"
                                                    d="m883.41 1270.9 60.434 122.65 111.98-1.7775 14.22-5.3324h103.09l243.52 190.19 28.44 35.55-21.33 47.992-44.437 28.44-21.33 39.105-21.33 99.539-10.665 44.437 3.5549 30.217-24.885 67.544-334.17 62.212-186.64-136.87 35.55-243.52 51.547-268.4z"
                                                    style="fill-opacity:0;stroke-opacity:0" />
                                            </g>
                                        </a>

                                    </svg>
                                    </card>
                                </div>
                            </div>
                        </div>

                        <!-- Second Container -->
                        <div id="second-container" class="col-md-3 mt-3 mb-3">
                            <div class="card text-center">
                                <div class="card-body">
                                    <p style="display: none;"></p>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>


            </div>

            <div class="container-fluid">
                <main class=" content px-3 py-3">
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
                                                datasets: [
                                                    {
                                                        label: 'Carabao Count',
                                                        data: <?php echo json_encode($carabaoData); ?>,
                                                        borderWidth: 2, // Increase border width for better visibility
                                                        borderColor: 'red',
                                                        fill: false
                                                    },
                                                    {
                                                        label: 'Cattle Count',
                                                        data: <?php echo json_encode($cattleData); ?>,
                                                        borderWidth: 2,
                                                        borderColor: 'green',
                                                        fill: false
                                                    },
                                                    {
                                                        label: 'Swine Count',
                                                        data: <?php echo json_encode($swineData); ?>,
                                                        borderWidth: 2,
                                                        borderColor: 'blue',
                                                        fill: false
                                                    },
                                                    {
                                                        label: 'Goat Count',
                                                        data: <?php echo json_encode($goatData); ?>,
                                                        borderWidth: 2,
                                                        borderColor: 'orange',
                                                        fill: false
                                                    },
                                                    {
                                                        label: 'Dog Count',
                                                        data: <?php echo json_encode($dogData); ?>,
                                                        borderWidth: 2,
                                                        borderColor: 'purple',
                                                        fill: false
                                                    },
                                                    {
                                                        label: 'Sheep Count',
                                                        data: <?php echo json_encode($sheepData); ?>,
                                                        borderWidth: 2,
                                                        borderColor: 'brown',
                                                        fill: false
                                                    },
                                                    
                                                    {
                                                        label: 'Horse Count',
                                                        data: <?php echo json_encode($horseData); ?>,
                                                        borderWidth: 2,
                                                        borderColor: 'pink',
                                                        fill: false
                                                    },

                                                ]

                                            },
                                            options: chartOptions,
                                        });



                                    </script>
                                </div>
                            </div>

                            <div class="col-md-5">
                                <div class="card p-3">
                                    <h4 class="text-center font-weight-bold ">Number of Veterinary and
                                        Poultry Farm
                                        Supplies
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


        <!-- Export Button -->
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

        <!-- Municipalities Table -->
        <script>
            var dataTable = new DataTable('#municipalities-table', {
                lengthChange: false,
                columns: [
                    { "width": "50%" },
                    { "width": "50%" },
                ],
                autoWidth: true,
                searching: false,
                paging: false,
                info: false,
                dom: 'Bfrtip',
                orderable: false,

            });
        </script>

        <!-- Comparison Tables -->
        <script>
            function initializeDataTable(tableId) {
                return new DataTable(tableId, {
                    lengthChange: false,
                    columns: [
                        { "width": "50%" },
                        { "width": "50%" },
                    ],
                    autoWidth: false,
                    searching: false,
                    paging: false,
                    info: false,
                    ordering: false,
                });
            }

            var itogonTable = initializeDataTable('#itogon-table');
            var bokodTable = initializeDataTable('#bokod-table');
            var tubaTable = initializeDataTable('#tuba-table');
            var atokTable = initializeDataTable('#atok-table');
            var bakunTable = initializeDataTable('#bakun-table');
            var buguiasTable = initializeDataTable('#buguias-table');
            var kabayanTable = initializeDataTable('#kabayan-table');
            var kibunganTable = initializeDataTable('#kibungan-table');
            var latrinidadTable = initializeDataTable('#latrinidad-table');
            var mankayanTable = initializeDataTable('#mankayan-table');
            var sablanTable = initializeDataTable('#sablan-table');
            var tublayTable = initializeDataTable('#tublay-table');
            var kapanganTable = initializeDataTable('#kapangan-table');
        </script>



        <!-- Hover  JS -->
        <script>
            // Get all elements with the class "hoverable"
            const hoverableElements = document.querySelectorAll('.hoverable');

            // Add event listeners for mouseover and mouseout
            hoverableElements.forEach(element => {
                element.addEventListener('mouseover', () => {
                    element.style.fillOpacity = 0.35;  // Change the fill-opacity on hover
                });

                element.addEventListener('mouseout', () => {
                    element.style.fillOpacity = 0;  // Reset the fill-opacity on mouseout
                });
            });
        </script>


        <!-- Comparison Functionality -->
        <script>
            $(document).ready(function () {
                $('#tuba-link').click(function () {
                    toggleContent('tuba-content');
                });

                $('#bokod-link').click(function () {
                    toggleContent('bokod-content');
                });

                $('#itogon-link').click(function () {
                    toggleContent('itogon-content');
                });

                $('#atok-link').click(function () {
                    toggleContent('atok-content');
                });

                $('#bakun-link').click(function () {
                    toggleContent('bakun-content');
                });

                $('#buguias-link').click(function () {
                    toggleContent('buguias-content');
                });

                $('#kabayan-link').click(function () {
                    toggleContent('kabayan-content');
                });

                $('#kapangan-link').click(function () {
                    toggleContent('kapangan-content');
                });

                $('#kibungan-link').click(function () {
                    toggleContent('kibungan-content');
                });

                $('#latrinidad-link').click(function () {
                    toggleContent('latrinidad-content');
                });

                $('#mankayan-link').click(function () {
                    toggleContent('mankayan-content');
                });

                $('#sablan-link').click(function () {
                    toggleContent('sablan-content');
                });

                $('#tublay-link').click(function () {
                    toggleContent('tublay-content');
                });

                // Function to add or close content based on the available containers
                function toggleContent(contentId) {
                    var clickedContent = $('#' + contentId).html();

                    // Check if both containers are full
                    if (!($('#first-container .card p').is(':empty') || $('#first-container .card p').is(':hidden')) &&
                        !($('#second-container .card p').is(':empty') || $('#second-container .card p').is(':hidden'))) {
                        // Close both containers and reset the queue
                        $('#first-container .card p, #second-container .card p').slideUp('fast');
                    } else {
                        // Check if the clicked municipality is already in the first or second container
                        if ($('#first-container .card p').html() === clickedContent) {
                            // Toggle visibility of content in the first container
                            $('#first-container .card p').slideToggle('fast');
                        } else if ($('#second-container .card p').html() === clickedContent) {
                            // Toggle visibility of content in the second container
                            $('#second-container .card p').slideToggle('fast');
                        } else {
                            // Move the content to the first or second container based on availability
                            if ($('#first-container .card p').is(':empty') || $('#first-container .card p').is(':hidden')) {
                                $('#first-container .card p').html(clickedContent).slideDown();
                            } else if ($('#second-container .card p').is(':empty') || $('#second-container .card p').is(':hidden')) {
                                $('#second-container .card p').html(clickedContent).slideDown();
                            }
                        }
                    }
                }
            });
        </script>




</body>

</html>