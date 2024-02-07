<?php
include_once('config.php');
include_once('client.php');

if (isset($_SESSION['client_id'])) {
    $client_id = $_SESSION['client_id'];
}

if (isset($_GET['med_id'])) {
    $med_id = $_GET['med_id'];

    // Retrieve the medicine details based on the medicine_id
    $sql = "SELECT * FROM medicines WHERE client_id = '$client_id' AND med_id = '$med_id' ";
    $result = mysqli_query($conn, $sql);

    if ($medicine =mysqli_fetch_assoc($result)) {
        $med_id = $medicine['med_id'];
        $med_name = $medicine['med_name'];
        $med_mg = $medicine['med_mg'];
        $med_price = $medicine['med_price'];
        $med_expiry = $medicine['med_expiry'];
        $med_company = $medicine['med_company'];
        $med_qr_code = $medicine['med_qr_code'];
        $med_image_name = $medicine['med_image'];
    } else {
        // Handle the case where the medicine doesn't exist or doesn't belong to the client.
        // You can redirect or display an error message as needed.
    }
}

if (isset($_POST['update_medicine'])) {
    // Handle the form submission to update the medicine details
    $new_med_name = $_POST['new_med_name'];
    $new_med_mg = $_POST['new_med_mg'];
    $new_med_price = $_POST['new_med_price'];
    $new_med_expiry = $_POST['new_med_expiry'];
    $new_med_qr_code = $_POST['new_med_qr_code'];
    $new_med_type = $_POST['new_med_type'];
    if (isset($_FILES['new_med_image']) && $_FILES['new_med_image']['error'] === UPLOAD_ERR_OK) { //Checks there is no erro/everything is fine(OK)
        $new_med_image_name= $_FILES['new_med_image']['name'];
        $med_image_tmp_name=$_FILES['new_med_image']['tmp_name'];
        move_uploaded_file($med_image_tmp_name, 'images/med_images/'.$new_med_image_name);

        $update_sql = "UPDATE medicines SET med_name = '$new_med_name', med_mg = '$new_med_mg', 
            med_type='$new_med_type', med_price = '$new_med_price', med_expiry = '$new_med_expiry', 
            med_image='$new_med_image_name' WHERE med_id = '$med_id'";
    }else {
        // If no new image is uploaded, update the record without changing the image field.
        $update_sql = "UPDATE medicines SET med_name = '$new_med_name', med_mg = '$new_med_mg', med_type = '$new_med_type', med_price = '$new_med_price', med_expiry = '$new_med_expiry', med_image='$med_image_name' WHERE med_id = '$med_id'";
    }
    
    if(mysqli_query($conn, $update_sql)) {
            $up_success = "Medicine Update successfully.";
            // Redirect to the medicine list page after successful update
            echo "<script>window.location.href='medicine_list.php?up_success=". urlencode($up_success) ."'</script>";
            exit;
        } 
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Medicine - MediGuard</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@700&family=Poppins:wght@400;500;600&display=swap">


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="text-end mt-3">
            <a class="btn btn-light btn-outline-dark btn-sm fw-bold" href="medicine_list.php">
                Go To Medicine List
                <i class="fa fa-arrow-circle-left" aria-hidden="true"></i>
            </a>
        </div>
        <h1 class="mt-5 text-center">Edit Medicine</h1>
        <div class="row mt-3">
            <div class="col-md-6 offset-md-3">
                <form method="POST" enctype="multipart/form-data">
                    <div class="form-group ">
                        <label for="new_med_name">Medicine Name:</label>
                        <input type="text" class="form-control" name="new_med_name" value="<?php echo $med_name; ?>">
                    </div>
                    <div class="form-group">
                        <br>
                        <label for="new_med_mg">MG:</label>
                        <input type="text" class="form-control" name="new_med_mg" value="<?php echo $medicine['med_mg']; ?>">
                    </div>
                    <div class="form-group">
                        <br>
                        <label for="new_med_type">Type:</label>
                        <select name="new_med_type" class="form-control form-select">
                            <option value="Tablet">Tablet</option>
                            <option value="Capsule">Capsule</option>
                            <option value="Syrup">Syrup</option>
                            <option value="Injection">Injection</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <br>
                        <label for="new_med_price">Price:</label>
                        <input type="text" class="form-control" name="new_med_price" value="<?php echo $medicine['med_price']; ?>">
                    </div>
                    <div class="form-group">
                    <br>
                        <label for="new_med_expiry">Expiry Date:</label>
                        <input type="text" class="form-control" name="new_med_expiry" value="<?php echo $medicine['med_expiry']; ?>">
                    </div>
                    <div class="form-group">
                    <br>
                        <label for="new_med_qr_code">Medicine QR CODE:</label>
                        <input type="text" class="form-control" name="new_med_qr_code" value="<?php echo $medicine['med_qr_code']; ?>">
                    </div>
                    <div class="form-group">
                    <br>
                        <label for="new_med_image">Medicine Image:</label>
                        <input type="file" class="form-control" name="new_med_image" accept="image/*">
                    </div>
                    <br>
                    <div class="text-center">
                        <button type="submit" name="update_medicine" class="btn btn-primary mx-auto">Update Medicine</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>