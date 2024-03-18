<?php
require('security.php');

   $instructor_id = $_SESSION['instructor_id'];
   if(!isset($instructor_id)){
       header('Location: ../login.php');
 }

 $admin_id = $_SESSION['admin_id'];
   if(!isset($admin_id)){
       header('Location: ../login.php');
 }


 // Checking if email and phone number are not already used
 function adminExists($conn, $email) {
    $email = mysqli_real_escape_string($conn, $email);

    $query = "SELECT * FROM `admins` WHERE `admin_email` = '$email'";
    $result = mysqli_query($conn, $query);

    return mysqli_num_rows($result) > 0;
}

// Registration process
if (isset($_POST['registerBtn'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = mysqli_real_escape_string($conn, $_POST['user_role']);

    // Checking whether the user is registered or not
    if (adminExists($conn, $email)) {
        $_SESSION['status'] = $name.' User is already registered!';
        header('Location: ../register.php');
        exit();
    }else {
            $sql = "INSERT INTO `admins` (`admin_id`, `admin_name`, `admin_email`, `admin_password`, `user_role_id`)
                    VALUES (NULL, '$name', '$email', '$password', '$role')";
            $query_run = mysqli_query($conn, $sql);

            if ($query_run) {
                $_SESSION['success'] = $name . ', your account is successfully registered. Please log in now to access your account.';
                header('Location: ../login.php');
                exit();
            } else {
                $_SESSION['status'] = 'Error in database operation. Please try again.';
                header('Location: ../register.php');
                exit();
            }
        }
}

// login process

if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($conn, $_POST['emaill']);
    $enteredPassword = $_POST['passwordd'];

    $query = "SELECT * FROM `admins` WHERE `admin_email` = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $getUser = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($getUser)) {

        // Verify the entered password using password_verify
        if (password_verify($enteredPassword, $row['admin_password'])) {

            switch ($row['user_role_id']) {
                case '1':
                    $_SESSION['admin_name'] = $row['admin_name'];
                    $_SESSION['admin_email'] = $row['admin_email'];
                    $_SESSION['admin_id'] = $row['admin_id'];
                    $_SESSION['admin_role_id'] = $row['user_role_id'];
                    header('Location: ../admin/admin_dashboard.php');
                    break;
                case '2':
                    $_SESSION['instructor_name'] = $row['admin_name'];
                    $_SESSION['instructor_email'] = $row['admin_email'];
                    $_SESSION['instructor_id'] = $row['admin_id'];
                    $_SESSION['instructor_role_id'] = $row['user_role_id'];
                    header('Location: ../index.php');
                    break;
            }
        } else {
            $_SESSION['status'] = 'Incorrect Password! Please try again.';
            header('Location: ../login.php');
        }
    } else {
        $_SESSION['status'] = 'User account is not found! Please try again.';
        header('Location: ../login.php');
    }
}


// updating live session
if(isset($_POST['session_edit'])){
    $edit_live_id = $_POST['edit_live_id'];
    $teacher_edit = mysqli_real_escape_string($conn, $_POST['teacher_edit']);
    $lesson_edit = mysqli_real_escape_string($conn, $_POST['editlesson_title']);
    $price_edit = mysqli_real_escape_string($conn, $_POST['edit_price']);
    $participants_edit = mysqli_real_escape_string($conn, $_POST['edit_participants']);
    $class_edit = mysqli_real_escape_string($conn, $_POST['edit_class']);
    $subject_edit = mysqli_real_escape_string($conn, $_POST['edit_subject']);
    $status_edit = mysqli_real_escape_string($conn, $_POST['edit_status']);

    
    $query = "UPDATE `live_sessions` SET `teacher_id` = '$teacher_edit', `class` = '$class_edit', `subject` = '$subject_edit', `lesson` = '$lesson_edit', `price`= '$price_edit', `participants`= '$participants_edit', `status` = '$status_edit'
    WHERE `live_id` = '$edit_live_id'";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        $_SESSION['success'] = 'lesson updated successfully.';
        header('Location:../admin/live_sessions.php');
    } else {
        $_SESSION['status'] = 'Failed to update lesson details.';
        header('Location: ../admin/live_edit.php');
    }
}


// // inserting teachers in database
function teacherExist($conn, $email, $phone) {
    $email = mysqli_real_escape_string($conn, $email);
    $phone = mysqli_real_escape_string($conn, $phone);
    $query = "SELECT * FROM `users` WHERE `email` = '$email' OR `phone` = '$phone'";
    $query_run = mysqli_query($conn, $query);
    return mysqli_num_rows($query_run) > 0;
}

if (isset($_POST['teacher_register'])) {
    //echo 'hello';
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $school = mysqli_real_escape_string($conn, $_POST['school']);
    $class = mysqli_real_escape_string($conn, $_POST['class']);
    $subject = mysqli_real_escape_string($conn, $_POST['subject']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    $referral = mysqli_real_escape_string($conn, $_POST['referral']);
   
    if (teacherExist($conn, $email, $phone)) {
        $_SESSION['status'] = $name.' is already registered! Please try again.';
        header('Location: ../admin/users.php');
        exit();
    } else {
        $query = "INSERT INTO `users` (`user_name`, `email`, `phone`, `gender`, `school`, `class`, `subject`, `status`, `referral`, `created_at`)
                  VALUES ('$name', '$email', '$phone', '$gender', '$school', '$class', '$subject', '$status', '$referral', current_timestamp())";
        $query_run = mysqli_query($conn, $query);
    
        if ($query_run) {
            $_SESSION['success'] = $name. ' is confirmed as a teacher.';
            header('Location: ../admin/users.php');
            exit();
        } else {
            $_SESSION['status'] = 'Your data was not added.';
            header('Location: ../admin/users.php');
            exit();
        }
    }
}

// if (isset($_POST['teacher_edit'])) {
//     //echo 'hello';
//     $id_edit = $_POST['edit_id'];
//     $name_edit = mysqli_real_escape_string($conn, $_POST['name_edit']);
//     $email_edit = mysqli_real_escape_string($conn, $_POST['email_edit']);
//     $phone_edit = mysqli_real_escape_string($conn, $_POST['phone_edit']);
//     $gender_edit = mysqli_real_escape_string($conn, $_POST['gender_edit']);
//     $school_edit = mysqli_real_escape_string($conn, $_POST['school_edit']);
//     $class_edit = mysqli_real_escape_string($conn, $_POST['class_edit']);
//     $subject_edit = mysqli_real_escape_string($conn, $_POST['subject_edit']);
//     $status_edit = mysqli_real_escape_string($conn, $_POST['status_edit']);
//     $referral_edit = mysqli_real_escape_string($conn, $_POST['referral_edit']);
    
//         $query = "UPDATE `users` SET `user_name` = '$name_edit', `email` = '$email_edit', `phone` = '$phone_edit', `gender` = '$gender_edit', `school` = '$school_edit', `class` = '$class_edit', `subject` = '$subject_edit', `status` = '$status_edit', `referral` = '$referral_edit' WHERE `user_id` = '$id_edit'";
//         $query_run = mysqli_query($conn, $query);
    
//         if ($query_run) {
//             $_SESSION['success'] = $name_edit. ' profile updated successfully.';
//             header('Location: ../admin/users.php');
//             exit();
//         } else {
//             $_SESSION['status'] = 'Your data was not added.';
//             header('Location: ../admin/users_edit.php');
//             exit();
//         }
// }

    if (isset($_POST['deleteTeacher'])) {
    $delete_id = $_POST['teacherDelete'];
    $query = "DELETE FROM `users` WHERE `user_id` = '$delete_id'";
    $query_run = mysqli_query($conn, $query);
    if ($query_run) {
        $_SESSION['success'] = 'You have deleted teacher details';
        header('Location: ../admin/users.php');
    } else {
        $_SESSION['status'] = 'Teacher details are not deleted';
        header('Location: ../admin/users.php');
    }
}

// inserting live sessions in database
if (isset($_POST['session_register'])) {
    //echo 'hello';
    $teacher = mysqli_real_escape_string($conn, $_POST['teacher']);
    $lesson = mysqli_real_escape_string($conn, $_POST['lesson']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $participants = mysqli_real_escape_string($conn, $_POST['participants']);
    $class = mysqli_real_escape_string($conn, $_POST['class']);
    $subject = mysqli_real_escape_string($conn, $_POST['subject']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);

        $query = "INSERT INTO `live_sessions` (`teacher_id`, `class`, `subject`, `lesson`, `price`, `participants`, `status`, `created_at`)
                  VALUES ('$teacher', '$class', '$subject', '$lesson', '$price', '$participants', '$status', current_timestamp())";
        $query_run = mysqli_query($conn, $query);
    
        if ($query_run) {
            $_SESSION['success'] = 'You have added a live session.';
            header('Location: ../admin/live_sessions.php');
            exit();
        } else {
            $_SESSION['status'] = 'Your data was not added.';
            header('Location: ../live_sessions.php');
            exit();
        }
}

if (isset($_POST['deleteEditBtn'])) {
    $delete_id = $_POST['delete_live'];
    $query = "DELETE FROM `live_sessions` WHERE `live_id` = '$delete_id'";
    $query_run = mysqli_query($conn, $query);
    if ($query_run) {
        $_SESSION['success'] = 'You have deleted teacher details';
        header('Location: ../admin/live_sessions.php');
    } else {
        $_SESSION['status'] = 'Teacher details are not deleted';
        header('Location: ../admin/live_sessions.php');
    }
}

// inserting subjects in database
function categoryExist($conn, $subject, $tag){
    $subject = mysqli_real_escape_string($conn, $_POST['subject_name']);
    $tag = mysqli_real_escape_string($conn, $_POST['subject_tag']);
    $query = "SELECT * FROM `subjects` WHERE `subject` = '$subject' OR `tag` = '$tag'";
    $query_run = mysqli_query($conn, $query);
    return mysqli_num_rows($query_run) > 0;
}

if(isset($_POST['subject'])){
    $subject = mysqli_real_escape_string($conn, $_POST['subject_name']);
    $tag = mysqli_real_escape_string($conn, $_POST['subject_tag']);
    $image =  $_FILES['subject_image']['name'];

    if (categoryExist($conn, $subject, $tag)) {
        $_SESSION['status'] = $subject.' is already a registered subject!';
        header('Location: ../admin/subjects.php');
        exit();
    }else{
        if(file_exists("../admin/uploads/subjects/".$_FILES['subject_image']['name'])){
            $filename = $_FILES['subject_image']['name'];
            $_SESSION['status'] =$filename.' image is already exists. Please try again.';
            header('Location: ../admin/subjects.php');
            exit();
        }else{
            $query = "INSERT INTO `subjects` (`id`, `subject`, `tag`, `image`, `date` ) 
            VALUES (NULL, '$subject', '$tag', '$image', current_timestamp())";
           $query_run = mysqli_query($conn, $query);
    
           if ($query_run) {
               move_uploaded_file($_FILES['subject_image']['tmp_name'], "../admin/uploads/subjects/". $_FILES['subject_image']['name']);
               $_SESSION['success'] = $subject. ' is added as a Category.';
               header('Location: ../admin/subjects.php');
               exit();
           } else {
               $_SESSION['status'] = 'Your Data is Not added';
               header('Location: ../admin/subjects.php');
               exit();
           }
    
        }

    }  
}

// Deleting a subject
if(isset($_POST['deleteSub'])){
    $subject_id = $_POST['deleteSubject'];

    $query = "DELETE FROM `subjects` WHERE `id` = '$subject_id'";
    $query_run = mysqli_query($conn, $query);

    if($query_run){
        $_SESSION['success'] =  'You have deleted subject details' ;
        header('Location: ../admin/subjects.php');
    }else{
        $_SESSION['status'] = 'Subject deteals are Not deleted';
        header('Location: ../admin/subjects.php');
    }

}

// inserting classes in database
function classExist($conn, $class, $class_tag){
    $class = mysqli_real_escape_string($conn, $_POST['class_name']);
    $class_tag = mysqli_real_escape_string($conn, $_POST['class_tag']);
    $query = "SELECT * FROM `classes` WHERE `class` = '$class' OR `class_tag` = '$class_tag'";
    $query_run = mysqli_query($conn, $query);
    return mysqli_num_rows($query_run) > 0;
}

if(isset($_POST['class'])){
    $class = mysqli_real_escape_string($conn, $_POST['class_name']);
    $class_tag = mysqli_real_escape_string($conn, $_POST['class_tag']);

    if (classExist($conn, $class, $class_tag)) {
        $_SESSION['status'] = $class.' is already a registered classs!';
        header('Location: ../admin/class.php');
        exit();
    }else{
           $query = "INSERT INTO `classes` (`class_id`, `class`, `class_tag`, `date` ) 
            VALUES (NULL, '$class', '$class_tag', current_timestamp());";
           $query_run = mysqli_query($conn, $query);
    
           if ($query_run) {
               $_SESSION['success'] = $class. ' is added as a Class.';
               header('Location: ../admin/class.php');
               exit();
           } else {
               $_SESSION['status'] = 'Your Data is Not added';
               header('Location: ../admin/class.php');
               exit();
           }
    
        }
} 

// Deleting a class
if (isset($_POST['deleteClass'])) {
    $delete_id = $_POST['classDelete'];
    $query = "DELETE FROM `classes` WHERE `class_id` = '$delete_id'";
    $query_run = mysqli_query($conn, $query);
    if ($query_run) {
        $_SESSION['success'] = 'You have deleted Class details';
        header('Location: ../admin/class.php');
    } else {
        $_SESSION['status'] = 'Class details are not deleted';
        header('Location: ../admin/class.php');
    }
}

// inserting team member in database
function teamExist($conn, $phone){
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $query = "SELECT * FROM `team` WHERE `phone` = '$phone'";
    $query_run = mysqli_query($conn, $query);
    return mysqli_num_rows($query_run) > 0;
}

if(isset($_POST['team'])){
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);

    if (teamExist($conn, $phone)) {
        $_SESSION['status'] ='Phone number is already a registered! Please Try Again';
        header('Location: ../admin/team.php');
        exit();
    }else{
           $query = "INSERT INTO `team` (`team_id`, `member`, `phone`, `created_at` ) 
            VALUES (NULL, '$name', '$phone', current_timestamp());";
           $query_run = mysqli_query($conn, $query);
    
           if ($query_run) {
               $_SESSION['success'] = $name. ' is added as a team member.';
               header('Location: ../admin/team.php');
               exit();
           } else {
               $_SESSION['status'] = 'Your Data is Not added';
               header('Location: ../admin/team.php');
               exit();
           }
    
    }
} 


if (isset($_POST['edit_team'])) {
    $edit_id = $_POST['edit_id'];
    $edit_name = mysqli_real_escape_string($conn, $_POST['edit_name']);
    $edit_phone = mysqli_real_escape_string($conn, $_POST['edit_phone']);
    
    $query = "UPDATE `team` SET `member` = '$edit_name', `phone` = '$edit_phone' WHERE `team_id` = '$edit_id'";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        $_SESSION['success'] = $edit_name . ' profile updated successfully.';
        header('Location:../admin/team.php');
    } else {
        $_SESSION['status'] = 'Failed to update member details.';
        header('Location: ../admin/team_edit.php');
    }
}

if (isset($_POST['member'])) {
    $delete_id = $_POST['deleteTeam'];
    $query = "DELETE FROM `team` WHERE `team_id` = '$delete_id'";
    $query_run = mysqli_query($conn, $query);
    if ($query_run) {
        $_SESSION['success'] = 'You have deleted a team member';
        header('Location: ../admin/team.php');
    } else {
        $_SESSION['status'] = 'Member details are not deleted';
        header('Location: ../admin/team.php');
    }
}


