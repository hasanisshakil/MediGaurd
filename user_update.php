<?php 
    include_once('config.php');
    include_once('admin.php');

    if(isset($_GET['user_id'])){
        $user_id= $_GET['user_id'];
    }


    $sql= "SELECT * FROM user_info WHERE user_id='$user_id'";

    if($run=mysqli_query($conn,$sql)){
        if($user_info=mysqli_fetch_assoc($run)){
            $user_fname = $user_info['user_fname'];
            $user_lname = $user_info['user_lname'];
            $user_email = $user_info['user_email'];
            $user_phone = $user_info['user_phone'];
            $user_gender = $user_info['user_gender'];

            if($user_info['user_image']){
                $user_image= $user_info['user_image'];
            }
            else{
                $user_image="no-profile-picture.jpg";
            }
            $user_reg_date = $user_info['user_reg_date'];


            if(isset($_POST['update_user_info'])){
                $new_user_name = $_POST['new_user_name'];
                $new_user_email = $_POST['new_user_email'];
                $new_user_phone = $_POST['new_user_phone'];
                $new_user_gender = $_POST['new_user_gender'];
                $new_user_reg_date = $_POST['user_reg_date'];


                $update_sql = "UPDATE user_info SET user_fname= '$new_user_fname', user_lname= '$new_user_lname',
                                user_email = '$new_user_email', user_phone = '$new_user_phone' user_gender='$new_user_gender',
                                user_reg_date= '$user_reg_date' WHERE user_id = '$user_id'";
                $run_update_sql= mysqli_query($update_sql);
                if($run_update_sql){
                    $message="Update Successfully";
                    header("location:user_list.php?update=$message");
                }
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User Info - MediGuard</title>
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            background-color: #ffffff;
            margin-top: 30px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px 2px #888888; /*hori-offset, v-offset, blur-effect,  blur-spread-radius, color */
            padding: 30px;
        }

        h2 {
            text-align: center;
        }

        .form-group label {
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="text-center">
            <img class="img-fluid rounded-circle" src="images/user_pic/<?php echo $user_image;?>" alt="" width="200px" height="200px">
        </div>
        <h2>Edit User Information</h2>
        <form method="POST">
            <div class="form-group">
                <label for="userName">User First Name</label>
                <input type="text" class="form-control my-2" id="userName" name="new_user_fname" value="<?php echo $user_fname; ?>">
            </div>
            <div class="form-group">
                <label for="userName">User Last Name</label>
                <input type="text" class="form-control my-2" id="userName" name="new_user_lname" value="<?php echo $user_lname; ?>">
            </div>
            <div class="form-group">
                <label for="userEmail">Email Address</label>
                <input type="email" class="form-control my-2" id="userEmail" name="new_user_email" value="<?php echo $user_email; ?>">
            </div>
            <div class="form-group">
                <label for="userPhone">Phone Number</label>
                <input type="tel" class="form-control my-2" id="userPhone" name="new_user_phone" value="<?php echo $user_phone; ?>">
            </div>
            <div class="form-group">
                <label for="userAddress">Gender</label>
                <input type="tel" class="form-control my-2" id="userPhone" name="new_user_gender" value="<?php echo $user_gender; ?>">
            </div>
            <div class="form-group">
                <label for="userAddress">Reg Date</label>
                <input type="tel" class="form-control my-2" id="userPhone" name="user_ac_date" value="<?php echo $user_reg_date; ?>">
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-dark my-2" name="update_user_info">Save</button>
            </div>
        </form>
    </div>
</body>
</html>