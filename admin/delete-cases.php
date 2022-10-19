<?php 

require_once "../connection.php";

$id_no =  $_GET["id_no"];

$sql = "DELETE FROM cases_tbl WHERE id_no = $id_no ";

mysqli_query($conn , $sql); 

header("Location: manage-cases.php?delete-success-where-id_no=" .$id_no );


?>
