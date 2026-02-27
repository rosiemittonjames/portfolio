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

    $interests = $_POST['interests'] ?? ''; 
    $userId = $_SESSION['user_id'] ?? null;

    if ($userId && $interests) {
        $sql = "UPDATE createaccount SET interests = :interests WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':interests', $interests);
        $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
        $stmt->execute();
    } 

    $conn = null;

} 
catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Similarities</title>
    <link href="question8.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
    <main>
        <section class="grid-container-flex">
            <div class="rectangle"></div> 

            <div class="question-header">
        <a href="question7.php" aria-label="Go back to previous page">
            <i class="fa-solid fa-arrow-circle-left arrow" aria-hidden="true"></i>
        </a>
        <h2><a href="question9.php">Skip</a></h2>
    </div>

            <div class="container">
                <h1>What similarities are important to you?</h1>

                <input type="text" id="searchInterests" placeholder="Search similarities..." onkeyup="filterInterests()">


                <form id="questionForm" action="question9.php" method="POST">

                    <div class="interests-row">
                        <button type="button" class="interestsbtn" data-value="Age">Age</button>
                        <button type="button" class="interestsbtn" data-value="Culture">Culture</button>
                        
                    </div>

                    <div class="interests-row">
                        <button type="button" class="interestsbtn" data-value="Side Effects">Side Effects</button>
                        <button type="button" class="interestsbtn" data-value="Type of Cancer">Type of Cancer</button>
                        
                    </div>

                    <div class="interests-row">
                        <button type="button" class="interestsbtn" data-value="Hobbies">Hobbies</button>
                        <button type="button" class="interestsbtn" data-value="Mental Health">Mental Health</button>
                    </div>

                    <div class="interests-row">
                        <button type="button" class="interestsbtn" data-value="Stage of Cancer">Stage of Cancer</button>
                        <button type="button" class="interestsbtn" data-value="Religion">Religion</button>
                    </div>

                    <div class="interests-row">
                        <button type="button" class="interestsbtn" data-value="Stage of Journey">Stage of Journey</button>
                        <button type="button" class="interestsbtn" data-value="Treatment">Treatment</button>
                    </div>

                    <div class="interests-row">
                        <button type="button" class="interestsbtn" data-value="Relationship to Patient">Relationship to Patient</button>
                        <button type="button" class="interestsbtn" data-value="Location">Location</button>
                    </div>

                    <div class="interests-row">
                        <button type="button" class="interestsbtn" data-value="Navigating My Journey">Navigating My Journey</button>
                        <button type="button" class="interestsbtn" data-value="Wellness">Wellness</button>
                    </div>

                    <div class="interests-row">
                        <button type="button" class="interestsbtn" data-value="Diagnosis Story">Diagnosis Story</button>
                        <button type="button" class="interestsbtn" data-value="Survivorship">Survivorship</button>
                    </div>

                    <div class="interests-row">
                        <button type="button" class="interestsbtn" data-value="Caregiving Experience">Caregiving Experience</button>
                        <button type="button" class="interestsbtn" data-value="Nutrition">Nutrition</button>
                    </div>

                    <div class="interests-row">
                        <button type="button" class="interestsbtn" data-value="Financal Impact">Financial Impact</button>
                        <button type="button" class="interestsbtn" data-value="Parenting">Parenting</button>
                    </div>

                 
                    <input type="hidden" name="similarities" id="selectedInterests">

             
                    <button type="submit" class="nextbtn">Next</button>
                </form>
            </div>
        </section>
    </main>

</body>
</html>

<script>

document.addEventListener("DOMContentLoaded", function() {
    const interestsButtons = document.querySelectorAll(".interestsbtn");
    const selectedInterestsInput = document.getElementById("selectedInterests");
    const form = document.getElementById("questionForm");

    interestsButtons.forEach(button => {
        button.addEventListener("click", function() {
            this.classList.toggle("selected");
            updateSelectedInterests();
        });
    });

    function updateSelectedInterests() {
        const selectedValues = [...document.querySelectorAll(".interestsbtn.selected")].map(btn => btn.getAttribute("data-value"));
        selectedInterestsInput.value = selectedValues.join(",");
    }

    form.addEventListener("submit", function(event) {
        if (!selectedInterestsInput.value) {
            event.preventDefault(); 
            alert("Please select at least one interest before proceeding.");
        }
    });
});

function filterInterests() {
    let input = document.getElementById("searchInterests").value.toLowerCase();
    let buttons = document.querySelectorAll(".interestsbtn");

    buttons.forEach(button => {
        let text = button.innerText.toLowerCase();
        if (text.includes(input)) {
            button.style.display = "inline-block"; 
        } else {
            button.style.display = "none"; 
        }
    });
}

</script>