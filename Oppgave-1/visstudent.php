<!DOCTYPE html>
<html lang="no">
<head>
    <title>Vis alle studenter</title>
</head>
<body>
    <h1>Vis alle studenter</h1>
    <p>Her er en oversikt over alle registrerte studenter:</p>
</body>
</html>

<?php
    // Tilkobler til databasen
    include 'db-kobling.php';

    // Henter alle studenter fra databasen
    $sqlsetning = "SELECT * FROM student";
    $sqlresultat = mysqli_query($db, $sqlsetning) or die ("ikke mulig å hente data fra database");
    $sqlRader = mysqli_num_rows($sqlresultat);

    // Viser antall studenter
    echo "<h3>Antall studenter: $sqlRader</h3>";
    
    // Opprett tabell for å vise studentene
    echo "<table border='1'>";
    echo "<tr><th align='left'>Brukernavn</th><th align='left'>Fornavn</th><th align='left'>Etternavn</th><th align='left'>Klassekode</th></tr>";

    // Itererer gjennom alle studentene og viser dem i tabellen
    for ($r=1;$r<=$sqlRader;$r++) {
        $rad = mysqli_fetch_array($sqlresultat);
        $brukernavn = $rad['brukernavn'];
        $fornavn = $rad['fornavn'];
        $etternavn = $rad['etternavn'];
        $klassekode = $rad['klassekode'];
        echo "<tr><td>$brukernavn</td><td>$fornavn</td><td>$etternavn</td><td>$klassekode</td></tr>";
    }
    echo "</table>";
?>