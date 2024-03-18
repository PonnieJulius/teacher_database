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
<div class="container-xxl flex-grow-1 container-p-y">
  <div class="container py-3">
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
                    <th>Participants</th>
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