<?php
ob_start();
session_start();
include 'header.php';
include 'db.php';

// بررسی ورود کاربر
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// گرفتن آیدی پست از URL
$post_id = isset($_GET['post_id']) ? intval($_GET['post_id']) : 0;

if ($post_id <= 0) {
    echo "شناسه پست نامعتبر است.";
    exit();
}

// واکشی پست از دیتابیس
$sql = "SELECT * FROM posts WHERE post_id = $post_id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
ob_end_flush();
?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($row['title']); ?> - وبلاگ</title>
    <link href="https://cdn.jsdelivr.net/gh/rastikerdar/vazir-font@v30.1.0/dist/font-face.css" rel="stylesheet" />
    <link rel="stylesheet" href="view_post.css">
</head>
<body>
    <header class="site-header">
        <nav class="main-nav">
            <ul class="nav-list">
                <li><a class="nav-link" href="user.php">صفحه اصلی</a></li>
                <li><a class="nav-link" href="my_posts.php">همه پست‌ها</a></li>
            </ul>
        </nav>
    </header>

    <main class="post-container">
        <section class="post-content">
            <h1 class="post-title"><?php echo htmlspecialchars($row['title']); ?></h1>
            <p class="post-body"><?php echo nl2br(htmlspecialchars($row['content'])); ?></p>
        </section>
    </main>

    <footer class="site-footer">
        <p>&copy; ۲۰۲۵ سامانه وبلاگ Cybernova. تمامی حقوق محفوظ است.</p>
    </footer>
</body>
</html>

