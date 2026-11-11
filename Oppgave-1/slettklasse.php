<script src="funksjoner.js"></script>

<!DOCTYPE html>
<html lang="no">
<head>
    <title>Slett klasse</title>
</head>
<body>
    <h1>Slett klasse</h1>
    <p>Velg en klasse å slette:</p>
    <form method="post" action="">
        Klasse 
        <select name="klassekode">
            <?php include 'dynamisk-listeboks.php'; hentKlasser(); ?>
        </select>
        <input type="submit" value="Slett klasse">
    </form>
</body>
</html>

<?php
    if (isset($_POST["klassekode"])) {
        $klassekode = $_POST["klassekode"];
        $klassenavn = $_POST["klassenavn"];
        $studiumkode = $_POST["studiumkode"];  

    include 'db-kobling.php';
        $sqlsetning = "SELECT * FROM klasse WHERE klassekode = '$klassekode' AND klassenavn = '$klassenavn' AND studiumkode = '$studiumkode'";
        $resultat = mysqli_query($db, $sqlsetning) or die ("ikke mulig å hente klasse");
        $antallRader = mysqli_num_rows($resultat);
            if ($antallRader==0) {
                print ("Klassen finnes ikke.");
             }
            else {
                $sqlsetning = "DELETE FROM klasse WHERE klassekode = '$klassekode' AND klassenavn = '$klassenavn' AND studiumkode = '$studiumkode'";
                mysqli_query($db, $sqlsetning) or die ("ikke mulig å slette klasse");
                echo "<p>Klassen $klassekode $klassenavn $studiumkode er slettet.</p>";
            }
        }
    ?> 

