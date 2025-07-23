<?php
ob_start();
session_start();
include 'header.php';
include 'db.php';

// بررسی ورود کاربر
if (!isset($_SESSION['is_logged']) || $_SESSION['is_logged'] !== true) {
    header('Location: login.php');
    exit();
}

// بررسی شناسه پست
if (!isset($_GET['post_id'])) {
    echo "شناسه‌ای برای پست ارائه نشده است.";
    exit();
}
$post_id = intval($_GET['post_id']);
if ($post_id <= 0) {
    echo "شناسه پست نامعتبر است.";
    exit();
}

// بررسی مالکیت پست
$sql = "SELECT author_id FROM posts WHERE post_id = $post_id";
$result = mysqli_query($conn, $sql);

if (!$result || mysqli_num_rows($result) === 0) {
    echo "پست مورد نظر یافت نشد.";
    exit();
}

$post = mysqli_fetch_assoc($result);

// بررسی اجازه حذف
if ($_SESSION['user_id'] != $post['author_id']) {
    echo "شما اجازه حذف این پست را ندارید.";
    exit();
}

// حذف پست
$sql = "DELETE FROM posts WHERE post_id = $post_id";
if (mysqli_query($conn, $sql)) {
    header("Location: my_posts.php?msg=پست با موفقیت حذف شد.");
    exit();
} else {
    $error = "خطا در حذف پست: " . mysqli_error($conn);
}
ob_end_flush();
?>

