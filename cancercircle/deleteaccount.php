<?php
session_start();

$db_hostname = 'localhost';
$db_database = 'bn21rcmj_cancercircle';
$db_username = 'bn21rcmj_user';
$db_password = '?[9Wm,)Y_AKB';
$db_connection_string = "mysql:host=$db_hostname;dbname=$db_database";

require_once('checklog.php');
$sess_userID = $_SESSION['userID'];
$submitted = isset($_POST["submit"] ) ? $_POST["submit"]: '';
$delete = isset($_POST["delete"] ) ? $_POST["delete"]: 0;
if ($submitted == 'submit') {
    if ($delete == 1) {
        try {
            $conn = new PDO($db_connection_string, $db_username, $db_password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // DELETE user
            $query = $conn->prepare("DELETE FROM users WHERE ID = :userid");
            $query->bindParam(':userid', $sess_userID, PDO::PARAM_INT);
            $query->execute();

            // DESTROY session
            $_SESSION = array();
            session_destroy();
            header('Location: signin.php');
            exit();

        } catch (PDOException $e) {
            $db_status = "Connection failed: " . $e->getMessage();
            echo $db_status;
        }

        $conn = null;
    } else {
        header('Location: profile.php');
        exit();
    }
}