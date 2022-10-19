<?php 

require_once "../connection.php";

$id =  $_GET["id"];

$sql = "DELETE FROM inmates WHERE id = $id ";

mysqli_query($conn , $sql); 

header("Location: manage-inmates.php?delete-success-where-id=" .$id );


?>
