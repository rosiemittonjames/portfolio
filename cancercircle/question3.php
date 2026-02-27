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
    $db_status = "Connected successfully";

    $gender = $_POST['gender'] ?? '';


  $userId = $_SESSION['user_id'] ?? null;

  if ($userId && $gender) {
    $sql = "UPDATE createaccount SET gender = :gender WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':gender', $gender);
    $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
    $stmt->execute();

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
    <title>Location</title>
    <link href="question3.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
</head>
<body>
    <main>
        <section class="grid-container-flex">


                <div class="rectangle"></div> 

                <div class="question-header">
        <a href="question2.php"aria-label="Go back to previous page">
            <i class="fa-solid fa-arrow-circle-left arrow" aria-hidden="true"></i>
        </a>
        <h2><a href="question4.php">Skip</a></h2>
    </div>

                <form action="question4.php" method="POST" onsubmit="return validateForm(event)" id="questionForm">
                    <div class="container">
                      <h1>Location</h1>
                  
                      <label for="location"><b>Where do you live?</b></label>
                      <input type="text" placeholder="Location" name="location" id="location">

                      <label for="ethnicity"><b>What's your ethnicity?</b></label>
                      <select id="ethnicity" name="ethnicity">
                        <option value="">Select an ethnicity</option>
                        <option value="White">White</option>
                        <option value="Black_or_African_American">Black or African American</option>
                        <option value="Asian">Asian</option>
                        <option value="Hispanic_or_Latino">Hispanic or Latino</option>
                        <option value="Other">Other</option>
                      </select>

                      <label for="language"><b>What's your first language?</b></label>
                        <select id="language" name="language">
                        <option value="">Select a language</option>
                        <option value="Albanian">Albanian</option>
                        <option value="Amharic">Amharic</option>
                        <option value="Arabic">Arabic</option>
                        <option value="Armenian">Armenian</option>
                        <option value="Bengali">Bengali</option>
                        <option value="Bosnian">Bosnian</option>
                        <option value="Bulgarian">Bulgarian</option>
                        <option value="Cantonese">Cantonese</option>
                        <option value="Croatian">Croatian</option>
                        <option value="Czech">Czech</option>
                        <option value="Dari">Dari</option>
                        <option value="English">English</option>
                        <option value="Farsi">Farsi</option>
                        <option value="French">French</option>
                        <option value="German">German</option>
                        <option value="Greek">Greek</option>
                        <option value="Gujarati">Gujarati</option>
                        <option value="Hebrew">Hebrew</option>
                        <option value="Hindi">Hindi</option>
                        <option value="Hungarian">Hungarian</option>
                        <option value="Italian">Italian</option>
                        <option value="Japanese">Japanese</option>
                        <option value="Korean">Korean</option>
                        <option value="Kurdish">Kurdish</option>
                        <option value="Lithuanian">Lithuanian</option>
                        <option value="Mandarin">Mandarin</option>
                        <option value="Nepali">Nepali</option>
                        <option value="Pashto">Pashto</option>
                        <option value="Polish">Polish</option>
                        <option value="Portuguese">Portuguese</option>
                        <option value="Punjabi">Punjabi</option>
                        <option value="Romanian">Romanian</option>
                        <option value="Russian">Russian</option>
                        <option value="Serbian">Serbian</option>
                        <option value="Slovak">Slovak</option>
                        <option value="Somali">Somali</option>
                        <option value="Spanish">Spanish</option>
                        <option value="Swahili">Swahili</option>
                        <option value="Tamil">Tamil</option>
                        <option value="Thai">Thai</option>
                        <option value="Tigrinya">Tigrinya</option>
                        <option value="Turkish">Turkish</option>
                        <option value="Ukrainian">Ukrainian</option>
                        <option value="Urdu">Urdu</option>
                        <option value="Vietnamese">Vietnamese</option>
                        <option value="Welsh">Welsh</option>
                        <option value="Yoruba">Yoruba</option>
                        <option value="Zulu">Zulu</option>
                        <option value="Other">Other</option>
                      </select>
                  
    
                      <button type="submit" class="nextbtn"></a>Next</button>
                    </div>
                  
                  </form>

            
    </main>
</body>
</html>