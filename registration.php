<?php
try{
$pdo = new PDO("mysql:host=localhost;dbname=u690288683_pos_main","u690288683_pos_main","Pharmaciadimaano01.");
//echo "connection Sucessfull";

}catch(PDOException $f){
    
    echo $f->getmessage();
}

session_start();
if ($_SESSION["useremail"]=="" OR $_SESSION["role"]=="user"){
    
    header("location:index.php");
}

include_once"header.php";



//function for saving a new user
if(isset($_POST["btnSave"])){

$username=$_POST["txtregname"];
$useremail=$_POST["txtregemail"];
$userrole=$_POST["txtselect_options"];
$userpassword=$_POST["txtregpassword"];

$select=$pdo->prepare("select useremail from tbl_user where useremail='$useremail'");  
$select->execute();
if ($select->rowCount()> 0)
{
    echo "<script type='text/javascript'>
        jQuery(function validation(){
        Swal.fire({
        position: 'center',
        icon: 'error',
        title: 'Warning',
        text: 'Someone is already registered with this Email',
        showConfirmButton: false,
        timer: 3000
        })
    });
        </script>";

}else{
    $insert=$pdo->prepare("insert into tbl_user(username,useremail,password,role) values(:name,:email,:pass,:role)");
    $insert->bindParam(":name",$username);
    $insert->bindParam(":email",$useremail);
    $insert->bindParam(":pass",$userpassword);
    $insert->bindParam(":role",$userrole);
    
    if ($insert->execute()){
        
        echo "<script type='text/javascript'>
        jQuery(function validation(){
        Swal.fire({
        position: 'center',
        icon: 'success',
        title: 'Saved',
        text: 'Cardentials saved succesfully',
        showConfirmButton: false,
        timer: 3000
        })
    });
        </script>";
        
}else{
        echo "<script type='text/javascript'>
        jQuery(function validation(){
        Swal.fire({
        position: 'center',
        icon: 'error',
        title: 'Failed',
        text: 'Unable to save cardentials',
        showConfirmButton: false,
        timer: 3000
        })
    });
        </script>";
}
    }
        }

?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"  style="overflow:scroll; height:400px;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">CREATE NEW USER</h1>
        
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">LOGOUT</a></li>
              <li class="breadcrumb-item active">Admin Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    
              
               <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Registration Form</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="" method="post">

             <div class="card-body">
              <div class="form-group">
                    <label for="exampleInputPassword1">Name</label>
                    <input type="text" class="form-control"  placeholder="Enter User Name to be added" name="txtregname" required>
                  </div>
                   
                   
                   
                  <div class="form-group">
                    <label for="exampleInputPassword1">Email</label>
                    <input type="email" class="form-control"  placeholder="Enter Email to be added" name="txtregemail" required>
                  </div>
                 
                 <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control"  placeholder="Enter Desired Password" name="txtregpassword" required>
                  </div>
    
                  <div class="form-group">
                        <label> Role</label>
                        <select class="form-control" name="txtselect_options" required>
                         <option value="" disabled selected>Select Role</option>
                          <option>user</option>
                           <option>admin</option>
                          
                          
                        </select>
                      </div>
         
                
               
                <!-- /.card-body -->

                <div class="form-group">
                  <button type="submit" class="btn btn-info" name="btnSave">Save</button>
                </div>
               
             </div>
                </div>
              </form>
            </div>
            <!-- /.card -->

           
                
              
    
            

          <!--/.col (left) -->
          <!-- right column -->

       <div class="col-md-6">
            
            <div class="card card-success" style="width:200%;">
              <div class="card-header">
                <h3 class="card-title">Users</h3></h3>
              </div>
              <div class="card-body">
        
        <form  action="" method="POST">
        <table id="example2" class="table table-bordered table-hover">

        <thead>
             <tr>
                 
                 <td>#</td>
                 <td>NAME</td>
                 <td>EMAIL</td>
                 <td>PASSWORD</td>
                 <td>ROLE</td>
             </tr>  
               
               
           </thead>
            
            
            
            <tbody>
                
             <?php
                
                
                $select=$pdo->prepare("select * from tbl_user order by userid desc");
                
                $select->execute();
                
                while($row=$select->fetch(PDO::FETCH_OBJ)){
                    
                    
                    
                    echo "
                    
                    <tr>
                    <td>$row->userid</td>
                    <td>$row->username</td>
                    <td>$row->useremail</td>
                    <td>$row->password</td>
                    <td>$row->role</td>
                    
                    <td>
                    
            
                
                    <td>
                    <a href=\"Editproduct.php?id=".$row->pid."\" 
                    class= \"btn btn-info\" role=\"button\" ><span class=\"fas fa-edit\" name=\"editBtn\"    style=\"color:#ffffff\" data-toggle=\"tooltip\" title=\"EDIT\"></span>
                    </a>
                    </td>
                    
                    <td>
                    <button id=".$row->userid." 
                    class= \"btn btn-danger dltBttn \" type=\"button\" ><span class=\"fas fa-trash\"   style=\"color:#ffffff\" data-toggle=\"tooltip\" title=\"DELETE\"></span>
                    </button>
                    </td>
                    
                    
                    </form>
                    
                     
                    </td>
                    
                    </tr>
                    ";
                    
                    
                    
                    
                    
                }
                
                
                ?>   
                    
                    
                
                
            </tbody>


        </table>
                  </form>
        
             </div>
               </div>
           
                
              
            </div>
    
    </div>


<script>

$(document).ready(function(){
    
    
$(".dltBttn").click(function(){
       
      
       var tdh =$(this);
    var id=$(this).attr("id");
   //   alert(id);
    
    
    
    
    Swal.fire({
  title: 'Are you sure?',
  text: "Once Deleted You won't be able to revert this!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
})
        .then((result) => {
  if (result.isConfirmed) {
      
      
       $.ajax({
       
       url:"userdelete.php",
       type:"post",
       data:{
           
           pidd:id
           
       },
       
       success:function(data){
           
       
       tdh.parents("tr").hide();
   }
           
   });
      
      
      
      
    Swal.fire(
      'Deleted!',
      'user has been deleted.',
      'success'
    );
      
  }
        
     
});
       
   });
    
    
    
});



</script>


  <!-- /.control-sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

 <?php
include_once"footer.php";


?>