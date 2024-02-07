<?php 
    include_once('config.php');
    include_once('header.php');

    if(isset($_GET['search_code'])){
        $qr_code = $_GET['qr_code'];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
    <link rel="stylesheet" href="style.css">

    <title>MediGuard</title>


</head>
<body>
    <div class="banner">
        <div class="container">
            <h3>WELCOME TO</h3>
            <div class="row">
                <div class="col-sm-10 col-md-10 col-lg-6 mx-auto">
                    <img src="images/Mediguard_logo.png" height="60px" width="100%" alt="brand_logo">
                </div>
            </div>
            <p>Your Trusted Health Shield</p> <br><br>
            

            <div class="row">
                <div class="col-sm-10 col-md-10 col-lg-8 mx-auto search-box">
                    <form action="authentication_result.php" method="GET">
                        <div class="input-group">
                         
                            <input type="search" id="scannedResult" name="qr_code" class="form-control" placeholder="Enter Scanned QR Code" required/>
                            <div class="input-group-append w-80-sm search_btn">
                                <button class="btn" type="submit" name="search_code">Search</button>
                            </div>
                            <label for="fileInput"  class="custom-file-label ms-2" > </label>
                            <input type="file" id="fileInput" class="custom-file-input" accept="image/*">
                        
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- our clients area-->
    <div class="display-block">
        <?php include_once("index_articles_clients.php"); ?>
    </div>

    <!-- Footer area -->
    <div class="display-block mt-5">
        <?php include_once("footer.php"); ?>
    </div>

    <!-- Bootstrap Javascript Link -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>



     <!-- Scanner  -->
    <script src="jsQR/dist/jsQR.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const fileInput = document.getElementById('fileInput');
            
            const scannedResultInput = document.getElementById('scannedResult');

            fileInput.addEventListener('change', handleFileUpload);

            function handleFileUpload() {
                const file = fileInput.files[0];

                if (file) {
                    const reader = new FileReader();

                    reader.onload = function (e) {
                        const image = new Image();
                        image.src = e.target.result;

                        image.onload = function () {
                            const canvas = document.createElement('canvas');
                            const context = canvas.getContext('2d');
                            canvas.width = image.width;
                            canvas.height = image.height;
                            context.drawImage(image, 0, 0, canvas.width, canvas.height);

                            const imageData = context.getImageData(0, 0, canvas.width, canvas.height);
                            const code = decodeQRCode(imageData);

                            if (code) {
                                // Set the scanned result in the input field
                                scannedResultInput.value = code;
                            } else {
                                // Clear the input field if no QR code is found
                                scannedResultInput.value = '';
                            }
                        };
                    };

                    reader.readAsDataURL(file);
                }
            }

            function decodeQRCode(imageData) {
                try {
                    const code = jsQR(imageData.data, imageData.width, imageData.height);
                    return code ? code.data : null;
                } catch (error) {
                    console.error('Error decoding QR code:', error);
                    return null;
                }
            }
        });
    </script>
</body>
</html>
