<?php 
    require_once "include/header.php";
?>


<?php  

        $nameErr = $id_noErr = $phoneErr = $descriptionErr = $locationErr = $categoryErr = "";
        $name = $id_no = $date = $gender = $phone = $description = $location = $category = "";

        if( $_SERVER["REQUEST_METHOD"] == "POST" ){

            if( empty($_REQUEST["gender"]) ){
                $gender ="";
            }else {
                $gender = $_REQUEST["gender"];
            }


            if( empty($_REQUEST["date"]) ){
                $date = "";
            }else {
                $date = $_REQUEST["date"];
            }
            if( empty($_REQUEST["location"]) ){
                $location = "";
            }else {
                $location = $_REQUEST["location"];
            }
            if( empty($_REQUEST["category"]) ){
                $category = "";
            }else {
                $category = $_REQUEST["category"];
            }

            if( empty($_REQUEST["name"]) ){
                $nameErr = "<p style='color:red'> * Name is required</p>";
                $name = "";
            }else {
                $name = $_REQUEST["name"];
            }

            if( empty($_REQUEST["id_no"]) ){
                $id_noErr = "<p style='color:red'> * ID Number is required</p>";
                $id_no = "";
            }else {
                $id_no = $_REQUEST["id_no"];
            }

            if( empty($_REQUEST["phone"]) ){
                $phoneErr = "<p style='color:red'> * Phone is required</p> ";
                $phone = " ";
            }else{
                $phone = $_REQUEST["phone"];
            }

            if( empty($_REQUEST["description"]) ){
                $descriptionErr = "<p style='color:red'> * Description is required</p> ";
                $description = "";
            }else{
                $description = $_REQUEST["description"];
            }


            if( !empty($name) && !empty($id_no) && !empty($phone) && !empty($description) ){

                // database connection
                require_once "../connection.php";

                $sql_select_query = "SELECT id_no FROM cases_tbl WHERE id_no = '$id_no' ";
                $r = mysqli_query($conn , $sql_select_query);

                if( mysqli_num_rows($r) > 0 ){
                    $id_noErr = "<p style='color:red'> * Case with id Already Reported</p>";
                } else{

                    $sql = "INSERT INTO cases_tbl ( id_no , name , phone , gender , date , description , location , category ) VALUES ( '$id_no' , '$name' , '$phone' , '$gender' , '$date', '$description' , '$location' , '$category' )  ";
                    $result = mysqli_query($conn , $sql);
                    if($result){
                     $id_no = $name = $phone = $gender = $date = $description = $location = $category = "";
                        echo "<script>
                        $(document).ready( function(){
                            $('#showModal').modal('show');
                            $('#modalHead').hide();
                            $('#linkBtn').attr('href', 'manage-cases.php');
                            $('#linkBtn').text('View Cases');
                            $('#addMsg').text('Cases Added Successfully!');
                            $('#closeBtn').text('Add More?');
                        })
                     </script>
                     ";
                    }
                    
                }

            }
        }

?>

<div style=""> 
<div class="login-form-bg h-100">
        <div class="container  h-100">
            <div class="row justify-content-center h-100">
                <div class="col-xl-6">
                    <div class="form-input-content">
                        <div class="card login-form mb-0">
                            <div class="card-body pt-4 shadow">                       
                                    <h2 class="text-center">Repot New Case</h2>
                                <form method="POST" action=" <?php htmlspecialchars($_SERVER['PHP_SELF']) ?>">
                            
                                <div class="form-group">
                                    <label >ID Number :</label>
                                    <input type="number" class="form-control" value="<?php echo $id_no; ?>"  name="id_no" >
                                   <?php echo $id_noErr; ?>
                                </div>
                                <div class="form-group">
                                    <label >Full Name :</label>
                                    <input type="text" class="form-control" value="<?php echo $name; ?>"  name="name" >     
                                    <?php echo $nameErr; ?>
                                </div>

                                <div class="form-group">
                                    <label >Phone Number : </label>
                                    <input type="number" class="form-control" value="<?php echo $phone; ?>" name="phone" > 
                                    <?php echo $phoneErr; ?>           
                                </div>

                                <div class="form-group">
                                    <label >Description :</label>
                                    <input type="text" class="form-control" value="<?php echo $description; ?>" name="description" >  
                                    <?php echo $descriptionErr; ?>            
                                </div>
                                <div class="form-group">
                                    <label >Location :</label>
                                    <input type="text" class="form-control" value="<?php echo $location; ?>" name="location" >  
                                    <?php echo $locationErr; ?>           
                                </div>
                                <div class="form-group">
                                    <label >Category :</label>
                                    <input type="text" class="form-control" value="<?php echo $category; ?>" name="category" >  
                                    <?php echo $categoryErr; ?>            
                                </div>

                                <div class="form-group">
                                    <label >Date :</label>
                                    <input type="date" class="form-control" value="<?php echo $date; ?>" name="date" >  
                                   
                                </div>

                                <div class="form-group form-check form-check-inline">
                                    <label class="form-check-label" >Gender :</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" <?php if($gender == "Male" ){ echo "checked"; } ?>  value="Male"  selected>
                                    <label class="form-check-label" >Male</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" <?php if($gender == "Female" ){ echo "checked"; } ?>  value="Female">
                                    <label class="form-check-label" >Female</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" <?php if($gender == "Other" ){ echo "checked"; } ?>  value="Other">
                                    <label class="form-check-label" >Other</label>
                                </div>

                               
                                <br>

                                <button type="submit" class="btn btn-primary btn-block">Add</button>
                                  </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
    require_once "include/footer.php";
?>


