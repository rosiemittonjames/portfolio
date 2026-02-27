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


$userId = $_SESSION['user_id'] ?? null;

$name = $age = $location = $connectionTag = $cancerType = $stage = $treatment = $bio = $photoPath = "";
$interestTags = [];


if ($userId) {


        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['bio'])) {
            $newBio = trim($_POST['bio']);

            $updateStmt = $conn->prepare("UPDATE createaccount SET bio = :bio WHERE id = :id");
            $updateStmt->bindParam(':bio', $newBio, PDO::PARAM_STR);
            $updateStmt->bindParam(':id', $userId, PDO::PARAM_INT);
            $updateStmt->execute();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['profile_photo']) && isset($_POST['save_photo'])) {
            $uploadDir = 'uploads/';
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            $tmpName = $_FILES['profile_photo']['tmp_name'];
            $originalName = basename($_FILES['profile_photo']['name']);
            $safeName = uniqid('profile_') . '_' . preg_replace("/[^a-zA-Z0-9\._-]/", "_", $originalName);
            $targetPath = $uploadDir . $safeName;

            if (move_uploaded_file($tmpName, $targetPath)) {
                $updateStmt = $conn->prepare("UPDATE createaccount SET profilephoto1 = :photo WHERE id = :id");
                $updateStmt->bindParam(':photo', $targetPath);
                $updateStmt->bindParam(':id', $userId, PDO::PARAM_INT);
                $updateStmt->execute();
            }
        }

        $stmt = $conn->prepare("SELECT name, age, location, connection, cancertype, stage, treatment, interests, bio, profilephoto1 FROM createaccount WHERE id = :id");
        $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            $name = $user['name'];
            $age = $user['age'];
            $location = $user['location'];
            $connectionTag = $user['connection'] ?? '';
            $cancerType = $user['cancertype'] ?? '';
            $stage = $user['stage'] ?? '';
            $treatment = $user['treatment'] ?? '';
            $interestTags = explode(',', $user['interests'] ?? '');
            $bio = $user['bio'] ?? '';
            $photoPath = $user['profilephoto1'] ?? '';
        }
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
    <title>Profile</title>
    <link href="profile.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<main>
    <section class="grid-container-flex">

        <div class="header-bar">
            <h1>Hello, <?php echo htmlspecialchars($name); ?></h1>

            <a href="settings.php" class="settings-link" aria-label="Settings">
                  <i class="fa fa-gear" aria-hidden="true"></i>
                </a>
        </div>

        <label for="profile_photo_input"><h1>Your favourite photo of you</h1></label>
        <div class="photos-wrapper" style="margin-bottom: 40px;">
            <form method="POST" enctype="multipart/form-data" class="photo-form">
                <div class="photos">
                    <div class="photo-upload">
                        <input type="file" class="photos-input" name="profile_photo" id="profile_photo_input" accept="image/*" style="display: none;">
                        <div class="photo-box">
                            <img class="photo-display" src="<?php echo htmlspecialchars($photoPath ?: 'default-profile.jpg'); ?>" alt="Profile Photo">
                        </div>
                    </div>
                </div>
                <div class="submit-row">
                    <div style="margin-top: 10px;">
                        <button type="button" onclick="document.getElementById('profile_photo_input').click();" class="nextbtn">Change Photo</button>
                        <button type="submit" name="save_photo" class="nextbtn">Save Photo</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="profile-container">
            <div class="profile-details">
                <h1><?php echo htmlspecialchars($name) . ', ' . htmlspecialchars($age); ?></h1> 
                <h2><?php echo htmlspecialchars($location); ?></h2>
            </div>

            <div class="profile-tags">
                <div class="tags">
                    <span><?php echo htmlspecialchars($connectionTag); ?></span>
                </div>

                <div class="tags">
                    <?php if (!empty($cancerType)): ?>
                        <span><?php echo htmlspecialchars($cancerType); ?></span>
                    <?php endif; ?>
                    <?php if (!empty($stage)): ?>
                        <span>Stage <?php echo htmlspecialchars($stage); ?></span>
                    <?php endif; ?>
                    <?php if (!empty($treatment)): ?>
                        <span><?php echo htmlspecialchars($treatment); ?></span>
                    <?php endif; ?>
                </div>

                <div class="tags">
                    <?php foreach ($interestTags as $tag): ?>
                        <span><?php echo htmlspecialchars(trim($tag)); ?></span>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>


        <label for="msg"><h1 style="margin-top: 40px;">All about you</h1></label>
        <p>If you want to change your bio then just change the text below and 
            then press update<p>
        <form method="POST" class="my-form">
            <textarea id="msg" name="bio" rows="7" cols="150"><?php echo htmlspecialchars($bio); ?></textarea>
            <button type="submit" class="nextbtn">Update</button>
        </form>


        <ul class="navigation">
    <li><a href="discovery.php">Discover</a></li>
    <li><a href="profilesuggestions.php">Community</a></li>
    <li><a href="profile.php" class="active">Profile</a></li>
    <li><a href="preferences.php">Preferences</a></li>
</ul>

    </section>
</main>
</body>
</html>