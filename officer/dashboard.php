<?php 
require_once "include/header.php";
?>
<?php

        // database connection
        require_once "../connection.php";

         
        $i = 1;
        


        // applied leaves--------------------------------------------------------------------------------------------
        $total_accepted = $total_pending = $total_canceled = $total_applied = 0;
        $leave = "SELECT * FROM emp_leave WHERE email = '$_SESSION[email_emp]' ";
        $result = mysqli_query($conn , $leave);

        if( mysqli_num_rows($result) > 0 ){

            $total_applied = mysqli_num_rows($result);

            while( $leave_info = mysqli_fetch_assoc($result) ){
                $status = $leave_info["status"];

                if( $status == "pending" ){
                    $total_pending += 1;
                }elseif( $status == "Accepted" ){
                    $total_accepted += 1;
                }elseif( $status = "Canceled"){
                    $total_canceled += 1;
                }
            }
        }else{
            $total_accepted = $total_pending = $total_canceled = $total_applied = 0;
        }



        // leave status--------------------------------------------------------------------------------------------------------------
        $currentDay = date( 'Y-m-d', strtotime("today") );

        $last_leave_status = "No leave appliyed";
        $upcoming_leave_status = "";

        // for last leave status
        $check_leave = "SELECT * FROM emp_leave WHERE email = '$_SESSION[email_emp]' ";
        $s = mysqli_query($conn , $check_leave);
        if( mysqli_num_rows($s) > 0 ){
            while( $info = mysqli_fetch_assoc($s) ){
               $last_leave_status =  $info["status"] ;
            }
    }


    // for next leave date
    $check_ = "SELECT * FROM emp_leave WHERE email = '$_SESSION[email_emp]' ORDER BY start_date ASC ";
    $e = mysqli_query($conn , $check_); 
    if( mysqli_num_rows($e) > 0 ){
        while( $info = mysqli_fetch_assoc($e) ){
            $date = $info["start_date"] ;
            $last_leave =  $info["status"] ;
           if ( $date > $currentDay && $last_leave == "Accepted" ){
               $upcoming_leave_status = date('jS F', strtotime($date) ) ;
               break;
           }
        }
}


        // total suspects--------------------------------------------------------------------------------------------
        $select_emp = "SELECT * FROM inmates";
        $total_emp = mysqli_query($conn , $select_emp);

       



        // current suspects in custody--------------------------------------------------------------------------
        $sql_highest_salary =  "SELECT * FROM inmates ORDER BY id_no DESC";
        $emp_ = mysqli_query($conn , $sql_highest_salary);



?>

<div class="container">

    <div class="row mt-5">
        <div class="col-4">
            <div class="card shadow " style="width: 18rem;">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item text-center"> <b>Leave Status</b> </li>
                    <li class="list-group-item">Upcoming Leave on :  <?php echo  $upcoming_leave_status ; ?>  </li>
                    <li class="list-group-item">Last Leave's Status :  <?php echo ucwords($last_leave_status) ;  ?> </li>
                </ul>
            </div>
        </div>
        <div class="col-4">
            <div class="card shadow " style="width: 18rem;">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item text-center"> <b>Applied leaves</b> </li>
                    <li class="list-group-item">Total Accepted  : <?php echo $total_accepted;  ?> </li>
                    <li class="list-group-item">Total Canceled  : <?php echo $total_canceled; ?> </li>
                    <li class="list-group-item">Total Pending  : <?php echo $total_pending; ?> </li>
                    <li class="list-group-item">Total Applied  : <?php echo $total_applied; ?> </li>
                </ul>
            </div>
        </div>
        <div class="col-4">
            <div class="card shadow " style="width: 18rem;">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item text-center"> <b>Suspects</b>  </li>
                    <li class="list-group-item">Total Suspects : <?php echo mysqli_num_rows($total_emp); ?></li>
                    <li class="list-group-item text-center"><a href="view-inmates.php"> <b>View All Suspects</b></a></li>
                </ul>
            </div>
        </div>
    </div>
    <!-- <div class="row mt-5">
        <div class="col-4">       
        </div>

        <div class="col-4">
            <div class="card shadow " style="width: 18rem;">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item text-center">Employees on Leave (Weekwise) </li>
                    <li class="list-group-item">This Week : </li>
                    <li class="list-group-item">Next Week : </li>
                </ul>
            </div>
        </div>
    </div> -->
    <div class="row mt-5 bg-white shadow "> 
    <div class="col-12">
            <div class=" text-center my-3 "> <h4>Suspects in Custody as of Today</h4> </div>
            <table class="table  table-hover">
        <thead>
            <tr class="bg-dark">
            <th scope="col">S.No.</th>
            <th scope="col">Suspect's Name</th>
            <th scope="col">Suspect's ID Number</th>
            <th scope="col">Phone</th>
            <th scope="col">Gender</th>
            <th scope="col">Arrested Date</th>
            </tr>
        </thead>
        <tbody>
        <?php while( $emp_info = mysqli_fetch_assoc($emp_) ){
                    $emp_name = $emp_info["name"];
                    $emp_id = $emp_info["id_no"];
                    $emp_phone = $emp_info["phone"];
                    $emp_gender = $emp_info["gender"];
                    $emp_date = $emp_info["date"];
                    ?>
            <tr>
            <th ><?php echo "$i. "; ?></th>
            <th ><?php echo $emp_name; ?></th>
            <td><?php echo $emp_id; ?></td>
            <td><?php echo $emp_phone; ?></td>
            <td><?php echo $emp_gender; ?></td>
            <td><?php echo $emp_date; ?></td>
            </tr>

          <?php  
          $i++; 
                } 
            ?>
        </tbody>
        </table>
    </div>
    </div>
</div>

<?php 
require_once "include/footer.php";
?>