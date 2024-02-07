<?php 
    include_once('config.php');
    include_once('client.php');

    if (isset($_SESSION['client_id'])) {
        $client_id= $_SESSION['client_id'];
    }

    /* Manual Medicne add Section Starts */
    if (isset($_POST['add_medicine'])) {
        $sql= "SELECT * FROM client_info WHERE client_id='$client_id'";
        $run = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($run);
        $med_company= $row['client_company'];
        
        $med_name= $_POST['med_name'];
        $med_mg= $_POST['med_mg'];
        $med_price= $_POST['med_price'];
        $med_expiry= $_POST['med_expiry'];
        $med_qr_code= $_POST['med_qr_code'];
        $med_type=$_POST['med_type'];
        //Med Image Upload
        if(isset($_FILES['med_image'])){
            $med_image_name= $_FILES['med_image']['name'];
            $med_image_tmp_name=$_FILES['med_image']['tmp_name'];
            move_uploaded_file($med_image_tmp_name, 'images/med_images/'.$med_image_name);


            $add_sql="INSERT INTO medicines(med_name, med_mg, med_type, med_price, med_expiry,med_qr_code,search_count, med_company, client_id, med_image)
                            VALUES('$med_name','$med_mg','$med_type','$med_price','$med_expiry','$med_qr_code', '1', '$med_company', '$client_id', '$med_image_name')";

            $run_add_sql=mysqli_query($conn,$add_sql);
            $success= "Added Successfully";
        } 
    }
    /* Manual Medicne add Section Ends */


    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Medicine - MediGuard</title>
    <link rel="stylesheet" href="login.css" />
    <link rel="stylesheet" href="client_profile.css" />
    <style>
        body{
            background:#ffffff;
            font-family: "Poppins", sans-serif;
        }
        .adding-section{
            width:60%;
            margin:auto;
            margin-top: 80px;
            padding: 0px 20px 20px 20px;
        }
        h2{
            margin: 20px 0;
        }
        .update {
            width: 50%;
            margin: auto;
        }
        .update input[type="submit"] {
            background: #000000;
            border: 2px solid #000000;
            transition: 0;
            justify-content:center;
        }
        .update input[type="submit"]:hover {
            background: #ffffff;
            border: 2px solid #000000;
            color: #000000;
        }
    </style>
</head>
<body>
    <h2 align="center">Enter Your Medicine Info Correctly</h2>
    <div class="container-sm container-md-fluid">
        <p style="font-weight:bold; color:green;">
            <?php if(isset($success)) {echo $success;} ?>
        </p>
        <form action="" Method="POST" enctype="multipart/form-data">
            <div class="txt_field">
                <input name="med_name" type="text" placeholder="Medicine Name" required />
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="txt_field mt-1">
                        <input name="med_mg" type="text" placeholder="Medicine Mg" required />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="txt_field form-group mt-2">
                        <select name="med_type" class="form-select" style="border: none;">
                            <option value="Tablet">Tablet</option>
                            <option value="Capsule">Capsule</option>
                            <option value="Syrup">Syrup</option>
                            <option value="Injection">Injection</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="txt_field mt-2">
                        <input name="med_price" type="text" placeholder="Medicine Price per 10pcs" required />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mt-2 txt_field">
                        <input name="med_expiry" type="text" placeholder="Medicine Expiry Date" required />
                    </div>
                </div>
            </div>
            <div class="txt_field mt-0">
                <input name="med_qr_code" type="text" placeholder="Medicine QR CODE" required />
            </div>
            <div class="form-group text-secondary">
                <label for="medicine image"> &nbsp;Upload Medicine Image: </label>
                <input class="form-control" name="med_image" type="file" accept="image/*" required />
            </div>
            <div class="update">
                <br><input name="add_medicine" type="submit" value="Add Medicine" />
            </div>
        </form>
    </div>
</body>
</html>