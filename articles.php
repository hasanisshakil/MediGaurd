<?php 
    include_once('config.php');
    include_once('header.php');

//Article Section PHP
    if(isset($_GET['article_id'])){
        $article_id = $_GET['article_id'];
    
        
        $sql= "SELECT * from articles WHERE article_id='$article_id'";
        $run= mysqli_query($conn,$sql);
        if (mysqli_num_rows($run) > 0) {
            while($row = mysqli_fetch_assoc($run)) {
                $article_title= $row['article_title'];
                $article_image= $row['article_image'];
                $article_description= $row['article_description'];
                $article_pub_time= $row['article_pub_time'];
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
    <link rel="stylesheet" href="style.css">

    
    <title>View Blog - MediGuard</title>
</head>
<body>
        
    <div class="container">
        <div class="card" style="width: 100%;">
            <div class="card-body">
                <h5 class="card-title"><?php echo $article_title; ?></h5>
                <p class="text-muted"><?php echo $article_pub_time; ?></p>
            </div>
                <img class="card-img-top mx-auto" style="max-height: 400px; width: 60%;"src="images/article/<?php echo $article_image; ?>" alt="Article">
            <div class="mx-auto" style="width: 90%; text-align:justify;">
                <br>
                <p class="card-text"><?php echo $article_description; ?></p>
                <br>
            </div>
        </div>
    </div>
    <div class="display-block mt-5">
        <?php include_once("footer.php"); ?>
    </div>
    <!-- Bootstrap Javascript Link -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
