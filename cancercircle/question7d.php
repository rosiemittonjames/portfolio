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

    $technologyComfort = $_POST['technologycomfort'] ?? ''; 
    $userId = $_SESSION['user_id'] ?? null;

    if ($userId && $technologyComfort) {
        $sql = "UPDATE createaccount SET technologycomfort = :technologyComfort WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':technologyComfort', $technologyComfort);
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
    <title>Interests & Hobbies</title>
    <link href="question7.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
    <main>
        <section class="grid-container-flex">
            <div class="rectangle"></div> 

            <div class="question-header">
        <a href="question6.php" aria-label="Go back to previous page">
            <i class="fa-solid fa-arrow-circle-left arrow" aria-hidden="true"></i>
        </a>
        <h3><a href="question8.php">Skip</a></h3>
    </div>

            <div class="container">
            <h1>What are your interests and hobbies?</h1>

                <input type="text" id="searchInterests" placeholder="Search interests..." onkeyup="filterInterests()">


                <form id="questionForm" action="question8.php" method="POST">


                <h2>Sports and Fitness</h2>
                    <div class="interests-row">
                        <button type="button" class="interestsbtn" data-value="Dancing">Dancing</button>
                        <button type="button" class="interestsbtn" data-value="Exercise">Exercise</button>
                    </div>

                    <div class="interests-row">
                        <button type="button" class="interestsbtn" data-value="Fitness">Fitness</button>
                        <button type="button" class="interestsbtn" data-value="Fishing">Fishing</button>
                    </div>

                    <div class="interests-row">
                        <button type="button" class="interestsbtn" data-value="Golf">Golf</button>
                        <button type="button" class="interestsbtn" data-value="Horse Riding">Horse Riding</button>
                    </div>

                    <div class="interests-row">
                        <button type="button" class="interestsbtn" data-value="Hiking">Hiking</button>
                        <button type="button" class="interestsbtn" data-value="Health & Wellness">Health & Wellness</button>
                    </div>

                    <div class="interests-row">
                    <button type="button" class="interestsbtn" data-value="Jogging">Jogging</button>
                        <button type="button" class="interestsbtn" data-value="Kayaking">Kayaking</button>
                    </div>

                    <div class="interests-row">
                        <button type="button" class="interestsbtn" data-value="Mountain Biking">Mountain Biking</button>
                        <button type="button" class="interestsbtn" data-value="Padel">Padel</button>
                    </div>

                    <div class="interests-row">
                    <button type="button" class="interestsbtn" data-value="Pilates">Pilates</button>
                        <button type="button" class="interestsbtn" data-value="Running">Running</button>
                    </div>

                    <div class="interests-row">
                        <button type="button" class="interestsbtn" data-value="Rowing">Rowing</button>
                        <button type="button" class="interestsbtn" data-value="Rugby">Rugby</button>
                    </div>

                    <div class="interests-row">
                        <button type="button" class="interestsbtn" data-value="Sports">Sports</button>
                        <button type="button" class="interestsbtn" data-value="Tennis">Tennis</button>
                    </div>

                    <div class="interests-row">
                        <button type="button" class="interestsbtn" data-value="Table Tennis">Table Tennis</button>
                    </div>

                    <h2>Wellness & Self-Care</h2>

                    <div class="interests-row">
                        <button type="button" class="interestsbtn" data-value="Mindfulness">Mindfulness</button>
                        <button type="button" class="interestsbtn" data-value="Meditation">Meditation</button>
                    </div>

                    <div class="interests-row">
                    <button type="button" class="interestsbtn" data-value="Nutrition">Nutrition</button>
                        <button type="button" class="interestsbtn" data-value="Journalling">Journalling</button>
                    </div>

                    <div class="interests-row">
                        <button type="button" class="interestsbtn" data-value="Spa">Spa</button>
                        <button type="button" class="interestsbtn" data-value="Skincare">Skincare</button>
                    </div>

                    <h2>Arts & Creativity</h2>

                    <div class="interests-row">
                        <button type="button" class="interestsbtn" data-value="Origami">Origami</button>
                        <button type="button" class="interestsbtn" data-value="Photography">Photography</button>
                    </div>

                    <div class="interests-row">
                    <button type="button" class="interestsbtn" data-value="Painting">Painting</button>
                        <button type="button" class="interestsbtn" data-value="Poetry">Poetry</button>
                    </div>

                    <div class="interests-row">
                        <button type="button" class="interestsbtn" data-value="Writing">Writing</button>
                        <button type="button" class="interestsbtn" data-value="Kitting">Knitting</button>
                    </div>

                    <div class="interests-row">
                        <button type="button" class="interestsbtn" data-value="Sewing">Sewing</button>
                        <button type="button" class="interestsbtn" data-value="Crochet">Crochet</button>
                    </div>

                    <div class="interests-row">
                        <button type="button" class="interestsbtn" data-value="Drawing">Drawing</button>
                    </div>

                    <h2>Digital Creativity</h2>
                    <div class="interests-row">
                        <button type="button" class="interestsbtn" data-value="Coding">Coding</button>
                        <button type="button" class="interestsbtn" data-value="Graphic Design">Graphic Design</button>
                    </div>

                    <div class="interests-row">
                        <button type="button" class="interestsbtn" data-value="Photography">Photography</button>
                        <button type="button" class="interestsbtn" data-value="Photo Editing">Photo Editing</button>
                    </div>

                    <div class="interests-row">
                        <button type="button" class="interestsbtn" data-value="Filmmaking">Filmmaking</button>
                        <button type="button" class="interestsbtn" data-value="Podcasting">Podcasting</button>
                    </div>

                    <div class="interests-row">
                    <button type="button" class="interestsbtn" data-value="Video Editing">Video Editing</button>
                        <button type="button" class="interestsbtn" data-value="Blogging">Blogging</button>
                    </div>

                    <div class="interests-row">
                        <button type="button" class="interestsbtn" data-value="Vlogging">Vlogging</button>
                        <button type="button" class="interestsbtn" data-value="Animation">Animation</button>
                    </div>

                    <div class="interests-row">
                    <button type="button" class="interestsbtn" data-value="Digital Storytelling">Digital Storytelling</button>
                    </div>

                    <h2>Performing Arts & Music</h2>

                    <div class="interests-row">
                        <button type="button" class="interestsbtn" data-value="Music">Music</button>
                        <button type="button" class="interestsbtn" data-value="Opera">Opera</button>
                    </div>

                    <div class="interests-row">
                        <button type="button" class="interestsbtn" data-value="Singing">Singing</button>
                        <button type="button" class="interestsbtn" data-value="Theatre">Theatre</button>
                    </div>

                    <div class="interests-row">
                        <button type="button" class="interestsbtn" data-value="Acting">Acting</button>
                        <button type="button" class="interestsbtn" data-value="Comedy">Comedy</button>
                    </div>

                    <div class="interests-row">
                        <button type="button" class="interestsbtn" data-value="Magic">Magic</button>
                        <button type="button" class="interestsbtn" data-value="Playing Instruments">Playing Instruments</button>
                    </div>

                    <h2>Nature & Outdoor Life</h2>

                    <div class="interests-row">
                    <button type="button" class="interestsbtn" data-value="Environment">Environment</button>
                    <button type="button" class="interestsbtn" data-value="Nature">Nature</button>
                    </div>

                    <div class="interests-row">
                        <button type="button" class="interestsbtn" data-value="Gardening">Gardening</button>
                        <button type="button" class="interestsbtn" data-value="Camping">Camping</button>
                    </div>

                    <div class="interests-row">
                    <button type="button" class="interestsbtn" data-value="Outdoor Adventures">Outdoor Adventures</button>
                    </div>

                    <h2>Animals</h2>
                    <div class="interests-row">
                        <button type="button" class="interestsbtn" data-value="Zoo">Zoo</button>
                        <button type="button" class="interestsbtn" data-value="Birdwatching">Birdwatching</button>
                    </div>

                    <div class="interests-row">
                        <button type="button" class="interestsbtn" data-value="Wildlife">Wildlife</button>
                        <button type="button" class="interestsbtn" data-value="Beekeeping">Beekeeping</button>
                    </div>

                    <div class="interests-row">
                        <button type="button" class="interestsbtn" data-value="Pets">Pets</button>
                        <button type="button" class="interestsbtn" data-value="Farm Animals">Farm Animals</button>
                    </div>

                    <h2>Learning & Knowledge</h2>
                    <div class="interests-row">
                        <button type="button" class="interestsbtn" data-value="Reading">Reading</button>
                        <button type="button" class="interestsbtn" data-value="Audiobooks">Audiobooks</button>
                    </div>

                    <div class="interests-row">
                        <button type="button" class="interestsbtn" data-value="Courses">Courses</button>
                        <button type="button" class="interestsbtn" data-value="Languages">Languages</button>
                    </div>

                    <div class="interests-row">
                        <button type="button" class="interestsbtn" data-value="Documentaries">Documentaries</button>
                    </div>

                    <h2>Activities</h2>
                    <div class="interests-row">
                        <button type="button" class="interestsbtn" data-value="Cinema">Cinema</button>
                        <button type="button" class="interestsbtn" data-value="Shopping">Shopping</button>
                    </div>

                    <div class="interests-row">
                        <button type="button" class="interestsbtn" data-value="Karaoke">Karaoke</button>
                        <button type="button" class="interestsbtn" data-value="Live Music">Live Music</button>
                    </div>

                    <div class="interests-row">
                        <button type="button" class="interestsbtn" data-value="Gaming">Gaming</button>
                        <button type="button" class="interestsbtn" data-value="Travel">Travel</button>
                    </div>

                    <div class="interests-row">
                        <button type="button" class="interestsbtn" data-value="Yachting">Yachting</button>
                        <button type="button" class="interestsbtn" data-value="Clubbing">Clubbing</button>
                    </div>

                    <div class="interests-row">
                        <button type="button" class="interestsbtn" data-value="Beauty & Makeup">Beauty & Makeup</button>
                    </div>

                    <h2>Food & Drink</h2>
                    <div class="interests-row">
                        <button type="button" class="interestsbtn" data-value="Eating Out">Eating Out</button>
                        <button type="button" class="interestsbtn" data-value="Bars">Bars</button>
                    </div>

                    <div class="interests-row">
                        <button type="button" class="interestsbtn" data-value="Cocktails">Cocktails</button>
                        <button type="button" class="interestsbtn" data-value="Nutrition">Nutrition</button>
                    </div>

                    <div class="interests-row">
                        <button type="button" class="interestsbtn" data-value="Healthy Eating">Healthy Eating</button>
                        <button type="button" class="interestsbtn" data-value="Wine">Wine</button>
                    </div>

                    <h2>Automobiles</h2>

                    <div class="interests-row">
                        <button type="button" class="interestsbtn" data-value="Motorbikes">Motorbikes</button>
                        <button type="button" class="interestsbtn" data-value="Mechanics">Mechanics</button>
                    </div>

                    <div class="interests-row">
                        <button type="button" class="interestsbtn" data-value="Car Racing">Car Racing</button>
                        <button type="button" class="interestsbtn" data-value="Cars">Cars</button>
                    </div>

                    <div class="interests-row">
                        <button type="button" class="interestsbtn" data-value="Car Racing">Car Racing</button>
                        <button type="button" class="interestsbtn" data-value="Motorbike Racing">Motorbike Racing</button>
                    </div>


         
                    <input type="hidden" name="interests" id="selectedInterests">

          
                    <button type="submit" class="nextbtn">Next</button>
                </form>
            </div>
        </section>
    </main>

<script>
    document.addEventListener("DOMContentLoaded", function() {
    const interestsButtons = document.querySelectorAll(".interestsbtn");
    const selectedInterestsInput = document.getElementById("selectedInterests");
    const form = document.getElementById("questionForm");

    interestsButtons.forEach(button => {
        button.addEventListener("click", function() {
            this.classList.toggle("selected"); 

       
            const selectedValues = [...document.querySelectorAll(".interestsbtn.selected")].map(btn => btn.getAttribute("data-value"));
            selectedInterestsInput.value = selectedValues.join(",");
        });
    });

    form.addEventListener("submit", function(event) {
        const selectedCount = document.querySelectorAll(".interestsbtn.selected").length;
        if (selectedCount === 0) {
            event.preventDefault(); 
            alert("Please select at least one interest before proceeding.");
        }
    });
});

</script>

</body>
</html>