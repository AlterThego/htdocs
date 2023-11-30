<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">  -->
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    
    <title>Dashboard</title>
</head>

<body>
    <div class="container">
        <aside>
            <div class="top">
                <div class="logo">
                    <img src="../images/logo.jpg" alt="logo">
                    <h2>BENGUET <span class="danger">LIVESTOCK</span></h2>
                </div>
                <div class="close" id="close-btn">
                    <span class="material-icons-sharp">close</span>
                </div>
            </div>
            <div class="sidebar">
                <a href="dashboard.html"  >
                    <span class="material-icons-sharp">grid_view</span>
                    <h3>Dashboard</h3>
                </a>
                <a href="poultry/poultry.html"class="active">
                    <span class="material-icons-sharp">egg</span>
                    <h3>Poultry</h3>
                </a>
                <a href="orders/orders.html">
                    <span class="material-icons-sharp">agriculture</span>
                    <h3>Livestock</h3>
                </a>
                <a href="#">
                    <span class="material-icons-sharp">agriculture</span>
                    <h3>Multiplier Farms</h3>
                </a>
                <a href="#">
                    <span class="material-icons-sharp">mail_outline</span>
                    <h3>Messages</h3>
                    
                </a>
                <a href="#">
                    <span class="material-icons-sharp">inventory</span>
                    <h3>Products</h3>
                </a>
                <a href="#">
                    <span class="material-icons-sharp">report_gmailerrorred</span>
                    <h3>Reports</h3>
                </a>
                <a href="#">
                    <span class="material-icons-sharp">settings</span>
                    <h3>Settings</h3>
                </a>
                <a href="#">
                    <span class="material-icons-sharp">add</span>
                    <h3>Add product</h3>
                </a>
                <a href="#">
                    <span class="material-icons-sharp">logout</span>
                    <h3>Logout</h3>
                    <span class="message-count">26</span>
                </a>
            </div>
        </aside>

        
        <main>
            <h1>Poultry Population</h1>
            <?php include 'index.php'; ?>
            
        </main>
        

        <div class="right">
            <div class="top">
                <button id="menu-btn">
                    <span class="material-icons-sharp">menu</span>
                </button>
                <div class="theme-toggler">
                    <span class="material-icons-sharp active">light_mode</span>
                    <span class="material-icons-sharp">dark_mode</span>
                </div>
                <div class="profile">
                    <div class="info">
                        <p>Hey, <b>Admin</b></p>
                    </div>
                    <div class="profile-photo">
                        <img src="../images/logo.jpg" alt="profile">
                    </div>
                </div>
            </div>
            <div class="recent-updates">
                <h2>Recent Updates</h2>
                <div class="updates">
                    <div class="update">
                        <div class="profile-photo">
                            <img src="../images/logo.jpg">
                        </div>
                        <div class="message">
                            <p><b>Mike Tyson</b> received his order of Night lion..</p>
                            <small class="text-muted">2 Minutes Ago</small>
                        </div>
                    </div>
                    <div class="update">
                        <div class="profile-photo">
                            <img src="../images/logo.jpg">
                        </div>
                        <div class="message">
                            <p><b>Mike Tyson</b> received his order of Night lion..</p>
                            <small class="text-muted">2 Minutes Ago</small>
                        </div>
                    </div>
                    <div class="update">
                        <div class="profile-photo">
                            <img src="../images/logo.jpg">
                        </div>
                        <div class="message">
                            <p><b>Mike Tyson</b> received his order of Night lion..</p>
                            <small class="text-muted">2 Minutes Ago</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="sales-analytics">
                <h2>Sales Analytics</h2>
                <div class="item online">
                    <div class="icon">
                        <span class="material-icons-sharp">shopping_cart</span>
                    </div>
                    <div class="right">
                        <div class="info">
                            <h3>Online Orders</h3>
                            <small class="text-muted">Last 24 hours</small>
                        </div>
                        <h5 class="success">+39%</h5>
                        <h3>3849</h3>
                    </div>
                </div>
                <div class="item offline">
                    <div class="icon">
                        <span class="material-icons-sharp">local_mall</span>
                    </div>
                    <div class="right">
                        <div class="info">
                            <h3>Offline Orders</h3>
                            <small class="text-muted">Last 24 hours</small>
                        </div>
                        <h5 class="danger">+78%</h5>
                        <h3>3849</h3>
                    </div>
                </div>
                <div class="item customers">
                    <div class="icon">
                        <span class="material-icons-sharp">person</span>
                    </div>
                    <div class="right">
                        <div class="info">
                            <h3>New Customers</h3>
                            <small class="text-muted">Last 24 hours</small>
                        </div>
                        <h5 class="success">+12%</h5>
                        <h3>3849</h3>
                    </div>
                </div>
                <div class="item add-product">
                    <div>
                        <span class="material-icons-sharp">add</span>
                        <h3>Add Product</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="index.js"></script>
    <script src="https://kit.fontawesome.com/4435a43a8a.js" crossorigin="anonymous"></script>
</body>

</html>