

<?php
ob_start();
include 'db.php';
include 'header.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get user input from the form
    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];

    try {
        $sql = "INSERT INTO `users` (username, email, password) value ('$username', '$email', '$password')";
        $result = mysqli_query($conn, $sql);

        if ($result === true){
            header("Location: login.php?msg=You have registered successfully, please login"); // Redirect to a welcome page or dashboard
        }
    } 
     catch (mysqli_sql_exception $e) {
    if (str_contains($e->getMessage(), 'Duplicate entry')) {
        $message = "نام کاربری یا ایمیل قبلاً ثبت شده است.";
    } else {
        $message = "خطا در ثبت‌نام: " . $e->getMessage();
    }
}
}

?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>ثبت‌نام</title>
    <link rel="stylesheet" href="style.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Vazirmatn&display=swap');

        body {
            font-family: 'Vazirmatn', Arial, sans-serif;
        }
    </style>
</head>
<body>

    <form class="register-form" action="register.php" method="post">
        <h2>ثبت‌نام</h2>

        <label for="username">نام کاربری :</label>
        <input type="text" id="username" name="username" required>

        <label for="email">ایمیل :</label>
        <input type="email" id="email" name="email" required>

        <label for="password">رمز عبور :</label>
        <input type="password" id="password" name="password" required>

        <input type="submit" value="ثبت‌نام">

        <a class="login-link" href="login.php">قبلاً ثبت‌نام کرده‌اید؟ وارد شوید</a>
    </form>

</body>
</html>

<?php if (isset($message)): ?>
    <p class="error-message"><?php echo $message; ?></p>
<?php endif; ?>
