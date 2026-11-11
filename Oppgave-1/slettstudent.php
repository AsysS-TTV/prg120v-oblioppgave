<script src="funksjoner.js"></script>

<!DOCTYPE html>
<html lang="no">
<head>
    <title>Slett student</title>
</head>
<body>
    <h1>Slett student</h1>
    <p>Velg en student å slette:</p>
    <form method="post" action="">
        <select name="brukernavn" id="brukernavn">
            <option value="">Velg student</option>
            <?php include 'dynamisk-listeboks.php'; hentStudenter(); ?>
        </select> <br/>
        <input type="submit" value="Slett student" id="Slettstudentknapp" name="Slettstudentknapp">
    </form>
</body>
</html>

<?php
    if (isset($_POST["Slettstudentknapp"])) {
        $brukernavn = $_POST["brukernavn"];

    include 'db-kobling.php';
         $sqlsetning = "DELETE FROM student WHERE brukernavn = '$brukernavn'";
             mysqli_query($db, $sqlsetning) or die ("ikke mulig å slette student");
             echo "<p>Studenten $brukernavn er slettet.</p>";
            }
    ?> 

