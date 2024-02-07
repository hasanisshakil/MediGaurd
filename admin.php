<?php
    include_once('config.php');
    session_start();
    if (!isset($_SESSION['admin_id'])) {
        header("Location:admin_login.php"); // Redirect to the login page if not logged in
        exit();
    }
    if(isset($_SESSION['admin_id'])){
        $admin_id = $_SESSION['admin_id'];
        $sql_admin_info = "SELECT * FROM admin_info WHERE admin_id='$admin_id'";
        if($run=mysqli_query($conn,$sql_admin_info)){
            if($admin_info=mysqli_fetch_assoc($run)){
                $a_name = $admin_info['admin_name'];
            }
        }
    }


    //Notification 
    $limit= 3;
    $sql= "SELECT * FROM client_info WHERE client_approve='No' ORDER BY client_id DESC LIMIT $limit";
    $run=mysqli_query($conn,$sql);
    
    $notifications = [];

    while ($notifications_row = mysqli_fetch_assoc($run)) {
        $notifications[] = $notifications_row;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="images/Medilogy_Fav.png" type="image/x-icon">
    
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@700&family=Poppins:wght@400;500;600&display=swap">


    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
    <style>
        *{
            font-family: "Poppins", sans-serif;
        }
        .active {
            font-weight: bold;
        }
        .dropdown:hover .dropdown-menu {
            display: block; 
        }

    </style>
</head>
<body>
<!-- Header section starts -->
<div class="header bg-dark">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fw-bold ">
        <div class="container-fluid bg-dark">
            <a href="admin_dashboard.php" class="navbar-brand">
                <img class="navbar-logo w-auto" src="images/Mediguard_logo.png" height="30" alt="CoolBrand">
            </a>
            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto">
                    <!-- Admin Dashboard Menu-->
                    <a href="admin_dashboard.php" class="nav-item nav-link <?php echo basename($_SERVER['PHP_SELF']) === 'admin_dashboard.php' ? 'active' : ''; ?>">Dashboard</a>
                    

                    <!-- Notification -->
                    <div class="dropdown">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item dropleft">
                                <a class="nav-link" 
                                    id="profileDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-bell-o" aria-hidden="true"></i>
                                    Notification
                                </a>
                                <div class="dropdown-menu">
                                <?php foreach ($notifications as $notification) { ?>
                                    <a class="dropdown-item"  href="#">
                                        <div class="text-wrap border-bottom">
                                            <p class="" style="font-size: 10px;">
                                                <i class="fa fa-envelope-o" aria-hidden="true"></i>
                                                You have a Registration Request from <b><?php echo $notification['client_company']; ?></b>
                                            </p>
                                        </div>
                                    </a>
                                    <?php } ?>
                                    <a class="dropdown-item text-center text-primary" href="client_list.php">
                                        <span><u>See All</u></span>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                    
                    <!-- Clients Options Dropdown -->
                    <div class="dropdown">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item dropleft">
                                <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) === 'client_list.php' || basename($_SERVER['PHP_SELF']) === 'client_req.php' || basename($_SERVER['PHP_SELF']) === 'client_trash.php') ? 'active' : ''; ?>" 
                                    id="profileDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Clients
                                </a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="client_list.php">
                                        <i class="fa fa-th-list" aria-hidden="true"></i>
                                        Client List
                                    </a>
                                    <a class="dropdown-item" href="client_req.php">
                                        <i class="fa fa-pause" aria-hidden="true"></i>
                                        Client Request
                                    </a>
                                    <a class="dropdown-item" href="client_trash.php">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                        Client Trash List
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>



                    <!-- User Options Dropdown -->
                    <div class="dropdown">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item dropleft">
                                <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) === 'user_list.php' || basename($_SERVER['PHP_SELF']) === 'user_block_list.php') ? 'active' : ''; ?>" 
                                    id="profileDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Users
                                </a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="user_list.php">
                                        <i class="fa fa-th-list" aria-hidden="true"></i>
                                        User List
                                    </a>
                                    <a class="dropdown-item" href="user_block_list.php">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                        Blocked Users
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <!-- User Profile/Login/LogOut Dropdown -->
                        <?php if (isset($_SESSION['admin_id'])): ?>
                            <div class="me-4 dropdown">
                                <ul class="navbar-nav ml-auto me-5">
                                    <li class="nav-item dropleft">
                                        <a class="nav-link" id="profileDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fa fa-user"></i>
                                            <?php if(isset($a_name)){echo $a_name; }?>
                                        </a>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="admin_profile.php">
                                                <i class="fa fa-user-circle"></i>&nbsp;View Profile
                                            </a>
                                            <a class="dropdown-item" href="admin_logout.php">
                                                <i class="fa fa-sign-out"></i>&nbsp;Logout
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        <?php else: ?>
                            <a class="btn ms-md-5 me-md-3 btn-color" href="admin_login.php" role="button">Login</a>
                        <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>
</div>
<!-- Header section Ends -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>