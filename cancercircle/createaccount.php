<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>
    <link href="createaccountstyle.css" rel="stylesheet" type="text/css">
    
</head>
<body>
    <main>
        <section class="grid-container-flex">

            <form action="question1.php" method="POST" onsubmit="return validateForm(event)">
                <div class="container">
                  <h1>Create Account</h1>
                  <h2>To join our supportive cancer community</h2>
              
                  <label for="email"><b>Email</b></label>
                  <input type="email" placeholder="Enter email" name="email" id="email" required>

                  <label for="psw"><b>Password</b></label>
                    <input type="password" placeholder="Enter password" name="psw" id="psw" required>

                    <label for="psw-repeat"><b>Repeat Password</b></label>
                    <input type="password" placeholder="Repeat password" name="psw-repeat" id="psw-repeat" required>

                    <input type="checkbox" id="privacy" name="privacy" value="accepted" required>
                    <label for="privacy"> I accept the <a href="privacynotice.pdf" target="_blank" style="text-decoration: underline;">privacy policy</a></label><br> 
              

                    <button type="submit" class="registerbtn">Register</button>
                </div>
              
               
                  <p>Already have an account? <a href="signin.php">Sign in</a>.</p>
              </form>
            
              <script>
                function validateForm(event) {
                    const emailInput = document.getElementById("email");
                    const passwordInput = document.getElementById("psw");
                    const confirmPasswordInput = document.getElementById("psw-repeat");

                    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

                    // Check if email is valid
                    if (!emailPattern.test(emailInput.value)) {
                        alert("Please enter a valid email address.");
                        event.preventDefault();
                        return false;
                    }

                    // Check if passwords match
                    if (passwordInput.value !== confirmPasswordInput.value) {
                        alert("Passwords do not match. Please enter the same password.");
                        event.preventDefault();
                        return false;
                    }

                    return true;
                }
            </script>
    </main>
</body>
</html>