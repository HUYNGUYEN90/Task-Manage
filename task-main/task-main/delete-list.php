<?php
include('config/constants.php');


//check list_id
if (isset($_GET['list_id'])) {
    // delete the list from db

    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die("CONNECT ERROR!");
    //select db
    $db_select = mysqli_select_db($conn, DB_NAME) or die("SELECT DB ERROR!");

    // get list_id value

    $list_id = $_GET['list_id'];

    //write query to delete List from DB
    $sql = "DELETE FROM table_list WHERE list_id =$list_id";
    // echo $sql;

    //execute query

    $res = mysqli_query($conn, $sql);
    if ($res == true) {
        // query excuted successfully delete

        //Create a SESSION Var to display msg
        $_SESSION['delete'] = "List Deleted Successfully";

        // echo "Data deleted";
        header('location:' . SITEURL . 'manage-list.php');
    } else {
        // fail to delete
        $_SESSION['delete_fail'] = "Failed to Delete List";
        header('location:' . SITEURL . 'manage-list.php');
    }
} else {
    //redirect to managet list
    header('location:' . SITEURL . 'manage-list.php');
}
