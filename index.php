<?php
require "./includes/top.php";
require "./includes/db.con.php";
if($conn){

    $res=mysqli_query($conn,"SELECT * FROM `user`");

  

}

if(isset($_GET['update']))
{
   if($_GET['update']==10){
      echo'<div class="alert alert-success" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <strong>Success!</strong> User Update successfully!
    </div>';

   }

}

if(isset($_GET['delete']))
{
   if($_GET['delete']==10){
      echo'<div class="alert alert-danger" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <strong>Success!</strong> User Delete successfully!
    </div>';

   }

}


?>
         <div class="content pb-0">
            <div class="orders">
               <div class="row">
                  <div class="col-xl-12">
                     <div class="card">
                     <div class="card-body d-flex justify-content-between" >
                           <h2 class="box-title" style="font-size:25px;">Users </h2>
                           <a class="btn btn-primary" style="height:40px" href="user-insert.php" role="button">Add User</a>
                        </div>
                        <div class="card-body--">
                           <div class="table-stats order-table ov-h">
                              <table class="table ">
                                 <thead>
                                    <tr>
                                       <th class="serial">#</th>
                                       <th class="avatar">Profile</th>
                                      
                                       <th>Name</th>
                                       <th>Phone</th>
                                       <th>age</th>
                                       <th>Gender</th>
                                       <th>Action</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php 
                                    if(mysqli_num_rows($res)>0){
                                        $i=1;
                                        while($row=mysqli_fetch_assoc($res)){

                                        

                                    
                                    ?>
                                    <tr>
                                       <td class="serial"><?php echo$i?></td>
                                       <td class="avatar">
                                          <div class="round-img">
                                             <a href="#"><img class="rounded-circle" src="profile pic/<?php echo$row['image']?>" alt=""></a>
                                          </div>
                                       </td>
                                       
                                       <td> <span class="name"><?php echo$row['name']?></span> </td>
                                       <td> <span class=""><?php echo$row['phone']?></span> </td>
                                       <td> <span class=""><?php echo$row['age']?></span> </td>
                                       <td> <span class=""><?php echo$row['gender']?></span> </td>

                                       <td>
                                       <a class="btn btn-primary m-2" href="user-insert.php?userid=<?php echo$row['id']?>" role="button">Edit</a>
                                         <a class="btn btn-danger m-2" onclick="return checkdelete()" href="user-delete.php?userid=<?php echo$row['id']?>" role="button">Delete</a>
                                       </td>
                                    </tr>
                                    <?php
                                    $i++;
                                        }
                                    }
                                    else{
                                        ?>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            
                                            <td ><h4>No Data Found</h4></td>
                                        </tr>
                                   <?php }
                                    ?>
                                   
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
		  </div>

       
          <?php

require "./includes/footer.php";



?>




