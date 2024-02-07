<?php 
    include_once('config.php');

    //Article Section PHP
    $sql_blog= "SELECT * from articles ORDER BY article_id DESC LIMIT 8";
    $run_blog= mysqli_query($conn,$sql_blog);

    $blogs = [];
    if (mysqli_num_rows($run_blog) > 0) {
        while ($row = mysqli_fetch_assoc($run_blog)) {
            $blogs[] = $row;
        }
    }

    

    //Our Clints Section PHP
    $sql= "SELECT * from our_clients";
    $run= mysqli_query($conn,$sql);

    $clients = [];
    if (mysqli_num_rows($run) > 0) {
        while ($row = mysqli_fetch_assoc($run)) {
            $clients[] = $row;
        }
    }


?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        .color{
            color: #447061;
        }
    </style>
</head>
<body>
<div class="container display-block">
    <!-- Articles area-->
  <h2 class="text-center mt-3 mb-3 color">LATEST ARTICLES</h2>
  <div class="text-end mb-3">
    <a href="blog.php" class="btn btn-primary" target="_blank"> See All</a>
  </div>
    <div class="row" >
        <?php foreach ($blogs as $blog) { ?>
            <div class="col-sm-3 mb-2">
                <div class="card h-100">
                    <img class="card-img-top" style="height: 60%;"src="images/article/<?php echo $blog['article_image']; ?>" alt="Article">
                    <div class="card-body">
                        <h5 class="card-title text-truncate"><?php echo $blog['article_title']; ?></h5>
                        <p class="card-text text-truncate"><?php echo $blog['article_description']; ?></p>
                        <a  href="articles.php?article_id=<?php echo $blog['article_id']; ?> " class="btn btn-success" target="_blank">Full Story</a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
    

    <!-- our clients area-->

    <h2 class="text-center mt-3 mb-3 color">Our Clients</h2>      
    <div class="row">
        <?php 
            foreach ($clients as $client) { ?>

            <div class="card ms-2 mx-auto mb-3" style="width: 9rem;">
                <img class="card-img-top" style="height: 50%;"src="images/admin_images/<?php echo $client['company_image']; ?>">
                <div class="card-body">
                    <p class="card-text fs-6 text-center color"><?php echo $client['company_name']; ?></p>
                </div>
            </div>
        <?php  } ?>
    </div>
</div>
</body>
</html>