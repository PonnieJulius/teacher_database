<?php
    include('includes/hdb.php'); 
    include('includes/sidenavadmin.php'); 
    include('includes/topnav.php');
?>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add a Course</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="mb-3 mt-3">
                    <label for="email" class="form-label">Name:</label>
                    <input type="text" name="name" class="form-control"required>
                </div>
                <div class="mb-3 mt-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="text" name="email" class="form-control"required>
                </div>
                <div class="mb-3">
                    <label for="pwd" class="form-label">Phone Number:</label>
                    <input type="text" name="phone" class="form-control"required>
                </div>
                <div class="mb-3">
                    <label for="pwd" class="form-label">Password:</label>
                    <input type="text" name="cfmPassword" class="form-control"required>
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Image:</label>
                    <input type="file" name="course_image" accept="image/jpg, image/png, image/jpeg" class="form-control" required>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal" onclick="location.reload();">Close</button>
                <button type="submit" class="btn btn-primary" name="courses">Submit</button>
                </div>
            </form>
        </div>
    </div>
    </div>
</div>

<div class="container py-5">
    <div class="card">
        <h5 class="card-header justify-content-between">
            Instructors
            <button type="button" class="mx-2 btn btn-primary float-right"data-bs-toggle="modal" data-bs-target="#exampleModal">
                Add
            </button>
        </h5>
        <div class="card-body">
            <div class="table-responsive text-nowrap">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Instructor</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Gender</th>
                    <th>Course</th>
                    <th>District</th>
                    <th>image</th>                    
                    <th>Date</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                        <tr>
                            <td>
                                <i class="fab fa-angular fa-lg text-danger me-3"></i><strong></strong>
                            </td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            <td>                        
                                <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                                    <li data-bs-toggle="tooltip" data-popup="tooltip-custom"data-bs-placement="top"class="avatar avatar-lg align-items-center pull-up"title="">
                                    <img src="assets/profile.png" alt="Avatar" class="rounded-5"/>
                                    </li>
                                </ul>                            
                            </td>                                
                                <td></td>
                                <td>
                                    <a class="dropdown-item btn-primary text-center rounded-5" href="category_edit.php">
                                        <i class="bx bx-edit-alt me-1"></i></a>
                                </td>
                                <td>
                                    <form action="" method="post">
                                        <input type="hidden" name="deleteCategory_id">
                                        <button type="submit" name="deleteEditBtn" class="dropdown-item btn-danger btn-sm align-items-center text-center " href="javascript:void(0);"><i class="bx bx-trash me-1"></i></button>
                                    </form>
                                </td>
                        </tr>          
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