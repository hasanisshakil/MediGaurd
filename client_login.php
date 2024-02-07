<?php
session_start();

include_once('config.php');

if (isset($_SESSION['client_id'])) {
    header("Location: client_dashboard.php");
}

if (isset($_POST['client_login'])) {
    $client_email = $_POST['client_email'];
    $client_pass = $_POST['client_pass'];

    $query = "SELECT * FROM client_info WHERE client_email='$client_email'";
    $run = mysqli_query($conn, $query);
    $client_data = mysqli_fetch_assoc($run);

    if (mysqli_num_rows($run) > 0){
      if($client_data['client_approve'] === 'Yes'){
          if ($client_pass === $client_data['client_pass']) {
            $_SESSION['client_id'] = $client_data['client_id'];
            $_SESSION['client_name'] = $client_data['client_name'];
            header("Location: client_dashboard.php");
            exit;
          } 
          else {
            $login_error = "Invalid password";
          }
      }
      else{
            $login_error = "You Are Not Approved by Admin";
          }
    } 
    else{
        $login_error = "Not found";
    }
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="login.css" />
    <link rel="shortcut icon" href="images/Medilogy_Fav.png" type="image/x-icon">
    <title>Client Login Form</title>
  </head>
  <body>
  <div>
    <a href="index.php" class="navbar-brand">
      <img src="images/Mediguard_logo.png" height="45" width="30%" alt="CoolBrand">
    </a>
  </div>
    <div class="center">
      <h1>Client Login</h1>
      <form method="post">
        <div class="txt_field">
          <input name="client_email" type="email" required />
          <span></span>
          <label>Email</label>
        </div>
        <div class="txt_field">
          <input name="client_pass" type="password" required />
          <span></span>
          <label>Password</label>
        </div>
        <input name="client_login" type="submit" value="Login" />
        <br> <br>

        <?php if (isset($login_error)) { ?>
            <p style="color: red; text-align:center;">
              <?php echo $login_error; ?>
            </p>
        <?php } ?>
      </form>
      <div class="signup_link">Not a client? <a href="client_registration.php">Signup</a></div>
    </div>
  </body>
</html>
