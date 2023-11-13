<?php
try{
$pdo = new PDO("mysql:host=localhost;dbname=u690288683_pos_main","u690288683_pos_main","Pharmaciadimaano01.");
//echo "connection Sucessfull";

}catch(PDOException $f){
    
    echo $f->getmessage();
}



//include_once"conectdb.php";
session_start();
if ($_SESSION["useremail"]=="" OR $_SESSION["role"]=="user"){
    
    header("location:index.php");
    
}

$id=$_POST["pidd"];
$sql="delete from tbl_user where userid=$id";
$delete=$pdo->prepare($sql);

if ($delete->execute()){
    
    
}else{
    
    
    echo"error in deleting";
}

?>