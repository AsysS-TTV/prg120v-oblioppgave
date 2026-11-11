<!DOCTYPE html>
<html lang="no">
<head>
    <title>Registrer klasse</title>
</head>
<body>
    <h1>Registrer klasse</h1>
    <form action="registrerklasse.php" method="post" id="registrerklasseform">
    Klassekode: <input type="text" id="klassekode" name="klassekode"><br>
    Klassenavn: <input type="text" id="klassenavn" name="klassenavn"><br>
    Studiumkode: <input type="text" id="studiumkode" name="studiumkode"><br>
        <input type="submit" value="Registrer">
        <input type="reset" value="Nullstill">
    </form>
</body>
</html>

<?php /* registrerklasse.php */
/*
/*  Programmet registrerer klasse i database
*/

include 'db-kobling.php'; /* tilkobling til database-serveren utført */

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $klasse = $_POST["klassekode"];
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
else {
    $sqlsetning="INSERT INTO klasse (klasse, klassenavn, studiumkode) VALUES ('$klasse', '$klassenavn', '$studiumkode')";
    $sqlresultat=mysqli_query($db,$sqlsetning) or die ("ikke mulig å registrere data i database");
    if ($sqlresultat) {
        echo "Klassen er nå registrert";
    }
    else {
        echo "Klassen er ikke registrert";
    }}
for ($r=1; $r<=mysqli_num_rows($sqlresultat); $r++) {
    $rad=mysqli_fetch_array($sqlresultat);
    echo "$rad[0] $rad[1] $rad[2]";
    echo "<br>";
}
print ("</table>"); 
mysqli_close($db); /* lukker tilkobling til database-serveren */
?>