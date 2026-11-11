<!DOCTYPE html>
<html lang="no">
<head>
    <title>Registrer klasse</title>
</head>
<body>
    <h1>Registrer klasse</h1>
    <form action="" method="post" id="registrerklasseSkjema" name="registrerklasseSkjema">
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
if (isset($_POST["klassekode"])) {
    $klassekode = $_POST["klassekode"];
    $klassenavn = $_POST["klassenavn"];
    $studiumkode = $_POST["studiumkode"];

    include 'db-kobling.php'; /* tilkobling til database-serveren utført */
        $sqlsetning="SELECT * FROM klasse WHERE klassekode='$klassekode'";
        $sqlresultat=mysqli_query($db,$sqlsetning) or die ("ikke mulig å hente data fra database");
        $antall_rader=mysqli_num_rows($sqlresultat);

        if ($antall_rader != 0) {
            echo "Klassen eksisterer allerede";
        }
        else 
        {
            $sqlsetning="INSERT INTO klasse (klassekode, klassenavn, studiumkode) VALUES ('$klassekode', '$klassenavn', '$studiumkode')";
            $sqlresultat=mysqli_query($db,$sqlsetning) or die ("ikke mulig å registrere data i database");
            if ($sqlresultat) {
                echo "Klassen $klassekode, $klassenavn, $studiumkode er nå registrert";
            }
            else {
                echo "Klassen er ikke registrert";
            }
        }
    }
?>