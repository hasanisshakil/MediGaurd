<?php 
    include_once('config.php');
    include_once('client.php');

    if (isset($_SESSION['client_id'])) {
        $client_id= $_SESSION['client_id'];
    }


      // Pagination configuration
      $results_per_page = 3; // Number of rows per page
      $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
      $start_index = ($current_page - 1) * $results_per_page;

      // Retrieve medicines for the current page
      $sql = "SELECT * FROM medicines WHERE client_id='$client_id' ORDER BY adding_date DESC LIMIT $results_per_page";
      $result = mysqli_query($conn, $sql);

      $medicines = []; // Empty array to store medicine data

      if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
              $medicines[] = $row;
          }
      }

      // Count total number of medicines for pagination
      $sql_count = "SELECT COUNT(*) AS total FROM medicines WHERE client_id='$client_id'";
      $result_count = mysqli_query($conn, $sql_count);
      $row_count = mysqli_fetch_assoc($result_count);
      $total_results = $row_count['total'];
      $total_pages = ceil($total_results / $results_per_page);
      //Pagination Ends Here- Rest continuous in html below section






      //Delete & Update Message
      if (isset($_GET['del_success'])) {
          $del_success = $_GET['del_success'];
      }
      if (isset($_GET['up_success'])) {
          $up_success = $_GET['up_success'];
      }

  


?>







<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medicine List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        @media (max-width: 767.98px) { .border-sm-start-none { border-left: none !important; } } /*Devider-line-None price,edit,delete section */
    </style>
</head>
<body>
<div style="width:100%; border: 1px solid light-grey;">
  <h1 class="text-center mt-3 mb-3 text-decoration-underline">RECENT UPLOADS</h1>
  <?php foreach ($medicines as $medicine) { ?>
    <div>
      <div class="row justify-content-center mb-3">
        <div class="col-md-12 col-xl-10">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-md-12 col-lg-3 col-xl-3 mb-4 mb-lg-0">
                  <div class="bg-image">
                    <img class="w-100"  src="images/med_images/
                        <?php //med img name
                            if(!empty($medicine['med_image'])){
                              echo $medicine['med_image'];
                            }else {
                              echo 'med_default_image.jpg'; 
                            }
                          ?>" 
                          alt="<?php echo $medicine['med_name'] . ' Image'; ?>"/>
                  </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-6">
                  <h5><strong><?php echo $medicine['med_name'] . ' ' . $medicine['med_mg'] . ' - ' . $medicine['med_type']; ?></strong></h5>
                  <strong>MG: </strong><span><?php echo $medicine['med_mg']; ?></span>

                  <div class="mt-1 mb-0 small">
                    <span>Type: </span>
                    <span class="text-primary"><?php echo $medicine['med_type']; ?></span>
                  </div>
                  <div class="mt-1 mb-0 small">
                    <span>Expiry Date: </span>
                    <span class="text-primary"><?php echo $medicine['med_expiry']; ?></span>
                  </div>
                  <div class="mt-1 mb-0 small">
                    <span>Company: </span>
                    <span class="text-primary"><?php echo $medicine['med_company']; ?></span>
                  </div>
                  <p class="text-truncate mb-4 mb-md-0">
                    Your Health is our responsibility.
                  </p>
                </div>
                <div class="col-md-6 col-lg-3 col-xl-3 border-sm-start-none border-start">
                  <div class="d-flex flex-row align-items-center mb-1">
                    <h4 class="mb-1 me-1">
                      <?php echo $medicine['med_price']; ?>
                      <text class="text-muted fs-6">Tk/per 10pcs</text>
                    </h4>
                  </div>
                  <div class="mt-1 mb-0 small">
                    <span>QR CODE: </span>
                    <span class="text-primary"><?php echo $medicine['med_qr_code']; ?></span>
                  </div>
                  
                  <div class="d-flex flex-column mt-4">
                    <a class="btn btn-outline-success mb-2 btn-sm" href="med_update.php?qr_code=<?php echo $medicine['med_qr_code']; ?>&med_name=<?php echo $medicine['med_name'] ?>">Edit</a>
                    <a class="btn btn-danger btn-sm mt-2" href="med_delete.php?qr_code=<?php echo $medicine['med_qr_code']; ?>&med_name=<?php echo $medicine['med_name'] ?>">Delete</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php } ?>
  <div class="text-center mb-3">
    <a href="medicine_list.php" class="btn btn-primary mx-auto">Show All Medicines</a>
  </div>
</div>

</body>
</html>