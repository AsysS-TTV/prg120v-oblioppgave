<!DOCTYPE html>
<html lang="no">
<head>
    <title>Registrer klasse</title>
</head>
<body>
    <h1>Registrer klasse</h1>
    <form action="registrerklasse.php" method="post">
        <input type="hidden" name="submit" value="1">
        <label for="klasse">Klasse:</label><br>
        <input list="registerklasse" id="registerklasse" name="klasse"><br>
            <datalist id="registerklasse">
                <option value="klassekode">
                <option value="klassenavn">
                <option value="studiumkode">
            </datalist><br>
        <label for="klassenavn">Klassenavn:</label><br>
        <input type="text" id="klassenavn" name="klassenavn"><br>
        <label for="studiumkode">Studiumkode:</label><br>
        <input type="text" id="studiumkode" name="studiumkode"><br>
        <input type="submit" value="Registrer">
    </form>
</body>
</html>

<?php /* registrerklasse.php */
/*
/*  Programmet registrerer klasse i database
*/

include 'db-kobling.php'; /* tilkobling til database-serveren utført */

if (isset($_POST["submit"])) {
    $klasse = $_POST["klasse"];
    $klassenavn = $_POST["klassenavn"];
    $studiumkode = $_POST["studiumkode"];
} else {
    die("Form not submitted");
}

$sqlsetning="SELECT * FROM klasse WHERE klasse='$klasse'";
$sqlresultat=mysqli_query($db,$sqlsetning) or die ("ikke mulig å hente data fra database");
if (mysqli_num_rows($sqlresultat) > 0) {
    die("Klassen eksisterer allerede");
}

$sqlsetning="INSERT INTO klasse (klasse, klassenavn, studiumkode) VALUES ('$klasse', '$klassenavn', '$studiumkode')";
$sqlresultat=mysqli_query($db,$sqlsetning) or die ("ikke mulig å registrere data i database");
if ($sqlresultat) {
    echo "Klassen er nå registrert";
}
mysqli_close($db); /* lukker tilkobling til database-serveren */
?>