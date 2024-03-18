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
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add a member</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="../dbFunctions/code.php" method="POST" enctype="multipart/form-data">

                    <div class="mb-3 mt-3">
                        <label for="email" class="form-label">Name:</label>
                        <input type="text" name="name" class="form-control"required>
                    </div>

                    <div class="mb-3">
                        <label for="pwd" class="form-label">Phone Number:</label>
                        <input type="text" name="phone" class="form-control"required>
                    </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" onclick="location.reload();">Close</button>
                    <button type="submit" class="btn btn-primary" name="team">Submit</button>
                </div>
            </form>
        </div>
    </div>
    </div>
</div>

<div class="container py-5">
    <div class="card">
        <h5 class="card-header justify-content-between">
            Team Members
            <button type="button" class="mx-2 btn btn-primary float-right"data-bs-toggle="modal" data-bs-target="#exampleModal">
                Add a Member
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
                $query = "SELECT * FROM `team`";
                $query_run = mysqli_query($conn, $query);
            ?>
                <thead>
                <tr class="text-center">
                    <th>ID</th>
                    <th>Name</th>
                    <th>Phone Number</th>
                    <th>date</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                    <?php
                        if(mysqli_num_rows($query_run) > 0){
                            foreach($query_run as $row){
                            
                                ?>
                                    <tr>
                                        <td>
                                        <i class="fab fa-angular fa-lg text-danger me-3"></i><?php echo $row['team_id'] ?><strong></strong>
                                        </td>
                                            <td><?php echo $row['member'] ?></td>
                                        
                                            <td><?php echo $row['phone'] ?></td>
                                            <td><?php $formatted_date = date('d M Y', strtotime($row['created_at']));echo $formatted_date;?></td>
                                            <td><a class="dropdown-item btn btn-primary text-center align-items-center rounded-5" href="team_edit.php?id=<?php echo $row['team_id'];?>">
                                            <i class="bx bx-edit-alt me-1"></i></a></td>
                                        <td>
                                            <form action="../dbFunctions/code.php" method="post">
                                                <input type="hidden" name="deleteTeam" value="<?php echo $row['team_id'];?>">
                                                <button type="submit" name="member" class="dropdown-item btn-danger btn-sm align-items-center text-center " href="javascript:void(0);"><i class="bx bx-trash me-1"></i></button>
                                            </form>
                                        </td>
                                    </tr>                                
                                <?php
                            }
                        }else{
                            echo 'Not Data Found';
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
<script type="text/javascript">
    $('.editCategory').click(function(){
        var id = $(this).data('val'); 
        $.ajax({
            url: "category_edit.php",
            type: "POST",
            data: {
                type: 1,
                id: id,
            },
            cache: false,
            success: function(data){
                var jsonData = $.parseJSON(data);
                $('#category_id').val(jsonData.category_id); 
                $('#category_name').val(jsonData.category_name);
                $('.tag_name').val(jsonData.tag_name);
                $('#category_image').append('<img src="' + jsonData.category_image + '">'); 
            }
        });
    });
</script>