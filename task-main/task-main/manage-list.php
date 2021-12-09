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

        <!-- <a href="index.php">Home</a> -->
        <a class="btn-secondary" href="<?php echo SITEURL; ?>">HOME</a>

        <h3>Manage Lists Page</h3>
        <p>
            <?php
            if (isset($_SESSION['add'])) {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            if (isset($_SESSION['delete'])) {
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }

            if (isset($_SESSION['delete_fail'])) {
                echo $_SESSION['delete_fail'];
                unset($_SESSION['delete_fail']);
            }

            if (isset($_SESSION['update'])) {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }

            ?>
        </p>

        <div class="all-lists">
            <a class="btn-primary" href="add-list.php">Add List</a>

            <table class="tbl-half">
                <tr>
                    <th>S.N.</th>
                    <th>List Name</th>
                    <th>Actions</th>
                </tr>

                <?php
                $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die("CONNECT ERROR!");
                //select db
                $db_select = mysqli_select_db($conn, DB_NAME) or die("SELECT DB ERROR!");
                //display all db
                $sql = "SELECT * FROM table_list";
                //run query
                $res = mysqli_query($conn, $sql);
                //check
                if ($res == true) {

                    //Create a SESSION Var to display msg
                    // $_SESSION['add'] = "List Added Successfully";

                    // echo "Data inserted";
                    // header('location:' . SITEURL . 'manage-list.php');

                    // echo "Executed";

                    //count the rows of data in db
                    $count_rows = mysqli_num_rows($res);
                    // echo $count_rows;

                    // create a serial numbe var
                    $sn = 1;


                    //check whether data in db or not
                    if ($count_rows > 0) {
                        // display in the table

                        while ($row = mysqli_fetch_assoc($res)) {
                            //read data from db
                            $list_id = $row['list_id'];
                            $list_name = $row['list_name'];
                ?>
                            <tr>
                                <td><?php echo $sn++; ?></td>
                                <td><?php echo $list_name; ?></td>
                                <td>
                                    <a href="<?php echo SITEURL; ?>update-list.php?list_id=<?php echo $list_id; ?>">Update</a>
                                    <a href="<?php echo SITEURL; ?>delete-list.php?list_id=<?php echo $list_id; ?>">Delete</a>
                                </td>
                            </tr>



                        <?php
                        }
                    } else {
                        //no data
                        ?>
                        <tr>
                            <td colspan="3">No List Added Yet.</td>
                        </tr>
                <?php

                    }
                } else {
                    // //create Session to save msg
                    // $_SESSION['add_fail'] = "Failed to Add List";
                    // // echo "Failed to insert data";
                    // header('location:' . SITEURL . 'add-list.php');
                }
                ?>
            </table>
        </div>
    </div>
</body>

</html>