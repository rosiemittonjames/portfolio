<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings</title>
    <link href="settings.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
</head>
<body>
    <main>
        <section class="grid-container-flex">

            <div class="settings-header">
                <a href="profile.php" aria-label="Go back to previous page">
            <i class="fa-solid fa-arrow-circle-left arrow" aria-hidden="true"></i>
        </a>
                <h1>Settings</h1>
            </div>

            <hr>
            
            <div class="setting-options">
                <h2>Feedback</h2>
                <a href="https://form.typeform.com/to/VFKqrTFI" aria-label="Go to feedback form">
            <i class="fa-solid fa-arrow-circle-right arrow" aria-hidden="true"></i>
        </a>
            </div>

                <hr>

                <div class="setting-options">
                    <h2>Bugs and reporting</h2>
                    <a href="https://form.typeform.com/to/IECuI5Vx" aria-label="Go to report bugs and other issues">
            <i class="fa-solid fa-arrow-circle-right arrow" aria-hidden="true"></i>
        </a>
                </div>

                <hr>

                <div class="setting-options">
                    <h2>Privacy notice</h2>
                    <a href="privacynotice.pdf" aria-label="Go to Cancer Circle's privacy notice">
            <i class="fa-solid fa-arrow-circle-right arrow" aria-hidden="true"></i>
        </a>
                </div>

                <hr>

                <div class="setting-options">
                    <h2>Change your password</h2>
                    <a href="forgotpassword.php" aria-label="Change your password">
            <i class="fa-solid fa-arrow-circle-right arrow" aria-hidden="true"></i>
        </a>
                </div>

                <hr>

                <div class="setting-options">
                    <h2>Delete your account</h2>
                    <a href="https://form.typeform.com/to/UOm2lajK" aria-label="Delete your account">
            <i class="fa-solid fa-arrow-circle-right arrow" aria-hidden="true"></i>
        </a>
                </div>

                <hr>

                <div class="setting-options">
                    <h2>Log out</h2>
                    <a href="logout.php" onclick="return confirmLogout();" aria-label="Go to log out">
            <i class="fa-solid fa-arrow-circle-right arrow" aria-hidden="true"></i>
        </a>
                </div>

                <hr style="margin-bottom: 250px;">

    <script>
function confirmLogout() {
    return confirm("Are you sure you want to log out?");
}
</script>

</main>

</body>
</html>