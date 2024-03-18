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
<div class="container-xxl flex-grow-1 container-p-y">

  <div class="row">
    <div class="col-lg-12 col-md-3 order-1">
      <div class="row">
        
        <div class="col-md-3 col-3 mb-4">
          <div class="card">
            <div class="card-body">
              <div class="card-title d-flex align-items-start justify-content-between">
                <div class="avatar flex-shrink-0">
                  <img src="assets/profile.png" class="rounded"/>
                </div>
                <div class="dropdown">
                  <button class="btn p-0"type="button"id="cardOpt3"data-bs-toggle="dropdown"aria-haspopup="true"aria-expanded="false">
                    <i class="bx bx-dots-vertical-rounded"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                    <a class="dropdown-item" href="class.php">View More</a>
                    <a class="dropdown-item" href="class.php">Add</a>
                  </div>
                </div>
              </div>
              <span class="fw-semibold fs-4 d-block mb-1 text-center">Class</span>
              <?php
                $query = "SELECT `class_id` FROM `classes` ORDER BY `class_id`";
                $query_run = mysqli_query($conn, $query);

                $row = mysqli_num_rows($query_run);
                
                echo '<h2 class="mx-2 text-center fw-bold">'.$row.'</h2>';
              ?>
            </div>
          </div>
        </div>

        <div class="col-md-3 col-3 mb-4">
          <div class="card">
            <div class="card-body">
              <div class="card-title d-flex align-items-start justify-content-between">
                <div class="avatar flex-shrink-0">
                  <img src="assets/profile.png" class="rounded"/>
                </div>
                <div class="dropdown">
                  <button class="btn p-0"type="button"id="cardOpt3"data-bs-toggle="dropdown"aria-haspopup="true"aria-expanded="false">
                    <i class="bx bx-dots-vertical-rounded"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                    <a class="dropdown-item" href="subjects.php">View More</a>
                    <a class="dropdown-item" href="subjects.php">Add</a>
                  </div>
                </div>
              </div>
              <span class="fw-semibold fs-4 d-block mb-1 text-center">Subjects</span>
              <?php
                $query = "SELECT `id` FROM `subjects` ORDER BY `id`";
                $query_run = mysqli_query($conn, $query);

                $row = mysqli_num_rows($query_run);
                
                echo '<h2 class="mx-2 text-center fw-bold">'.$row.'</h2>';
              ?>
            </div>
          </div>
        </div>
          <!-- registered instructors -->
          <div class="col-md-3 col-3 mb-4">
          <div class="card">
            <div class="card-body">
              <div class="card-title d-flex align-items-start justify-content-between">
                <div class="avatar flex-shrink-0">
                  <img src="assets/profile.png" class="rounded"/>
                </div>
                <div class="dropdown">
                  <button class="btn p-0"type="button"id="cardOpt3"data-bs-toggle="dropdown"aria-haspopup="true"aria-expanded="false">
                    <i class="bx bx-dots-vertical-rounded"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                    <a class="dropdown-item" href="users.php">View More</a>
                    <a class="dropdown-item" href="users.php">Add</a>
                  </div>
                </div>
              </div>
              <span class="fw-semibold fs-4 d-block mb-1 text-center">Teachers</span>
              <?php
                $query = "SELECT `user_id` FROM `users` ORDER BY `user_id`";
                $query_run = mysqli_query($conn, $query);

                $row = mysqli_num_rows($query_run);
                
                echo '<h2 class="mx-2 text-center fw-bold">'.$row.'</h2>';
              ?>
            </div>
          </div>
        </div>
          <!-- Enolled last month -->
          <div class="col-md-3 col-3 mb-4">
          <div class="card">
            <div class="card-body">
              <div class="card-title d-flex align-items-start justify-content-between">
                <div class="avatar flex-shrink-0">
                  <img src="assets/profile.png" class="rounded"/>
                </div>
                <div class="dropdown">
                  <button class="btn p-0"type="button"id="cardOpt3"data-bs-toggle="dropdown"aria-haspopup="true"aria-expanded="false">
                    <i class="bx bx-dots-vertical-rounded"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                    <a class="dropdown-item" href="live_sessions.php">View More</a>
                    <a class="dropdown-item" href="live_sessions.php">Add</a>
                  </div>
                </div>
              </div>
              <span class="fw-semibold fs-4 d-block mb-1 text-center">Live Session</span>
              <?php
                $query = "SELECT `live_id` FROM `live_sessions` ORDER BY `live_id`";
                $query_run = mysqli_query($conn, $query);

                $row = mysqli_num_rows($query_run);
                
                echo '<h2 class="mx-2 text-center fw-bold">'.$row.'</h2>';
              ?>
            </div>
          </div>
        </div> 
        
        <div class="col-md-3 col-3 mb-4">
          <div class="card">
            <div class="card-body">
              <div class="card-title d-flex align-items-start justify-content-between">
                <div class="avatar flex-shrink-0">
                  <img src="assets/profile.png" class="rounded"/>
                </div>
                <div class="dropdown">
                  <button class="btn p-0"type="button"id="cardOpt3"data-bs-toggle="dropdown"aria-haspopup="true"aria-expanded="false">
                    <i class="bx bx-dots-vertical-rounded"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                    <a class="dropdown-item" href="team.php">View More</a>
                    <a class="dropdown-item" href="team.php">Add</a>
                  </div>
                </div>
              </div>
              <span class="fw-semibold fs-4 d-block mb-1 text-center">Members</span>
              <?php
                $query = "SELECT `team_id` FROM `team` ORDER BY `team_id`";
                $query_run = mysqli_query($conn, $query);

                $row = mysqli_num_rows($query_run);
                
                echo '<h2 class="mx-2 text-center fw-bold">'.$row.'</h2>';
              ?>
            </div>
          </div>
        </div>


      </div>
    </div>
  </div>

    <div class="card">
        <h5 class="card-header justify-content-between">
            Live Sessions
            <?php
                $query = "SELECT `live_id` FROM `live_sessions` ORDER BY `live_id`";
                $query_run = mysqli_query($conn, $query);

                $row = mysqli_num_rows($query_run);
                
                echo '<button type="button"class="mx-2 btn btn-primary fw-bold btn-sm float-right">'.$row.'</button>';
              ?>
           
        </h5>
        <div class="card-body">
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
                    <th>Status</th>
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
                                        <td>
                                            <?php
                                                if($live['status'] == '1'){
                                                    echo '<div class="btn btn-success"><strong>Paid</strong></div>';
                                                }elseif($live['status'] == '2'){
                                                    echo '<div class="btn btn-danger btn-sm"><strong>Not Paid</strong></div>'; 
                                                }
                                            ?>
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
<?php 
include('includes/fdb.php');
include('includes/script.php');
?>
