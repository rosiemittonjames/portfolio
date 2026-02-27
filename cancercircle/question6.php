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

    $cancerType = $_POST['cancertype'] ?? '';
    $stage = $_POST['stage'] ?? '';
    $stageJourney = $_POST['stagejourney'] ?? '';
    $treatment = $_POST['treatment'] ?? '';
    $userId = $_SESSION['user_id'] ?? null;

    if ($userId && ($cancerType || $stage || $treatment || $stageJourney)) {
        $sql = "UPDATE createaccount SET cancertype = :cancertype, stage = :stage, stagejourney = :stagejourney, treatment = :treatment WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':cancertype', $cancerType);
        $stmt->bindParam(':stage', $stage);
        $stmt->bindParam(':stagejourney', $stageJourney);
        $stmt->bindParam(':treatment', $treatment);
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
    <title>Technology</title>
    <link href="question6.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
    <main>
        <section class="grid-container-flex">
            <div class="rectangle"></div> 

            <div class="question-header">
        <a href="question5a.php" aria-label="Go back to previous page">
            <i class="fa-solid fa-arrow-circle-left arrow" aria-hidden="true"></i>
        </a>
        <h2><a href="question7.php">Skip</a></h2>
    </div>

            <div class="container">
                <h1>How comfortable are you with technology?</h1>

                <div class="label-row">
                    <span class="left-label"><b>Not very</b></span>
                    <span class="right-label"><b>Very</b></span>
                </div>

                <form action="question7.php" method="POST" id="questionForm">
                    <div class="connection-row">
                        <button type="button" class="connectionbtn" data-value="1">1</button>
                        <button type="button" class="connectionbtn" data-value="2">2</button>
                        <button type="button" class="connectionbtn" data-value="3">3</button>
                        <button type="button" class="connectionbtn" data-value="4">4</button>
                        <button type="button" class="connectionbtn" data-value="5">5</button>
                    </div>

           
                    <input type="hidden" name="technologycomfort" id="selectedConnection">

   
                    <button type="submit" class="nextbtn">Next</button>
                </form>
            </div>
        </section>
    </main>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
    const connectionButtons = document.querySelectorAll(".connectionbtn");
    const selectedConnectionInput = document.getElementById("selectedConnection");
    const form = document.getElementById("questionForm");

    connectionButtons.forEach(button => {
        button.addEventListener("click", function() {
            if (this.classList.contains("selected")) {
         
                this.classList.remove("selected");
                selectedConnectionInput.value = "";
            } else {
             
                connectionButtons.forEach(btn => btn.classList.remove("selected"));

          
                this.classList.add("selected");
                selectedConnectionInput.value = this.getAttribute("data-value");
            }
        });
    });

    form.addEventListener("submit", function(event) {
        if (!selectedConnectionInput.value) {
            event.preventDefault(); 
            alert("Please select an option before proceeding.");
        }
    });
});
    </script>

</body>
</html>