
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link href="forgotpassword.css" rel="stylesheet" type="text/css">
    
</head>
<body>
    <main>
        <section class="grid-container-flex">

        <form action="send-reset-code.php" method="POST">
    <div class="container">
      <h1>Change Your Password</h1>

      <label for="email"><b>Enter Your Email</b></label>
      <input type="email" placeholder="Enter your email" name="email" id="email" required>

      <button type="submit" class="registerbtn">Send Code</button>
    </div>
</form>

            
    </main>
</body>
</html>