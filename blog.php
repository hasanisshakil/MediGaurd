<?php 
    include_once('config.php');
    include_once('header.php');

    //Article Section PHP
    $sql_blog= "SELECT * from articles ORDER BY article_id DESC";
    $run_blog= mysqli_query($conn,$sql_blog);

    $blogs = [];
    if (mysqli_num_rows($run_blog) > 0) {
        while ($row = mysqli_fetch_assoc($run_blog)) {
            $blogs[] = $row;
        }
    }

?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Blog - MediGuard</title>
    <style>
        .color{
            color: #447061;
        }
    </style>
</head>
<body>
    
<div class="container">
    <!-- Articles area-->
  <h2 class="text-center mt-3 mb-3 color">All ARTICLES</h2>
    <div class="row" >
        <?php foreach ($blogs as $blog) { ?>
            <div class="col-sm-3 mb-2">
                <div class="card h-100">
                    <img class="card-img-top" style="height: 60%;"src="images/article/<?php echo $blog['article_image']; ?>" alt="Article">
                    <div class="card-body">
                        <h5 class="card-title text-truncate"><?php echo $blog['article_title']; ?></h5>
                        <div class="text-truncate"><p class="card-text"><?php echo $blog['article_description']; ?></p></div>
                        <a  href="articles.php?article_id=<?php echo $blog['article_id']; ?> " class="btn btn-success" target="_blank">Full Story</a>
                    </div>
                </div>
            </div>
        <?php  } ?>
    </div>
</div>
<div class="display-block mt-5">
    <?php include_once("footer.php"); ?>
</div>
</body>
</html>