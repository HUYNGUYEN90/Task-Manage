<?php
include('config/constants.php');

if (isset($_GET['task_id'])) {

    $task_id = $_GET['task_id'];

    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die("CONNECT ERROR!");
    $db_select = mysqli_select_db($conn, DB_NAME) or die("SELECT DB ERROR!");

    $sql = "DELETE FROM table_task WHERE task_id =$task_id";
    // echo $sql;

    //execute query
    $res = mysqli_query($conn, $sql);
    if ($res == true) {

        //Create a SESSION Var to display msg
        $_SESSION['delete'] = "Task Deleted Successfully";

        header('location:' . SITEURL);
    } else {
        // fail to delete
        $_SESSION['delete_fail'] = "Failed to Delete Task";
        header('location:' . SITEURL);
    }
} else {
    //redirect to managet list
    header('location:' . SITEURL);
}
