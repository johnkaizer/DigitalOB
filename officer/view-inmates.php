
<?php 
    require_once "include/header.php";
?>

<?php 
 
//  database connection
require_once "../connection.php";

$sql = "SELECT * FROM inmates";
$result = mysqli_query($conn , $sql);

$i = 1;
$you = "";


?>

<style>
table, th, td {
  border: 1px solid black;
  padding: 15px;
}
table {
  border-spacing: 10px;
}
</style>

<div class="container bg-white shadow">
    <div class="py-4 mt-5"> 
    <h2 class="text-center pb-3">All Suspects</h2>
    <table style="width:100%" class="table-hover text-center ">
    <tr class="bg-dark">
        <th>S.No.</th>
        <th>Name</th>
        <th>ID Number</th>
        <th>Phone</th> 
        <th>Gender</th>
        <th>Date of Arrest</th>
        <th>Reason</th>
        <th>Items</th>
    </tr>
    <?php 
    
    if( mysqli_num_rows($result) > 0){
        while( $rows = mysqli_fetch_assoc($result) ){
            $name= $rows["name"];
            $id_no= $rows["id_no"];
            $phone = $rows["phone"];
            $gender = $rows["gender"];
            $date = $rows["date"];
            $reason = $rows["reason"];
            $items = $rows["items"];
            if($gender == "" ){
                $gender = "Not Defined";
            } 

            if($date == "" ){
                $date = "Not Defined";
                $days = "Not Defined";
            }else{
                $date1=date_create($date);
                $date2=date_create("now");
                $diff=date_diff($date1,$date2);
                $days = $diff->format("%y Years"); 
            }            
            ?>
        <tr>
        <td><?php echo $i; ?></td>
        <td><?php echo $id_no; ?></td>
        <td> <?php echo $name ; ?></td>
        <td><?php echo $phone; ?></td>
        <td><?php echo $gender; ?></td>
        <td><?php echo $date; ?></td>
        <td><?php echo $reason; ?></td> 
        <td><?php echo $items; ?></td> 

    <?php 
            $i++;
            }
        }else{
        echo "no admin found";
        }
    ?>
     </tr>
    </table>
    </div>
</div>

<?php 
    require_once "include/footer.php";
?>

<?php 
    require_once "include/footer.php";
?>