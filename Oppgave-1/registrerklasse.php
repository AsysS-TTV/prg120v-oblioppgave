<!DOCTYPE html>
<html lang="no">
<head>
    <title>Registrer klasse</title>
</head>
<body>
    <h1>Registrer klasse</h1>
    <form action="registrerklasse.php" method="post">
        <label for="klasse">Klasse:</label><br>
        <select id="registerklasse" name="klasse"><br>
            <option value="1">klassekode</option>
            <option value="2">klassenavn</option>
            <option value="3">studiumkode</option>
        </select><br>
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