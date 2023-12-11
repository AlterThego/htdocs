<?php
session_start();
$connection = mysqli_connect("localhost", "root", "", "suaking");

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Assuming you have a logged-in user. You may need to modify this part based on your authentication mechanism.
if (!isset($_SESSION['user_id'])) {
    header('location: index.php'); // Redirect to the login page if the user is not logged in
    exit();
}

$user_id = $_SESSION['user_id'];

// Retrieve user details from the database
$details_query = "SELECT * FROM user WHERE user_id=?";
$details_stmt = mysqli_prepare($connection, $details_query);

if ($details_stmt) {
    mysqli_stmt_bind_param($details_stmt, "i", $user_id);
    $details_query_run = mysqli_stmt_execute($details_stmt);

    if ($details_query_run) {
        $user_details = mysqli_stmt_get_result($details_stmt);
        $user_details = mysqli_fetch_assoc($user_details);
    } else {
        // Handle error if the query fails
        echo 'Error retrieving user details: ' . mysqli_error($connection);
    }

    mysqli_stmt_close($details_stmt);
} else {
    // Handle error if preparing the statement fails
    echo 'Failed to prepare statement: ' . mysqli_error($connection);
}

mysqli_close($connection);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light ms-3">
        <a class="navbar-brand" href="#">School Record</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/finalexamination/frontend/enrollment.php">Enrollment</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/finalexamination/frontend/student.php">Student</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/finalexamination/frontend/course.php">Courses</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/finalexamination/frontend/instructor.php">Instructor</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="/finalexamination/frontend/user.php">Account</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container d-flex justify-content-center align-items-center min-vw-100 mt-5">
        <div class="row border rounded-2 p-3 bg-white shadow box-area">
            <div class="col-md-12 right-box">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Account Detais</h3>
                    </div>
                    <div class="card-body">
                        <?php if (isset($user_details)): ?>
                            <dl class="row">
                                <dt class="col-sm-3">User ID</dt>
                                <dd class="col">
                                    <?php echo $user_details['user_id']; ?>
                                </dd>

                                <dt class="col-sm-3">User Name</dt>
                                <dd class="col">
                                    <?php echo $user_details['user_name']; ?>
                                </dd>
                                <!-- Add more details as needed -->
                            </dl>
                        <?php else: ?>
                            <p class="text-danger">Error retrieving user details.</p>
                        <?php endif; ?>

                        <button type="button" class="btn btn-warning me-5">Edit</button>
                        <button type="button" class="btn btn-danger">Delete</button>

                        <button type="button" class="btn btn-primary float-end">Logout</button>
                    </div>
                </div>


            </div>
        </div>
    </div>

    <!-- Bootstrap JS and Popper.js (for some components) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
        integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V"
        crossorigin="anonymous"></script>

</body>

</html>