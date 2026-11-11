<script src="funksjoner.js"></script>

<!DOCTYPE html>
<html lang="no">
<head>
    <title>Slett student</title>
</head>
<body>
    <h1>Slett student</h1>
    <p>Velg en student å slette:</p>
    <form method="post" action="" id="Slettstudentknapp" name="Slettstudentknapp"  onclick="return bekreft()"> 
        Student:
        <select name="brukernavn" id="brukernavn">
            <option value="">Velg student</option>
            <?php include("dynamiske-funksjoner.php"); hentStudenter(); ?>
        </select> <br/>
        <input type="submit" value="Slett student" id="Slettstudentknapp" name="Slettstudentknapp">
    </form>
</body>
</html>

<?php
    // Sjekker om knappen "Slett student" ble klikket
    if (isset($_POST["Slettstudentknapp"])) {
        $brukernavn = $_POST["brukernavn"];
        
        // Validerer at en student ble valgt
        if (!$brukernavn) {
            die("Vennligst velg en student.");
        }

        // Tilkobler til databasen
        include 'db-kobling.php';
        
        // Sletter studenten fra databasen
        $sqlsetning = "DELETE FROM student WHERE brukernavn = '$brukernavn'";
        mysqli_query($db, $sqlsetning) or die ("ikke mulig å slette student");
        
        // Bekrefter at studenten ble slettet
        echo "<p>Studenten $brukernavn er slettet.</p>";
    }
?>