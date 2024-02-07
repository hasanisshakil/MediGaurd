<?php 
    include_once('config.php');
    include_once('client.php');

    if (isset($_SESSION['client_id'])) {
        $client_id= $_SESSION['client_id'];
    }


    //Get user Info
    $sql= "SELECT * FROM medicines WHERE client_id='$client_id' ORDER BY adding_date DESC";
    $run=mysqli_query($conn,$sql);
    $total_rows= mysqli_num_rows($run);
    
    $medicines = [];

    while ($medicines_row = mysqli_fetch_assoc($run)) {
        $medicines_info[] = $medicines_row;

    }











    if(isset($_GET['del_success'])){
        $message= $_GET['del_success'];
    }

    if(isset($_GET['up_success'])){
        $message= $_GET['up_success'];
    }

?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medicine List - MediGuard</title>
    <!-- Datatable(Plugin) Style CDN -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css" />
</head>
<body>

    <h2 class="text-center mt-2">Medicine List</h2>

    <p class="text-success">
    <?php if(isset($message)){
            echo $message;
        }
    ?></p>

<div class="container border my-4">
    <div class="table-responsive">
        <table id="userTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th scope="col">Qr Code</th>
                    <th scope="col">Name</th>
                    <th scope="col">Mg</th>
                    <th scope="col">Type</th>
                    <th scope="col">Price</th>
                    <th scope="col">Expiry</th>    <!-- Scope means Table Header -->
                    <th scope="col" class="text-nowrap">Search Count</th>
                    <th scope="col" class="text-nowrap">No of Users</th>
                    <th scope="col">Company</th>
                    <th scope="col">Image</th>
                    <th scope="col">Action</th>

                </tr>
            </thead>
            <tbody>
                <?php foreach ($medicines_info as $medicines_information) { ?>
                    <tr>
                        <td class="text-nowrap">
                            <?php echo $medicines_information['med_qr_code'];?>
                        </td>
                        <td class="text-nowrap">
                            <?php echo $medicines_information['med_name'];?>
                        </td>
                        <td class="text-nowrap">
                            <?php echo $medicines_information['med_mg'];?>
                        </td>
                        <td class="text-nowrap">
                            <?php echo $medicines_information['med_type'];?>
                        </td>
                        <td class="text-nowrap">
                            <?php echo $medicines_information['med_price'];?>
                        </td>
                        <td>
                            <?php echo $medicines_information['med_expiry'];?>
                        </td>
                        <td class="text-center">
                            <?php 
                                $search_count = $medicines_information['search_count'];

                                $value= 1; //for show the exact search counts
                                $exact_search_count= $search_count - $value;
                                
                                echo $exact_search_count;?>
                        </td>
                        <td class="text-wrap">
                            <?php 
                            
                            echo $medicines_information['searched_users'];?>
                        </td>

                        <td class="text-wrap">
                            <?php echo $medicines_information['med_company'];?>
                        </td>
                        <td> 
                            <img src="images/med_images/<?php if(empty($medicines_information['med_image'])){ echo "med_default_image.jpg";}
                                                            else{echo $medicines_information['med_image'];}?>" alt="<?php echo $medicines_information['med_name'] . ' Image'; ?>" alt="" height="50px" width="80px">
                        </td>
                        <td>
                            <div class="mb-1 d-block">
                                <a class="btn btn-outline-success btn-sm w-100 mb-1" href="med_update.php?med_id=<?php echo $medicines_information['med_id']; ?>&med_qr_code=<?php echo $medicines_information['med_qr_code']; ?>&med_name=<?php echo $medicines_information['med_name']; ?>">Edit</a>
                            
                                <a class="btn btn-outline-danger btn-sm w-100" href="med_delete.php?med_id=<?php echo $medicines_information['med_id']; ?>&med_qr_code=<?php echo $medicines_information['med_qr_code']; ?>&med_name=<?php echo $medicines_information['med_name']; ?>">Delete</a>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <!-- Datatable JS CDN -->
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

    <!-- Datatable download CDN -->
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>

    <!-- Datatable JS Code -->
    <script>
        $(document).ready( function () {
            $('#userTable').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    {
                    extend: 'csv',
                    text: 'Download CSV',
                    filename: 'medicine_list',
                },
                {
                    extend: 'excel',
                    text: 'Download Excel',
                    filename: 'medicine_list',
                },
                'print'
                
                ]
            } );
        });
    </script>

 
</body>
</html>