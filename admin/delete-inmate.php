<?php 

require_once "../connection.php";

$id_no =  $_GET["id_no"];

$sql = "DELETE FROM inmates WHERE id_no = $id_no ";

mysqli_query($conn , $sql); 

header("Location: manage-inmates1.php?delete-success-where-id_no=" .$id_no );


?>
