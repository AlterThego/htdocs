<?php
session_start();
$connection = mysqli_connect("localhost", "root", "", "studentrecord");

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
        header('location: index.php');
        exit(); // Stop execution if passwords don't match
    }

    $insert_query = "INSERT INTO user (user_name, user_pass) 
                     VALUES ('$user_name', '$user_pass')";
    $insert_query_run = mysqli_query($connection, $insert_query);

    if ($insert_query_run) {
        $_SESSION['status'] = 'User record added successfully';
        $_SESSION['user_id'] = mysqli_insert_id($connection); // Set the user_id in the session
        header('location: index.php');
    } else {
        $_SESSION['status'] = 'Failed to add user record: ' . mysqli_error($connection);
        header('location: index.php');
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
            header('location: /finalexamination/frontend/enrollment.php'); // Redirect to the dashboard page
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
