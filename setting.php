<?php
ob_start();
session_start();
include 'header.php';
include 'db.php';
if (isset($_SESSION['is_logged']) === true) {

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $user_id = $_POST['user_id'];
        $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
        $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $bio = mysqli_real_escape_string($conn, $_POST['bio']);
        $password_change = false;
    
        if ($password === ""){
            $sql = "UPDATE `users` SET `first_name` = '$first_name', `last_name` = '$last_name', `bio` = '$bio' where `user_id` = " . intval($user_id);
        }else{
            $sql = "UPDATE `users` SET `first_name` = '$first_name', `last_name` = '$last_name', `bio` = '$bio', `password` = $password where `user_id` = " . intval($user_id);
            $password_change = true;
        }

        try {
            $result = mysqli_query($conn, $sql);
            if ($result === true){
                if ($password_change === true) header("Location: logout.php"); 
                else header("Location: settings.php");
            }
        } catch (mysqli_sql_exception $e) {
            $message = $e->getMessage();
            print($message);
        }
        exit;
    }

    try {
        $sql = "select * from `users` where user_id = " . $_SESSION['user_id'];
        $result = mysqli_query($conn, $sql);
        $user_information = mysqli_fetch_assoc($result);

        //print_r($user_informationow);

    } catch (mysqli_sql_exception $e) {
        $message = $e->getMessage();
    }
ob_end_flush();
?>
<body>
<header class="profile-settings__header">
<link rel="stylesheet" href="setting-style.css">
<main class="profile-settings__main">
    <!-- ... -->
    <img class="profile-settings__avatar" src="<?='/get_image.php?imgsrc=statics/images/' . md5($_SESSION['user_id']) . '.png';?>" onerror="this.src='/statics/images/user.png'" width="200" height="200"><img><br>
    <input class="profile-settings__file-input" type="file" id="imageUpload" accept="image/*">
    <progress id="uploadProgress" class="profile-settings__progress" max="100" value="0"></progress>
    <div id="message" class="profile-settings__message"></div>
    <!-- ... -->
    <form class="profile-settings__form" action="" method="POST">
        <!-- inputs -->
        <input type="hidden" name="user_id" value="<?=$user_information['user_id'];?>">

	<label class="profile-settings__label" for="username">نام کاربری:</label>
        <input class="profile-settings__input" type="text" id="username" name="username" value="<?=$user_information['username'];?>" disabled><br>

        <label class="profile-settings__label" for="email">ایمیل:</label>
        <input class="profile-settings__input" type="email" id="email" name="email" value="<?=$user_information['email'];?>" disabled><br>

        <label class="profile-settings__label" for="first_name">نام:</label>
        <input class="profile-settings__input" type="text" id="first_name" name="first_name" value="<?=$user_information['first_name'];?>"><br>

        <label class="profile-settings__label" for="last_name">نام خانوادگی:</label>
        <input class="profile-settings__input" type="text" id="last_name" name="last_name" value="<?=$user_information['last_name'];?>"><br>

        <label class="profile-settings__label" for="bio">بیوگرافی:</label>
        <textarea class="profile-settings__textarea" id="bio" name="bio"><?=$user_information['bio'];?></textarea><br>

        <label class="profile-settings__label" for="password">رمز:</label>
        <input class="profile-settings__input" type="password" id="password" name="password" value=""><br>

        <input class="profile-settings__submit" type="submit" value="به روز رسانی">
    </form>
    </main>
<?php } else { ?>
<p>Redirecting you to login page...</p>
<script>
    // Delay the redirection for 3 seconds (adjust as needed)
    setTimeout(function () {
        // Specify the URL you want to redirect to
        window.location.href = '/login.php';

        // Display a message (optional)
        document.body.innerHTML = '<p>You are now being redirected to the new page.</p>';
    }, 3000); // 3000 milliseconds (3 seconds)
</script>
<?php } ?>
<footer>
    <p> 2025  Cybernova</p>
</footer>
</body>
</html>

