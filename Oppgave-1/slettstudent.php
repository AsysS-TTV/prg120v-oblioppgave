<script src="funksjoner.js"></script>

<!DOCTYPE html>
<html lang="no">
<head>
    <title>Slett student</title>
</head>
<body>
    <h1>Slett student</h1>
    <p>Velg en student å slette:</p>
    <form method="post" action="">
        Student 
        <select name="brukernavn" id="brukernavn">
            <option value="">Velg student</option>
            <?php include 'dynamisk-listeboks.php'; hentStudenter(); ?>
        </select> <br/>
        <input type="submit" value="Slett student">
    </form>
</body>
</html>

<?php
    if (isset($_POST["brukernavn"])) {
        $brukernavn = $_POST["brukernavn"];
        $fornavn = $_POST["fornavn"];
        $etternavn = $_POST["etternavn"];  
        $klassekode = $_POST["klassekode"];

    include 'db-kobling.php';
        $sqlsetning = "SELECT * FROM student WHERE brukernavn = '$brukernavn' AND fornavn = '$fornavn' AND etternavn = '$etternavn' AND klassekode = '$klassekode'";
        $resultat = mysqli_query($db, $sqlsetning) or die ("ikke mulig å hente student");
        $antallRader = mysqli_num_rows($resultat);
            if ($antallRader==0) {
                print ("Studenten finnes ikke.");
             }
            else {
                $sqlsetning = "DELETE FROM student WHERE brukernavn = '$brukernavn' AND fornavn = '$fornavn' AND etternavn = '$etternavn' AND klassekode = '$klassekode'";
                mysqli_query($db, $sqlsetning) or die ("ikke mulig å slette student");
                echo "<p>Studenten $brukernavn $fornavn $etternavn $klassekode er slettet.</p>";
            }
        }
    ?> 

