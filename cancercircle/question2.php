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

  
  $name = $_POST['name'] ?? '';
  $age = $_POST['age'] ?? '';

  
  $userId = $_SESSION['user_id'] ?? null;

  if ($userId && $name && $age) {
   
    $sql = "UPDATE createaccount SET name = :name, age = :age WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':age', $age);
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
    <title>Gender</title>
    <link href="question2.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
</head>
<body>

    <main>

        <section class="grid-container-flex">

                <div class="rectangle"></div> 

                <div class="question-header">
        <a href="question1.php" aria-label="Go back to previous page">
            <i class="fa-solid fa-arrow-circle-left arrow" aria-hidden="true"></i>
        </a>
    
        <h2><a href="question3.php">Skip</a></h2>
    </div>


                <form action="question3.php" method="POST" onsubmit="return validateForm(event)" id="questionForm">

                    <div class="container">
                      <h1>What's your gender?</h1>

                      <p>Select one</p>

                        <div class="gender-row">
                            <button type="button" class="genderbtn" data-value="female">Female</button>
                            <button type="button" class="genderbtn"data-value="male">Male</button> 
                        </div>
                        <div class="gender-row"></div>
                            <button type="button" class="genderbtn" data-value="transgender">Transgender</button>
                            <button type="button" class="genderbtn" data-value="non-binary">Non-binary</button>
                        </div>
                        <div class="gender-row"></div>
                            <button type="button" class="genderbtn" data-value="prefer not to say">Prefer not to say</button>
                            <button type="button" class="genderbtn" data-value="other">Other</button>
                        </div>

                        <input type="hidden" name="gender" id="selectedGender">
    
                      <button type="submit" class="nextbtn"></a>Next</button>
                    </div>
                </form>
            </section>
    </main>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
    const genderButtons = document.querySelectorAll(".genderbtn");
    const selectedGenderInput = document.getElementById("selectedGender");
    const form = document.getElementById("questionForm");

    genderButtons.forEach(button => {
        button.addEventListener("click", function() {
            if (this.classList.contains("selected")) {
               
                this.classList.remove("selected");
                selectedGenderInput.value = "";
            } else {
             
                genderButtons.forEach(btn => btn.classList.remove("selected"));

             
                this.classList.add("selected");
                selectedGenderInput.value = this.getAttribute("data-value");
            }
        });
    });

    form.addEventListener("submit", function(event) {
        if (!selectedGenderInput.value) {
            event.preventDefault(); 
            alert("Please select an option before proceeding.");
        }
    });
});
    </script>

</body>
</html>