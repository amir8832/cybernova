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

// دریافت آیدی پست
if (!isset($_GET['post_id'])) {
    echo "شناسه پست مشخص نشده است.";
    exit();
}
$post_id = intval($_GET['post_id']);
if ($post_id <= 0) {
    echo "شناسه پست نامعتبر است.";
    exit();
}

// واکشی اطلاعات پست
$sql = "SELECT * FROM posts WHERE post_id = $post_id";
$result = mysqli_query($conn, $sql);
if (!$result || mysqli_num_rows($result) === 0) {
    echo "پست پیدا نشد.";
    exit();
}
$post = mysqli_fetch_assoc($result);

// بررسی مجوز ویرایش
if ($_SESSION['user_id'] != $post['author_id']) {
    echo "شما اجازه ویرایش این پست را ندارید.";
    exit();
}

// پردازش فرم
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $content = mysqli_real_escape_string($conn, $_POST['content']);

    $sql_update = "UPDATE posts SET title = '$title', content = '$content' WHERE post_id = $post_id";
    if (mysqli_query($conn, $sql_update)) {
        header("Location: my_posts.php?msg=پست با موفقیت به‌روزرسانی شد!");
        exit();
    } else {
        $error = "خطا در به‌روزرسانی پست: " . mysqli_error($conn);
    }
}
ob_end_flush();
?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>ویرایش پست - سامانه وبلاگ</title>
    <link href="https://cdn.jsdelivr.net/gh/rastikerdar/vazir-font@v30.1.0/dist/font-face.css" rel="stylesheet" />
    <link rel="stylesheet" href="edit_post.css">
</head>
<body>
    <header class="site-header">
        <nav class="main-nav">
            <ul class="nav-list">
                <li><a href="user.php">پنل کاربری</a></li>
                <li><a href="write_post.php">نوشتن پست</a></li>
                <li><a href="my_posts.php">پست‌های من</a></li>
                <li><a href="setting.php">تنظیمات</a></li>
                <li>(<?php echo $_SESSION['username']; ?>) <a href="logout.php">خروج</a></li>
            </ul>
        </nav>
    </header>

    <main class="edit-container">
        <section class="edit-form">
            <h1 class="form-title">ویرایش پست</h1>
            
            <?php if (isset($error)) echo "<p class='error-msg'>$error</p>"; ?>

            <form action="" method="POST">
                <label for="title">عنوان پست:</label>
                <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($post['title']); ?>" required>

                <label for="content">محتوای پست:</label>
                <textarea id="content" name="content" rows="10" required><?php echo htmlspecialchars($post['content']); ?></textarea>

                <input type="submit" value="به‌روزرسانی پست">
            </form>
        </section>
    </main>

    <footer class="site-footer">
        <p>&copy; ۲۰۲۵ سامانه وبلاگ Voorivex. تمامی حقوق محفوظ است.</p>
    </footer>
</body>
</html>

