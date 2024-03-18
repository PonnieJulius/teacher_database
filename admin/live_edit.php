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
                    $query = "SELECT * FROM `live_sessions` WHERE `live_id` = '$class_id'";
                    $query_run = mysqli_query($conn, $query);
                    if(mysqli_num_rows($query_run) > 0){
                        foreach($query_run as $row){
                            //$_SESSION['subject'] = $row['id'];
                            //echo $_SESSION['subject'];
                            ?>
                                 <form action="../dbFunctions/code.php" method="POST" enctype="multipart/form-data">
                                    <div class="card-body">
                                        <h1 class="modal-title fs-4 text-primary text-center" id="exampleModalLabel">Edit Class</h1>
                                        <input type="hidden" value="<?php echo $row['live_id'] ?>" name="edit_live_id"> 
                                        <div class="card-body">                
                                            <div class="mb-3 mt-3">
                                                <label class="form-label">Lesson title:</label>
                                                <input type="text" value="<?php echo $row['lesson'] ?>" name="editlesson_title" class="form-control">
                                            </div>
                                            <div class="mb-3">
                                                <?php
                                                    $query = "SELECT * FROM `users`";
                                                    $query_run = mysqli_query($conn, $query);
                                                    if(mysqli_num_rows($query_run) > 0) {
                                                    ?>                              
                                                    <div class="mb-3 mt-3">
                                                        <label for="class" class="form-label">Teacher:</label>
                                                        <select name="teacher_edit" class="form-select" required>
                                                            <option value="<?php echo $row['teacher_id'] ?>">Choose a teacher</option>
                                                            <?php
                                                            foreach($query_run as $teacher) {
                                                            ?>
                                                            <option value="<?php echo $teacher['user_id'];?>"><?php echo $teacher['user_name'];?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <?php
                                                    } else {
                                                        echo '<div class="alert alert-danger"><strong>Sorry!! </strong>No Class Available</div>';
                                                    }
                                                    ?>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="phone" class="form-label">Price:</label>
                                                    <input type="text" value="<?php echo $row['price'] ?>" name="edit_price" class="form-control">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="phone" class="form-label">Participants:</label>
                                                    <input type="text"value="<?php echo $row['participants'] ?>"name="edit_participants" class="form-control">
                                                </div>

                                                <div class="mb-3">
                                                    <?php
                                                    $query = "SELECT * FROM `classes`";
                                                    $query_run = mysqli_query($conn, $query);
                                                    if(mysqli_num_rows($query_run) > 0) {
                                                    ?>                              
                                                    <div class="mb-3 mt-3">
                                                        <label for="class" class="form-label">Class:</label>
                                                        <select name="edit_class" class="form-select">
                                                            <option value="<?php echo $row['class'] ?>">Choose a Class</option>
                                                            <?php
                                                            foreach($query_run as $class) {
                                                            ?>
                                                            <option value="<?php echo $class['class'];?>"><?php echo $class['class'];?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <?php
                                                    } else {
                                                        echo '<div class="alert alert-danger"><strong>Sorry!! </strong>No Class Available</div>';
                                                    }
                                                    ?>
                                                </div>
                                                <div class="mb-3">
                                                    <?php
                                                    $query = "SELECT * FROM `subjects`";
                                                    $query_run = mysqli_query($conn, $query);
                                                    if(mysqli_num_rows($query_run) > 0) {
                                                    ?>                              
                                                    <div class="mb-3 mt-3">
                                                        <label for="subject" class="form-label">Subject:</label>
                                                        <select name="edit_subject" class="form-select">
                                                            <option value="<?php echo $row['subject'] ?>">Choose a Subject</option>
                                                            <?php
                                                            foreach($query_run as $subject) {
                                                            ?>
                                                            <option value="<?php echo $subject['subject'];?>"><?php echo $subject['subject'];?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <?php
                                                    } else {
                                                        echo '<div class="alert alert-danger"><strong>Sorry!! </strong>No Subject Available</div>';
                                                    }
                                                    ?>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="status" class="form-label">Status:</label>
                                                    <select name="edit_status" class="form-select">
                                                        <option value="<?php echo $row['status'] ?>" >Choose Status</option>
                                                        <option value="1">Paid</option>
                                                        <option value="2">Not Paid</option>
                                                    </select>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" onclick="location.reload();">Close</button>
                                                    <button type="submit" class="btn btn-primary" name="session_edit">Submit</button>
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
