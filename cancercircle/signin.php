<?php
session_start();

$db_hostname = 'localhost';
$db_database = 'bn21rcmj_cancercircle';
$db_username = 'bn21rcmj_user';
$db_password = '?[9Wm,)Y_AKB';
$db_connection_string = "mysql:host=$db_hostname;dbname=$db_database";

try {
    $conn = new PDO($db_connection_string, $db_username, $db_password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['email'] ?? '';
        $password = $_POST['psw'] ?? '';

        $stmt = $conn->prepare("SELECT id, password FROM createaccount WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
       
            $_SESSION['user_id'] = $user['id'];

        
            header("Location: discovery.php");
            exit;
        } else {
            $error = "Invalid email or password.";
        }
    }

    $conn = null;

} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <link href="signin.css" rel="stylesheet" type="text/css">
    
</head>
<body>

    <main>
        <section class="grid-container-flex">

        <form action="" method="POST" onsubmit="return validateForm(event)">
                <div class="container">
                  <h1>Sign In</h1>
              
                  <label for="email"><b>Email</b></label>
                  <input type="email" placeholder="Enter your email" name="email" id="email" required>
              
                  <label for="psw"><b>Password</b></label>
                  <input type="password" placeholder="Enter your password" name="psw" id="psw" required>
              

                  <button type="submit" class="registerbtn">Sign In</button>
                </div>
              
               
                  <p>Forgot your password? <a href="forgotpassword.php">Change password</a>.</p>
              </form>

              <script>

                function validateForm(event) {
                    const emailInput = document.getElementById("email");
                    const passwordInput = document.getElementById("psw");

                    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

                if (!emailPattern.test(emailInput.value)) {
                    alert("Please enter a valid email address.");
                    event.preventDefault();
                    return false;
                    }
                }


            </script>
            
    </main>
</body>
</html>