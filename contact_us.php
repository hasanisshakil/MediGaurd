<?php 
    include_once('header.php'); 
    include_once('config.php'); 


    if(isset($_POST['send'])){
        $msg_name= $_POST['msg_name'];
        $msg_email= $_POST['msg_email'];
        $msg_subject= $_POST['msg_subject'];
        $msg_text= $_POST['msg_text'];

        $sql= "INSERT INTO feedback_message(msg_name, msg_email, msg_subject, msg_text)VALUE('$msg_name','$msg_email','$msg_subject','$msg_text')";
        $run= mysqli_query($conn, $sql);
        if($run){
            $message= "Thank you for choosing MediGuard. We value your input and look forward to assisting you.";
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
    
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">

    <link rel="stylesheet" href="style.css">
    <title>ContactUs - MediGuard</title>
</head>
<body>

  
<div class="container">
    <div class="row pt-3 pb-3">
        <div class="col-lg-7 mb-md-5">
            <form id="leave-a-message-form" method="POST">
                <h2 class="mb-4">Leave a Message</h2>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group"> 
                            <label for="name">Name *</label>
                            <input type="text" class="form-control" name="msg_name" placeholder="Enter your name">
                        </div>        
                        <div class="form-group mt-2">
                            <label for="email">Email *</label>
                            <input type="email" class="form-control" name="msg_email" placeholder="Enter your email address">
                        </div>
                        <div class="form-group mt-2">
                            <label for="subject">Subject *</label>
                            <input type="text" class="form-control" name="msg_subject" placeholder="Enter the subject">   
                        </div>
                    </div>
                    <div class="col-md-6">
                            <label for="message">Message *</label>
                            <textarea class="form-control" name="msg_text" rows="5" placeholder="Enter your message" maxlength="150"></textarea>
                            <button type="submit" class="btn btn-primary btn-block mt-2" name="send">Send Message</button>
                    </div>
                </div>
            </form>
            <div>
                <p class="text-success"> <?php if(isset($message)){
                        echo $message;
                    }?>
                </p>
            </div>
        </div>
        <div class="col-lg-5 my-auto">
            <div class="row mb-3">
                <div class="col-2 text-center">
                    <i class="fa fa-envelope fa-3x text-success"></i>
                </div>
                <div class="col-10">
                    General Inquiries: nahid15-3751@diu.edu.bd <br>
                    Technical Support: hasanisshakil@gmail.com <br>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-2 text-center">
                    <i class="fa fa-phone-square fa-3x text-success"></i>
                </div>
                <div class="col-10">
                    Customer Support: 01684181154 <br>
                    Business Inquiries: 01684181154 <br>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-2 text-center">
                    <i class="fa fa-home fa-3x text-success"></i>
                </div>
                <div class="col-10 my-auto">
                    Daffodil Smart City, Birulia, Savar, Dhaka-1216
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