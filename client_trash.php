<?php
    include_once('config.php');
    include_once('admin.php');


    if (!isset($_SESSION['admin_id'])) {
        header("Location: admin_login.php"); // Redirect to the login page if not logged in

    }
    else{
        $admin_id= $_SESSION['admin_id'];
    }


    //Get Client Info who are not Aprroved
    $sql= "SELECT * FROM client_trash ORDER BY client_id DESC";
    $run=mysqli_query($conn,$sql);
    $total_rows= mysqli_num_rows($run);
    
    $client_info = [];
    while ($client_info_row = mysqli_fetch_assoc($run)) {
        $client_info[] = $client_info_row;
        $client_logo= "No Image";
    }
    

    if(isset($_GET['undo'])){
        $message= $_GET['undo'];
    }
    
    if(isset($_GET['deleted_per'])){
        $message= $_GET['deleted_per'];
    }

?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trash list - MediGuard</title>
    <!-- Datatable Style CDN -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" />
</head>
<body>

    <h2 class="text-center mt-2">Client Trash List</h2>

    <p class="text-success">
        <?php 
            if(isset($message)){
                echo $message;
            }
        ?>
    </p>


<div class="container border my-4">
    <div class="table-responsive">
        <table id="clientTable" class="table table-striped cell-border">
            <thead>
                <tr>
                    <th scope="col" class="text-nowrap">SL Number</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Company</th>
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
                            <?php echo $client_information['client_approve'];?>
                        </td>
                        <td>
                            <?php echo $client_information['client_validity'];?>
                        </td>
                        <td>
                            <div class="fluid">
                                <a class="btn btn-success btn-sm d-block w-100" href="trash_undo.php?c_id=<?php echo $client_information['client_id']; ?>&client_company=<?php echo $client_information['client_company']; ?>">
                                    Undo
                                </a>
                                <a class="btn btn-danger btn-sm d-block w-100" href="client_del_permanently.php?c_id=<?php echo $client_information['client_id']; ?>&client_company=<?php echo $client_information['client_company']; ?>">
                                    Delete Permanently
                                </a>
                            </div>
                        </td>
                    <?php } ?>
                </tr>
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