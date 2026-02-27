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

try {
    $conn = new PDO($db_connection_string, $db_username, $db_password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        switch ($_FILES['filename']['error']) {
            case UPLOAD_ERR_OK:
                $errmsg = 'fine'; break;
            case UPLOAD_ERR_NO_FILE:
                $errmsg = 'No file sent.'; break;
            case UPLOAD_ERR_INI_SIZE:
            case UPLOAD_ERR_FORM_SIZE:
                $errmsg = 'Exceeded filesize limit.'; break;
            default:
                $errmsg = 'Unknown error.';
        }
    
        if ($errmsg == 'fine') {
            if (isset($_FILES['filename']['name'])) {
                $name = $_FILES['filename']['name'];
                $size = $_FILES['filename']['size'];
                $tmp_name = $_FILES['filename']['tmp_name'];
    
                // Check file type
                switch ($_FILES['filename']['type']) {
                    case 'image/jpeg': $ext = "jpg"; break;
                    case 'image/jpg':  $ext = "jpg"; break;
                    case 'image/png':  $ext = "png"; break;
                    default: $ext = ''; break;
                }
    
                if ($ext) {
                    if ($size < 100000) {
                        $safe_name = preg_replace("[^A-Za-z0-9.]", "", $name);
                        $safe_name = strtolower($safe_name);
                        $safe_path = "uploaded_images/$safe_name";
    
                        move_uploaded_file($tmp_name, $safe_path);
    
                        // Correct session variable
                        $userID = $_SESSION['user_id']; 
    
                        // Correct PDO code for updating the database
                        $stmt = $conn->prepare("UPDATE createaccount SET profilepicture = :profilepicture WHERE id = :id");
                        $stmt->bindParam(':profilepicture', $safe_path);
                        $stmt->bindParam(':id', $userID);
                        $stmt->execute();
    
                        $_SESSION['upload_success'] = "Profile picture updated!";
                    } else {
                        $_SESSION['upload_error'] = "'$name' is too big - 100KB max.";
                    }
                } else {
                    $_SESSION['upload_error'] = "'$name' not uploaded - only jpg/png accepted.";
                }
            } else {
                $_SESSION['upload_error'] = "No image uploaded.";
            }
        } else {
            $_SESSION['upload_error'] = $errmsg;
        }
    
        header('Location: profile.php');
        exit();
    }

$conn = null;

} 
catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>