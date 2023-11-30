<?php
include 'connect.php';
$id=$_GET['updateid'];
$sql="Select * from `crud` where id=$id";
$result=mysqli_query($con, $sql );
$row=mysqli_fetch_assoc($result);
$name=$row['name'];
$email=$row['email'];
$mobile=$row['mobile'];
$password=$row['password'];


if(isset($_POST['submit'])){
  $name = $_POST['name'];
  $email = $_POST['email'];
  $mobile = $_POST['mobile'];
  $password = $_POST['password'];

  $sql = "UPDATE `crud` set id=$id, name='$name',email='$email',mobile='$mobile',password='$password'where id=$id";

  $result = mysqli_query($con, $sql);

  if($result){
    //echo "upda succ";
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

  <title>CRUD</title>
</head>

<body>
  <div class="container m-5">
    <form method="post">
      <div class="form-group">
        <label>Name</label>
        <input type="text" class="form-control" placeholder="Enter name" name="name" autocomplete="off" 
        value="<?php echo $name;?>">
      </div>

      <div class="form-group">
        <label>Email</label>
        <input type="email" class="form-control" placeholder="Enter email" name="email" autocomplete="off"
        value="<?php echo $email;?>">
      </div>

      <div class="form-group">
        <label>Mobile</label>
        <input type="text" class="form-control" placeholder="Enter mobile" name="mobile" autocomplete="off"
        value="<?php echo $mobile;?>">
      </div>

      <div class="form-group">
        <label>Password</label>
        <input type="password" class="form-control" placeholder="Enter password" name="password" autocomplete="off"
        value="<?php echo $password;?>">
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
