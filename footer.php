<?php
    include_once('config.php');

    if (isset($_SESSION['user_id'])){
        $user_id = $_SESSION['user_id'];

        //To display The Profile name in footer section
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="Medilogy Fav.png" type="image/x-icon">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <style>
        a {
            text-decoration: none;
        }
        .footer_color {
            background-color: #447061;
            padding: 30px 0;
        }
        .container ul li a:hover{
            text-decoration: underline;
        }
        .size {
            font-size: 14px;
        }
    </style>
</head>
<body>
    <footer class="footer_color">
        <div class="container">
            <div class="row">
                <div class="col-md-4 my-auto text-white fs-5">
                    <h5 class="fs-5 text-center">MediGuard</h5>
                    <p class="size" style="text-align: justify;">
                        Explore reliable medication authentication on our web platform. 
                        Scan QR codes effortlessly to ensure pharmaceutical product authenticity, 
                        empowering both healthcare professionals and patients. Join us in advancing 
                        medication security for a safer healthcare experience.
                    </p>
                </div>
                <div class="col-md-4">
                    <h5 class="border-bottom text-end text-white">Quick Links</h5>
                    <ul class="list-unstyled text-end">
                        <li><a href="index.php" class="text-white size">Home</a></li>
                        <li><a href="about_us.php" class="text-white size">About Us</a></li>
                        <li><a href="contact_us.php" class="text-white size">Contact Us</a></li>
                        <li><a href="blog.php" class="text-white size">Blog</a></li>
                        <li><a href="privacy_policy.php" class="text-white size">Privacy Policy</a></li>
                        <li><a href="terms_and_conditions.php" class="text-white size">Terms and Conditions</a></li>
                        <li><a href="client_registration.php" class="text-white size" target="_blank">Become Our Client</a></li>
                        <li><a href="client_login.php" class="text-white size" target="_blank">Client Login</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5 class="border-bottom text-end text-white">Contact Us</h5>
                    <address class="text-white size text-end">
                        <h6 >Address</h6>
                        <p>&emsp;Daffodil Smart City, Birulia, Savar, Dhaka-1216</p>
                        <h6>Hotline</h6>
                        <p>&emsp;+88 017xx xxx xxx</p>
                    </address>
                </div>
            </div>
            <div class="text-center mt-3">
                <p>MediGuard &copy; 2023</p>
            </div>
        </div>
    </footer>
</body>
</html>