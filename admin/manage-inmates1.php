<?php 
    require_once "include/header.php";
?>


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
    <div class='text-center pb-2'><h2>Manage Suspects in Custody</h2></div>
    <table style="width:100%" class="table-hover text-center ">
    <tr class="bg-dark">
        <th>S.No.</th>
        <th>Name</th>
        <th>ID Number</th>
        <th>Phone</th> 
        <th>Gender</th>
        <th>Arrested Date</th>
        <th>Reason(s) for arrest</th>
        <th>Items</th>
        <th>Action</th>
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
                $date = date('jS F, Y' , strtotime($date));
                $date1=date_create($date);
                $date2=date_create("now");
                $diff=date_diff($date1,$date2);
                $days = $diff->format("%Y"); 
            }  
            
            ?>
        <tr>
        <td><?php echo "{$i}."; ?></td>
        <td><?php echo $name; ?></td>
        <td><?php echo $id_no ; ?></td>
        <td><?php echo $phone; ?></td>
        <td><?php echo $gender; ?></td>
        <td><?php echo $date; ?></td>
        <td><?php echo $reason; ?></td>
        <td><?php echo $items; ?></td>

        <td>  <?php 
                $edit_icon = "<a href='edit-inmate.php?id_no= {$id_no}' class='btn-sm btn-primary float-right ml-3 '> <span ><i class='fa fa-edit '></i></span> </a>";
                $delete_icon = " <a href='delete-inmate.php?id_no={$id_no}' id_no='bin' class='btn-sm btn-primary float-right'> <span ><i class='fa fa-trash '></i></span> </a>";
                echo $edit_icon . $delete_icon;
             ?> 
        </td>

      
        

    <?php 
            $i++;
            }
        }else{
            echo "<script>
            $(document).ready( function(){
                $('#showModal').modal('show');
                $('#linkBtn').attr('href', 'add-inmates.php');
                $('#linkBtn').text('Add Suspect');
                $('#addMsg').text('No Suspect(s) Found!');
                $('#closeBtn').text('Remind Me Later!');
            })
         </script>
         ";
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