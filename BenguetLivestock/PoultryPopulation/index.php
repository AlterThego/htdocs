<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

    <!-- DataTables JS -->
    <script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>





    <link rel="stylesheet" href="/benguetlivestock/styles.css">
    <title>Poultry Population</title>
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
            <main class="content px-3 py-2">
                <!-- Main Table -->
                <div class="container-fluid mt-3">
                    <div class="row justify-content-center">
                        <div class="col-md-9">
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
                                <div class="card-header mb-3 ">
                                    <h3 class="text-center font-weight-bold ">Poultry Population</h3>
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#exampleModal">
                                        Add data
                                    </button>
                                    <a data-toggle="modal" href="#advancedOptionModal"
                                        class="btn btn-warning float-end">Advanced Options</a>
                                </div>

                                <table class="display table-bordered" id="main-table">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Type</th>
                                            <th scope="col">Count</th>
                                            <th scope="col">Date Updated</th>
                                            <th class="text-center" scope="col">Update</th>
                                            <th class="text-center" scope="col">Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $totalCount = 0;
                                        $connection = mysqli_connect("localhost", "root", "", "benguetlivestockdb");

                                        $fetch_query = "SELECT poultrypopulation.poultry_type_id, poultrytype.poultry_type_name, poultrypopulation.date_updated, poultrypopulation.count
                        FROM poultrypopulation
                        JOIN poultrytype ON poultrypopulation.poultry_type_id = poultrytype.poultry_type_id";

                                        $fetch_query_run = mysqli_query($connection, $fetch_query);

                                        if (mysqli_num_rows($fetch_query_run) > 0) {
                                            while ($row = mysqli_fetch_array($fetch_query_run)) {
                                                ?>
                                                <tr>
                                                    <td>
                                                        <?php echo $row['poultry_type_id']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row['poultry_type_name']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo number_format($row['count'], 0, '.', ','); ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row['date_updated']; ?>
                                                    </td>

                                                    <td class="text-center">
                                                        <button class="btn btn-update btn-success btn-sm center"
                                                            data-toggle="modal" data-target="#updateModal"
                                                            data-id="<?php echo $row['poultry_type_id']; ?>"
                                                            data-type="<?php echo $row['poultry_type_name']; ?>"
                                                            data-count="<?php echo $row['count']; ?>"
                                                            data-date="<?php echo $row['date_updated']; ?>">
                                                            Update
                                                        </button>

                                                    </td>
                                                    <td class="text-center">
                                                        <form action="code.php" method="post">
                                                            <input type="hidden" name="id"
                                                                value="<?php echo $row['poultry_type_id']; ?>">
                                                            <button type="button" class="btn btn-danger btn-delete btn-sm"
                                                                data-toggle="modal" data-target="#deleteConfirmationModal">
                                                                Delete
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                <?php
                                                $totalCount += $row['count'];
                                            }
                                        } else {
                                            ?>
                                            <tr>
                                                <td colspan="6">No Record Available</td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                    </tbody>

                                </table>
                            </div>
                            <div class="mt-3 text-center">
                                <strong>Total Count:</strong>
                                <?php echo number_format($totalCount, 0, '.', ' '); ?>
                            </div>

                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Add, Delete, Update Modal -->
    <?php include 'modals.php'; ?>

    <script>
        var dataTable = new DataTable('#main-table', {
            lengthChange: false,
            columnDefs: [
                { targets: [4, 5], orderable: false } // Disable sorting for columns with index 4 (Update) and 5 (Delete)
            ],
            autoWidth: false,
            search: true,
            // info: false,
            paging: false,
        });
    </script>

    <script>
        var dataTable = new DataTable('#advanced-table', {
            lengthChange: false,
            columnDefs: [
                { targets: [4, 5], orderable: false } // Disable sorting for columns with index 4 (Update) and 5 (Delete)
            ],
            autoWidth: false,
            search: true,
            // info: false,
            paging: false,
        });
    </script>






    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>

    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>


    <!-- JS for Update and Delete 'script.js'-->
    <script src="script.js"></script>
</body>

</html>