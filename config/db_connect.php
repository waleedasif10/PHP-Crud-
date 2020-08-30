<?php
//mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$conn= mysqli_connect('localhost','waleed','pakistan','waleed pizza');
 
 if(!$conn){
echo'connection error:'. mysqli_connect_error();
 }
 ?>