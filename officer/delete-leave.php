<?php 

    // database connection
    require_once "../connection.php";
    $id = $_GET["id"];

    $sql = "DELETE FROM off_leave WHERE id = '$id' ";
    $result= mysqli_query($conn , $sql);
    if($result){
        header("Location: leave-status.php?delete-success-id=" .$id);
    }
?>