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

    $connection = $_POST['connection'] ?? '';
    $userId = $_SESSION['user_id'] ?? null;

    if ($userId && $connection) {
        $sql = "UPDATE createaccount SET connection = :connection WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':connection', $connection);
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
    <title>Family</title>
    <link href="question5c.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
</head>
<body>
    <main>
        <section class="grid-container-flex">


                <div class="rectangle"></div> 

                <div class="question-header">
        <a href="question4.php" aria-label="Go back to previous page">
            <i class="fa-solid fa-arrow-circle-left arrow" aria-hidden="true"></i>
        </a>
        <h2><a href="question6c.php">Skip</a></h2>
    </div>

                <form action="question6c.php" method="POST">
                    <div class="container">
                      <h1>I'm a family member</h1>
                  
                      <label for="cancertype"><b>What type of cancer do they have?</b></label>
                      <input type="text" placeholder="type of cancer" name="cancertype" id="cancertype">

                      <div class="connection-row">
                        <label><b>Stage of cancer (if known)</b></label>
                    </div>
                    <div class="connection-row">
                        <button type="button" class="connectionbtn" data-value="1">1</button>
                        <button type="button" class="connectionbtn" data-value="2">2</button>
                        <button type="button" class="connectionbtn" data-value="3">3</button>
                        <button type="button" class="connectionbtn" data-value="4">4</button>
                    </div>

                    <input type="hidden" name="stage" id="selectedStage">

                    <label for="stagejourney"><b>What stage are you at in your journey?</b></label>
                      <select id="stagejourney" name="stagejourney">
                        <option value="">Select a stage</option>
                        <option value="Just Diagnosed">Just Diagnosed</option>
                        <option value="In Treatment">In Treatment</option>
                        <option value="Just Finished Treatment">Just Finished Treatment</option>
                        <option value="In Remission">In Remission</option>
                        <option value="Living with Cancer">Living with Cancer</option>
                        <option value="Terminal">Terminal</option>
                        <option value="Other">Other</option>
                      </select>

                    <label for="treatment"><b>What treatment are they having?</b></label>
                    <input type="text" placeholder="treatment" name="treatment" id="treatment">

                    <button type="submit" class="nextbtn">Next</button>
                    </div>
                  </form>
            </section>
        </main>


        <script>
  document.addEventListener("DOMContentLoaded", function () {
    const stageButtons = document.querySelectorAll(".connectionbtn");
    const selectedStage = document.getElementById("selectedStage");

    stageButtons.forEach(button => {
      button.addEventListener("click", function () {
        const isSelected = this.classList.contains("selected");


        stageButtons.forEach(btn => btn.classList.remove("selected"));

        if (!isSelected) {

          this.classList.add("selected");
          selectedStage.value = this.getAttribute("data-value");
        } else {

          selectedStage.value = "";
        }
      });
    });
  });
</script>
            
</body>
</html>