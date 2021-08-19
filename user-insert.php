<?php
require "./includes/top.php";
require "./includes/db.con.php";
$errorMsg="";
$fname="";
$lname="";
$phone="";
$age="";
$gender="";
$img_required="required";


if(isset($_GET['userid']) && !empty($_GET['userid'])  )
{


   $img_required="";
   $userid=mysqli_real_escape_string($conn,$_GET['userid']);

   $data=mysqli_query($conn,"select * from user where id='$userid'");

   if(mysqli_num_rows($data)>0){

      $row=mysqli_fetch_assoc($data);
      

      $fullname=$row['name'];

      $str=explode(" ",$fullname);
      $fname=$str[0];
      $lname=$str[1];

      $phone=$row['phone'];
      $age=$row['age'];
      $gender=$row['gender'];










   }
   else{
      header("location:index.php");
   }


}



if(isset($_POST['submit'])){

    

    if($conn){

        
        $fname=mysqli_real_escape_string($conn,$_POST['fname']);
        $lname=mysqli_real_escape_string($conn,$_POST['lname']);
        $phone=mysqli_real_escape_string($conn,$_POST['phone']);
        $age=mysqli_real_escape_string($conn,$_POST['age']);
        $gender=mysqli_real_escape_string($conn,$_POST['gender']);

        // print_r($_FILES['profile']);
        // print_r($_FILES['profile']['name']);
        $imageName=$_FILES['profile']['name'];
        


      //   error code 0 select or not
        if($_FILES['profile']['error']=='0' && $_FILES['profile']['type']!='image/jpeg' && $_FILES['profile']['type']!='image/jpg' && $_FILES['profile']['type']!='image/png'){
            $errorMsg="Please Select Valid Image";


        }

        if($errorMsg==""){

         if(isset($_GET['userid']) && !empty($_GET['userid']) ){

            if($_FILES['profile']['name']!=""){

               $destination="./profile pic/".''.$_FILES['profile']['name'];
               move_uploaded_file($_FILES['profile']['tmp_name'],$destination);

               $update_query="UPDATE `user` SET `name`='$fname $lname',`phone`='$phone',`age`='$age',`gender`='$gender',`image`='$imageName' WHERE id='$userid'";






            }
            else{
               $update_query="UPDATE `user` SET `name`='$fname $lname',`phone`='$phone',`age`='$age',`gender`='$gender' WHERE id='$userid'";

               

            }
            $result=mysqli_query($conn,$update_query);
            if($result!='')
            {
                header("location:index.php?update=10");
            }
            


         }
         else{
            $destination="./profile pic/".''.$_FILES['profile']['name'];
            move_uploaded_file($_FILES['profile']['tmp_name'],$destination);

            $insert_query="INSERT INTO `user`(`name`, `phone`, `age`, `gender`, `image`) VALUES ('$fname $lname','$phone','$age','$gender','$imageName')";

            $result=mysqli_query($conn,$insert_query);

            if($result!='')
            {
                header("location:user-insert.php?insert=10");
            }
         }

           




        }


    }


}

if(isset($_GET['insert']))
{
   if($_GET['insert']==10){
      echo'<div class="alert alert-success" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <strong>Success!</strong> User add successfully!
    </div>';

   }

}



?>
 


<div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong>User</strong><small> Form</small></div>
                        <div class="card-body card-block">
                           
                           <form enctype="multipart/form-data" action="" method="post">
                           <div class="form-group">
                             <label for="firstname">Firstname:</label>
                             <input required type="text" value="<?php echo$fname?>" name="fname" id="firstname" class="form-control" placeholder="First Name">
                          </div>
                          <div class="form-group">
                           <label  for="lastname">Lastname:</label>
                           <input required type="text" value="<?php echo$lname?>" name="lname" id="lastname" class="form-control" placeholder="Last Name">
                          </div>
                          <div class="form-group">
            <label for="phone">Phone:</label>
            <input required type="number" value="<?php echo$phone?>" name="phone" id="phone" class="form-control" placeholder="Phone">
        </div>
        <div class="form-group">
            <label  for="dob">Age:</label>
            <input type="number" value="<?php echo$age?>" required name="age" id="age" class="form-control" placeholder="Age">
        </div>
        <div class="form-group">
            <label for="gender">Gender:</label>
            <select  class="form-control" name="gender" id="gender">
                <option value="" selected disabled>Select Gender</option>
                <option <?php if($gender=='male')
                   { echo"selected";
                   }?> value="male">
                   Male
                </option>
                <option <?php if($gender=='female')
                   { echo"selected";
                   }?> value="female">
                Female
                </option>
                <option value="other" <?php if($gender=='other')
                   { echo"selected";
                   }?>>Other</option>
               
            </select>
            
        </div>
                        <div class="form-group">
                        <label for="image" class="form-control-label">Profile Pic</label>
                        <input type="file" accept="image/*" name="profile" id="image" class="form-control" <?php echo $img_required?> >
                        <p style="color:red"><?php echo$errorMsg?></p>
                        </div>
                           <button id="payment-button" name="submit" type="submit" class="btn btn-lg btn-info btn-block">
                           <span id="payment-button-amount">Submit</span>
                           </button>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
<?php
require "./includes/footer.php";
?>