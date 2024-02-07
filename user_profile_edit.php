<?php 
    include_once('config.php');
    include_once('header.php');


    if (isset($_SESSION['user_id'])) {
        $user_id= $_SESSION['user_id'];



    $sql= "SELECT * FROM user_info WHERE user_id='$user_id'";

    if($run=mysqli_query($conn,$sql)){
        if($user_info=mysqli_fetch_assoc($run)){
            $user_fname = $user_info['user_fname'];
            $user_lname = $user_info['user_lname'];
            $user_email = $user_info['user_email'];
            $user_phone = $user_info['user_phone'];
            $user_age = $user_info['user_age'];
            $user_blood = $user_info['user_blood'];
            $user_gender = $user_info['user_gender'];
            $user_date = $user_info['user_reg_date'];


            if($user_info['user_image']){
                $user_image= $user_info['user_image'];
            }
            else{
                $empty_image="no-profile-picture.jpg";
            }

            if(isset($_POST['update_profile'])){
                $new_user_email = $_POST['new_user_email'];
                $new_user_phone = $_POST['new_user_phone']; 
                $new_user_age = $_POST['new_user_age'];
                $new_user_blood = $_POST['new_user_blood'];


                if (isset($_FILES['change_photo']) && $_FILES['change_photo']['error'] === UPLOAD_ERR_OK) { //Checks there is no erro/everything is fine(OK)
                    $change_photo_name= $_FILES['change_photo']['name'];
                    $change_photo_tmp_name=$_FILES['change_photo']['tmp_name'];
                    move_uploaded_file($change_photo_tmp_name, 'images/user_pic/'.$change_photo_name);
            
                    $save_sql = "UPDATE user_info SET user_image= '$change_photo_name', user_email = '$new_user_email', user_phone = '$new_user_phone',
                                    user_age = '$new_user_age', user_blood = '$new_user_blood' WHERE user_id = '$user_id'";
                }else {
                    // If no new image is uploaded, update the record without changing the image field.
                    $save_sql = "UPDATE user_info SET user_email = '$new_user_email', user_phone = '$new_user_phone', 
                                user_age = '$new_user_age', user_blood = '$new_user_blood' WHERE user_id = '$user_id'";
                }
                
                if(mysqli_query($conn, $save_sql)) {
                        $save_success = "Saved successfully";
                        // Redirect to the medicine list page after successful update
                        echo "<script>window.location.href='user_profile.php?save_success=". urlencode($save_success) ."'</script>";
                }
            }

        }
    }
    }
    else{
        header("Location: index.php"); // Redirect to the same page
        exit;
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile - MediGuard</title>
    <link rel="stylesheet" href="client_profile.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <div class="container emp-profile">
        <div class="row">
                <div class="col-md-4">
                <form method="post" enctype="multipart/form-data">
                    <div class="profile-img">
                        <img class="img-fluid rounded-circle" src="images/user_pic/<?php if(isset($empty_image)){echo $empty_image; } else{echo $user_image;}?>" alt=""/>
                    </div>
                    <div class="text-center">
                        <h6 class="text-primary">Want To change profile Photo?</h6>
                        <input type="file" name="change_photo" class="form-control" accept="image/*">
                        <!--<button type="submit" name="update_photo" class="btn btn-primary mx-auto">Change Photo</button> -->
                    </div>
                    <!--<div class="col-md-4">    
                        <div class="profile-work">
                            <p>WORK LINK</p>
                            <a href="">Website Link</a><br/>
                            <a href="">Bootsnipp Profile</a><br/>
                            <a href="">Bootply Profile</a>
                            <p>SKILLS</p>
                            <a href="">Web Designer</a><br/>
                            <a href="">Web Developer</a><br/>
                            <a href="">WordPress</a><br/>
                            <a href="">WooCommerce</a><br/>
                            <a href="">PHP, .Net</a><br/>
                        </div> 
                    </div>-->
                </div>
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-8 profile-head">
                            <h5>
                                <?php echo $user_fname." ".$user_lname;?>
                            </h5>
                            <h6>
                                <label>User Id : <?php echo $user_id; ?> </label>
                            </h6>
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">About</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <a href="user_profile.php"><input type="button" class="profile-edit-btn" name="btnAddMore" value="Profile"/></a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="tab-content profile-tab" id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Name</label>
                                        </div>
                                        <div class="col-md-6">
                                            <p><?php echo $user_fname." ".$user_lname;?></p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Email</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" name="new_user_email" value="<?php echo $user_email;?>">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Phone</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" name="new_user_phone" value="<?php echo $user_phone;?>">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Age</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" name="new_user_age" value="<?php echo $user_age;?>">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Blood Group</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" name="new_user_blood" value="<?php echo $user_blood;?>">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Activation Date</label>
                                        </div>
                                            <div class="col-md-6">
                                                <p><?php echo $user_date;?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center row w-80 mx-auto">
                                        <button type="submit" name="update_profile" class="btn btn-primary mx-auto">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>      
                    </div>
                </form>
                </div>
            
        </div>
    </div> 
    <?php include_once("footer.php"); ?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>