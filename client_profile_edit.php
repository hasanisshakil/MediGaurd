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
                $c_image= $client_info['client_logo'];
            }
            else{
                $empty_image="no-profile-picture.jpg";
            }
            $c_validity = $client_info['client_validity'];
            if(isset($_POST['update_profile'])){
                $new_c_email = $_POST['new_c_email'];
                $new_c_phone = $_POST['new_c_phone'];


                if (isset($_FILES['change_photo']) && $_FILES['change_photo']['error'] === UPLOAD_ERR_OK) { //Checks there is no erro/everything is fine(OK)
                    $change_photo_name= $_FILES['change_photo']['name'];
                    $change_photo_tmp_name=$_FILES['change_photo']['tmp_name'];
                    move_uploaded_file($change_photo_tmp_name, 'images/client_pic/'.$change_photo_name);
            
                    $save_sql = "UPDATE client_info SET client_logo= '$change_photo_name', client_email = '$new_c_email', client_phone = '$new_c_phone' WHERE client_id = '$c_id'";
                }else {
                    // If no new image is uploaded, update the record without changing the image field.
                    $save_sql = "UPDATE client_info SET client_email = '$new_c_email', client_phone = '$new_c_phone' WHERE client_id = '$c_id'";
                }
                
                if(mysqli_query($conn, $save_sql)) {
                        $save_success = "Saved successfully";
                        // Redirect to the medicine list page after successful update
                        echo "<script>window.location.href='client_profile.php?save_success=". urlencode($save_success) ."'</script>";
                        exit;
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
    <title>Edit Profile - MediGuard</title>
    <link rel="stylesheet" href="client_profile.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>
<body>
    <div class="container emp-profile">
        <div class="row">
                <div class="col-md-4">
                <form method="post" enctype="multipart/form-data">
                    <div class="profile-img">
                        <img class="img-fluid rounded-circle" src="images/client_pic/<?php if(isset($empty_image)){echo $empty_image; } else{echo $c_image;}?>" alt=""/>
                    </div>
                    <div class="text-center">
                        <h6 class="text-primary">Want To change profile Photo?</h6>
                        <input type="file" name="change_photo" class="form-control" accept="image/*">
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-8 profile-head">
                            <h6>
                                <?php echo $c_company; ?>
                            </h6>
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">About</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <a href="client_profile.php"><input type="button" class="profile-edit-btn" name="btnAddMore" value="Profile"/></a>
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

                                    <div class="row mb-2">
                                        <div class="col-md-6">
                                            <label>Email</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" name="new_c_email" value="<?php echo $c_email;?>">
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-md-6">
                                            <label>Phone</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" name="new_c_phone" value="<?php echo $c_phone;?>">
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-md-6">
                                            <label>Activation Validity</label>
                                        </div>
                                            <div class="col-md-6 form-group">
                                                <p> Till (<?php echo $c_validity; ?>)</p>
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
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</body>
</html>