<?php
session_start();
if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    unset($_SESSION['user'][$delete_id]);
}

$_SESSION['message'] = 'Tugas telah dihapus!';
$_SESSION['type'] = 'success';

header("Location: index.php");
exit(); 
?>