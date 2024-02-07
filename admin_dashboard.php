<?php 
    include_once('config.php');
    include_once('admin.php');


    if (isset($_SESSION['admin_id'])) {
        $admin_id= $_SESSION['admin_id'];
    }
    //Count Total Medicine
    $sql_items = "SELECT * FROM medicines";
    if($items_result=mysqli_query($conn,$sql_items)){
        $items_rows=mysqli_num_rows($items_result);
    }


    //Count Total Medicine
    $sql_users = "SELECT COUNT(*) as total_users FROM user_info";
    if($users_result=mysqli_query($conn,$sql_users)){
        $users_rows=mysqli_num_rows($users_result);
    }

    $sql_clients = "SELECT COUNT(*) as total_clients FROM client_info";
    if($clients_result=mysqli_query($conn,$sql_clients)){
        $clients_rows=mysqli_num_rows($clients_result);
    }








    /* File Uploading Section Starts */
            if (isset($_POST['upload_file'])) {
                /*Getting admin info */
                $sql= "SELECT * FROM admin_info WHERE admin_id='$admin_id'";
                $run = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($run);
        
        
        
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
                        $med_company= mysqli_real_escape_string($conn, $data['med_company']);
                        $med_image = mysqli_real_escape_string($conn, $data['med_image']);
                        $M_des_indication = mysqli_real_escape_string($conn, $data['M_des_indication']);
                        $M_des_uses = mysqli_real_escape_string($conn, $data['M_des_uses']);
                        $M_des_works = mysqli_real_escape_string($conn, $data['M_des_works']);
                        $M_des_side_effects = mysqli_real_escape_string($conn, $data['M_des_side_effects']);
                        $M_des_pharmacology = mysqli_real_escape_string($conn, $data['M_des_pharmacology']);
                        $M_des_dosage = mysqli_real_escape_string($conn, $data['M_des_dosage']);
                        $M_des_pregnancy = mysqli_real_escape_string($conn, $data['M_des_pregnancy']);
                        $M_des_suggestions = mysqli_real_escape_string($conn, $data['M_des_suggestions']);

        


                        /*Getting Client medicine info for matching Med existing*/
                        $check_existing_query = "SELECT * FROM medicine_details WHERE med_name='$med_name' AND med_mg= '$med_mg' AND med_type='$med_type'";
                        $check_existing = mysqli_query($conn, $check_existing_query);
                        /* matching Med existing Ends*/
                        if(mysqli_num_rows($check_existing) > 0){
                            $sql = "UPDATE medicine_details 
                                    SET med_name='$med_name', med_mg='$med_mg', med_type='$med_type', med_price='$med_price', med_company='$med_company', med_image='$med_image', 
                                    M_des_indication='$M_des_indication',
                                    M_des_uses='$M_des_uses', 
                                    M_des_works='$M_des_works', 
                                    M_des_side_effects='$M_des_side_effects', 
                                    M_des_pharmacology='$M_des_pharmacology', 
                                    M_des_dosage='$M_des_dosage', 
                                    M_des_pregnancy='$M_des_pregnancy',
                                    M_des_suggestions='$M_des_suggestions', 
                                    WHERE med_name='$med_name' AND med_mg= '$med_mg' AND med_type='$med_type'";
                            $run= mysqli_query($conn, $sql);
                            
                            $message= 'Upload File Succesfully';
        
                            
                        }
                        else{
                            $sql = "INSERT INTO medicine_details(med_name, med_mg, med_type, med_price, med_company, med_image,
                                        M_des_indication, M_des_uses, M_des_works, M_des_side_effects, M_des_pharmacology,
                                        M_des_dosage, M_des_pregnancy, M_des_suggestions)
                                    VALUES('$med_name', '$med_mg', '$med_type', '$med_price','$med_company','$med_image',
                                        '$M_des_indication',  '$M_des_uses',  '$M_des_works',  '$M_des_side_effects',  
                                        '$M_des_pharmacology', '$M_des_dosage',  '$M_des_pregnancy',  '$M_des_suggestions', )";
                            $run= mysqli_query($conn, $sql);
        
                            $upload_message= 'Upload File Succesfully';
                        }
                        
                    }
        
                }
                else{
                    $upload_message= 'Please Upload a CSV,EXCEL or XML File';
                }
            }
    /* File Uploading Section Ends */


    
    /* Insert Clients Start*/
        if (isset($_POST['add_client'])) {
            $company_name = $_POST['company_name'];
            if(isset($_FILES['company_image'])){
                $company_image_name= $_FILES['company_image']['name'];
                $company_image_tmp_name=$_FILES['company_image']['tmp_name'];
                move_uploaded_file($company_image_tmp_name, 'images/admin_images/'.$company_image_name);
            }
            $add_sql="INSERT INTO our_clients(company_name, company_image) VALUES('$company_name','$company_image_name')";
            $run_add_sql=mysqli_query($conn,$add_sql);
            $add_successfully= "Added Successfully";
        }

        //Show Our Clints
        $sql= "SELECT * from our_clients";
        $run= mysqli_query($conn,$sql);

        $clients = [];
        if (mysqli_num_rows($run) > 0) {
            while ($row = mysqli_fetch_assoc($run)) {
                $clients[] = $row;
            }
        }

        //Client delete msg
        if (isset($_GET['del_success'])) {
            $dlt_msg = $_GET['del_success'];
        }
    /* Add Clients End*/



/* Add Article Start*/
        if (isset($_POST['post'])) {
            $article_title = $_POST['article_title']; 
            $article_description = $_POST['article_description'];
            if(isset($_FILES['article_image'])){
                $article_image_name= $_FILES['article_image']['name'];
                $article_image_tmp_name=$_FILES['article_image']['tmp_name'];
                move_uploaded_file($article_image_tmp_name, 'images/article/'.$article_image_name);
            }
            $post_sql="INSERT INTO articles(article_title, article_image, article_description) VALUES('$article_title','$article_image_name', '$article_description')";
            $run_add_sql=mysqli_query($conn,$post_sql);
            $post_successfully= "POST Successful";
        }




            ////Show Articles
                $sql_blog= "SELECT * from articles ORDER BY article_id DESC";
                $run_blog= mysqli_query($conn,$sql_blog);

                $blogs = [];
                if (mysqli_num_rows($run_blog) > 0) {
                    while ($row = mysqli_fetch_assoc($run_blog)) {
                        $blogs[] = $row;
                    }
                }

            //Delete article msg
            if (isset($_GET['del_success'])) {
                $dlt_art_msg = $_GET['del_success'];
            }
    /* Add Article End*/


?>

<head>
    <title>Dashboard - Admin - MediGuard</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" />
    <style>
    .truncate-text {
        max-width: 200px;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>

</head>
<div class="container">
    <h1 class="text-center">Dashboard</h1>


    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Medicines</h5>
                    <!-- Display the total number of products from your database -->
                    <p class="card-text text-center" style="font-size:100px;"><?php echo $items_rows;    ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Clients</h5>
                    <!-- Display the total number of users from your database -->
                    <p class="card-text text-center" style="font-size:100px;"><?php echo $clients_rows;    ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Users</h5>
                    <!-- Display the total number of users from your database -->
                    <p class="card-text text-center" style="font-size:100px;"><?php echo $users_rows;    ?></p>
                </div>
            </div>
        </div>
    </div>


    <!-- Add Medicine Section -->
    <br> <br>
    <div class="border border-light">
        <div class="p-3 text-center border bg-light">
            <form action="" Method="POST" enctype="multipart/form-data">
                    <div class="text-white bg-dark p-3">
                        <h2>Add Medicines</h2>
                    </div>
                    <label for="upload-file"> 
                        <h3>&nbsp;Upload CSV or EXCEL File:</h3>
                    </label> <br>
                
                <div class="input-group text-secondary justify-content-center">
                    <label for="company_photo" class="btn btn-light btn-outline-dark">
                        <input  id="form1" name="input_file" type="file" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" required />
                    </label>
                    <div class="input-group-append">
                        <button class="btn-sm btn-primary text-white border border-dark btn-outline-dark p-3" type="submit" name="upload_file">Upload</button>
                    </div>
                </div>
            </form>
            <strong class="text-success"><?php if(isset($upload_message)){echo $upload_message;} ?></strong>
        </div>
    </div>
    <br> <br>

    <!-- Add Our Client Section -->
    <div class="bg-light border">
        <div class="p-3">
            <form action="" Method="POST" enctype="multipart/form-data">
                <div class="text-center text-white bg-dark p-3">
                    <label for="upload-file" class="">
                        <h2 >Add Our Clients</h2>
                    </label> <br>
                </div>
                <div class="form-group justify-content-center">
                    <div>
                        <label class="form-label" >Company Name:</label>
                        <input type="text" name="company_name" class="form-control" required>
                    </div> <br>
                    <div>
                        <label class="form-label" >Company Photo:</label>
                        <label for="company_photo" class="btn btn-light btn-outline-dark w-50">
                            <input type="file" name="company_image" accept="image/*"  required>
                        </label> <br>
                    </div>
                    <div class="form-group mt-2 text-center">
                        <input type="submit" name="add_client" value="Add Client" class="btn-sm text-white btn-primary border border-dark btn-outline-dark p-2">
                    </div>
                </div>
            </form>
            <strong class="text-success"><?php if(isset($add_successfully)){ echo $add_successfully;} ?></strong>
            <hr>
        </div>

        <!-- Our Client List -->
        <div class="table-responsive p-3">
            <strong class="text-success"><?php if(isset($dlt_msg)){ echo $dlt_msg;} ?></strong>
            <table id="clientTable" class="table table-striped table-bordered outline-secondary">
                <thead>
                    <tr>
                        <th scope="col">company Name</th>
                        <th scope="col">Logo</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($clients as $client) { ?>
                        <tr>
                            <td class="text-nowrap">
                                <?php echo $client['company_name'];?>
                            </td>
                            <td class="text-nowrap">
                                <img src="images/admin_images/<?php echo $client['company_image']; ?>" height="50px" width="80px">
                            </td>
                            <td>
                                <div class="mb-1 d-block">
                                    
                                <!-- <a class="btn btn-outline-success btn-sm w-100 mb-1" href="our_client_update.php?company_id=<?php echo $client['company_id'];?>">Edit</a> --->
                                        
                                    <a class="btn btn-outline-danger btn-sm w-100" href="our_client_delete.php?company_id=<?php echo $client['company_id'];?>">Delete</a>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <br> <br>


    <!-- Articles Section -->
    <div class="bg-light border">
        <div class="p-3">
            <form action="" Method="POST" enctype="multipart/form-data">
                <div class="text-center text-white bg-dark p-3">
                    <label for="upload-file" >
                        <h2>Add Latest Articles</h2>
                    </label> <br>
                </div>
                <div class="form-group justify-content-center">
                    <div class="w-100">
                        <label class="form-label">Title:</label> <br>
                        <input type="text" name="article_title" class="form-control" required>
                    </div> <br>
                    <div class="w-100">
                        <label>Photo:</label>
                        <label for="article_image" class="btn btn-light btn-outline-dark w-50">
                            <input type="file" name="article_image" accept="image/*" required>
                        </label>
                    </div> <br>
                    <div class="w-100">
                        <label class="form-label">Description:</label><br>
                        <textarea class="form-control" name="article_description" cols required></textarea>
                    </div> <br>
                    <div class="form-group mt-2 text-center">
                        <input type="submit" name="post" value="Post Article" class="btn-sm text-white btn-primary border border-dark btn-outline-dark p-2">
                    </div>
                </div>
            </form>
            <strong class="text-success"><?php if(isset($post_successfully)){ echo $post_successfully;} ?></strong>
            <hr>
            <!-- Articles List -->
        </div>
        <div class="table-responsive p-3">
            <strong class="text-success"><?php if(isset($dlt_art_msg)){ echo $dlt_art_msg;} ?></strong>
            <table id="articleTable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Title</th>
                        <th scope="col">Banner</th>
                        <th scope="col">Description</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($blogs as $blog) { ?>
                        <tr>
                            <td class="text-wrap" style="max-width: 150px;">
                                <?php echo $blog['article_title'];?>
                            </td>
                            <td class="text-nowrap">
                                <img src="images/article/<?php echo $blog['article_image']; ?>" height="50px" width="80px">
                            </td>
                            <td class="truncate-text text-nowrap">
                                <p ><?php echo $blog['article_description'];?></p>
                            </td>
                            <td>
                                <div class="mb-1 d-block">
                                    <!-- <a class="btn btn-outline-success btn-sm w-100 mb-1" href="article_update.php?company_id=<?php echo $client['company_id'];?>">Edit</a> -->
                                        
                                    <a class="btn btn-outline-danger btn-sm w-100" href="article_delete.php?company_id=<?php echo $client['company_id'];?>">Delete</a>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
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
            $('#articleTable').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    {
                    extend: 'csv',
                    text: 'Download CSV',
                    filename: 'article_list',
                },
                {
                    extend: 'excel',
                    text: 'Download Excel',
                    filename: 'article_list',
                },
                'print'
                
                ]
            } );
        });
    </script>

    <!-- Datatable JS Code -->
    <script>
        $(document).ready( function () {
            $('#clientTable').DataTable();
        });
        
    </script>
