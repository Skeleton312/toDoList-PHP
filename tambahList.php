<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $header = $_POST['header'];
    $komen = $_POST['komen'];
    $tanggal = $_POST['tanggal'];
    $level = $_POST['level'];

    $user = [
        'header' => $header,
        'komen' => $komen,
        'tanggal' => $tanggal,
        'level' => $level,
        'check' => 'false'
    ];
    if ($edit_id != -1 && isset($_SESSION['users'][$edit_id])) {
        $_SESSION['users'][$edit_id] = $user;
        $_SESSION['type'] = 'success';
        $_SESSION['message'] = 'Data user berhasil diperbarui!';
    }
    elseif (!isset($_SESSION['user'])) {
            $_SESSION['user'] = [];
        }
    $_SESSION['user'][] = $user;
    $_SESSION['type'] = 'success';
    $_SESSION['massage'] = 'Tugas Baru Ditambahkan';
    header("Location: index.php");
    exit();
}
?>
