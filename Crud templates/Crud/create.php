<?php
include 'connect.php';

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $password = $_POST['password'];

    $sql = "INSERT INTO `crud` (name, email, mobile, password) 
            VALUES ('$name', '$email', '$mobile', '$password')";

    $result = $con->query($sql);

    if ($result) {
        header('location:display.php');
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
    <title>CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container m-5">
        <form method="post">
            <div class="form-group">
        <label>Name</label>
        <input type="text" class="form-control" placeholder="Enter name" name="name" autocomplete="off">
      </div>

      <div class="form-group">
        <label>Email</label>
        <input type="email" class="form-control" placeholder="Enter email" name="email" autocomplete="off">
      </div>

      <div class="form-group">
        <label>Mobile</label>
        <input type="text" class="form-control" placeholder="Enter mobile" name="mobile" autocomplete="off">
      </div>

      <div class="form-group">
        <label>Password</label>
        <input type="password" class="form-control" placeholder="Enter password" name="password" autocomplete="off">
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
