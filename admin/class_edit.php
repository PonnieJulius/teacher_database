<?php
    require('../dbFunctions/security.php');
    $admin_id = $_SESSION['admin_id'];
    if(!isset($admin_id)){
        header('Location: ../login.php');
}
?>
<?php
    include('includes/hdb.php'); 
    include('includes/sidenavadmin.php'); 
    include('includes/topnav.php');
?>
<div class="container  py-5">
    <div class="row justify-content-center">
        <div class="col-md-10"> 
        <?php
                    if(isset($_SESSION['success']) && $_SESSION['success'] !=''){
                        echo '<div class="alert alert-primary"><strong>Hey, </strong>'.$_SESSION['success'].'</div>';
                        unset($_SESSION['success']);
                    }
                    if(isset($_SESSION['status']) && $_SESSION['status'] !=''){
                        echo '<div class="alert alert-danger"><strong>Sorry!! </strong>'.$_SESSION['status'].'</div>';
                        unset($_SESSION['status']);
                    }
                ?>
            <div class="card">
            <?php
                $class_id = $_GET['id'];
                    $query = "SELECT * FROM `classes` WHERE `class_id` = '$class_id'";
                    $query_run = mysqli_query($conn, $query);
                    if(mysqli_num_rows($query_run) > 0){
                        foreach($query_run as $row){
                            //$_SESSION['subject'] = $row['id'];
                            //echo $_SESSION['subject'];
                            ?>
                                 <form action="../dbFunctions/user.php" method="POST" enctype="multipart/form-data">
                                    <div class="card-body">
                                        <h1 class="modal-title fs-4 text-primary text-center" id="exampleModalLabel">Edit Class</h1>
                                        <input type="hidden" value="<?php echo $row['class_id'] ?>" name="class_id"> 
                                        <div class="card-body">                
                                            <div class="mb-3 mt-3">
                                                <label class="form-label">Class:</label>
                                                <input type="text" value="<?php echo $row['class'] ?>" name="editclass_name" class="form-control">
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Tag Name:</label>
                                                <input type="text" value="<?php echo $row['class_tag'] ?>" name="editclass_tag" class="form-control">
                                            </div>
                                            <div class="modal-footer">
                                                <a href="class.php" class="btn btn-danger text-white">Close</a>
                                                <button type="submit" class="btn btn-primary" name="edit_class">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            <?php
                        }
                    }else{
                        echo 'Not Data Found';
                    }
                    ?>
            </div>
        </div>
    </div>
</div>

       

<?php
    include('includes/fdb.php');
    include('includes/script.php');
?>
