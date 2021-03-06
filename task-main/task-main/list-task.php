<?php
include('config/constants.php');
$list_id_url = $_GET['list_id'];
?>


<html>

<head>
    <title>Task Manager with PHP and MySQL</title>
    <link rel="stylesheet" href="<?php echo SITEURL; ?>css/style.css" />
</head>

<body>
    <div class="wrapper">
        <h1>TASK MANAGER</h1>

        <div class="menu">
            <!-- <a href="index.html">Home</a> -->
            <a href="<?php echo SITEURL; ?>">Home</a>

            <?php

            $conn2 = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die("CONNECT ERROR!");
            $db_select2 = mysqli_select_db($conn2, DB_NAME) or die("DB ERROR!");
            $sql2 = "SELECT * FROM table_list";

            $res2 = mysqli_query($conn2, $sql2);
            if ($res2 == true) {
                while ($row2 = mysqli_fetch_assoc($res2)) {
                    $list_id = $row2['list_id'];
                    $list_name = $row2['list_name'];
            ?>
                    <a href="<?php echo SITEURL; ?>list-task.php?list_id=<?php echo $list_id; ?>"><?php echo $list_name; ?></a>
            <?php
                }
            }
            ?>


            <!-- <a href="#">To Do</a>
    <a href="#">Doing</a>
    <a href="#">Done</a> -->


            <!-- <a href="manage-list.php">Manage Lists</a> -->
            <a href="<?php echo SITEURL; ?>manage-list.php">Manage Lists</a>
        </div>

        <div class="all-task">
            <a class="btn-primary" href="<?php echo SITEURL; ?>add-task.php">Add Task</a>

            <table class="tbl-full">
                <tr>
                    <th>S.N.</th>
                    <th>Task Name</th>
                    <th>Priority</th>
                    <th>Deadline</th>
                    <th>Actions</th>
                </tr>

                <?php
                $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die("CONNECT ERROR!");
                $db_select = mysqli_select_db($conn, DB_NAME) or die("SELECT DB ERROR!");
                $sql = "SELECT * FROM table_task WHERE list_id=$list_id_url";
                $res = mysqli_query($conn, $sql);
                if ($res == true) {
                    $count_rows = mysqli_num_rows($res);
                    $sn = 1;
                    if ($count_rows > 0) {
                        // display in the table
                        while ($row = mysqli_fetch_assoc($res)) {
                            $task_id = $row['task_id'];
                            $task_name = $row['task_name'];
                            $priority = $row['priority'];
                            $deadline = $row['deadline'];
                ?>
                            <tr>
                                <td><?php echo $sn++; ?></td>
                                <td><?php echo $task_name; ?></td>
                                <td><?php echo $priority; ?></td>
                                <td><?php echo $deadline; ?></td>
                                <td>
                                    <a href="<?php echo SITEURL; ?>update-task.php?task_id=<?php echo $task_id; ?>">Update</a>
                                    <a href="<?php echo SITEURL; ?>delete-task.php?task_id=<?php echo $task_id; ?>">Delete</a>
                                </td>
                            </tr>
                    <?php
                        }
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="5">No Task Added on this list</td>
                    </tr>
                <?php
                }
                ?>
            </table>
        </div>
    </div>
</body>

</html>