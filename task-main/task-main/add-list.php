<?php
include('config/constants.php');

// session_start();

?>

<html>

<head>
    <title>Task Manager with PHP and MySQL</title>
    <link rel="stylesheet" href="<?php echo SITEURL; ?>css/style.css" />
</head>

<body>
    <div class="wrapper">
        <h1>TASK MANAGER</h1>

        <a class="btn-secondary" href="index.php">Home</a>
        <a class="btn-secondary" href="manage-list.php">Manage Lists</a>

        <h3>Add List Page</h3>

        <p>
            <?php
            if (isset($_SESSION['add_fail'])) {
                echo $_SESSION['add_fail'];
                unset($_SESSION['add_fail']);
            }
            ?>
        </p>

        <form method="POST" action="">

            <table class="tbl-half">
                <tr>
                    <td>List Name:</td>
                    <td><input type="text" name="list_name" placeholder="Type list name here" required="required"></td>
                </tr>

                <tr>
                    <td>List Description</td>
                    <td><textarea name="list_description" placeholder="Type List Description Here"></textarea></td>
                </tr>

                <tr>
                    <td><input class="btn-primary btn-lg" type="submit" name="submit" value="SAVE"></td>
                </tr>
            </table>

        </form>
    </div>
</body>

</html>

<?php

$conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die("CONNECT ERROR!");
$db_select = mysqli_select_db($conn, DB_NAME) or die("DB ERROR!");

// $list_name = '';
// $list_description = '';

if (isset($_POST['submit'])) {
    // echo "Form Submitted";

    // echo $list_name = $_POST['list_name'];
    // echo $list_description = $_POST['list_description'];

    $list_name = $_POST['list_name'];
    $list_description = $_POST['list_description'];
    // }
    //  else {
    //     echo "Form Not Submitted";
    // }

    $sql = "INSERT INTO table_list SET
        list_name = '$list_name',
        list_description = '$list_description'";

    $res = mysqli_query($conn, $sql);
    if ($res == true) {

        //Create a SESSION Var to display msg
        $_SESSION['add'] = "List Added Successfully";

        // echo "Data inserted";
        header('location:' . SITEURL . 'manage-list.php');
    } else {

        //create Session to save msg

        $_SESSION['add_fail'] = "Failed to Add List";

        // echo "Failed to insert data";
        header('location:' . SITEURL . 'add-list.php');
    }
}





// Connect DB
// $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die("CONNECT ERROR!");
// $conn = mysqli_connect('localhost', 'root', '') or die("CONNECT ERROR!");

// if ($conn == true) {
//     echo "DB Connected Success";
// } else {
//     echo 'DB Connected ERROR!';
// }

//Select DB
// $db_select = mysqli_select_db($conn, DB_NAME);

// if ($db_select == true) {
//     echo "DB Selected Success";
// } else {
//     echo 'DB Selected ERROR!';
// }

// $query = "INSERT INTO users VALUES('$username', '$password', '$email')";

// $sql = "INSERT INTO table_list VALUES('','$list_name','$list_description')";

// $sql = "INSERT INTO table_list SET
//         list_name = '$list_name',
//         list_description = '$list_description'";

// $res = mysqli_query($conn, $sql);

// if ($res == true) {
//     // echo "Data inserted";
//     // header('location:' . SITEURL . 'manage-list.php');
// } else {
//     // echo "Failed to insert data";
//     // header('location:' . SITEURL . 'add-list.php');
// }

?>