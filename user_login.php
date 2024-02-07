<?php
session_start();
include_once('config.php');

if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

if (isset($_POST['user_login'])) {
    $user_email = $_POST['user_email'];
    $user_pass = $_POST['user_pass'];

    $query = "SELECT user_id, user_fname, user_pass FROM user_info WHERE user_email = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $user_email);

    if (mysqli_stmt_execute($stmt)) {
        $result = mysqli_stmt_get_result($stmt);

        if ($user_data = mysqli_fetch_assoc($result)) {
            if ($user_data['user_pass'] == $user_pass) { //Hash Value Noot Workssssssssssss******
                $_SESSION['user_id'] = $user_data['user_id'];
                $_SESSION['user_name'] = $user_data['user_fname'];
                header("Location: index.php");

            } else {
                $login_error = "Invalid password";
            }
        } else {
            $login_error = "User not found";
        }
    } else {
        $login_error = "Database query error"; // Handle the database error appropriately
    }
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>Login & Registration - MediGuard</title>
    <link rel="shortcut icon" href="images/Medilogy_Fav.png" type="image/x-icon">
    <link rel="stylesheet" href="login.css" />
  </head>
  <body>
    <div>
          <a href="index.php" class="navbar-brand">
            <img src="images/Mediguard_logo.png" height="45" width="30%" alt="CoolBrand">
          </a>
    </div>




    <div class="center">
      <h1>Login</h1>
      <form method="POST">
        <div class="txt_field">
          <input name="user_email" type="text" required />
          <span></span>
          <label>Email</label>
        </div>
        <div class="txt_field">
          <input name="user_pass" type="password" required />
          <span></span>
          <label>Password</label>
        </div>
        <div class="pass">Forgot Password?</div>
        <input name="user_login" type="submit" value="Login" />

        <br> <br>

        <?php if (isset($login_error)) { ?>
            <p style="color: red; text-align:center;">
              <?php echo $login_error; ?>
            </p>
        <?php } ?>
      </form>
      <div class="signup_link">Not a member? <a href="registration.php">Signup</a></div>
    </div>
  </body>
</html>
