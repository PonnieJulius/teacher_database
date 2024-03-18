<?php
    require('dbFunctions/security.php');
    $instructor_id = $_SESSION['instructor_id'];
    if(!isset($instructor_id)){
        header('Location: login.php');
}
?>
<?php
 include('includes/hdb.php'); 
 include('includes/sidenava.php'); 
include('includes/topnav.php');
?>
  <div class="container-fluid py-5">
          <div class="card shadow">
            <div class="card-header py-3">
              <h6 class="m-0 text-primary font-weight-bold">Registered Taechers
              <?php
                $query = "SELECT `user_id` FROM `users` ORDER BY `user_id`";
                $query_run = mysqli_query($conn, $query);

                $row = mysqli_num_rows($query_run);
                
                echo '<button type="button"class="mx-2 btn btn-primary fw-bold btn-sm float-right">'.$row.'</button>';
              ?>
              </h6>
            </div> 
            
            <div class="card-body">
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
                                            echo '<div class="btn btn-success"><strong>Active</strong></div>';
                                        }elseif($teacher['status'] == '2'){
                                            echo '<div class="btn btn-primary btn-sm"><strong>Approved</strong></div>'; 
                                        }elseif($teacher['status'] == '3'){
                                            echo '<div class="btn btn-danger btn-sm"><strong>Pending</strong></div>'; 
                                        }
                                     ?></td>
                                    <td><?php echo $teacher['referral'] ?></td>
                                    <td><?php $formatted_date = date('d M Y', strtotime($teacher['created_at']));echo $formatted_date;?></td>
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
