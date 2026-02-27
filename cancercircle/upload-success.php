<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
$userId = $_SESSION['user_id'] ?? null;


if ($userId) {
    try {
        $conn = new PDO("mysql:host=localhost;dbname=bn21rcmj_cancercircle", "bn21rcmj_user", "?[9Wm,)Y_AKB");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        function handlePhotoUpload($conn, $fieldName, $userID) {
            $file = $_FILES[$fieldName];
            $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png'];

            if (in_array($file['type'], $allowedTypes)) {
                if ($file['size'] <= 2000000) {
                    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
                    $safeName = preg_replace("/[^A-Za-z0-9]/", "", pathinfo($file['name'], PATHINFO_FILENAME));
                    $newFileName = uniqid() . '_' . $safeName . '.' . $ext;
                    $uploadDir = 'uploaded_images/';
                    $destPath = $uploadDir . $newFileName;

                    if (move_uploaded_file($file['tmp_name'], $destPath)) {
                        $stmt = $conn->prepare("UPDATE createaccount SET $fieldName = :filepath WHERE id = :id");
                        $stmt->bindParam(':filepath', $destPath);
                        $stmt->bindParam(':id', $userID, PDO::PARAM_INT);
                        $stmt->execute();
                    }
                }
            }
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $bio = $_POST['bio'] ?? '';
            if (!empty($bio)) {
                $stmt = $conn->prepare("UPDATE createaccount SET bio = :bio WHERE id = :id");
                $stmt->bindParam(':bio', $bio);
                $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
                $stmt->execute();
            }

            if (isset($_FILES['profilephoto1']) && $_FILES['profilephoto1']['error'] === UPLOAD_ERR_OK) {
                handlePhotoUpload($conn, 'profilephoto1', $userId);
            }
        }


        $conn = null;
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Upload Successful</title>
  <link href="upload-success.css" rel="stylesheet" type="text/css">
</head>
<body>
  <main>
  <section class="grid-container-flex">
    <h1>You're Profile is Now Created!</h1>
    <p>Now it's time for you to start using Cancer Circle.</p>
    <p>You'll be directed to your profile at first and then you'll be able 
      to discover others in the community similar to you and find local places and 
      useful resources.</p>

      <p>Once you're on the next page make sure you bookmark the page so you 
        easily come back</p>
        
    <a href="profile.php" class="nextbtn">Explore</a>
</section>
  </main>
</body>
</html>