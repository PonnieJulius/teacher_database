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
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add a Session</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="../dbFunctions/code.php" method="POST" enctype="multipart/form-data">
                <div class="mb-3 mt-3">
                    <label for="name" class="form-label">Lesson Title:</label>
                    <input type="text" name="lesson" class="form-control" required>
                </div>
                <div class="mb-3">
                <?php
                    $query = "SELECT * FROM `users`";
                    $query_run = mysqli_query($conn, $query);
                    if(mysqli_num_rows($query_run) > 0) {
                    ?>                              
                    <div class="mb-3 mt-3">
                        <label for="class" class="form-label">Teacher:</label>
                        <select name="teacher" class="form-select" required>
                            <option value="">Choose a teacher</option>
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
                    <input type="text" name="price" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Participants:</label>
                    <input type="text" name="participants" class="form-control" required>
                </div>
                <div class="mb-3">
                    <?php
                    $query = "SELECT * FROM `classes`";
                    $query_run = mysqli_query($conn, $query);
                    if(mysqli_num_rows($query_run) > 0) {
                    ?>                              
                    <div class="mb-3 mt-3">
                        <label for="class" class="form-label">Class:</label>
                        <select name="class" class="form-select" required>
                            <option value="">Choose a Class</option>
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
                        <select name="subject" class="form-select" required>
                            <option value="">Choose a Subject</option>
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
                    <select name="status" class="form-select" required>
                        <option value="">Choose Status</option>
                        <option value="1">Paid</option>
                        <option value="2">Not Paid</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" onclick="location.reload();">Close</button>
                    <button type="submit" class="btn btn-primary" name="session_register">Submit</button>
                </div>
            </form>
        </div>
    </div>
    </div>
</div>

<div class="container py-5">
    <div class="card">
        <h5 class="card-header justify-content-between">
            Live Sessions
            <button type="button" class="mx-2 btn btn-primary float-right"data-bs-toggle="modal" data-bs-target="#exampleModal">
                Add a Session
            </button>
        </h5>
        <div class="card-body">
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
            <div class="table-responsive text-nowrap">
            <table class="table table-bordered">
                <?php
                    $query = "SELECT * FROM `live_sessions`";
                    $query_run = mysqli_query($conn, $query);
                ?>
                <thead>
                <tr>
                    <th>date</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>class</th>
                    <th>Subject</th>
                    <th>title</th>
                    <th>Price</th>
                    <th>Participants</th>
                    <th>Status</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                    <?php
                        if(mysqli_num_rows($query_run) > 0){
                            foreach($query_run as $live){
                                ?>
                                    <tr>
                                        <td><?php $formatted_date = date('d M Y', strtotime($live['created_at']));echo $formatted_date;?></td>
                                        <td>
                                            <?php 
                                            $id = $live['teacher_id'];
                                            
                                            $query = "SELECT * FROM `users` WHERE `user_id` = '$id'";
                                            $query_run = mysqli_query($conn, $query);
                                            if(mysqli_num_rows($query_run) > 0){
                                                foreach($query_run as $teacher){
                                                    $_SESSION['name'] = $teacher['user_name'];
                                                    $_SESSION['phone'] = $teacher['phone'];
                                                    echo $_SESSION['name'];
                                                }
                                            }
                                            ?>
                                        </td>
                                        <td><?php echo $_SESSION['phone']; ?></td>
                                        <td><?php echo $live['class']?></td>
                                        <td><?php echo $live['subject']?></td>
                                        <td><?php echo $live['lesson']?></td>
                                        <td><?php echo $live['price']?></td>
                                        <td><?php echo $live['participants']?></td>
                                        <td>
                                            <?php
                                                if($live['status'] == '1'){
                                                    echo '<div class="btn btn-success"><strong>Paid</strong></div>';
                                                }elseif($live['status'] == '2'){
                                                    echo '<div class="btn btn-danger btn-sm"><strong>Not Paid</strong></div>'; 
                                                }
                                            ?>
                                        </td>
                                        <td>
                                            <a class="dropdown-item btn-primary text-center rounded-5" href="live_edit.php?id=<?php echo $live['live_id'];?>">
                                                <i class="bx bx-edit-alt me-1"></i></a>
                                        </td>
                                        <td>
                                        <form action="../dbFunctions/code.php" method="post">
                                            <input type="hidden" value="<?php echo $live['live_id'];?>" name="delete_live">
                                            <button type="submit" name="deleteEditBtn" class="dropdown-item btn-danger btn-sm align-items-center text-center " href="javascript:void(0);"><i class="bx bx-trash me-1"></i></button>
                                        </form>
                                        </td>
                                    </tr>
                                <?php
                            }
                        }
                    ?>
                </tbody>
            </table>
            </div>
        </div>
    </div>
</div>
<?php 
include('includes/fdb.php');
include('includes/script.php');
?>