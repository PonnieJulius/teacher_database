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
 <div class="container py-4 mb-4">
  <div class="row">
        <?php
          $query = "SELECT * FROM `subjects`";
          $query_run = mysqli_query($conn, $query);
          if(mysqli_num_rows($query_run) > 0){
            foreach($query_run as $subject){
              ?>
                <div class="col-md-4 mb-3">
                  <div class="card  align-items-center" style="width: 15rem;">
                    <img src="<?php echo "admin/uploads/subjects/".$subject['image'] ?>" class=" img-fluid rounded-5 mt-3" style="width: 30%" alt="...">
                    <div class="card-body">
                      <h5 class="card-text fw-bold"><?php echo $subject['subject'];?></h5>
                    </div>
                  </div>
                </div>
              <?php
            }
          }else{
            echo '<div class="alert alert-danger"><strong>Sorry!! </strong>No Class Available</div>';
          }
        ?>
  </div>
 </div>

 <div class="container py-2">
    <div class="card">
        <h5 class="card-header justify-content-between">
            Classes
            <?php
                $query = "SELECT `class_id` FROM `classes` ORDER BY `class_id`";
                $query_run = mysqli_query($conn, $query);

                $row = mysqli_num_rows($query_run);
                
                echo '<button type="button"class="mx-2 btn btn-primary fw-bold btn-sm float-right">'.$row.'</button>';
              ?>
           
        </h5>
        <div class="card-body">
            <div class="table-responsive text-nowrap">
            <?php
                $query = "SELECT * FROM `classes`";
                $query_run = mysqli_query($conn, $query);
            ?>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>class</th>
                    <th>Tag name</th>
                    <th>date</th>
                </tr>
                </thead>
                <tbody>
                    <?php
                        if(mysqli_num_rows($query_run) > 0){
                            foreach($query_run as $row){
                                $_SESSION['class_number'] = $row['class_id'];
                                //echo $_SESSION['class_number'];
                                ?>
                                <tr>
                                    <td>
                                        <i class="fab fa-angular fa-lg text-danger me-3"></i><strong><?php echo $row['class_id']?></strong>
                                    </td>
                                    <td><?php echo $row['class']?></td>
                                    <td><?php echo $row['class_tag']?></td>
                                    <td>
                                    <?php $formatted_date = date('d M Y', strtotime($row['date']));echo $formatted_date;?>
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
