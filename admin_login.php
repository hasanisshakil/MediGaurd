<?php
session_start();

include_once('config.php');

if (isset($_SESSION['admin_id'])) {
    header("Location: admin_dashboard.php");
}

if (isset($_POST['admin_login'])) {
    $admin_email = $_POST['admin_email'];
    $admin_pass = $_POST['admin_pass'];

    $query = "SELECT admin_id, admin_name, admin_pass FROM admin_info WHERE admin_email = ?";
    $run = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($run, "s", $admin_email);

    if (mysqli_stmt_execute($run)) {
        $result = mysqli_stmt_get_result($run);

        if ($admin_data = mysqli_fetch_assoc($result)) {
            if ($admin_pass === $admin_data['admin_pass']) {
                $_SESSION['admin_id'] = $admin_data['admin_id'];
                $_SESSION['admin_name'] = $admin_data['admin_name'];
                header("Location: admin_dashboard.php");

            } else {
                $login_error = "Invalid password";
            }
        } else {
            $login_error = "admin not found";
        }
    } else {
        $login_error = "Database query error"; // Handle the database error appropriately
    }
}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8" />
    <link rel="shortcut icon" href="images/Medilogy_Fav.png" type="image/x-icon">
    <link rel="stylesheet" href="login.css" />
    <title>Login - MediGuard</title>
  </head>
  <body style="background: #82a599;">
    <div class="center">
      <h1>Admin Login</h1>
      <form method="post">
        <div class="txt_field">
          <input name="admin_email" type="text" required />
          <span></span>
          <label>Email</label>
        </div>
        <div class="txt_field">
          <input name="admin_pass" type="password" required />
          <span></span>
          <label>Password</label>
        </div>
        <input name="admin_login" type="submit" value="Login" />
        <br> <br>

        <?php if (isset($login_error)) { ?>
            <p style="color: red; text-align:center;">
              <?php echo $login_error; ?>
            </p>
        <?php } ?>
      </form>
    </div>
  </body>
</html>
