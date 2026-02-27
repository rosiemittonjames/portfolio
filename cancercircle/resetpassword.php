<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link href="resetpassword.css" rel="stylesheet" type="text/css">
    
</head>
<body>
    <main>
        <section class="grid-container-flex">

        <form action="reset-password-handler.php" method="POST">
        <div class="container">

        <h1>Reset Password</h1>

            <label for="code"><b>Enter The Code You Received</b></label>
                <input type="text" placeholder="Code" name="code" id="code" required>

            <label for="new_password"><b>Enter Your New Password</b></label>
                <input type="password" placeholder="New password" name="new_password" id="new_password" required>

        <button type="submit" class="registerbtn">Reset Password</button>
    
  </div>
</form>

            
    </main>
</body>
</html>