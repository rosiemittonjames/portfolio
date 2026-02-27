<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link href="narration.css" rel="stylesheet" type="text/css">
    
</head>
<body>
    <main>
        <section class="grid-container-grid">

        <section class="grid-container-flex">
            <h1>Welcome to Cancer Circle!</h1>
            <p>We're a community of people who've been affected by cancer
                who are here to connect with others similar to us. 
            </p>
            <p>To join the community all you need to do is answer a short 
                questionnaire. 
            </p>
            <p>Based on the answers you submit we'll connect you with others 
                who are similar to you in the ways which are important to you.
            </p>
            <button class="my-button" onclick="goToPage()">Sign Up</button>
        </section>
    </main>

    <script>

        function goToPage() {
            window.location.href = 'createaccount.php'; 
        }

    </script>
</body>
</html>