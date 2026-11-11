<!DOCTYPE html>
<html lang="no">
<head>
    <title>Registrer student</title>
</head>
<body>
    <h1>Registrer student</h1>
    <form action="" method="post" id="registrerstudentSkjema" name="registrerstudentSkjema">
    Brukernavn: <input type="text" id="brukernavn" name="brukernavn"><br>
    Fornavn: <input type="text" id="fornavn" name="fornavn"><br>
    Etternavn: <input type="text" id="etternavn" name="etternavn"><br>
    Klassekode: <input type="text" id="klassekode" name="klassekode"><br>
        <input type="submit" value="Registrer">
        <input type="reset" value="Nullstill">
    </form>
</body>
</html>

<?php /* registrerstudent.php */
/*
/*  Programmet registrerer student i database
*/
if (isset($_POST["brukernavn"])) {
    $brukernavn = $_POST["brukernavn"]; 
    $fornavn = $_POST["fornavn"];
    $etternavn = $_POST["etternavn"];
    $klassekode = $_POST["klassekode"];

    include 'db-kobling.php'; /* tilkobling til database-serveren utført */
        $sqlsetning="SELECT * FROM student WHERE brukernavn='$brukernavn'";
        $sqlresultat=mysqli_query($db,$sqlsetning) or die ("ikke mulig å hente data fra database");
        $antall_rader=mysqli_num_rows($sqlresultat);

        if ($antall_rader != 0) {
            echo "Studenten eksisterer allerede";
        }
        else {
            $sqlsetning="INSERT INTO student (brukernavn, fornavn, etternavn, klassekode) VALUES ('$brukernavn', '$fornavn', '$etternavn', '$klassekode')";
            $sqlresultat=mysqli_query($db,$sqlsetning) or die ("ikke mulig å registrere data i database");
            if ($sqlresultat) {
                echo "Studenten , $brukernavn, $fornavn, $etternavn, $klassekode er nå registrert";
            }
            else {
                echo "Studenten er ikke registrert";
            }
        }
    }
?>