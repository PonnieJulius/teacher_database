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
                $id = $_GET['id'];
                    $query = "SELECT * FROM `users` WHERE `user_id` = '$id'";
                    $query_run = mysqli_query($conn, $query);
                    if(mysqli_num_rows($query_run) > 0){
                        foreach($query_run as $teacher){
                            //$_SESSION['subject'] = $row['id'];
                            //echo $_SESSION['subject'];
                            ?>
                                 <form action="../dbFunctions/user.php" method="POST" enctype="multipart/form-data">
                                    <div class="card-body">
                                        <h1 class="modal-title fs-4 text-primary text-center" id="exampleModalLabel">Edit a teacher Details</h1>
                                        <input type="hidden" value="<?php echo $teacher['user_id'] ?>" name="edit_id"> 
                                        <div class="modal-body">          
                                                <div class="mb-3 mt-3">
                                                    <label for="name" class="form-label">Name:</label>
                                                    <input type="text" name="name_edit" value="<?php echo $teacher['user_name'] ?>"class="form-control" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="email" class="form-label">Email:</label>
                                                    <input type="email" value="<?php echo $teacher['email'] ?>" name="email_edit" class="form-control" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="phone" class="form-label">Phone Number:</label>
                                                    <input type="tel" value="<?php echo $teacher['phone'] ?>" name="phone_edit" class="form-control" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="gender" class="form-label">Gender:</label>
                                                    <select name="gender_edit" class="form-select" required>
                                                        <option  value="<?php echo $teacher['gender'] ?>">Choose your gender</option>
                                                        <option value="Male">Male</option>
                                                        <option value="Female">Female</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="school" class="form-label">School:</label>
                                                    <input type="text" value="<?php echo $teacher['school'] ?>" name="school_edit" class="form-control" required>
                                                </div>
                                                <div class="mb-3">
                                                    <?php
                                                    $query = "SELECT * FROM `classes`";
                                                    $query_run = mysqli_query($conn, $query);
                                                    if(mysqli_num_rows($query_run) > 0) {
                                                    ?>                              
                                                    <div class="mb-3 mt-3">
                                                        <label for="class" class="form-label">Class:</label>
                                                        <select name="class_edit" class="form-select" required>
                                                            <option  value="<?php echo $teacher['class'] ?>">Choose a Class</option>
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
                                                        <select name="subject_edit" class="form-select" required>
                                                            <option  value="<?php echo $teacher['subject'] ?>">Choose a Subject</option>
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
                                                    <select name="status_edit" class="form-select" required>
                                                        <option  value="<?php echo $teacher['status'] ?>">Choose Status</option>
                                                        <option value="1">Active</option>
                                                        <option value="2">Approved</option>
                                                        <option value="3">Pending</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <?php
                                                    $query = "SELECT * FROM `team`";
                                                    $query_run = mysqli_query($conn, $query);
                                                    if(mysqli_num_rows($query_run) > 0) {
                                                    ?>                              
                                                    <div class="mb-3 mt-3">
                                                        <label for="referral" class="form-label">Referral:</label>
                                                        <select name="referral_edit" class="form-select" required>
                                                            <option  value="<?php echo $teacher['referral'] ?>">Choose a Referral</option>
                                                            <?php
                                                            foreach($query_run as $member) {
                                                            ?>
                                                            <option><?php echo $member['member'];?></option>
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
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" onclick="location.reload();">Close</button>
                                                    <button type="submit" class="btn btn-primary" name="teacher_edit">Submit</button>
                                                </div>
                                            </form>
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
