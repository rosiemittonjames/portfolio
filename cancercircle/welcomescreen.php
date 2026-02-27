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


    $connectionType = $_POST['connection'] ?? '';
    $userId = $_SESSION['user_id'] ?? null;

    if ($userId && ($connectionType)) {
        $sql = "UPDATE createaccount 
                SET connectiontype = :connectiontype 
                WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':connectiontype', $connectionType);
        $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
        $stmt->execute();
    } 


    $name = '';
    if ($userId) {
        $stmt = $conn->prepare("SELECT name FROM createaccount WHERE id = :id");
        $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $name = $result['name'] ?? '';
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
    <title>Welcome</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="welcomescreen.css" rel="stylesheet" type="text/css">
    
</head>
<body>
    <main>
        <section class="grid-container-flex">

                    <h1>Hello, <?php echo htmlspecialchars($name); ?>!</h1>

                  <p>Let's create your profile</p>

                  <a href="createprofile.php" aria-label="Go to create your profile">
                    <i class="fa-solid fa-arrow-circle-right arrow" aria-hidden="true"></i>
                    </a>

    </main>
</body>
</html>