<?php
session_start();

?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Modules &rsaquo; DataTables &mdash; Stisla</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="assets/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/modules/fontawesome/css/all.min.css">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="assets/modules/datatables/datatables.min.css">
  <link rel="stylesheet" href="assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css">

  <!-- Template CSS -->
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/components.css">
  <!-- Start GA -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag() { dataLayer.push(arguments); }
    gtag('js', new Date());

    gtag('config', 'UA-94034622-3');
  </script>
  <!-- /END GA -->
</head>

<body>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <form class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i
                  class="fas fa-search"></i></a></li>
          </ul>
        </form>
      </nav>
      <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="index.html">Stisla</a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">St</a>
          </div>
          <ul class="sidebar-menu">
            <li class="menu-header">General</li>
            <li class="dropdown">
              <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Dashboard</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="index.html">General</a></li>
                <li><a class="nav-link" href="index-0.html">Forecast</a></li>
              </ul>
            </li>
            <li class="menu-header">Livestock and Poultry</li>
            <li class="dropdown  active">
              <a href="#" class="nav-link has-dropdown"><i class="fas fa-th"></i> <span>Population</span></a>
              <ul class="dropdown-menu">
                <li class="active"><a class="nav-link" href="poultry-population.html">Poultry Population</a></li>
                <li><a class="nav-link" href="#">Livestock Population</a></li>
              </ul>
            </li>

            <li class="menu-header">Starter</li>
            <li class="dropdown">
              <a href="#" class="nav-link has-dropdown"><i class="fas fa-th"></i> <span>Bootstrap</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="bootstrap-alert.html">Alert</a></li>
                <li><a class="nav-link" href="bootstrap-buttons.html">Buttons</a></li>
                <li><a class="nav-link" href="bootstrap-card.html">Card</a></li>
                <li><a class="nav-link" href="bootstrap-modal.html">Modal</a></li>
              </ul>
            </li>

            <li class="menu-header">Stisla</li>
            <li class="dropdown">
              <a href="#" class="nav-link has-dropdown"><i class="fas fa-th-large"></i> <span>Components</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="components-statistic.html">Statistic</a></li>
                <li><a class="nav-link" href="components-table.html">Table</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="nav-link has-dropdown"><i class="fas fa-plug"></i> <span>Modules</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="modules-chartjs.html">ChartJS</a></li>
                <li><a class="nav-link" href="modules-datatables.html">DataTables</a></li>
                <li><a class="nav-link" href="modules-sparkline.html">Sparkline</a></li>
                <li><a class="nav-link" href="modules-sweet-alert.html">Sweet Alert</a></li>
                <li><a class="nav-link" href="modules-toastr.html">Toastr</a></li>
              </ul>
            </li>
            <li class="menu-header">Pages</li>
            <li class="dropdown">
              <a href="#" class="nav-link has-dropdown"><i class="far fa-user"></i> <span>Auth</span></a>
              <ul class="dropdown-menu">
                <li><a href="auth-forgot-password.html">Forgot Password</a></li>
                <li><a href="auth-login.html">Login</a></li>
                <li><a href="auth-register.html">Register</a></li>
                <li><a href="auth-reset-password.html">Reset Password</a></li>
              </ul>
            </li>
          </ul>



          <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <a href="https://getstisla.com/docs" class="btn btn-primary btn-lg btn-block btn-icon-split">
              <i class="fas fa-rocket"></i> Documentation
            </a>
          </div>
        </aside>
      </div>

      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Poultry Population</h1>
          </div>

          <div class="section-body">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Poultry Population</h4>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped" id="table-1">
                        <thead>
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
                                  <button class="btn btn-update btn-success btn-sm center" data-toggle="modal"
                                    data-target="#updateModal" data-id="<?php echo $row['poultry_type_id']; ?>"
                                    data-type="<?php echo $row['poultry_type_name']; ?>"
                                    data-count="<?php echo $row['count']; ?>"
                                    data-date="<?php echo $row['date_updated']; ?>">
                                    Update
                                  </button>

                                </td>
                                <td class="text-center">
                                  <form action="code.php" method="post">
                                    <input type="hidden" name="id" value="<?php echo $row['poultry_type_id']; ?>">
                                    <button type="button" class="btn btn-danger btn-delete btn-sm" data-toggle="modal"
                                      data-target="#deleteConfirmationModal">
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
            </div>
          </div>

          <?php include 'modal.php'; ?>
        </section>
      </div>
      <footer class="main-footer">
        <div class="footer-left">
          Copyright &copy; 2018 <div class="bullet"></div> Design By <a href="https://nauval.in/">Muhamad Nauval
            Azhar</a>
        </div>
        <div class="footer-right">

        </div>
      </footer>
    </div>
  </div>

  <!-- General JS Scripts -->
  <script src="assets/modules/jquery.min.js"></script>
  <script src="assets/modules/popper.js"></script>
  <script src="assets/modules/tooltip.js"></script>
  <script src="assets/modules/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
  <script src="assets/modules/moment.min.js"></script>
  <script src="assets/js/stisla.js"></script>

  <!-- JS Libraies -->
  <script src="assets/modules/datatables/datatables.min.js"></script>
  <script src="assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
  <script src="assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js"></script>
  <script src="assets/modules/jquery-ui/jquery-ui.min.js"></script>

  <!-- Page Specific JS File -->
  <script src="assets/js/page/modules-datatables.js"></script>

  <!-- Template JS File -->
  <script src="assets/js/scripts.js"></script>
  <script src="assets/js/custom.js"></script>

</body>

</html>