<?php
include_once('header.php');
include_once('config.php');
if(empty($_SESSION['user_id'])) {
  header("Location: user_login.php"); // Redirect to the login page if not logged in
  exit();
}
if(!empty($_SESSION['user_id'])) {


  $qr_code = isset($_GET['qr_code']) ? $_GET['qr_code'] : '';

    if(isset($_GET['search_code']) && !empty($qr_code)){
      $qr_search = "SELECT * FROM medicines WHERE med_qr_code='$qr_code'";
      $run = mysqli_query($conn, $qr_search);

      if($run) {
        if(mysqli_num_rows($run) > 0) {
            while($row = mysqli_fetch_assoc($run)) {
                $Med_id= $row['med_id'];
                $M_name = $row['med_name'];
                $M_mg = $row['med_mg'];
                $M_price = $row['med_price'];
                $M_expiry = $row['med_expiry'];
                $M_total_search = $row['search_count'];

                $M_searched_list = $row['searched_users'];

                $Last_time_scanned = $row['last_time_scanned'];

                if(empty($row['last_time_scanned'])){
                  $Last_time_scanned= "You are the first one.";
                }
                if($M_total_search>3){
                  $total_search_over= "Scanned Over 3 Times."; 
                }
                if($M_total_search>5){
                  $total_search_over= "Scanned Over 5 Times. <br> <b class='text-danger'> This medicine may be harmful. </b>"; 
                }

                $M_authentication = "Authentic";
                $M_image= $row['med_image'];
                if(empty($M_image)){
                  $M_default_image= "med_default_image.jpg";
                }
            }
          // Set the timezone to Bangladesh
          date_default_timezone_set('Asia/Dhaka');

          // Get the current date and time
          $currentDateTime = date('Y-m-d H:i:s');
          
          $update_value= 1;
          $update_search_count= $M_total_search + $update_value;
          $update="UPDATE medicines SET search_count='$update_search_count', last_time_scanned='$currentDateTime' WHERE med_id= '$Med_id'";
          $run_update=mysqli_query($conn,$update);
        } else {
            $unmatch = '<p class="text-danger">Not found any medicine<p>';
            $unmatch1 = 'Null';
          }
      }
    }




    $user_id = $_SESSION['user_id'];
    $searched_users = "SELECT * FROM medicines WHERE searched_users LIKE '%$user_id%'";
    $check_existing = mysqli_query($conn, $searched_users);
        if ($check_existing) {
          if (mysqli_num_rows($check_existing) < 1) {
            $add_searched_users = "UPDATE medicines SET searched_users='$M_searched_list $user_id,' WHERE med_qr_code='$qr_code'";
            $run2 = mysqli_query($conn, $add_searched_users); 
          } 
        }




}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authenticatin Result - MediGuard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="all_medicine.css">
    
</head>
<body>

  <section class="py-3">
  <h2 align="center">Here is your search result</h2>
    <div class="container my-5">
      <div class="row gx-5">
        <aside class="col-lg-6">
          <div class="border rounded-4 mb-3 d-flex justify-content-center">
            <img src="images/med_images/<?php if(isset($M_default_image)){ echo $M_default_image;} else{echo $M_image;}?>" 
                        alt="Medicine Image" class="w-100" style="min-width:500px; max-height: 400px; margin: auto;"/>
              <!--<img style="max-width: 100%; max-height: 100vh; margin: auto;" class="rounded-4 fit" src="images/banner3.jpg" /> -->
          </div>
          
        </aside>
        <main class="col-lg-6">
          <div class="ps-lg-3">
            <h4 class="title text-dark">
                <?php if (isset($unmatch)) {echo $unmatch;} 
                      else {echo $M_name." ".$M_mg." "."mg";}
                ?>
            </h4>


            <div class="mb-3">
              <span class="h5">
                <?php if (isset($unmatch1)) {echo $unmatch1;} 
                      else {echo $M_price;}
                ?>&nbsp; Taka APX</span>
              <span class="text-muted">/10 Pcs</span>
            </div>

            <p class="text-success fs-5 fw-bold">
              <?php if (isset($unmatch1)) {echo $unmatch1; ?> <p color="green"> <?php }
                  else {echo $M_authentication;} ?> </p>
            </p>

            <div class="row">
              <dt class="col-5">Price(1 piece):</dt>
              <dd class="col-7">
                <?php if (isset($unmatch1)) {echo $unmatch1;} 
                    else {
                      $divisor = 10;
                      $one_piece_price = $M_price/$divisor;
                      echo $one_piece_price." Taka <span class='text-muted'>(Approx)</span>";}
              ?>
              </dd>

              <dt class="col-5">Total Scanned: </dt>
              <dd class="col-7">
                  <?php
                  if (!isset($unmatch1)) {
                      if (isset($total_search_over)) {
                          
                              echo $total_search_over;
                          }
                       else {
                          echo $M_total_search;
                      }
                  } else {
                      echo $unmatch1;
                  }
                  ?>
              </dd>

              <dt class="col-5">Last Time Scanned: </dt>
              <dd class="col-7">
                <?php if (isset($unmatch1)) {echo $unmatch1;} 
                  else {echo $Last_time_scanned;}
                ?>


              <dt class="col-5">Expiry Date: </dt>
              <dd class="col-7"> 
                  <?php if (isset($unmatch1)) {echo $unmatch1;} 
                      else {echo $M_expiry;}
                  ?>
              </dd>
            </div>
          </div>
          <div class="mt-5 search_again">
            <a class="btn btn-success text-white fw-bold fs-5 mb-5" href="index.php">
                Search Another Medicine QR CODE
            </a>
          </div>
        </main>
      </div>
  </section>
  <?php include_once("footer.php"); ?>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>