<?php
try{
$pdo = new PDO("mysql:host=localhost;dbname=u690288683_pos_main","u690288683_pos_main","Pharmaciadimaano01.");
//echo "connection Sucessfull";

}catch(PDOException $f){
    
    echo $f->getmessage();
}
?>