<?php
include('config/constants.php');

if (isset($_GET['task_id'])) {
    $task_id = $_GET['task_id'];

    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die("CONNECT ERROR!");
    $db_select = mysqli_select_db($conn, DB_NAME) or die("DB ERROR!");

    $sql = "SELECT * FROM table_task where task_id ='$task_id'";
    $res = mysqli_query($conn, $sql);
    if ($res == true) {
        //get the value from db
        $row = mysqli_fetch_assoc($res);
        // print_r($row);

        // create invidual var to save the data
        $task_name = $row['task_name'];
        $task_description = $row['task_description'];
        $list_id = $row['list_id'];
        $priority = $row['priority'];
        $deadline = $row['deadline'];

        // header('location:' . SITEURL . 'manage-list.php');
    } else {
        //go back to manage list 
        header('location:' . SITEURL);
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
        <h1>TASK MANAGER</h1>
        <p><a  class="btn-secondary" href="<?php echo SITEURL; ?>">Home</a></p>

        <h3>Update Task Page</h3>

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
                    <td>Task Name:</td>
                    <td><input type="text" name="task_name" value="<?php echo $task_name; ?>" required="required"></td>
                </tr>

                <tr>
                    <td>Task Description:</td>
                    <td><textarea name="task_description"><?php echo $task_description; ?></textarea></td>
                </tr>

                <tr>
                    <td>Select List:</td>
                    <td>
                        <select name="list_id">
                            <?php
                            $conn2 = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die("CONNECT ERROR!");
                            $db_select2 = mysqli_select_db($conn2, DB_NAME) or die("SELECT DB ERROR!");
                            $sql2 = "SELECT * FROM table_list";
                            $res2 = mysqli_query($conn2, $sql2);
                            if ($res2 == true) {
                                $count_row2 = mysqli_num_rows($res2);
                                if ($count_row2 > 0) {
                                    while ($row2 = mysqli_fetch_assoc($res2)) {
                                        $list_id_db = $row2['list_id'];
                                        $list_name = $row2['list_name'];
                            ?>
                                        <option <?php if ($list_id_db == $list_id) {
                                                    echo "selected='selected'";
                                                } ?> value="<?php echo $list_id_db; ?>"><?php echo $list_name; ?></option>

                                <?php
                                    }
                                }
                            } else {
                                ?>
                                <option <?php if ($list_id == 0) {
                                            echo "selected='selected'";
                                        } ?> value="0">None</option>
                            <?php
                            }

                            ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Priority:</td>
                    <td>
                        <select name="priority">
                            <option <?php if ($priority == "High") {
                                        echo "selected='selected'";
                                    }; ?> value="High">High</option>
                            <option <?php if ($priority == "Medium") {
                                        echo "selected='selected'";
                                    }; ?>value="Medium">Medium</option>
                            <option <?php if ($priority == "Low") {
                                        echo "selected='selected'";
                                    }; ?>value="Low">Low</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Deadline: </td>
                    <td><input type="date" name="deadline" value="<?php echo $deadline; ?>"></td>
                </tr>

                <tr>
                    <td><input class="btn-primary" type="submit" name="submit" value="UPDATE"></td>
                </tr>

            </table>
        </form>
    </div>
</body>

</html>

<?php

if (isset($_POST['submit'])) {
    // echo "Button clicked";      

    $task_name = $_POST['task_name'];
    $task_description = $_POST['task_description'];
    $list_id = $_POST['list_id'];
    $priority = $_POST['priority'];
    $deadline = $_POST['deadline'];

    $conn3 = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die("CONNECT ERROR!");
    $db_select2 = mysqli_select_db($conn3, DB_NAME) or die("DB ERROR!");

    //query to update list

    $sql3 = "UPDATE table_task SET
            task_name = '$task_name',
            task_description = '$task_description',
            list_id = '$list_id',
            priority = '$priority',
            deadline = '$deadline'
            WHERE
            task_id = $task_id
            ";

    $res3 = mysqli_query($conn3, $sql3);
    if ($res3 == true) {
        $_SESSION['update'] = "Task Updated Successfully";
        header('location:' . SITEURL);
    } else {
        // fail to update
        $_SESSION['update_fail'] = "Failed to Update Task";
        header('location:' . SITEURL . 'update-task.php?task_id=' . $task_id);
    }
}


?>