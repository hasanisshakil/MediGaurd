<?php 
    include_once('config.php');
    include_once('admin.php');


    if (!isset($_SESSION['admin_id'])) {
        header("Location: admin_login.php"); // Redirect to the login page if not logged in

    }
    else{
        $client_id= $_SESSION['admin_id'];
    }


    //Get Client Info
    $sql= "SELECT * FROM client_info WHERE client_approve='Yes' ";
    $run=mysqli_query($conn,$sql);
    $total_rows= mysqli_num_rows($run);
    
    $client_info = [];

    while ($client_info_row = mysqli_fetch_assoc($run)) {
        $client_info[] = $client_info_row;

        if(empty($client_info['client_logo'])){
            $empty_image="no-profile-picture.jpg";
        }
    }

    if(isset($_GET['delete'])){
        $message= $_GET['delete'].". 
        
        To Undo the precess go to <a href='client_trash.php'>Client Trash</a>.";
    }

    if(isset($_GET['update'])){
        $message= $_GET['update'];
    }

    if(isset($_GET['unapprove'])){
        $message= $_GET['unapprove'];
    }

?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client List - MediGuard</title>
    <!-- Datatable(Plugin) Style CDN -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" />
</head>
<body>

    <h2 class="text-center mt-2">Client List</h2>


    <p class="text-success">
    <?php if(isset($message)){
            echo $message;
        }
    ?></p>
<div class="container border my-4">
    <div class="table-responsive">
        <table id="clientTable" class="table table-striped cell-border">
            <thead>
                <tr>
                    <th scope="col" class="text-nowrap">Client ID</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Company</th>
                    <th scope="col">Logo</th>
                    <th scope="col">Approved</th>
                    <th scope="col">Validity</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($client_info as $client_information) { ?>
                    <tr>
                        <td scope="row">
                            <?php echo $client_information['client_id'];?>
                        </td>
                        <td>
                            <?php echo $client_information['client_email'];?>
                        </td>
                        <td>
                            <?php echo $client_information['client_phone'];?>
                        </td>
                        <td>
                            <?php echo $client_information['client_company'];?>
                        </td>
                        <td> 
                            <img src="images/client_pic/<?php if(empty($client_information['client_logo'])){ echo "no-profile-picture.jpg";}
                                                            else{echo $client_information['client_logo'];}?>" alt="" height="50px" width="80px">
                        </td>
                        <td>
                            <?php echo $client_information['client_approve'];?>
                        </td>
                        <td>
                            <?php echo $client_information['client_validity'];?>
                        </td>
                        <td>
                            <div class="mb-1 d-block w-100">
                                <a class="btn btn-outline-success btn-sm" href="client_update.php?c_id=<?php echo $client_information['client_id']; ?>&client_company=<?php echo $client_information['client_company']; ?>">Edit</a>

                                <a class="btn btn-outline-danger btn-sm" href="client_delete.php?c_id=<?php echo $client_information['client_id']; ?>&client_company=<?php echo $client_information['client_company']; ?>">Delete</a>
                            </div>
                                <a class="btn btn-outline-warning btn-sm d-block w-100" href="client_unapprove.php?c_id=<?php echo $client_information['client_id']; ?>&client_company=<?php echo $client_information['client_company']; ?>">&nbsp;&nbsp;Unapprove&nbsp;&nbsp;</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>


    <!-- Datatable JS Code -->
    <script>
        $(document).ready( function () {
            $('#clientTable').DataTable();
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <!-- Datatable JS CDN -->
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
</body>
</html>