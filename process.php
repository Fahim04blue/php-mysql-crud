<?php

session_start();

$mysqli = new mysqli('localhost', 'root', '', 'crud') or die(mysqli_error($mysqli));

// if (!function_exists('mysqli_init') && !extension_loaded('mysqli')) {
//     echo 'We don\'t have mysqli!!!';
// } else {
//     echo 'Phew we have it!';
// }

$topic_name = '';
$details = '';

if (isset($_POST['add'])) {
    $topic_name = $_POST['name'];
    $details = $_POST['details'];

    $mysqli->query("insert into todo (topic_name,details) values('$topic_name','$details')") or die($mysqli->error);

    $_SESSION['message'] = "Todo is Saved";
    $_SESSION['msg_type'] = "success";

    header('location: index.php');
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $mysqli->query("delete from todo where id = $id") or die($mysqli->error);

    $_SESSION['message'] = "Todo is Deleted";
    $_SESSION['msg_type'] = "danger";
}

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $result = $mysqli->query("select * from todo where id = $id") or die($mysqli->error);

    if ($result) {
        $row = $result->fetch_array();
        $topic_name = $row['topic_name'];
        $details = $row['details'];
    }
}
