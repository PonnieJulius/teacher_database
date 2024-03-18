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
<div class="container py-3">
    <div class="card">
        <h5 class="card-header justify-content-between">
            Team Members
            <?php
                $query = "SELECT `team_id` FROM `team` ORDER BY `team_id`";
                $query_run = mysqli_query($conn, $query);

                $row = mysqli_num_rows($query_run);
                
                echo '<button type="button"class="mx-2 btn btn-primary fw-bold btn-sm float-right">'.$row.'</button>';
              ?>
        </h5>
        <div class="card-body">
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
                                            <td>
                                            <?php $formatted_date = date('d M Y', strtotime($row['created_at']));echo $formatted_date;?>
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