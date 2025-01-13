<?php
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname="crud";

  // create connection object
  $con = new mysqli($servername,$username,$password,$dbname);
  
  // check connection
  if($con -> connect_error){
    die("connection failed".$con->connect_error);
  }

?>

