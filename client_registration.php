<?php
session_start();
include('config.php');

if (isset($_SESSION['client_id'])) {
  header("Location: client_dashboard.php");
}
if (isset($_POST['client_registration'])) {
  $client_company = $_POST['client_company'];
  $client_email = $_POST['client_email'];
  $client_phone = $_POST['client_phone'];
  $client_pass = $_POST['client_pass'];
  $client_cpass = $_POST['client_cpass'];
  $comapany_address = $_POST['comapany_address'];

  $check_existing_query = "SELECT * FROM client_info WHERE client_email='$client_email'";
  $check_existing = mysqli_query($conn, $check_existing_query);

  if ($check_existing) {
      if (mysqli_num_rows($check_existing) > 0) {
        $client_data= mysqli_fetch_assoc($check_existing);
        if($client_data['client_approve'] == 'Yes'){
            $account_error = "Already have an account";
        }
        else{
            header("Location: gopayment_step.php?&client_email=$client_email&client_company=$client_company");
        }
        
      } else {
          //$password_hash=password_hash($client_pass,PASSWORD_BCRYPT);
          $sql = "INSERT INTO client_info(client_company,client_email,client_phone,client_pass,comapany_address,client_approve)
                                VALUES ('$client_company','$client_email','$client_phone','$comapany_address','$client_gender', 'No')";

          if (mysqli_query($conn, $sql)) {
                $success = 'Your Request For Registration Is Successful. Now Complete the payment.';
                header("Location: payment.php?success=$success&client_email=$client_email&client_company=$client_company");

          } else {
              echo "Error: " . $sql . "<br>" . mysqli_error($conn);
          }
      }
  } else {
      // Handle database query error
      echo "Error: " . mysqli_error($conn);
  }
}
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title>Registration - MediGuard</title>
    <link rel="stylesheet" href="registration.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
    <link rel="shortcut icon" href="images/Medilogy_Fav.png" type="image/x-icon">
   </head>
<body>
  <div class="container">
    <a href="index.php" class="navbar-brand">
      <img src="images/Mediguard_logo.png" height="45" width="30%" alt="CoolBrand">
    </a>
  </div>
  <div class="regform container mt-3 mb-5">
    <div class="title">For Client Registration</div>
    <div class="content">
      <div style="align:center; color:red;">
          <?php if (isset($account_error)) echo $account_error; ?>
      </div>
      <div style="align:center; color:Green;">
          <?php if (isset($success)) echo $success; ?>
      </div>
      <form onsubmit="return validatePassword()" id="registrationForm" Method="POST">
        <div class="user-details">
          <div class="input-box">
            <span class="details">Company Name</span>
            <input type="text" name="client_company" placeholder="Enter your company name" required>
          </div>
          <div class="input-box">
            <span class="details">Email</span>
            <input type="email" name="client_email" placeholder="Enter your email" required>
          </div>
          <div class="input-box">
            <span class="details">Phone Number</span>
            <input type="text" name="client_phone" placeholder="Enter your number" required>
          </div>
          <div class="input-box">
            <span class="details">Company Address</span>
            <input type="text" name="comapany_address" placeholder="Enter your Comapany Address" required>
          </div>
          <div class="input-box">
            <span class="details">Password</span>
            <input type="password" id="password" name="client_pass" placeholder="Enter your password" required>
          </div>
          <div class="input-box">
            <span class="details">Confirm Password</span>
            <input type="password" id="confirmPassword" name="client_cpass" placeholder="Confirm your password" required>
            <!-- Password Matching Message -->
            <p id="message" style="color: red;"></p>
          </div>
        </div>

        <div class="button">
          <input type="submit" name="client_registration" value="Register">
        </div>
      </form>
      <div class="login_link">Already have an account? <a href="client_login.php">Login</a></div>
    </div>
  </div>




  <script>
        function validatePassword() {
            var password = document.getElementById("password").value;
            var confirmPassword = document.getElementById("confirmPassword").value;

            if (password !== confirmPassword) {
                document.getElementById("message").innerHTML = "Passwords do not match!";
                return false;
            } else {
                document.getElementById("message").innerHTML = "";
                return true;
            }
        }




        function makePayment() {
            var form = document.getElementById('registrationForm');
            var email = form.elements['client_email'].value;
            var name = form.elements['client_name'].value;
            var company = form.elements['client_company'].value;
            form.action = 'payment.php?client_email=' + encodeURIComponent(email) + '&client_name=' + encodeURIComponent(name) + '&client_company=' + encodeURIComponent(company);
    
            form.submit();
        }


        document.getElementById('makePaymentLink').addEventListener('click', function(event) {
            event.preventDefault();
            makePayment();
        });
    </script>

    
</body>
</html>