<?php 
    require_once "include/header.php";
?>


<?php 
    require_once "include/header.php";
?>

<?php 
 
//  database connection
require_once "../connection.php";

$sql = "SELECT * FROM cases_tbl";
$result = mysqli_query($conn , $sql);

$i = 1;


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
    <div class='text-center pb-2'><h2>Manage Reported Cases</h2></div>
    <table style="width:100%" class="table-hover text-center ">
    <tr class="bg-dark">
        <th>S.No.</th>
        <th>ID Number</th>
        <th>Name</th>
        <th>Phone</th>
        <th>Gender</th>
        <th>Date</th>
        <th>Description</th> 
        <th>Location</th>
        <th>Category</th>
        <th>Action</th>
    </tr>
    <?php 
    
    if( mysqli_num_rows($result) > 0){
        while( $rows = mysqli_fetch_assoc($result) ){
            $id_no= $rows["id_no"];
            $name= $rows["name"];
            $phone= $rows["phone"];
            $gender = $rows["gender"];
            $date= $rows["date"];
            $description = $rows["description"];
            $location = $rows["location"];
            $category = $rows["category"];
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
        <td><?php echo $id_no; ?></td>
        <td><?php echo $name ; ?></td>
        <td><?php echo $phone; ?></td>
        <td><?php echo $gender; ?></td>
        <td><?php echo $date; ?></td>
        <td><?php echo $description; ?></td>
        <td><?php echo $location; ?></td>
        <td><?php echo $category; ?></td>

        <td>  <?php 
                $edit_icon = "<a href='edit-case.php?id_no= {$id_no}' class='btn-sm btn-primary float-right ml-3 '> <span ><i class='fa fa-edit '></i></span> </a>";
                $delete_icon = " <a href='delete-cases.php?id_no={$id_no}' id_no='bin' class='btn-sm btn-primary float-right'> <span ><i class='fa fa-trash '></i></span> </a>";
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
                $('#linkBtn').attr('href', 'add-cases.php');
                $('#linkBtn').text('Add Case');
                $('#addMsg').text('No Cases Found!');
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