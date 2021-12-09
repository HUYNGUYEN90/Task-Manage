<?php
include('config/constants.php');

if (isset($_GET['list_id'])) {
    $list_id = $_GET['list_id'];

    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die("CONNECT ERROR!");
    $db_select = mysqli_select_db($conn, DB_NAME) or die("DB ERROR!");

    // query to get the value from DB

    $sql = "SELECT * FROM table_List where list_id ='$list_id'";
    $res = mysqli_query($conn, $sql);
    if ($res == true) {
        //get the value from db
        $row = mysqli_fetch_assoc($res);

        // print_r($row);

        // create invidual var to save the data
        $list_name = $row['list_name'];
        $list_description = $row['list_description'];



        //Create a SESSION Var to display msg
        // $_SESSION['add'] = "List Added Successfully";


        // header('location:' . SITEURL . 'manage-list.php');
    } else {
        //go back to manage list 
        header('location:' . SITEURL . 'manage-list.php');


        // $_SESSION['add_fail'] = "Failed to Add List";
    }
}






?>

<html>

<head>
    <title>Task Manager with PHP and MySQL</title>
    <link rel="stylesheet" href="<?php echo SITEURL; ?>css/style.css" />
</head>

<body>
    <div class="wrapper">
        <a class="btn-secondary" href="<?php echo SITEURL; ?>">Home</a>
        <a class="btn-secondary" href="<?php echo SITEURL; ?>manage-list.php">Manage List</a>

        <h3>Update List Page</h3>
        <p>
            <?php
            if (isset($_SESSION['update_fail'])) {
                echo $_SESSION['update_fail'];
                unset($_SESSION['update_fail']);
            }
            ?>
        </p>

        <form action="" method="POST">
            <table class="tbl-half">
                <tr>
                    <td>List Name:</td>
                    <td><input type="text" name="list_name" value="<?php echo $list_name; ?>" required="required"></td>
                </tr>

                <tr>
                    <td>List Description:</td>
                    <td><textarea name="list_description">
                    <?php echo $list_description; ?>
                </textarea></td>
                </tr>

                <tr>
                    <td><input class="btn-primary btn-lg" type="submit" name="submit" value="Update"></td>
                </tr>
            </table>
        </form>
    </div>
</body>

</html>

<?php
// check whether the update is clicked or not

if (isset($_POST['submit'])) {
    // echo "Button clicked";

    //get the update value from the form

    $list_name = $_POST['list_name'];
    $list_description = $_POST['list_description'];

    $conn2 = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die("CONNECT ERROR!");
    $db_select2 = mysqli_select_db($conn, DB_NAME) or die("DB ERROR!");

    //query to update list

    $sql2 = "UPDATE table_list SET
                list_name = '$list_name',
                list_description ='$list_description'
                WHERE list_id = $list_id";

    // execute query

    $res2 = mysqli_query($conn, $sql2);
    if ($res2 == true) {
        // query excuted successfully update
        // set the msg        
        $_SESSION['update'] = "List Updated Successfully";

        // echo "Data update";
        header('location:' . SITEURL . 'manage-list.php');
    } else {
        // fail to update
        $_SESSION['update_fail'] = "Failed to Update List";
        header('location:' . SITEURL . 'update-list.php?list_id=' . $list_id);
    }
}



?>