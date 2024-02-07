<?php 
    include_once('config.php');
    include_once('admin.php');

    if(isset($_GET['c_id']) && isset($_GET['client_company'])){
        $c_id= $_GET['c_id'];
        $client_company= $_GET['client_company'];
    }


    $sql= "SELECT * FROM client_info WHERE client_id='$c_id'";

    if($run=mysqli_query($conn,$sql)){
        if($client_info=mysqli_fetch_assoc($run)){
            $c_email = $client_info['client_email'];
            $c_phone = $client_info['client_phone'];
            $c_company = $client_info['client_company'];

            if($client_info['client_logo']){
                $c_logo= $client_info['client_logo'];
            }
            else{
                $c_logo="no-profile-picture.jpg";
            }
            $c_validity = $client_info['client_validity'];


            if(isset($_POST['update_client_info'])){
                $new_c_email = $_POST['new_c_email'];
                $new_c_phone = $_POST['new_c_phone'];
                $new_c_company = $_POST['new_c_company'];
                $new_c_validity = $_POST['new_c_validity'];


                $update_sql = "UPDATE client_info SET client_email = '$new_c_email', 
                                client_phone = '$new_c_phone', client_company='$new_c_company',
                                client_validity= '$new_c_validity' WHERE client_id = '$c_id'";
                $run_update_sql=mysqli_query($conn,$update_sql);
                if($run_update_sql){
                    $message="Update Successfully";
                    echo "<script>window.location.href='client_list.php?update=". urlencode($message) ."'</script>";
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
    <title>Update Client Info - MediGuard</title>
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
            <img class="img-fluid rounded-circle" src="images/client_pic/<?php echo $c_logo;?>" alt="" width="200px" height="200px">
        </div>
        <h2>Edit Client Information</h2>
        <form method="POST">
            <div class="form-group">
                <label for="clientEmail">Email Address</label>
                <input type="email" class="form-control my-2" id="clientEmail" name="new_c_email" value="<?php echo $c_email; ?>">
            </div>
            <div class="form-group">
                <label for="clientPhone">Phone Number</label>
                <input type="tel" class="form-control my-2" id="clientPhone" name="new_c_phone" value="<?php echo $c_phone; ?>">
            </div>
            <div class="form-group">
                <label for="clientAddress">Company</label>
                <input type="tel" class="form-control my-2" id="clientPhone" name="new_c_company" value="<?php echo $c_company; ?>">
            </div>
            <div class="form-group">
                <label for="clientAddress">Validity</label>
                <input type="tel" class="form-control my-2" id="clientPhone" name="new_c_validity" value="<?php echo $c_validity; ?>">
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-dark my-2" name="update_client_info">Save</button>
            </div>
        </form>
    </div>
</body>
</html>