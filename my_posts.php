<?php
session_start();
include 'header.php';
include 'db.php';
if (isset($_SESSION['is_logged']) === true) {

    $sql = "SELECT * FROM posts where author_id = " . $_SESSION['user_id'];
    $result = mysqli_query($conn, $sql);
    $rows = mysqli_fetch_all($result);

?>
<body>
    <header class="site-header">
        <nav class="main-nav">
            <ul class="nav-list">
                <li class="nav-item"><a class="nav-link" href="user.php">پنل کاربری</a></li>
                <li class="nav-item"><a class="nav-link" href="write_post.php">نوشتن پست</a></li>
                <li class="nav-item"><a class="nav-link" href="setting.php">تنظیمات</a></li>
                <li class="nav-item user-info">(<?php echo htmlspecialchars($_SESSION['username']) ?>) <a class="nav-link logout-link" href="/logout.php">خروج</a></li>
            </ul>
        </nav>
    </header>
<head>
    <meta charset="UTF-8" />
    <title>عنوان صفحه</title>
    <link href="https://cdn.jsdelivr.net/gh/rastikerdar/vazir-font@v30.1.0/dist/font-face.css" rel="stylesheet" />
    <link rel="stylesheet" href="my_posts.css" />
</head>

    <main class="content">
        <section class="posts-section">
            <h1 class="section-title">پست‌های وبلاگ من</h1>
            <div class="posts-list">
            <?php
                foreach ($rows as $row) {
                    echo '<div class="post-item">';
                    echo '<span class="post-title">- ' . htmlspecialchars($row[1]) . '</span>';
                    echo '<span class="post-date">، منتشر شده در: ' . htmlspecialchars($row[5]) . '</span>';
                    echo ' | <a class="post-link" href="/view_post.php?post_id=' . $row[0] . '">نمایش</a>';
                    echo ' <a class="post-link" href="/edit_post.php?post_id=' . $row[0] . '">ویرایش</a>';
                    echo ' <a class="post-link delete-link" href="/delete_post.php?post_id=' . $row[0] . '">حذف</a>';
                    echo '</div>';
                }

                if (array_key_exists('msg', $_GET)) {
                    $message = $_GET['msg'];
                }
                if (isset($message)) {
                    echo '<p class="message">' . htmlspecialchars($message) . '</p>';
                }
            ?>
            </div>
        </section>
    </main>
<?php } else { ?>
<p class="redirect-msg">در حال انتقال به صفحه ورود...</p>
<script>
    setTimeout(function () {
        window.location.href = '/login.php';
        document.body.innerHTML = '<p class="redirect-msg">شما اکنون به صفحه جدید منتقل می‌شوید.</p>';
    }, 3000);
</script>
<?php } ?>
<footer class="site-footer">
    <p>&copy; ۲۰۲۵ سامانه وبلاگ سایبرنوا. همه حقوق محفوظ است.</p>
</footer>
</body>
</html>

