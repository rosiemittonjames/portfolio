<?php
session_start();

$enteredCode = $_POST['code'] ?? '';
$newPassword = $_POST['new_password'] ?? '';
$email = $_SESSION['reset_email'] ?? '';
$expectedCode = $_SESSION['reset_code'] ?? '';

$message = "";
$success = false;

if ($enteredCode == $expectedCode && $email) {
    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

    $conn = new PDO("mysql:host=localhost;dbname=bn21rcmj_cancercircle", "bn21rcmj_user", "?[9Wm,)Y_AKB");
    $stmt = $conn->prepare("UPDATE createaccount SET password = :pwd WHERE email = :email");
    $stmt->bindParam(':pwd', $hashedPassword);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    unset($_SESSION['reset_email']);
    unset($_SESSION['reset_code']);

    $message = "Your password has been successfully updated!";
    $success = true;
} else {
    $message = "Invalid code, please try again.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset Status</title>
    <link href="reset-password-handler.css" rel="stylesheet" type="text/css">
</head>
<body>
<main>
    <section class="grid-container-flex">
        <div class="container">
            <h1><?php echo $message; ?></h1>

            <?php if ($success): ?>
                <a href="signin.php" class="registerbtn">Sign In Now</a>

            <?php else: ?>
                <a href="forgotpassword.php" class="registerbtn">Try Again</a>
            <?php endif; ?>
        </div>
    </section>
</main>
</body>
</html>