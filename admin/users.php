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
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add a Teacher</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="../dbFunctions/code.php" method="POST" enctype="multipart/form-data">
                <div class="mb-3 mt-3">
                    <label for="name" class="form-label">Name:</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone Number:</label>
                    <input type="tel" name="phone" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="gender" class="form-label">Gender:</label>
                    <select name="gender" class="form-select" required>
                        <option value="">Choose your gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="school" class="form-label">School:</label>
                    <input type="text" name="school" class="form-control" required>
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
                        <select name="referral" class="form-select" required>
                            <option value="">Choose a Referral</option>
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
                    <button type="submit" class="btn btn-primary" name="teacher_register">Submit</button>
                </div>
            </form>
        </div>
    </div>
    </div>
</div>
  <div class="container-fluid py-5">
          <div class="card shadow">
            <div class="card-header py-3">
              <h6 class="m-0 text-primary font-weight-bold">Registered Taechers
              <!-- Button trigger modal -->
                <button type="button" class="mx-2 btn btn-primary justify-content-end" data-bs-toggle="modal" data-bs-target="#exampleModal">
                  Add teacher
                </button>
              </h6>
            </div> 
            
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
              <div class="table-responsive">
                <?php
                    $query = "SELECT * FROM `users`";
                    $query_run = mysqli_query($conn, $query);
                ?>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr class="text-center">
                      <th>Id</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Phone</th>
                      <th>Gender</th>
                      <th>School</th>
                      <th>Class</th>
                      <th>Subject</th>
                      <th>Status</th>
                      <th>referral</th>
                      <th>date</th>
                      <th>Edit</th>
                      <th>Delete</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                        if(mysqli_num_rows($query_run) > 0){
                            foreach($query_run as $teacher){
                               ?>
                                <tr>
                                    <td><?php echo $teacher['user_id'] ?></td>  
                                    <td><?php echo $teacher['user_name'] ?></td>
                                    <td><?php echo $teacher['email'] ?></td>
                                    <td><?php echo $teacher['phone'] ?></td>
                                    <td><?php echo $teacher['gender'] ?></td>
                                    <td><?php echo $teacher['school'] ?></td>
                                    <td><?php echo $teacher['class'] ?></td>
                                    <td><?php echo $teacher['subject'] ?></td>
                                    <td><?php
                                        if($teacher['status'] == '1'){
                                            echo '<div class="btn btn-success btn-sm"><strong>Active</strong></div>';
                                        }elseif($teacher['status'] == '2'){
                                            echo '<div class="btn btn-primary btn-sm"><strong>Approved</strong></div>'; 
                                        }elseif($teacher['status'] == '3'){
                                            echo '<div class="btn btn-danger btn-sm"><strong>Pending</strong></div>'; 
                                        }
                                     ?></td>
                                    <td><?php echo $teacher['referral'] ?></td>
                                    <td><?php $formatted_date = date('d M Y', strtotime($teacher['created_at']));echo $formatted_date;?></td>
                                    <td>
                                        <a class="dropdown-item btn btn-primary text-center align-items-center rounded-5" href="users_edit.php?id=<?php echo $teacher['user_id'];?>">
                                        <i class="bx bx-edit-alt me-1"></i></a></td>
                                        <td>
                                            <form action="../dbFunctions/code.php" method="post">
                                                <input type="hidden" name="teacherDelete" value="<?php echo $teacher['user_id'];?>">
                                                <button type="submit" name="deleteTeacher" class="dropdown-item btn-danger btn-sm align-items-center text-center " href="javascript:void(0);"><i class="bx bx-trash me-1"></i></button>
                                            </form>
                                        </td>
                                </tr>     
                               <?php
                            }
                        }else{

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
