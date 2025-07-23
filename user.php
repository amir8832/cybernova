<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8" />
    <title>پنل کاربری</title>
    <link rel="stylesheet" href="user.css" />
</head>
<body>
    <div class="container">
        <aside class="sidebar">
            <h2>سلام، <?php echo htmlspecialchars($_SESSION['username']); ?> 👋</h2>
            <ul>
                <li><a href="setting.php">⚙️ تنظیمات</a></li>
                <li><a href="calculate.php">🧮 محاسبات</a></li>
                <li><a href="write_post.php">✍️ افزودن پست</a></li>
                <li><a href="logout.php">🚪 خروج</a></li>
            </ul>
        </aside>
        <main class="main-content">
            <h1>به پنل کاربری خوش آمدید</h1>
            <p>از منوی کناری، عملیات مورد نظر خود را انتخاب کنید.</p>
        </main>
    </div>
</body>
</html>

