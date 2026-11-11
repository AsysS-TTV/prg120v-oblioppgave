<!DOCTYPE html>
<html lang="no">
<head>
    <title>Vis alle studenter</title>
</head>
<body>
    <h1>Vis alle studenter</h1>
    <p>Her er en oversikt over alle registrerte studenter:</p>

    <?php
    include 'db-kobling.php';
    $sqlsetning = "SELECT * FROM student";
    $sqlresultat = mysqli_query($db, $sqlsetning) or die ("ikke mulig å hente data fra database");
    echo "<table border='1'>";
    echo "<tr><th>Brukernavn</th><th>Fornavn</th><th>Etternavn</th><th>Klassekode</th></tr>";
    while ($rad = mysqli_fetch_assoc($sqlresultat)) {
        echo "<tr>";
        echo "<td>" . $rad['brukernavn'] . "</td>";
        echo "<td>" . $rad['fornavn'] . "</td>";
        echo "<td>" . $rad['etternavn'] . "</td>";
        echo "<td>" . $rad['klassekode'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    ?>
</body>
</html>