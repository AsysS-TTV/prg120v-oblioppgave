<script src="funksjoner.js"></script>

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
        <input type="submit" value="Slett klasse" id="Slettklasseknapp" name="Slettklasseknapp">
    </form>
</body>
</html>

<?php
    if (isset($_POST["Slettklasseknapp"])) {
        $klassekode = $_POST["klassekode"];
        if (!$klassekode) {
            die("Vennligst velg en klasse.");
        }
    include 'db-kobling.php';
         $sqlsetning = "DELETE FROM klasse WHERE klassekode = '$klassekode'";
         if ($klassekode < 0) {
             print("Kan ikke slette klasse med studenter i den");
         }
             mysqli_query($db, $sqlsetning) or die ("ikke mulig å slette klasse");
             echo "<p>Klassen $klassekode er slettet.</p>";
            }
?> 