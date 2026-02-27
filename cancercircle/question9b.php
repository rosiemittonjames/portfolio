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

    $similarities = $_POST['similarities'] ?? ''; 
    $userId = $_SESSION['user_id'] ?? null;

    if ($userId && $similarities) {
        $sql = "UPDATE createaccount SET similarities = :similarities WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':similarities', $similarities);
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
    <title>Contact Details</title>
    <link href="question9.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
</head>
<body>
    <main>
        <section class="grid-container-flex">

                <div class="rectangle"></div> 

                <div class="question-header">
        <a href="question8b.php" aria-label="Go back to previous page">
            <i class="fa-solid fa-arrow-circle-left arrow" aria-hidden="true"></i>
        </a>
    </div>

                <form action="question10b.php" method="POST" onsubmit="return validateForm(event)">
                    <div class="container">
                      <h1>Enter your preferred contact details</h1>

                      <p>This contact information will be used for others to get in contact with you</p>

                      <p>Enter at least one or both</p>
                  
                      <label for="email"><b>Email</b></label>
                      <input type="email" placeholder="Enter your email if prefered" name="email" id="email">

                      <label for="tel"><b>Phone Number</b></label>
                        <input type="tel" placeholder="Enter your number if preferred" name="tel" id="tel">
                  
    
                      <button type="submit" class="nextbtn">Next</button>
                    </div>
                  
                  </form>
                  
            
    </main>

    <script>
      function validateForm(event) {
    const emailInput = document.getElementById("email").value.trim();
    const numberInput = document.getElementById("number").value.trim();

    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    const phonePattern = /^\+?\d{7,15}$/; 


    if (emailInput === "" && numberInput === "") {
        alert("Please enter either an email or phone number.");
        event.preventDefault();
        return false;
    }

  
    if (emailInput !== "" && !emailPattern.test(emailInput)) {
        alert("Please enter a valid email address.");
        event.preventDefault();
        return false;
    }


    if (numberInput !== "" && !phonePattern.test(numberInput)) {
        alert("Please enter a valid phone number (digits only, optionally starting with '+').");
        event.preventDefault();
        return false;
    }

    return true; 
}

        </script>
</body>
</html>