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
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add a Class</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="../dbFunctions/code.php" method="POST" enctype="multipart/form-data">

                    <div class="mb-3 mt-3">
                        <label for="email" class="form-label">Class:</label>
                        <input type="text" name="class_name" class="form-control"required>
                    </div>
                    <div class="mb-3">
                        <label for="pwd" class="form-label">Tag Name:</label>
                        <input type="text" name="class_tag" class="form-control"required>
                    </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" onclick="location.reload();">Close</button>
                    <button type="submit" class="btn btn-primary" name="class">Submit</button>
                </div>
            </form>
        </div>
    </div>
    </div>
</div>

<div class="container py-5">
    <div class="card">
        <h5 class="card-header justify-content-between">
            Classes
            <button type="button" class="mx-2 btn btn-primary float-right"data-bs-toggle="modal" data-bs-target="#exampleModal">
                Add a Class
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
                    <th>Edit</th>
                    <th>Delete</th>
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
                                    <td><?php $formatted_date = date('d M Y', strtotime($row['date']));echo $formatted_date;?></td>
                                    <td>
                                        <a class="dropdown-item btn-primary text-center rounded-5" href="class_edit.php?id=<?php echo $row['class_id'];?>">
                                            <i class="bx bx-edit-alt me-1"></i></a>
                                    </td>
                                    <td>
                                         <form action="../dbFunctions/code.php" method="post">
                                            <input type="hidden" name="classDelete" value="<?php echo $row['class_id'];?>">
                                            <button type="submit" name="deleteClass" class="dropdown-item btn-danger btn-sm align-items-center text-center " href="javascript:void(0);"><i class="bx bx-trash me-1"></i></button>
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