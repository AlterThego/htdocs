<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <!-- CSS -->
    <link rel="stylesheet" href="assets/css/login.css">



    <title>Login | Student Information System</title>
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="row border rounded-5 p-3 bg-white shadow box-area">
            <div class="col-md-12 right-box">
                <form action="/finalexamination/backend/login.php" method="post">
                    <div class="header-text mb-3">
                        <h2>Hello!</h2>
                        <p>Glad you're back.</p>
                    </div>

                    <div class="mb-3">
                        <label for="login-username" class="form-label">Username</label>
                        <input type="text" name="login-username" class="form-control form-control-lg bg-light fs-6"
                            autocomplete="off">
                    </div>

                    <div class="mb-3">
                        <label for="login-p" class="form-label">Password</label>
                        <input type="password" name="login-password" class="form-control form-control-lg bg-light fs-6"
                            autocomplete="off">
                    </div>

                    <div class="mb-3">
                        <button type="submit" name="login_user" class="btn btn-lg btn-primary w-100 fs-6">Login</button>
                    </div>

                    <div class="row">
                        <small>Don't have an account? <a href="contents/signup.php">Signup</a></small>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>