<?php
session_start();

$db_hostname = 'localhost';
$db_database = 'bn21rcmj_cancercircle';
$db_username = 'bn21rcmj_user';
$db_password = '?[9Wm,)Y_AKB';
$db_connection_string = "mysql:host=$db_hostname;dbname=$db_database";

$message = "";
$codeDisplay = "";

try {
    $conn = new PDO($db_connection_string, $db_username, $db_password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['email'] ?? '';

        $stmt = $conn->prepare("SELECT id FROM createaccount WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($user = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $code = rand(100000, 999999);
            $_SESSION['reset_email'] = $email;
            $_SESSION['reset_code'] = $code;

            $message = "Use this code to reset your password.";
            $codeDisplay = $code;
        } 

    } else {
        echo "<script>
            alert('No account found with that email. You will be redirected to create an account.');
            window.location.href = 'createaccount.php';
        </script>";
        exit;
    }

} catch(PDOException $e) {
    $message = "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Code</title>
    <link href="send-reset-code.css" rel="stylesheet" type="text/css">
    
</head>
<body>
    <main>
        <section class="grid-container-flex">

        <form action="send-reset-code.php" method="POST">
    <div class="container">
        <h1><?php echo $message; ?></h1>

      <h2><?php echo $codeDisplay; ?></h2>

      <?php if ($codeDisplay): ?>
                <a href="resetpassword.php" class="registerbtn">Reset Your Password</a>
            <?php endif; ?>

    </div>
</form>

            
    </main>
</body>
</html>