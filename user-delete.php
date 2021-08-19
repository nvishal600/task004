<?php

print_r($_GET);

if(isset($_GET['userid']) && !empty($_GET['userid']) ){

    require "./includes/db.con.php";

    if($conn){
        $userid=mysqli_real_escape_string($conn,$_GET['userid']);

        $data=mysqli_query($conn,"select * from user where id='$userid';");

   if(mysqli_num_rows($data)>0){

   

    

    $result=mysqli_query($conn,"DELETE FROM `user` WHERE id='$userid';");

    if($result!=null){


        header("location:index.php?delete=10");



    }

   


   }
   else{
    header("location:index.php");

   }

    }
  

}

?>