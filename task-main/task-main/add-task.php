<?php
include('config/constants.php');
?>

<html>

<head>
    <title>Task Manager with PHP and MySQL</title>
    <link rel="stylesheet" href="<?php echo SITEURL; ?>css/style.css" />
</head>

<body>
    <div class="wrapper">
        <h1>TASK MANAGER</h1>
        <a class="btn-secondary" href="<?php echo SITEURL ?>">Home</a>
        <h3>Add Task Page</h3>

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
                    <td>Task Name:</td>
                    <td><input type="text" name="task_name" placeholder="Type your task name" required="required"></td>
                </tr>

                <tr>
                    <td>Task Description:</td>
                    <td><textarea name="task_description" placeholder="Type Task Description"></textarea></td>
                </tr>

                <tr>
                    <td>Select List:</td>
                    <td>
                        <select name="list_id">
                            <?php
                            $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die("CONNECT ERROR!");
                            //select db
                            $db_select = mysqli_select_db($conn, DB_NAME) or die("SELECT DB ERROR!");

                            $sql = "SELECT * FROM table_list";
                            //run query
                            $res = mysqli_query($conn, $sql);
                            //check
                            if ($res == true) {
                                $count_rows = mysqli_num_rows($res);
                                if ($count_rows > 0) {
                                    while ($row = mysqli_fetch_assoc($res)) {
                                        $list_id = $row['list_id'];
                                        $list_name = $row['list_name'];
                            ?>
                                        <option value="<?php echo $list_id ?>"><?php echo $list_name; ?></option>
                                    <?php
                                    }
                                } else {
                                    ?>
                                    <option value="0">None</option>
                            <?php }
                            }
                            ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Priority:</td>
                    <td>
                        <select name="priority">
                            <option value="High">High</option>
                            <option value="Medium">Medium</option>
                            <option value="Low">Low</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Deadline: </td>
                    <td><input type="date" name="deadline"></td>
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
if (isset($_POST['submit'])) {
    $task_name = $_POST['task_name'];
    $task_description = $_POST['task_description'];
    $list_id = $_POST['list_id'];
    $priority = $_POST['priority'];
    $deadline = $_POST['deadline'];

    $conn2 = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die("CONNECT ERROR!");
    //select db
    $db_select2 = mysqli_select_db($conn2, DB_NAME) or die("SELECT DB ERROR!");

    $sql2 = "INSERT INTO table_task SET
            task_name = '$task_name',
            task_description = '$task_description',
            list_id = $list_id,
            priority = '$priority',
            deadline = '$deadline'";
    //run query
    $res2 = mysqli_query($conn2, $sql2);
    // //check
    if ($res2 == true) {
        $_SESSION['add'] = 'Task Added Successfully';
        header('location:' . SITEURL);
    } else {
        $_SESSION['add_fail'] = 'Fail to add Task';
        header('location:' . SITEURL . 'add-task.php');
    }
}




?>