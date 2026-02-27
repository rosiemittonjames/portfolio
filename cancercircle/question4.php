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

    $location = $_POST['location'] ?? '';
    $ethnicity = $_POST['ethnicity'] ?? '';
    $language = $_POST['language'] ?? '';


  $userId = $_SESSION['user_id'] ?? null;

  if ($userId && ($location || $ethnicity || $language)) {
    $sql = "UPDATE createaccount SET location = :location, ethnicity = :ethnicity, language = :language WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':location', $location);
    $stmt->bindParam(':ethnicity', $ethnicity);
    $stmt->bindParam(':language', $language);
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
  <title>Connection to Cancer</title>
  <link href="question4.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
  <main>
    <section class="grid-container-flex">
      <div class="rectangle"></div> 

      <div class="question-header">
        <a href="question3.php"aria-label="Go back to previous page">
            <i class="fa-solid fa-arrow-circle-left arrow" aria-hidden="true"></i>
        </a>
    </div>

      <div class="container">
        <h1>What's your main connection to cancer?</h1>

        <form method="POST" id="questionForm">
          <div class="connection-row">
            <button type="button" class="connectionbtn" data-value="Cancer Journey" data-url="question5a.php">I'm currently on my cancer journey</button>
          </div>
          <div class="connection-row">
            <button type="button" class="connectionbtn" data-value="Cancer Survivor" data-url="question5b.php">I'm a cancer survivor</button>
          </div>
          <div class="connection-row">
            <button type="button" class="connectionbtn" data-value="Caregiver" data-url="question5d.php">I'm a caregiver</button>
          </div>
          <div class="connection-row">
            <button type="button" class="connectionbtn" data-value="Family Member" data-url="question5c.php">I'm a family member</button>
          </div>
          <div class="connection-row">
            <button type="button" class="connectionbtn" data-value="Friend" data-url="question5e.php">I'm a friend</button>
          </div>


          <input type="hidden" name="connection" id="selectedConnection">


          <button type="button" class="nextbtn">Next</button>
        </form>
      </div>
    </section>
  </main>

  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const buttons = document.querySelectorAll(".connectionbtn");
      const form = document.getElementById("questionForm");
      const selectedConnection = document.getElementById("selectedConnection");
      const nextButton = document.querySelector(".nextbtn");
      let nextUrl = "";

      buttons.forEach(button => {
        button.addEventListener("click", function () {
          buttons.forEach(btn => btn.classList.remove("selected"));
          this.classList.add("selected");

          selectedConnection.value = this.getAttribute("data-value");
          nextUrl = this.getAttribute("data-url");
        });
      });

      nextButton.addEventListener("click", function () {
        if (selectedConnection.value && nextUrl) {
          form.action = nextUrl;
          form.submit();
        } else {
          alert("Please select an option before proceeding.");
        }
      });
    });
  </script>
</body>
</html>