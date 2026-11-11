<?php

function hentKlasser() {
    include 'db-kobling.php';
    $sqlsetning = "SELECT * FROM klasse ORDER BY klassekode";
    $sqlresultat = mysqli_query($db, $sqlsetning) or die ("ikke mulig å hente klasser");
    $antallRader = mysqli_num_rows($sqlresultat);
    for ($r=1;$r<=$antallRader;$r++) {
        $rad = mysqli_fetch_array($sqlresultat);
        $klassekode = $rad["klassekode"];
        $klassenavn = $rad["klassenavn"];
        $studiumkode = $rad["studiumkode"];
        echo "<option value='$klassekode'>$klassekode $klassenavn $studiumkode</option>";
    }
}

function hentStudenter() {
    include 'db-kobling.php';
    $sqlsetning = "SELECT * FROM student ORDER BY brukernavn;"
    $sqlResultat = mysqli_query($db, $sqlsetning) or die ("ikke mulig å hente studenter");
    $antallRader = mysqli_num_rows($sqlResultat);
    for ($r=1;$r<=$antallRader;$r++) {
        $rad = mysqli_fetch_array($sqlResultat);
        $brukernavn = $rad["brukernavn"];
        $fornavn = $rad["fornavn"];
        $etternavn = $rad["etternavn"];
        $klassekode = $rad["klassekode"];
        echo "<option value='$brukernavn'>$brukernavn $fornavn $etternavn $klassekode</option>";
    }
}

function hentStudenterFraKlasse($klassekode) {
    include 'db-kobling.php';
    $sqlsetning = "SELECT * FROM student WHERE klassekode = '$klassekode' ORDER BY brukernavn";
    $resultat = mysqli_query($db, $sqlsetning) or die ("ikke mulig å hente studenter");
    $antallRader = mysqli_num_rows($resultat);
    for ($r=1;$r<=$antallRader;$r++) {
        $rad = mysqli_fetch_array($resultat);
        $brukernavn = $rad["brukernavn"];
        $fornavn = $rad["fornavn"];
        $etternavn = $rad["etternavn"];
        $klassekode = $rad["klassekode"];
        echo "<option value='$brukernavn'>$brukernavn $fornavn $etternavn $klassekode</option>";
    }
} 
?>