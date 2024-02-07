<?php 
    include_once('config.php');
    include_once('client.php');


    if (isset($_SESSION['client_id'])) {
        $client_id= $_SESSION['client_id'];
    }
    //Count Total Medicine
    $sql_items = "SELECT COUNT(*) as total_items FROM medicines WHERE client_id=$client_id";
    if($items_result=mysqli_query($conn,$sql_items)){
        $items_rows=mysqli_fetch_assoc($items_result);
        $items_rowcount=$items_rows['total_items'];
    }


    //Count Total Medicine
    $sql_client = "SELECT * FROM client_info WHERE client_id='$client_id'";
    if($client_info=mysqli_query($conn,$sql_client)){
        if($client_data=mysqli_fetch_assoc($client_info)){
            $client_company = $client_data['client_company'];
            $client_validity = $client_data['client_validity'];
        }

    }
?>

<head>
    <title>Dashboard - MediGuard</title>
</head>
<body>
<div class="container mt-1">
    <h1 class="text-center mb-5">Hi, <?php if(isset($client_company)){ echo $client_company;} ?> <br> WELCOME TO YOUR DASHBOARD</h1>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body" style="height: 200px; width:100%">
                    <h5 class="card-title">You Uploaded</h5>
                    <!-- Display the total number of products from your database -->
                    <p class="card-text text-center" style="font-size:100px;"><?php echo $items_rowcount;    ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body" style="height: 200px; width:100%">
                    <h5 class="card-title">Account Validity</h5>
                    <!-- Display the total number of users from your database -->
                    <p class="card-text text-center" style="font-size:50px;"><?php echo $client_validity;    ?></p>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-5 mb-5">
        <?php   include_once('medicine_list_dashboard.php'); ?>
    </div>
</div>
</body>