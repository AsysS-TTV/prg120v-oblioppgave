<!DOCTYPE html>
<html lang="no">
<head>
    <title>Slett klasse</title>
</head>
<body>
    <h1>Slett klasse</h1>
    <p>Velg en klasse å slette:</p>
    <form method="post" action="" id="Slettklasseknapp" name="Slettklasseknapp"> 
        Klasse:
        <select name="klassekode" id="klassekode">
            <option value="">Velg klasse</option>
            <?php include("dynamiske-funksjoner.php"); hentKlasser(); ?>
        </select> <br/>
        <script src="funksjoner.js"></script>
        <input type="submit" value="Slett klasse" id="Slettklasseknapp" name="Slettklasseknapp">
    </form>
</body>
</html>

<?php
    // Sjekker om knappen "Slett klasse" ble klikket
    if (isset($_POST["Slettklasseknapp"])) {
        $klassekode = $_POST["klassekode"];
        
        // Validerer at en klasse ble valgt
        if (!$klassekode) {
            die("Vennligst velg en klasse.");
        }

        // Tilkobler til databasen
        include 'db-kobling.php';

        // Sjekk om klassen har studenter før sletting
        $sjekkStudenter = "SELECT COUNT(*) AS antall FROM student WHERE klassekode = '$klassekode'";
        $resultat = mysqli_query($db, $sjekkStudenter);
        $rad = mysqli_fetch_assoc($resultat);
        
        // Hvis klassen har studenter, kan vi ikke slette den
        if ($rad['antall'] > 0) {
            die("Kan ikke slette klasse med studenter i den");
        }

        // Slett klassen hvis ingen studenter er tilknyttet den
        $sqlsetning = "DELETE FROM klasse WHERE klassekode = '$klassekode'";
        mysqli_query($db, $sqlsetning) or die ("ikke mulig å slette klasse");
        
        // Bekrefter at klassen ble slettet
        echo "<p>Klassen $klassekode er slettet.</p>";
    }
?> 