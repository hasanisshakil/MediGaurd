<?php
include_once('config.php');
    if(isset($_GET['u_id']) && isset($_GET['u_name'])){
        $u_id= $_GET['u_id'];
        $u_name= $_GET['u_name'];
    }
    //Block User
    $unblock_sql= "UPDATE user_info SET user_blocked='No' WHERE user_id='$u_id'";
    $run_unblock_sql= mysqli_query($conn, $unblock_sql);

    if($run_unblock_sql){
        $message= "User $u_name Has Been Unblocked";
        header("location:user_block_list.php?unblock=$message");
    }
?>