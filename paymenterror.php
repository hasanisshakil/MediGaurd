<?php
include_once('config.php');

  if(!isset($_GET['client_email'])){
    header("location:client_registration.php");
  }

  if(isset($_GET['client_email'])){
    $client_email= $_GET['client_email'];
  }
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title>Payment Error - MediGuard</title>
    <link rel="stylesheet" href="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="images/Medilogy_Fav.png" type="image/x-icon">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


    <style>
      body {
        background: linear-gradient(135deg,   #e6e5c1, #447061);
        height: 100vh;
      }
      .row{
        height: 100vh;
      }
      .golink{
        background: #447061;
        color: #ffffff;
      }
    </style>
  </head>
  <body>
    <div class="container">
        <div class="row d-flex align-items-center">
          <div class="col-md-4 "></div>

          <div class="col-md-4 bg-light p-3 rounded-3">
              <p class="text-justify">Dear  <b class="text-primary"><?php  echo $client_email; ?></b>, You have submitted a payment request already. For any query please contact <b>01684181154</b>.</p>
              <div class="text-center">
                  <a class="btn golink" href="client_registration.php"> Go to Registration Page</a>
              </div>
          </div>
          <div class="col-md-4 "></div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>