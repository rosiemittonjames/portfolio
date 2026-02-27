<?php
$db_hostname = 'localhost';
$db_database = 'bn21rcmj_cancercircle'; //'Your database name'
$db_username = 'bn21rcmj_user'; //'your username';
$db_password = '?[9Wm,)Y_AKB'; //'Your password';
$db_connection_string = "mysql:host=$db_hostname;dbname=$db_database";
$db_status = 'not initialised';
$content = '';

try {

  $conn = new PDO($db_connection_string, $db_username, $db_password);

  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $db_status = "Connected successfully";

session_start();

$email = $_POST['email'] ?? '';
$password = $_POST['psw'] ?? '';
$privacy = isset($_POST['privacy']) && $_POST['privacy'] === 'accepted' ? 1 : 0;

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);


$checkSql = "SELECT COUNT(*) FROM createaccount WHERE email = :email";
$checkStmt = $conn->prepare($checkSql);
$checkStmt->bindParam(':email', $email);
$checkStmt->execute();

if ($checkStmt->fetchColumn() > 0) {
  echo "<script>
      alert('That email is already registered. Please use a different one or sign in.');
      window.history.back(); // Go back to the previous page
   </script>";
  exit();
 }

$sql = "INSERT INTO createaccount (email, password, privacy) VALUES (:email, :password, :privacy)";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':password', $hashedPassword);
$stmt->bindParam(':privacy', $privacy);
$stmt->execute();

$_SESSION['user_id'] = $conn->lastInsertId();


  $conn = null;

 } catch(PDOException $e) {
    $db_status = "Connection failed: " . $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tell Us About Yourself</title>
    <link href="question1.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
</head>
<body>
    <main>
        <section class="grid-container-flex">


                <div class="rectangle"></div> 

                <div class="question-header">
        <a href="createaccount.php" aria-label="Go back to previous page">
            <i class="fa-solid fa-arrow-circle-left arrow" aria-hidden="true"></i>
        </a>
    </div>

                <form action="question2.php" method="POST" onsubmit="return validateForm(event)">
                    <div class="container">
                      <h1>Tell us about yourself</h1>
                  
                      <label for="name"><b>First name</b></label>
                      <input type="text" placeholder="Enter your first name" name="name" id="name" required>

                      <label for="age"><b>How old are you?</b></label>
                      <input type="number" placeholder="Enter your age" name="age" id="age" required>
                  
    
                      <button type="submit" class="nextbtn"></a>Next</button>
                    </div>
                  
                  </form>
                  
            
    </main>
</body>
</html>