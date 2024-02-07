<?php
include('config.php');
if (isset($_POST['user_registration'])) {
  $user_fname = $_POST['user_fname'];
  $user_lname = $_POST['user_lname'];
  $user_email = $_POST['user_email'];
  $user_phone = $_POST['user_phone'];
  $user_age = $_POST['user_age'];
  $user_blood = $_POST['user_blood'];
  $user_pass = $_POST['user_pass'];
  $user_cpass = $_POST['user_cpass'];
  $user_gender = $_POST['user_gender'];

  $check_existing_query = "SELECT * FROM user_info WHERE user_email='$user_email'";
  $check_existing = mysqli_query($conn, $check_existing_query);

  if ($check_existing) {
      if (mysqli_num_rows($check_existing) > 0) {
          $account_error = "Already have an account"; 
      } else {
          //$password_hash=password_hash($user_pass,PASSWORD_BCRYPT);
          $sql = "INSERT INTO user_info(user_fname,user_lname,user_email,user_phone,user_age,user_blood,user_pass,user_gender, user_blocked)
                    VALUES ('$user_fname', '$user_lname','$user_email', '$user_phone', '$user_age', '$user_blood', '$user_pass', '$user_gender', 'No')";

          if (mysqli_query($conn, $sql)) {
              $success = 'Registration Successful';

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
    <title>log in or registration - MediGuard</title>
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
  <div class="regform container">
    <div class="title">Registration</div>
    <div class="content">
      <div style="align:center; color:red;">
          <?php if (isset($account_error)) echo $account_error; ?>
      </div>
      <div style="align:center; color:Green;">
          <?php if (isset($success)) echo $success; ?>
      </div>
      <form onsubmit="return validatePassword()" action="" Method="POST">
        <div class="user-details">
          <div class="input-box">
            <span class="details">First Name</span>
            <input type="text" name="user_fname" placeholder="Enter your first name" required>
          </div>
          <div class="input-box">
            <span class="details">Last Name</span>
            <input type="text" name="user_lname" placeholder="Enter your last name" required>
          </div>
          <div class="input-box">
            <span class="details">Email</span>
            <input type="email" name="user_email" placeholder="Enter your email" required>
          </div>
          <div class="input-box">
            <span class="details">Phone Number</span>
            <input type="text" name="user_phone" placeholder="Enter your number" required>
          </div>
          <div class="input-box">
            <span class="details">Age</span>
            <input type="text" name="user_age" placeholder="Enter your age in year" required>
          </div>
          <div class="input-box">
            <span class="details">Blood Group</span>
            <input type="text" name="user_blood" placeholder="Enter your Blood Group" required>
          </div>
          <div class="input-box">
            <span class="details">Password</span>
            <input type="password" id="password" name="user_pass" placeholder="Enter your password" required>
          </div>
          <div class="input-box">
            <span class="details">Confirm Password</span>
            <input type="password" id="confirmPassword" name="user_cpass" placeholder="Confirm your password" required>
            <!-- Password Matching Message -->
            <p id="message" style="color: red;"></p>
          </div>
        </div>



        <div class="gender-details">
          <input type="radio" name="user_gender" id="dot-1" value="Male">
          <input type="radio" name="user_gender" id="dot-2" value="Female">
          <input type="radio" name="user_gender" id="dot-3" value="Prefer not to say">
          <span class="gender-title">Gender</span>
          <div class="category">
            <label for="dot-1">
            <span class="dot one"></span>
            <span class="gender">Male</span>
          </label>
          <label for="dot-2">
            <span class="dot two"></span>
            <span class="gender">Female</span>
          </label>
          <label for="dot-3">
            <span class="dot three"></span>
            <span class="gender">Prefer not to say</span>
            </label>
          </div>
        </div>



        <div class="button">
          <input type="submit" name="user_registration" value="Register">
        </div>
      </form>
      <div class="login_link">Already have an account? <a href="user_login.php">Login</a></div>
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
    </script>

    <!-- Bootstrap Javascript Link -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>