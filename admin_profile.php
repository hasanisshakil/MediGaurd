<?php 
    include_once('config.php');
    include_once('admin.php');
    if(isset($_SESSION['admin_id'])){
        $admin_id = $_SESSION['admin_id'];
        $sql= "SELECT * FROM admin_info WHERE admin_id='$admin_id'";
        if (isset($_FILES['change_photo'])) {
            $image_name= $_FILES['change_photo']['name'];
            $image_tmp_name=$_FILES['change_photo']['tmp_name'];
            move_uploaded_file($image_tmp_name, 'images/admin_images/'.$image_name);
        }
        if(isset($_POST['upload'])) {
            $add_sql="UPDATE admin_info SET admin_image='$image_name'";
            $run_add_sql=mysqli_query($conn,$add_sql);
            if ($run_add_sql) {
                $change_pic="Picture Changed";
                echo "<script>window.location.href='admin_profile.php?change_pic=" . urlencode($change_pic) ."';</script>";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
        if($run=mysqli_query($conn,$sql)){
            if($admin_info=mysqli_fetch_assoc($run)){
                $a_name = $admin_info['admin_name'];
                $a_email = $admin_info['admin_email'];
                $a_phone = $admin_info['admin_phone'];
                $a_address = $admin_info['admin_address'];
                if($admin_info['admin_image']){
                    $a_image= $admin_info['admin_image'];
                }
                else{
                    $a_image="no-profile-picture.jpg";
                }
                if(isset($_POST['update_admin_info'])){
                    $new_a_name = $_POST['new_a_name'];
                    $new_a_email = $_POST['new_a_email'];
                    $new_a_phone = $_POST['new_a_phone'];
                    $new_a_address = $_POST['new_a_address'];

                    $update_sql = "UPDATE admin_info SET admin_name = '$new_a_name', admin_email = '$new_a_email'
                                    WHERE admin_id = '$admin_id'";
                    $run_update_sql= mysqli_query($conn, $update_sql);
                    if($run_update_sql){
                        $update="Update Successfully";
                        echo "<script>window.location.href='admin_profile.php?update=". urlencode($update) ."';</script>";
                    }
                }
            }
        }
    }

    if(isset($_GET['change_pic'])){
        $message_pic = $_GET['change_pic'];
    }
    if(isset($_GET['update'])){
        $message_update = $_GET['update'];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - MediGuard</title>
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
        .btn{
            cursor: pointer;
        }
        .form-group label {
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Account Information</h2>
        <hr>
        <div class="row mb-3">
            <div class="text-center col-md-4">
                <img class="img-fluid rounded-circle" src="images/admin_images/<?php echo $a_image;?>" alt="" width="200px" height="200px">
            </div>
            <div class="col-md-8 my-auto text-start">
                <div>
                    <p class="text-success">
                    <?php if(isset($message_pic)){
                            echo $message_pic;
                        }?></p>
                </div>
                <p>Change Profile Picture: </p>
                <form method="POST" action="" enctype="multipart/form-data">
                    <label for="change_photo" class="btn btn-light btn-outline-dark">
                        <input type="file" name="change_photo" id="change_photo" accept="image/*"  required>
                    </label>
                        <input class="btn btn-dark" type="submit" name="upload" value="Save">
                </form>
            </div>
        </div>
        <hr>
        <h2>Edit admin Information</h2>
        <div>
            <p class="text-success">
            <?php if(isset($message_update)){
                    echo $message_update;
                }?></p>
        </div>
        <form method="POST">
            <div class="form-group">
                <label for="adminName">Admin Name</label>
                <input type="text" class="form-control my-2" id="adminName" name="new_a_name" value="<?php echo $a_name; ?>">
            </div>
            <div class="form-group">
                <label for="adminEmail">Email Address</label>
                <input type="email" class="form-control my-2" id="adminEmail" name="new_a_email" value="<?php echo $a_email; ?>">
            </div>
            <div class="form-group">
                <label for="adminPhone">Phone Number</label>
                <input type="tel" class="form-control my-2" id="adminPhone" name="new_a_phone" value="<?php echo $a_phone; ?>">
            </div>
            <div class="form-group">
                <label for="adminAddress">Admin Address</label>
                <input type="tel" class="form-control my-2" id="adminAddress" name="new_a_address" value="<?php echo $a_address; ?>">
            </div>
            <div class="text-center">
                <a href="admin_profile.php" type="submit" class="btn btn-outline-dark my-2" name="update_admin_info">Cancel</a>
                <button type="submit" class="btn btn-dark my-2" name="update_admin_info">Save</button>
            </div>
        </form>
    </div>
</body>
</html>