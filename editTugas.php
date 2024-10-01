<?php
session_start();
if(isset($_GET['checked'])){
    $checked_id = $_GET['checked'];
    $_SESSION['user'][$checked_id]['check'] = 'true';
    $_SESSION['message'] = 'Tugas ditandai selesai! Klik \'Selesai\' untuk melihat';
    $_SESSION['type'] = 'success';
}


header("Location: index.php");
exit();
?>