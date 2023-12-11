<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Signup | Student Information System</title>
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="row border rounded-5 p-3 bg-white shadow box-area">
            <div class="col-md-12 right-box">
                <form action="code.php" method="post">
                    <div class="header-text mb-3">
                        <h2>Welcome!</h2>
                        <p>Lets get stareted.</p>
                    </div>

                    <div class="mb-3">
                        <label for="signup-username" class="form-label">Username</label>
                        <input type="text" name="signup-username" class="form-control form-control-lg bg-light fs-6" autocomplete="off">
                    </div>

                    <div class="mb-3">
                        <label for="signup-password" class="form-label">Password</label>
                        <input type="password" name="signup-password" class="form-control form-control-lg bg-light fs-6" autocomplete="off">
                    </div>

                    <div class="mb-3">
                        <label for="signup-reenter" class="form-label">Re-enter Password</label>
                        <input type="password" name="signup-reenter" class="form-control form-control-lg bg-light fs-6" autocomplete="off">
                    </div>

                    <div class="mb-3">
                        <button type="submit" name="save_user" class="btn btn-lg btn-primary w-100 fs-6">Signup</button>
                    </div>

                    <div class="row">
                        <small>Already have an account? <a href="../index.php">Login</a></small>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>