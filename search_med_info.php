<?php 
    include_once('header.php'); 
    include_once('config.php');
    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Search Medicine Info - - MediGuard</title>
    <link rel="stylesheet" href="login.css">
    <style>
        body{
            background: #ffffff;
        }
        .search-section{
            width:100%;
            margin:auto;
            margin-top: 80px;
            border:#ffffff 5px solid;
            padding: 0px 20px 20px 20px;
        }
        h2{
            margin: 20px 0;
        }

    </style>
</head>
<body>
    <h2 align="center" class="mt-3">Enter Your Medicine Info Correctly</h2>
    <div class="search-section container mb-5">
        <div class="row">
            <div class="col-sm-12 col-md-10 col-lg-10 mx-auto">
                <div class="full-width-div">
                    <form action="search_result.php" method="get">
                            <div class="txt_field">
                                <input type="text" name="med_name" required />
                                <span></span>
                                <label>Enter Medicine Name</label>
                            </div>
                            <div class="txt_field">
                                <input type="text" name="med_mg" required />
                                <span></span>
                                <label>Enter Medicine Mg</label>
                            </div>
                            <div class="w-80-sm search_btn mt-3 ms-5">
                                <input name="search_code" type="submit" value="Search" />
                            </div>
                    </form>
                    <?php if(isset($unmatch)){echo $unmatch;} ?>
                </div>
            </div>

        </div>
    </div>


    <?php include_once("footer.php"); ?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>