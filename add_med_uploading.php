<?php 
    include_once('config.php');
    include_once('client.php');

    if (isset($_SESSION['client_id'])) {
        $client_id= $_SESSION['client_id'];
    }

        /* File Uploading Section Starts */
        if (isset($_POST['upload_file'])) {
            /*Getting Client info */
            $sql= "SELECT * FROM client_info WHERE client_id='$client_id'";
            $run = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($run);
            $med_company= $row['client_company'];
    
    
    
            if($_FILES['input_file']){
                $file_name = explode(".", $_FILES['input_file']['name']);
                $read_file = fopen($_FILES['input_file']['tmp_name'], 'r');
                $column_headings = fgetcsv($read_file);
    
                while($csv_data= fgetcsv($read_file)){
                    $data = array_combine($column_headings, $csv_data);
    
                    /* $med_id = mysqli_real_escape_string($conn, $data['med_id']); */
                    $med_name= mysqli_real_escape_string($conn, $data['med_name']);
                    $med_mg= mysqli_real_escape_string($conn, $data['med_mg']);
                    $med_type=mysqli_real_escape_string($conn, $data['med_type']);
                    $med_price= mysqli_real_escape_string($conn, $data['med_price']);
                    $med_expiry= mysqli_real_escape_string($conn, $data['med_expiry']);
                    $med_qr_code= mysqli_real_escape_string($conn, $data['med_qr_code']);

                    $med_image = mysqli_real_escape_string($conn, $data['med_image']);
    
                    /*Getting Client medicine info for matching Med existing*/
                    $check_existing_query = "SELECT * FROM medicines WHERE client_id='$client_id' AND med_qr_code= '$med_qr_code'";
                    $check_existing = mysqli_query($conn, $check_existing_query);
                    /* matching Med existing Ends*/

                    if(mysqli_num_rows($check_existing) > 0){
                        $sql = "UPDATE medicines 
                                SET med_name='$med_name', med_mg='$med_mg', med_type='$med_type', med_price='$med_price', med_expiry='$med_expiry', med_qr_code='$med_qr_code', 
                                    med_company='$med_company', med_image='$med_image'
                                WHERE med_qr_code= '$med_qr_code'";
                        $run= mysqli_query($conn, $sql);
                        
                        $message= 'Upload File Succesfully';
    
                        
                    }
                    else{
                        $sql = "INSERT INTO medicines(med_name, med_mg, med_type, med_price, med_expiry, med_qr_code, 
                                search_count, med_company, client_id, med_image)
                                VALUES('$med_name', '$med_mg', '$med_type', '$med_price', '$med_expiry', '$med_qr_code',
                                '1', '$med_company', '$client_id', '$med_image')";
                        $run= mysqli_query($conn, $sql);
    
                        $message= 'Upload File Succesfully';
                    }
                    
                }
    
            }
            else{
                $message= 'Please Upload a CSV,EXCEL File';
            }
        }
        /* File Uploading Section Ends */
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
   
    <title>Add Medicine - MediGuard</title>
    <style>
        body{
            background:#ffffff;
            font-family: "Poppins", sans-serif;
        }
        .steps{
            border: 2px solid #000000;
            width: 80%;
            margin: auto;
            padding: 5px;
        }
    </style>
</head>
<body>
    <h3 class="w-50 m-auto mt-5 text-center">You can upload a bulk amount of medicines at a time. It is time consuming and easy.</h3>
    
    <div class="steps mt-5">
        <p><b>STEP-01: 
            </b> Download the file format by 
            <a href="https://drive.usercontent.google.com/uc?id=1PQoJ7BmD3tkv3jp9GIhYVa8kQTltQIOw&export=download" target="_blank" class="font-weight-bold">clicking over it.</a>
        </p>
        <p><b>STEP-02:
            </b> Update the table rows according to your medicine information.</a>
        </p>
        <p><b>STEP-03:</b> Upload the updated file below and click <b>Import</b>.</p>
    </div>
    
    
    <div class="text-center text-success fw-bold">
        <?php
            if(isset($message)){
                echo $message;
            }
        ?>
    </div>
    
    <div class="steps mt-5 p-3 text-center">
        <form action="" Method="POST" enctype="multipart/form-data">
            <label for="upload-file"> <h3>&nbsp;Upload CSV or EXCEL File:</h3></label> <br>
            <div class="input-group text-secondary justify-content-center">
                <br><input class="border border-dark" id="form1" name="input_file" type="file" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" required />
                <div class="input-group-append">
                    <button class="btn-sm btn-primary border border-dark" type="submit" name="upload_file">Import</button>
                </div>
            </div>
        </form>
    </div>
</body>
</html>