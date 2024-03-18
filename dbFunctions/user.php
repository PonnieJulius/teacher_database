<?php
require('security.php');
if (isset($_POST['teacher_edit'])) {
    //echo 'hello';
    $id_edit = $_POST['edit_id'];
    $name_edit = mysqli_real_escape_string($conn, $_POST['name_edit']);
    $email_edit = mysqli_real_escape_string($conn, $_POST['email_edit']);
    $phone_edit = mysqli_real_escape_string($conn, $_POST['phone_edit']);
    $gender_edit = mysqli_real_escape_string($conn, $_POST['gender_edit']);
    $school_edit = mysqli_real_escape_string($conn, $_POST['school_edit']);
    $class_edit = mysqli_real_escape_string($conn, $_POST['class_edit']);
    $subject_edit = mysqli_real_escape_string($conn, $_POST['subject_edit']);
    $status_edit = mysqli_real_escape_string($conn, $_POST['status_edit']);
    $referral_edit = mysqli_real_escape_string($conn, $_POST['referral_edit']);
    
        $query = "UPDATE `users` SET `user_name` = '$name_edit', `email` = '$email_edit', `phone` = '$phone_edit', `gender` = '$gender_edit', `school` = '$school_edit', `class` = '$class_edit', `subject` = '$subject_edit', `status` = '$status_edit', `referral` = '$referral_edit' WHERE `user_id` = '$id_edit'";
        $query_run = mysqli_query($conn, $query);
    
        if ($query_run) {
            $_SESSION['success'] = $name_edit. ' profile updated successfully.';
            header('Location: ../admin/users.php');
            exit();
        } else {
            $_SESSION['status'] = 'Your data was not added.';
            header('Location: ../admin/users_edit.php');
            exit();
        }
}

// class
if (isset($_POST['edit_class'])) {
    $edit_id = $_POST['class_id'];
    $class_edit = mysqli_real_escape_string($conn, $_POST['editclass_name']);
    $class_tag_edit = mysqli_real_escape_string($conn, $_POST['editclass_tag']);
    
    $query = "UPDATE `classes` SET `class` = '$class_edit', `class_tag` = '$class_tag_edit' WHERE `class_id` = '$edit_id'";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        $_SESSION['success'] = $class_edit . ' profile updated successfully.';
        header('Location:../admin/class.php');
    } else {
        $_SESSION['status'] = 'Failed to update category data.';
        header('Location: ../admin/class_edit.php');
    }
}


// updating subject
if (isset($_POST['edit_subject'])) {
    $edit_id = $_POST['edit_id'];
    $edit_subject = mysqli_real_escape_string($conn, $_POST['editsubject_name']);
    $edit_tag = mysqli_real_escape_string($conn, $_POST['editsubject_tag']);
    $edit_image = $_FILES['editsubject_image']['name'];
    $old_image = $_POST['old_image'];

    if ($edit_image != '') {
        $update_filename = $edit_image;

        $upload_path = "../admin/uploads/subjects/" . $edit_image;

        if (is_uploaded_file($_FILES['editsubject_image']['tmp_name'])) {
            move_uploaded_file($_FILES['editsubject_image']['tmp_name'], $upload_path);
            unlink("../admin/uploads/subjects/" . $old_image);
        } else {
            $_SESSION['status'] = "Failed to upload the image. Please try again.";
            header('Location:../admin/category_edit.php');
            exit();
        }
    } else {
        $update_filename = $old_image;
    }

    $query = "UPDATE `subjects` SET `subject` = '$edit_subject', `tag` = '$edit_tag', `image` = '$update_filename' WHERE `id` = '$edit_id'";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        $_SESSION['success'] = $edit_subject . ' profile updated successfully.';
        header('Location:../admin/subjects.php');
    } else {
        $_SESSION['status'] = 'Failed to update category data.';
        header('Location: ../admin/category_edit.php');
    }
}