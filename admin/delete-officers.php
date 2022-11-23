<?php 

require_once "../connection.php";

$id =  $_GET["id"];

$sql = "DELETE FROM officers WHERE id = $id ";

mysqli_query($conn , $sql); 

header("Location: manage-officers.php?delete-success-where-id=" .$id );


?>
