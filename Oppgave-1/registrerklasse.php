<!DOCTYPE html>
<html lang="no">
<head>
    <title>Registrer klasse</title>
</head>
<body>
    <h1>Registrer klasse</h1>
    <form action="registrerklasse.php" method="post">
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

$sqlsetning="INSERT INTO klasse (klasse, klassenavn, studiumkode) VALUES ('$_POST[klasse]', '$_POST[klassenavn]', '$_POST[studiumkode]')";
$sqlresultat=mysqli_query($db,$sqlsetning) or die ("ikke mulig å registrere data i database");
if ($sqlresultat) {
    echo "Klassen er nå registrert";
}
mysqli_close($db); /* lukker tilkobling til database-serveren */
?>