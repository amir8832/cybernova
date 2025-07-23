<?php
ob_start();
session_start();
include 'header.php';
include 'db.php';
if (isset($_SESSION['is_logged']) === true) {

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $title = $_POST['title'];
        $content = $_POST['content'];
        $author_id = $_SESSION['user_id'];
        $category_id = $_POST['category'];

        try {
            $sql = "INSERT INTO `posts` (title, content, author_id, category_id) value ('$title', '$content', '$author_id', '$category_id')";
            $result = mysqli_query($conn, $sql);

            if ($result === true){
                header("Location: my_posts.php?msg=پست شما با موفقیت منتشر شد!");
                exit;
            }
        } catch (mysqli_sql_exception $e) {
            $message = $e->getMessage();
        }
        
    }

    $sql = "SELECT * FROM categories";
    $result = mysqli_query($conn, $sql);
    $rows = mysqli_fetch_all($result);
ob_end_flush();
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>نوشتن پست وبلاگ</title>
    <link rel="stylesheet" href="write_post-style.css">
</head>
<body>
    <header class="site-header">
        <nav class="navbar">
            <ul class="nav-list">
                <li class="nav-item"><a href="user.php" class="nav-link">پنل کاربری</a></li>
                <li class="nav-item"><a href="my_posts.php" class="nav-link">پست‌ها</a></li>
                <li class="nav-item"><a href="setting.php" class="nav-link">تنظیمات</a></li>
                <li class="nav-item user-info">(<?php echo $_SESSION['username']?>) <a href="/logout.php" class="nav-link logout-link">خروج</a></li>
            </ul>
        </nav>
    </header>

    <main class="main-content">
        <section class="post-write-section">
            <h1 class="section-title">نوشتن پست وبلاگ</h1>
        </section>

        <form action="" method="POST" class="post-form">

            <!-- عنوان -->
            <label for="title" class="form-label">عنوان:</label>
            <input type="text" id="title" name="title" class="form-input" value="" placeholder="عنوان را وارد کنید"><br>

            <!-- محتوا -->
            <label for="content" class="form-label">محتوا:</label><br>
            <textarea id="content" name="content" class="form-textarea" placeholder="سلام، در این پست می‌خواهم درباره... صحبت کنم"></textarea><br>
        
            <select id="category" name="category" class="form-select">
                <?php foreach($rows as $row){
                    echo '<option value="' . $row[0] . '">' . $row[1] . '</option>';
                }
                ?>
            </select>

            <input type="submit" value="ارسال" class="btn-submit">
        </form>
    </main>
<?php } else { ?>
<p class="redirect-message">در حال انتقال به صفحه ورود...</p>
<script>
    setTimeout(function () {
        window.location.href = '/login.php';
        document.body.innerHTML = '<p>شما اکنون به صفحه جدید منتقل می‌شوید.</p>';
    }, 3000);
</script>
<?php } ?>
<footer class="site-footer">
    <p>&copy; 2025 سامانه وبلاگ نویسی Cybernova. همه حقوق محفوظ است.</p>
</footer>
</body>
</html>

