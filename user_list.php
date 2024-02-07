<?php 
    include_once('config.php');
    include_once('admin.php');


    if (!isset($_SESSION['admin_id'])) {
        header("Location: admin_login.php"); // Redirect to the login page if not logged in

    }
    else{
        $user_id= $_SESSION['admin_id'];
    }


    //Get user Info
    $sql= "SELECT * FROM user_info WHERE user_blocked='No'";
    $run=mysqli_query($conn,$sql);
    $total_rows= mysqli_num_rows($run);
    
    $user_info = [];

    while ($user_info_row = mysqli_fetch_assoc($run)) {
        $user_info[] = $user_info_row;

        if(empty($user_info['user_logo'])){
            $empty_image="no-profile-picture.jpg";
        }
    }

    if(isset($_GET['update'])){
        $message= $_GET['update'];
    }

    if(isset($_GET['blocked'])){
        $message= $_GET['blocked'];
    }

?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users List - MediGuard</title>
    <!-- Datatable(Plugin) Style CDN -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" />
</head>
<body>

    <h2 class="text-center mt-2">User List</h2>

    <p class="text-success">
    <?php if(isset($message)){
            echo $message;
        }
    ?></p>
<div class="container border my-4">
    <div class="table-responsive">
        <table id="userTable" class="table table-striped cell-border">
            <thead>
                <tr>
                    <th scope="col" class="text-nowrap">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Image</th>
                    <th scope="col">Reg Date</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($user_info as $user_information) { ?>
                    <tr>
                        <td scope="row">
                            <?php echo $user_information['user_id'];?>
                        </td>
                        <td>
                            <?php echo $user_information['user_fname']." ".$user_information['user_lname'];?>
                        </td>
                        <td>
                            <?php echo $user_information['user_email'];?>
                        </td>
                        <td>
                            <?php echo $user_information['user_phone'];?>
                        </td>
                        <td>
                            <?php echo $user_information['user_gender'];?>
                        </td>
                        <td> 
                            <img src="images/user_pic/<?php if(empty($user_information['user_image'])){ echo "no-profile-picture.jpg";}
                                                            else{echo $user_information['user_image'];}?>" alt="" height="50px" width="80px">
                        </td>
                        <td>
                            <?php echo $user_information['user_reg_date'];?>
                        </td>
                        <td>
                            <div class="mb-1 d-block">
                                <a class="btn btn-outline-success btn-sm w-100 mb-1" href="user_update.php?user_id=<?php echo $user_information['user_id']; ?>&user_name=<?php echo $user_information['user_fname']; ?>">Edit</a>
                            
                                <a class="btn btn-outline-danger btn-sm w-100" href="user_block.php?user_id=<?php echo $user_information['user_id']; ?>&user_name=<?php echo $user_information['user_fname']; ?>">Block</a>
                            </div>
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
            $('#userTable').DataTable();
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <!-- Datatable JS CDN -->
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
</body>
</html>