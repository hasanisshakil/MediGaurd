<?php
include_once('config.php');
    if(isset($_GET['user_id']) && isset($_GET['user_name'])){
        $user_id= $_GET['user_id'];
        $user_name= $_GET['user_name'];
    }
    //Block User
    $block_sql= "UPDATE user_info SET user_blocked='Blocked' WHERE user_id='$user_id'";
    $run_block_sql= mysqli_query($conn, $block_sql);

    if($run_block_sql){
        $message= "User $user_name Has Been Blocked";
        header("location:user_list.php?blocked=$message");
    }
?>