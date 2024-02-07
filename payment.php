<?php
include_once('config.php');
  if(!isset($_GET['client_email'])){
    header("location:client_registration.php");
  }

  if(isset($_GET['client_email'],$_GET['client_company'])){
    $client_email= $_GET['client_email'];
    $client_company= $_GET['client_company'];
    $req_success= isset($_GET['success']) ? $_GET['success']: '';
  }
  if(isset($_POST['submit'])){
    $payment_method= $_POST['payment_method'];
    $wallet_number= $_POST['wallet_number'];
    $transaction_id= $_POST['transaction_id'];

    $check_existing_query = "SELECT * FROM payment_details WHERE client_email='$client_email'";
    $check_existing = mysqli_query($conn, $check_existing_query);
    if ($check_existing) {
        if (mysqli_num_rows($check_existing) > 0) {
          header("Location: paymenterror.php?client_email=$client_email");
        }}

    $sql= "INSERT INTO payment_details(client_email, client_company, payment_method, wallet_number, transaction_id)
            VALUES('$client_email','$client_company','$payment_method', '$wallet_number', '$transaction_id')";
    $run=mysqli_query($conn, $sql);
    header("Location: ThankYou.php?client_email=$client_email&client_company=$client_company");
  }

?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="login.css" />
    <link rel="shortcut icon" href="images/Medilogy_Fav.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
   
    <title>Payment - MediGuard</title>

    <style>
      .center h5{
        text-align: center;
        border-bottom: 1px solid silver;
        width: 90%;
        margin: auto;
        margin-bottom: 10px;
      }
    </style>
  </head>
  <body style="background: #82a599;">
    <p class="center text-white"><?php if(isset($req_success)){ echo  $req_success;} ?></p>
    <div class="center">
      <h1>Payment Option</h1>
      <p class="text-center text-primary">Dear Client, <?php echo $client_email; ?></p>
      <h5>To complete your registration as Clinet<br> Make Payment to this number 017********</h5>

      <form method="POST">
        <div class="payment-details">
            <span class="payment-title mt-5">Payment Method:</span>

            <div class="btn-group" role="group" aria-label="Payment Method">
                <input type="radio" name="payment_method" id="bkash" value="Bkash" class="btn-check" autocomplete="off" required>
                <label class="btn btn-outline-primary payment-option" for="bkash">Bkash</label>

                <input type="radio" name="payment_method" id="rocket" value="Rocket" class="btn-check" autocomplete="off" required>
                <label class="btn btn-outline-primary payment-option" for="rocket">Rocket</label>

                <input type="radio" name="payment_method" id="nagad" value="Nagad" class="btn-check" autocomplete="off" required>
                <label class="btn btn-outline-primary payment-option" for="nagad">Nagad</label>
            </div>
        </div>
        <div class="txt_field">
          <input name="wallet_number" type="text" required />
          <span></span>
          <label>Your Wallet Number</label>
        </div>
        <div class="txt_field">
          <input name="transaction_id" type="text" required />
          <span></span>
          <label>Transaction Id</label>
        </div>

        <input name="submit" type="submit" value="Submit" />
        <br> <br>

      </form>
    </div>
  </body>
</html>