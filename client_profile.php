<?php 
    include_once('config.php');
    include_once('client.php');


    if (!isset($_SESSION['client_id'])) {
        header("Location: client_login.php"); // Redirect to the login page if not logged in

    }
    else{
        $client_id= $_SESSION['client_id'];
    }


    $sql= "SELECT * FROM client_info WHERE client_id='$client_id'";

    if($run=mysqli_query($conn,$sql)){
        if($client_info=mysqli_fetch_assoc($run)){
            $c_email = $client_info['client_email'];
            $c_pass = $client_info['client_pass'];
            $c_id = $client_info['client_id'];
            $c_phone = $client_info['client_phone'];
            $c_company = $client_info['client_company'];

            if($client_info['client_logo']){
                $c_logo= $client_info['client_logo'];
            }
            else{
                $empty_image="no-profile-picture.jpg";
            }
            $c_validity = $client_info['client_validity'];
        }
    }


    if (isset($_GET['save_success'])) {
        $save_success= $_GET['save_success'];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - MediGuard</title>
    <link rel="stylesheet" href="client_profile.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <div class="container emp-profile">
        <div class="row">
            <div class="col-md-4">
                <div class="profile-img">
                    <img class="img-fluid rounded-circle" src="images/client_pic/<?php echo $c_logo;?>" alt=""/>
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
                            <?php echo $c_company; ?>
                        </h5>
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">About</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <a href="client_profile_edit.php"><input type="button" class="profile-edit-btn" name="btnAddMore" value="Edit Profile"/></a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <div class="tab-content profile-tab" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>User Id</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p><?php echo $c_id;?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Email</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p><?php echo $c_email;?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Phone</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p><?php echo $c_phone;?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Activation Validity</label>
                                    </div>
                                        <div class="col-md-6">
                                            <p> Till (<?php echo $c_validity; ?>)</p>                                
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Upgrade Validity:</label>
                                    </div>
                                        <div class="col-md-6">
                                            <a href="payment.php?client_email=<?php echo $c_email; ?>&client_company=<?php echo $c_company; ?>">GO FOR UPGRADE VALIDITY</a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>      
                </div>
            </div>
        </div>
    </div>            
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</body>
</html>