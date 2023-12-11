<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Boostrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">


    <!-- CSS -->
    <link rel="stylesheet" href="../assets/css/signup.css">


    <title>Signup | Student Information System</title>
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="row border rounded-5 p-3 bg-white shadow box-area">
            <div class="col-md-12 right-box">
                <form action="code.php" method="post">
                    <div class="header-text mb-3">
                        <h2>Welcome!</h2>
                        <p>Lets get started.</p>
                    </div>

                    <div class="mb-3">
                        <label for="signup-username" class="form-label">Username</label>
                        <input type="text" name="signup-username" class="form-control form-control-lg bg-light fs-6"
                            autocomplete="off">
                    </div>

                    <div class="mb-3">
                        <label for="signup-password" class="form-label">Password</label>
                        <input type="password" name="signup-password" class="form-control form-control-lg bg-light fs-6"
                            autocomplete="off">
                    </div>

                    <div class="mb-3">
                        <label for="signup-reenter" class="form-label">Re-enter Password</label>
                        <input type="password" name="signup-reenter" class="form-control form-control-lg bg-light fs-6"
                            autocomplete="off">
                    </div>

                    <div class="mb-3">
                        <button type="submit" name="save_user" class="btn btn-lg btn-primary w-100 fs-6">Signup</button>
                    </div>

                    <div class="row">
                        <small>Already have an account? <a href="/finalexamination/index.php">Login</a></small>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>

<?php
session_start();
$connection = mysqli_connect("localhost", "root", "", "suaking");

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['save_user'])) {
    $user_name = mysqli_real_escape_string($connection, $_POST['signup-username']);
    $user_pass = mysqli_real_escape_string($connection, $_POST['signup-password']);
    $user_reenter = mysqli_real_escape_string($connection, $_POST['signup-reenter']);

    // Check if the password and reentered password match
    if ($user_pass != $user_reenter) {
        $_SESSION['status'] = 'Password and reentered password do not match';
        header('location: /finalexamination/index.php');
        exit(); // Stop execution if passwords don't match
    }

    $insert_query = "INSERT INTO user (user_name, user_pass) 
                     VALUES ('$user_name', '$user_pass')";
    $insert_query_run = mysqli_query($connection, $insert_query);

    if ($insert_query_run) {
        $_SESSION['status'] = 'User record added successfully';
        $_SESSION['user_id'] = mysqli_insert_id($connection); // Set the user_id in the session
        header('location: /finalexamination/index.php');
    } else {
        $_SESSION['status'] = 'Failed to add user record: ' . mysqli_error($connection);
        header('location: /finalexamination/index.php');
    }

} elseif (isset($_POST['login_user'])) {
    $login_user = mysqli_real_escape_string($connection, $_POST['login-username']);
    $login_pass = mysqli_real_escape_string($connection, $_POST['login-password']);

    // Example query (adjust according to your database schema)
    $login_query = "SELECT * FROM user WHERE user_name='$login_user' AND user_pass='$login_pass'";
    $login_query_run = mysqli_query($connection, $login_query);

    if ($login_query_run) {
        // Check if user credentials are valid
        if (mysqli_num_rows($login_query_run) > 0) {
            $user_data = mysqli_fetch_assoc($login_query_run);
            $_SESSION['status'] = 'Login successful';
            $_SESSION['user_id'] = $user_data['user_id']; // Set the user_id in the session
            header('location: /finalexamination/contents/enrollment.php'); // Redirect to the dashboard page
        } else {
            $_SESSION['status'] = 'Invalid username or password';
            header('location: /finalexamination/index.php'); // Redirect to the login page
        }
    } else {
        $_SESSION['status'] = 'Error during login: ' . mysqli_error($connection);
        header('location: /finalexamination/index.php'); // Redirect to the login page
    }
}

mysqli_close($connection);
?>