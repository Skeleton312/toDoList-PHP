<?php 
session_start();
if (isset($_SESSION['user'])){
    unset($_SESSION['user']);
}
$_SESSION['message'] = 'Data dihapus!';
$_SESSION['type'] = 'success';
header('Location: index.php');
exit();
?>