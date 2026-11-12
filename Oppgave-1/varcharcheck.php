<?php
/**
 * varcharcheck.php
 * Automatisk validering av inputbokser for å forhindre database-feil
 * Definerer databaser-feltlengder og validerer automatisk
 */

// Database feltlengder for alle tabeller
$GLOBALS['db_field_limits'] = array(
    'klasse' => array(
        'klassekode' => 5,
        'klassenavn' => 50,
        'studiumkode' => 10
    ),
    'student' => array(
        'brukernavn' => 20,
        'fornavn' => 30,
        'etternavn' => 30,
        'klassekode' => 5
    ),
    'studium' => array(
        'studiumkode' => 10,
        'studienavn' => 50
    )
);

/**
 * Validerer et felt mot maksimal lengde
 */
function validerFeltLengde($feltNavn, $verdi, $maksLengde) {
    if (strlen($verdi) > $maksLengde) {
        return "Feltet '$feltNavn' kan ikke være lengre enn $maksLengde tegn. Du skrev " . strlen($verdi) . " tegn.";
    }
    return null;
}

/**
 * Henter alle POST-felt som skal valideres
 */
function hentPostFelt() {
    if (empty($_POST)) {
        return array();
    }
    
    $felt = array();
    foreach ($_POST as $key => $value) {
        if ($key !== 'submit' && $key !== 'reset') {
            $felt[$key] = $value;
        }
    }
    return $felt;
}

/**
 * Bestemmer hvilken tabell som skal valideres basert på POST-feltene
 */
function bestemTabell($postFelt) {
    if (isset($postFelt['klassekode']) && isset($postFelt['klassenavn']) && isset($postFelt['studiumkode'])) {
        return 'klasse';
    }
    if (isset($postFelt['brukernavn']) && isset($postFelt['fornavn']) && isset($postFelt['etternavn'])) {
        return 'student';
    }
    if (isset($postFelt['studiumkode']) && isset($postFelt['studienavn'])) {
        return 'studium';
    }
    return null;
}

/**
 * Validerer POST-data automatisk og stopper hvis det er feil
 */
function validerPostData() {
    if (empty($_POST)) {
        return;
    }
    
    $postFelt = hentPostFelt();
    if (empty($postFelt)) {
        return;
    }
    
    $tabell = bestemTabell($postFelt);
    if ($tabell === null) {
        return;
    }
    
    $grenser = $GLOBALS['db_field_limits'][$tabell];
    $feil = array();
    
    foreach ($postFelt as $felt => $verdi) {
        if (isset($grenser[$felt])) {
            $feilMelding = validerFeltLengde($felt, $verdi, $grenser[$felt]);
            if ($feilMelding !== null) {
                $feil[] = $feilMelding;
            }
        }
    }
    
    if (!empty($feil)) {
        visFeilmeldinger($feil);
        exit();
    }
}

/**
 * Viser feilmeldinger i HTML-format
 */
function visFeilmeldinger($errors) {
    if (!empty($errors)) {
        echo "<p><strong>Feil i skjemaet:</strong></p>";
        echo "<ul>";
        foreach ($errors as $feil) {
            echo "<li>" . htmlspecialchars($feil) . "</li>";
        }
        echo "</ul>";
    }
}

// Kjør validering automatisk når filen inkluderes
validerPostData();
?>
