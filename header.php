<?php
    include_once('config.php');
    session_start();
    if (isset($_SESSION['user_id'])){
        $user_id = $_SESSION['user_id'];
        //To display The Profile name in Navbar
        $sql_user_info= "SELECT * FROM user_info WHERE user_id='$user_id'";

        if($run=mysqli_query($conn,$sql_user_info)){
            if($user_info=mysqli_fetch_assoc($run)){
                $user_fname = $user_info['user_fname'];
                $user_lname = $user_info['user_lname'];
            }
        }
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
    <link rel="stylesheet" href="style.css">
    <style>
        *{
            font-family: "Poppins", sans-serif;
        }
        body{
            margin: 0;
        }
        .active {
            font-weight: bold;
        }
        /* Update the background color and text color of the navbar */
        .nav_color {
            background-color: #447061;
        }

        /* If you want to adjust the text color of the navbar links to make them more visible on the new background color, you can add the following CSS */
        .navbar-light .navbar-nav .nav-link {
            color: #fff; /* Change the text color to white or another color that suits your design */
        }

        /* If you want to change the active link color, you can add this CSS */
        .navbar-light .navbar-nav .nav-link.active {
            color: #f00; /* Change the active link color to a different color */
        }


        .custom_hover_link:hover {
            font-weight: bold;
            color: #ffffff; /* Default text color */
            transition: color 0.2s; /* Smooth transition effect */
        }
        .login_btn a {
            background: #ffffff;
            color: #447061;
            font-weight: bold;
        }
        .login_btn i {
            color: #447061;
        }

        .login_btn a:hover{
            border: 1px solid #ffffff;
            background: #447061;
            color: #ffffff;
        }
        .login_btn a:hover i.fa-user {
            color: white;
        }

        .dropdown:hover .dropdown-menu {
            display: block; 
        } 
    </style>
</head>
<body>
<!-- Header section starts -->
<div class="nav_color">
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <a href="index.php" class="navbar-brand">
                <img class="navbar-logo w-auto" src="images/Mediguard_logo.png" height="20" alt="CoolBrand">
            </a>
            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon navi_color"></span> <!-- Change toggler button color here -->
            </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto fs-6">
                        <a href="index.php" class="text-white custom_hover_link nav-item nav-link <?php echo basename($_SERVER['PHP_SELF']) === 'index.php' ? 'active' : ''; ?>">Home</a>
                        <a href="search_med_info.php" class="text-white custom_hover_link nav-item nav-link <?php echo basename($_SERVER['PHP_SELF']) === 'search_med_info.php' ? 'active' : ''; ?>">Search Medicine Info</a>
                        <a href="about_us.php" class="text-white custom_hover_link nav-item nav-link <?php echo basename($_SERVER['PHP_SELF']) === 'about_us.php' ? 'active' : ''; ?>">About Us</a>
                    </div>

                    <div>
                        <?php if(isset($_SESSION['user_id'])):?>
                            <div class="nav-item dropdown">
                                <ul class="navbar-nav ml-auto me-5">
                                    <li class="nav-item dropdown">
                                        <a class="nav-link text-white" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fa fa-user"></i>
                                            <?php if(isset($user_fname)){echo $user_fname; }?>
                                        </a>
                                        <div class="dropdown-menu" style="width: 20%;" aria-labelledby="profileDropdown">
                                            <!-- Add links for profile and log-out -->
                                            <a class="dropdown-item" href="user_profile.php">
                                                <i class="fa fa-user-circle"></i>&nbsp;View Profile
                                            </a>
                                            <a class="dropdown-item" href="user_logout.php" name="logout">
                                                <i class="fa fa-sign-out"></i>&nbsp;Log Out
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        <?php else:?>
                            <div class="login_btn">
                                <a class="btn btn-md ms-md-3 me-md-3" href="user_login.php" role="button">
                                    <i class="fa fa-user"></i>&nbsp;LOGIN
                                </a>
                            </div>
                        <?php endif;?>
                    </div>
                </div>
        </div>
    </nav>
</div>
</body>
</html>