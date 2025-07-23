
<?php
ob_start();
session_start();
include 'header.php';
include 'db.php';
$message = '';
if (isset($_GET['msg'])) {
    $message = htmlspecialchars($_GET['msg']);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get user input from the form
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['is_logged'] = true;
        $_SESSION['username'] = $row['username'];
        $_SESSION['user_id'] = $row['user_id'];
        header("Location: user.php"); // Redirect to a welcome page or dashboard
    } else {
        // Authentication failed
        $message = "نام کاربری و یا رمز صحیح نمی باشد  <br>فراموشی رمز <a href='forget_password.php?username=$username'>اینجا کلیک کنید</a>";
        $username = $_POST["username"];
    }
}

?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8" />
    <title>صفحه ورود</title>
    <link rel="stylesheet" href="login_style.css" />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Vazirmatn&display=swap');
        body {
            font-family: 'Vazirmatn', Arial, sans-serif;
        }
    </style>
</head>
<body>

    <form class="login-form" action="login.php" method="post">
        <h2>ورود</h2>

        <label for="username">نام کاربری :</label>
        <input type="text" id="username" name="username" required />

        <label for="password">رمز عبور :</label>
        <input type="password" id="password" name="password" required />

        <input type="submit" value="ورود" />

        <a class="register-link" href="register.php">حساب ندارید؟ ثبت‌نام کنید</a>

        <?php if ($message): ?>
            <p class="error-message"><?php echo $message; ?></p>
        <?php endif; ?>
    </form>




</body>
</html>

<?php
ob_end_flush();
?>

