<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

$db_hostname = 'localhost';
$db_database = 'bn21rcmj_cancercircle';
$db_username = 'bn21rcmj_user';
$db_password = '?[9Wm,)Y_AKB';
$db_connection_string = "mysql:host=$db_hostname;dbname=$db_database";

$imagemessage = '';
$uploadedImagePath = '';

function handlePhotoUpload($conn, $fieldName, $userID) {
    $file = $_FILES[$fieldName];
    $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png'];

    if (in_array($file['type'], $allowedTypes)) {
        if ($file['size'] <= 2000000) { // 2MB limit
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

try {
    $conn = new PDO($db_connection_string, $db_username, $db_password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $userID = $_SESSION['user_id'] ?? null;
    if (!$userID) {
        die("Error: User not logged in.");
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        $bio = $_POST['bio'] ?? '';
        if (!empty($bio)) {
            $stmt = $conn->prepare("UPDATE createaccount SET bio = :bio WHERE id = :id");
            $stmt->bindParam(':bio', $bio);
            $stmt->bindParam(':id', $userID, PDO::PARAM_INT);
            $stmt->execute();
        }

    
        if (isset($_FILES['profilephoto1']) && $_FILES['profilephoto1']['error'] === UPLOAD_ERR_OK) {
            handlePhotoUpload($conn, 'profilephoto1', $userID);
        }

    $conn = null;
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create Profile</title>
  <link href="createprofile.css" rel="stylesheet" type="text/css">
</head>
<body>
<main>
<section class="grid-container-flex">

<h1>Upload your profile picture and bio</h1>

<form id="frmMultiplePhotos" action="" method="POST" enctype="multipart/form-data">

<!-- Profile Photo 2 -->
<div class="photos">
<div class="photo-upload">
  <input type="file" id="profilephoto2" name="profilephoto2" accept="image/*" hidden onchange="previewPhoto(event, 2)">
  <div class="photo-box" onclick="triggerFileInput(2)">
    <span class="plus-icon" id="plusIcon2">+</span>
    <img id="photoDisplay2" class="photo-display" src="" style="display:none;">
    <span class="remove-photo" id="removePhoto2" onclick="removeSelectedPhoto(event, 2)" style="display:none;">&#10006;</span>
  </div>
</div>

<!-- Profile Photo 3 -->
<div class="photo-upload">
  <input type="file" id="profilephoto3" name="profilephoto3" accept="image/*" hidden onchange="previewPhoto(event, 3)">
  <div class="photo-box" onclick="triggerFileInput(3)">
    <span class="plus-icon" id="plusIcon3">+</span>
    <img id="photoDisplay3" class="photo-display" src="" style="display:none;">
    <span class="remove-photo" id="removePhoto3" onclick="removeSelectedPhoto(event, 3)" style="display:none;">&#10006;</span>
  </div>
</div>

<!-- Profile Photo 4 -->
<div class="photo-upload">
  <input type="file" id="profilephoto4" name="profilephoto4" accept="image/*" hidden onchange="previewPhoto(event, 4)">
  <div class="photo-box" onclick="triggerFileInput(4)">
    <span class="plus-icon" id="plusIcon4">+</span>
    <img id="photoDisplay4" class="photo-display" src="" style="display:none;">
    <span class="remove-photo" id="removePhoto4" onclick="removeSelectedPhoto(event, 4)" style="display:none;">&#10006;</span>
  </div>
</div>

<!-- Profile Photo 5 -->
<div class="photo-upload">
  <input type="file" id="profilephoto5" name="profilephoto5" accept="image/*" hidden onchange="previewPhoto(event, 5)">
  <div class="photo-box" onclick="triggerFileInput(5)">
    <span class="plus-icon" id="plusIcon5">+</span>
    <img id="photoDisplay5" class="photo-display" src="" style="display:none;">
    <span class="remove-photo" id="removePhoto5" onclick="removeSelectedPhoto(event, 5)" style="display:none;">&#10006;</span>
  </div>
</div>

<!-- Profile Photo 6 -->
<div class="photo-upload">
  <input type="file" id="profilephoto6" name="profilephoto6" accept="image/*" hidden onchange="previewPhoto(event, 6)">
  <div class="photo-box" onclick="triggerFileInput(6)">
    <span class="plus-icon" id="plusIcon6">+</span>
    <img id="photoDisplay6" class="photo-display" src="" style="display:none;">
    <span class="remove-photo" id="removePhoto6" onclick="removeSelectedPhoto(event, 6)" style="display:none;">&#10006;</span>
  </div>
</div>

<!-- Profile Photo 7 -->
<div class="photo-upload">
  <input type="file" id="profilephoto7" name="profilephoto7" accept="image/*" hidden onchange="previewPhoto(event, 7)">
  <div class="photo-box" onclick="triggerFileInput(7)">
    <span class="plus-icon" id="plusIcon7">+</span>
    <img id="photoDisplay7" class="photo-display" src="" style="display:none;">
    <span class="remove-photo" id="removePhoto7" onclick="removeSelectedPhoto(event, 7)" style="display:none;">&#10006;</span>
  </div>
</div>
</div>

<input type="submit" class="nextbtn" value="Save All Photos" />

</form>

</div>

  </section>
</main>

<script>
function triggerFileInput(number) {
  document.getElementById('profilephoto' + number).click();
}

function previewPhoto(event, number) {
  const file = event.target.files[0];
  if (file && file.type.startsWith('image/')) {
    const reader = new FileReader();
    reader.onload = function(e) {
      document.getElementById('photoDisplay' + number).src = e.target.result;
      document.getElementById('photoDisplay' + number).style.display = 'block';
      document.getElementById('plusIcon' + number).style.display = 'none';
      document.getElementById('removePhoto' + number).style.display = 'block';
    }
    reader.readAsDataURL(file);
  }
}

function removeSelectedPhoto(event, number) {
  event.stopPropagation();
  document.getElementById('profilephoto' + number).value = '';
  document.getElementById('photoDisplay' + number).src = '';
  document.getElementById('photoDisplay' + number).style.display = 'none';
  document.getElementById('plusIcon' + number).style.display = 'block';
  document.getElementById('removePhoto' + number).style.display = 'none';
}
</script>

</body>
</html>