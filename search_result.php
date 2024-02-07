<?php 
include_once('header.php');
include_once('config.php');

$med_name = isset($_GET['med_name']) ? $_GET['med_name'] : '';
$med_mg = isset($_GET['med_mg']) ? $_GET['med_mg'] : '';

if (!empty($med_name) && !empty($med_mg)) {
    $search_sql = "SELECT * FROM medicine_details WHERE med_name='$med_name' AND med_mg='$med_mg'";
    $run = mysqli_query($conn, $search_sql);
    $check_result = mysqli_query($conn, $search_sql);

    if ($check_result && mysqli_num_rows($check_result) > 0) {
        while ($row = mysqli_fetch_assoc($run)) {
            $M_name = $row['med_name'];
            $M_mg = $row['med_mg'];
            $M_price = $row['med_price'];
            $M_company= $row['med_company'];
            $M_image= $row['med_image'];
            if(empty($M_image)){
              $M_default_image= "med_default_image.jpg";
            }

            $M_des_indication = $row['M_des_indication'];
            $M_des_uses = $row['M_des_uses'];
            $M_des_works = $row['M_des_works'];
            $M_des_side_effects = $row['M_des_side_effects'];
            $M_des_pharmacology = $row['M_des_pharmacology'];
            $M_des_dosage = $row['M_des_dosage'];
            $M_des_pregnancy = $row['M_des_pregnancy'];
            $M_des_suggestions = $row['M_des_suggestions'];

        }
    } else {
      $unmatch= "No Medicine Found";
      $unmatch1="";
      
    }
}
?>


<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="shortcut icon" href="Fab_icon.png" type="image/x-icon">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
      <link rel="stylesheet" href="style.css">
      <title>Search Result - MediGuard</title>
      <style>
          .search_again:hover{
              color: #003180;
          }
      </style>
  </head>
  <body>
    <h2 align="center">Here is your search result</h2> <br>
    <div class="container">
      <div class="row gx-5">
        <aside class="col-lg-6">
          <div class="border rounded-4 mb-3 d-flex justify-content-center">
            <img src="images/med_images/<?php if(isset($M_default_image)){ echo $M_default_image;} else{echo $M_image;}?>" alt="Medicine Image"
                style="min-width:500px; max-height: 400px; margin: auto;" class="rounded-4 fit" />
          </div>
        </aside>
        <div class="col-lg-6">
          <div class="ps-lg-3">
            <h4 class="title text-dark">
              <?php if (isset($unmatch)) {echo $unmatch;} 
                    else {echo $M_name." ".$M_mg."mg";}
              ?>
            </h4>
            <div class="mb-3">
              <span class="h5">
                <?php if (isset($unmatch1)) {echo $unmatch1;} 
                      else {echo $M_price;}
                ?>
              </span>
              Taka<span class="text-muted">/10 Pcs (APX)</span>
            </div>
            <div class="row">
              <dt class="col-4">Price(1 piece):</dt>
              <dd class="col-8">
                <?php if (isset($unmatch1)) {echo $unmatch1;} 
                      else {
                        $divisor = 10;
                        $one_piece_price = $M_price/$divisor;
                        echo $one_piece_price." Taka <span class='text-muted'>(Approx)</span>";}
                ?>
              </dd>
                <dt class="col-4">Brand:</dt>
                <dd class="col-8"> 
                  <?php if (isset($unmatch1)) {echo $unmatch1;} 
                      else {echo $M_company;}
                ?>
                </dd>
                <div class="mt-5 search_again">
                  <a class="btn btn-success text-white fw-bold fs-5 mb-5" href="search_med_info.php">
                    Search Another Medicine
                  </a>
                </div>
            </div>

            




          </div>
        </div>



        <!--Medicine Descroption -->
        <div class="accordion mb-5" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Indications
                      </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                      <div class="accordion-body">
                        <p>
                          <?php if (isset($unmatch1)) {echo $unmatch1;} 
                              else {echo $M_des_indication;}           
                            ?>
                        </p>  
                      </div>
                    </div>
                </div>
                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        <strong>Uses</strong>
                    </button>
                  </h2>
                  <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                      <p>
                        <?php if (isset($unmatch1)) {echo $unmatch1;} 
                             else {echo $M_des_uses;}           
                          ?>
                      </p> 
                    </div>
                  </div>
                </div>
                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                      <strong>How works</strong>
                    </button>
                  </h2>
                  <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                      <p>
                        <?php if (isset($unmatch1)) {echo $unmatch1;} 
                            else {echo $M_des_works;}           
                          ?>
                      </p> 
                    </div>
                  </div>
                </div>
                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingFour">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                      <strong>Side Effects</strong>
                    </button>
                  </h2>
                  <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                      <p>
                        <?php if (isset($unmatch1)) {echo $unmatch1;} 
                            else {echo $M_des_side_effects;}           
                          ?>
                      </p> 
                    </div>
                  </div>
                </div>
                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingFive">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                      <strong>Pharmacology</strong>
                    </button>
                     </h2>
                     <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordionExample">
                       <div class="accordion-body">
                         <p>
                           <?php if (isset($unmatch1)) {echo $unmatch1;} 
                                  else {echo $M_des_pharmacology;}           
                            ?>
                          </p> 
                    </div>
                  </div>
                </div>
                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingSix">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                      <strong>Dosage & Administrations</strong>
                    </button>
                  </h2>
                  <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                      <p>
                        <?php if (isset($unmatch1)) {echo $unmatch1;} 
                            else {echo $M_des_dosage;}           
                          ?>
                      </p> 
                    </div>
                  </div>
                </div>
                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingSeven">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                      <strong>Pregnancy & Lactation</strong>
                    </button>
                  </h2>
                  <div id="collapseSeven" class="accordion-collapse collapse" aria-labelledby="headingSeven" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                      <p>
                        <?php if (isset($unmatch1)) {echo $unmatch1;} 
                            else {echo $M_des_pregnancy;}           
                          ?>
                      </p> 
                    </div>
                  </div>
                </div>
                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingEight">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                      <strong>Quick Suggestions</strong>
                    </button>
                  </h2>
                  <div id="collapseEight" class="accordion-collapse collapse" aria-labelledby="headingEight" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                      <p>
                        <?php if (isset($unmatch1)) {echo $unmatch1;} 
                            else {echo $M_des_suggestions;}           
                          ?>
                      </p> 
                    </div>
                  </div>
                </div>
                      
            </div>
      </div>
    </div>




    <?php include_once("footer.php"); ?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  </body>
</html>