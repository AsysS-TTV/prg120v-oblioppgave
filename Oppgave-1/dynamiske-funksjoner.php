<?php

function hentKlasser() {
    include 'db-kobling.php';
    $sqlsetning = "SELECT * FROM klasse";
    $resultat = mysqli_query($db, $sqlsetning) or die ("ikke mulig å hente klasser");
    while ($rad = mysqli_fetch_array($resultat)) {
        $klassekode = $rad["klassekode"];
        $klassenavn = $rad["klassenavn"];
        $studiumkode = $rad["studiumkode"];
        echo "<option value='$klassekode'>$klassekode $klassenavn $studiumkode</option>";
    }
}

function hentStudenter() {
    include 'db-kobling.php';
    $sqlsetning = "SELECT * FROM student";
    $resultat = mysqli_query($db, $sqlsetning) or die ("ikke mulig å hente studenter");
    while ($rad = mysqli_fetch_array($resultat)) {
        $brukernavn = $rad["brukernavn"];
        $fornavn = $rad["fornavn"];
        $etternavn = $rad["etternavn"];
        $klassekode = $rad["klassekode"];
        echo "<option value='$brukernavn'>$brukernavn $fornavn $etternavn $klassekode</option>";
    }
}

function hentStudenterFraKlasse($klassekode) {
    include 'db-kobling.php';
    $sqlsetning = "SELECT * FROM student WHERE klassekode = '$klassekode'";
    $resultat = mysqli_query($db, $sqlsetning) or die ("ikke mulig å hente studenter");
    while ($rad = mysqli_fetch_array($resultat)) {
        $brukernavn = $rad["brukernavn"];
        $fornavn = $rad["fornavn"];
        $etternavn = $rad["etternavn"];
        echo "<option value='$brukernavn'>$brukernavn $fornavn $etternavn $klassekode</option>";
    }
}