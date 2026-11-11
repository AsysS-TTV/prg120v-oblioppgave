<!DOCTYPE html>
<html lang="no">
<head>
    <title>Vis alle klasser</title>
</head>
<body>
    <h1>Vis alle klasser</h1>
    <p>Her er en oversikt over alle registrerte klasser:</p>
</body>
</html>

<?php
    // Tilkobler til databasen
    include 'db-kobling.php';

    // Henter alle klasser fra databasen
    $sqlsetning = "SELECT * FROM klasse";
    $sqlresultat = mysqli_query($db, $sqlsetning) or die ("ikke mulig å hente data fra database");
    $sqlRader = mysqli_num_rows($sqlresultat);

    // Viser antall klasser
    echo "<h3>Antall klasser: $sqlRader</h3>";
    
    // Opprett tabell for å vise klassene
    echo "<table border='1'>";
    echo "<tr><th align='left'>Klassekode</th><th align='left'>Klassenavn</th><th align='left'>Studiumkode</th></tr>";

    // Itererer gjennom alle klassene og viser dem i tabellen
    for ($r=1;$r<=$sqlRader;$r++) {
        $rad = mysqli_fetch_array($sqlresultat);
        $klassekode = $rad['klassekode'];
        $klassenavn = $rad['klassenavn'];
        $studiumkode = $rad['studiumkode'];
        echo "<tr><td>$klassekode</td><td>$klassenavn</td><td>$studiumkode</td></tr>";
    }
    echo "</table>";
?>
