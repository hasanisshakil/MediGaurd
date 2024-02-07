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
                //$c_validity = $client_info['med_price'];
            }
        }



        if (isset($_GET['save_success'])) {
            $save_success= $_GET['save_success'];
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
    <title>Profile - MediGuard</title>
    <link rel="stylesheet" href="client_profile.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <div class="container emp-profile">
        <div class="row">
            <div class="col-md-4">
                <div class="profile-img">
                    <img class="img-fluid rounded-circle" src="images/user_pic/<?php if(isset($empty_image)){echo $empty_image; } else{echo $user_image;}?>" alt="" />
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
                        <h4 class="text-success">
                            <?php if(isset($save_success)){echo $save_success;} ?>
                        </h4>
                        <h5>
                            <?php echo $user_fname." ".$user_lname;?>
                        </h5>
                        <h6>
                            
                        </h6>

                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">About</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <a href="user_profile_edit.php"><input type="button" class="profile-edit-btn" name="btnAddMore" value="Edit Profile"/></a>
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
                                        <p><?php echo $user_email;?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Phone</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p><?php echo $user_phone;?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Gender</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p><?php echo $user_gender;?></p>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Age</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p><?php echo $user_age;?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Blood Group</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p><?php echo $user_blood;?></p>
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
                        </div>
                    </div>      
                </div>
            </div>
        </div>
    </div>     
    <?php include_once("footer.php"); ?>       
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>