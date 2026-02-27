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

    $email = $_POST['email'] ?? '';
    $tel = $_POST['tel'] ?? '';
    $userId = $_SESSION['user_id'] ?? null;

    if ($userId && ($email || $tel)) {
        $sql = "UPDATE createaccount SET contactemail = :email, contactnumber = :tel WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':tel', $tel);
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
  <link href="question10.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
  <main>
    <section class="grid-container-flex">
      <div class="rectangle"></div> 

      <div class="question-header">
        <a href="question9d.php" aria-label="Go back to previous page">
            <i class="fa-solid fa-arrow-circle-left arrow" aria-hidden="true"></i>
        </a>
        <h2><a href="welcomescreen.php">Skip</a></h2>
    </div>

      <div class="container">
        <h1>Do you want to eventually meet others or just stay online?</h1>

        <form method="POST" id="questionForm">
          <div class="connection-row">
            <button type="button" class="connectionbtn" data-value="Meet Others In-person">Meet Others In-person</button>
          </div>
          <div class="connection-row">
            <button type="button" class="connectionbtn" data-value="Only Connect Online">Only Connect Online</button>
          </div>
          <div class="connection-row">
            <button type="button" class="connectionbtn" data-value="Connect Online & In-Person">Connect Online & In-Person</button>
          </div>
          <div class="connection-row">
            <button type="button" class="connectionbtn" data-value="I'm Not Sure">I'm Not Sure</button>
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
        const isSelected = this.classList.contains("selected");
  
     
        buttons.forEach(btn => btn.classList.remove("selected"));
  
        if (!isSelected) {
    
          this.classList.add("selected");
          selectedConnection.value = this.getAttribute("data-value");
          nextUrl = this.getAttribute("data-url") || ""; 
        } else {
       
          selectedConnection.value = "";
          nextUrl = "";
        }
      });
    });

    nextButton.addEventListener("click", function () {
  if (selectedConnection.value) {
    form.action = "welcomescreen.php";
    form.submit();
  } else {
    alert("Please select an option before proceeding.");
  }
});
  
  });
  </script>
</body>
</html>