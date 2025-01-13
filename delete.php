<?php
    include 'connection.php';
    $redirect_url = 'index.php';
    if (isset ( $_GET['id'] ) ){
        $id = $_GET ['id'];
        $sql = "DELETE FROM User_information WHERE id = $id";
        $result = $con -> query($sql);
        $redirect_url= "index.php?is_delete=true";
        if( $result ){
            header("location:./" . $redirect_url); 
        }
        
    }
?>

