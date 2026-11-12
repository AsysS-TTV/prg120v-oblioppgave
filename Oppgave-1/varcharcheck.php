<?php
/**
 * varcharcheck.php
 * Validering av inputbokser for å sjekke lengde før de sendes til databasen
 */

/**
 * Validerer at input ikke overstiger maksimal lengde
 * @param array $data Assosiativ array med felt-navn som nøkkel og verdi som data
 * @param array $limits Assosiativ array med felt-navn som nøkkel og maksimal lengde som verdi
 * @return array Array med 'valid' (bool) og 'errors' (array av feilmeldinger)
 */
function validerInputLengde($data, $limits) {
    $feil = array();
    $valid = true;

    foreach ($data as $felt => $verdi) {
        if (isset($limits[$felt])) {
            $makslengde = $limits[$felt];
            $faktisklengde = strlen($verdi);

            if ($faktisklengde > $makslengde) {
                $valid = false;
                $feil[$felt] = "Feltet '{$felt}' kan ikke være længre enn {$makslengde} tegn. Du skrev {$faktisklengde} tegn.";
            }
        }
    }

    return array(
        'valid' => $valid,
        'errors' => $feil
    );
}

/**
 * Validerer at påkrevde felt ikke er tomme
 * @param array $data Assosiativ array med felt-navn som nøkkel og verdi som data
 * @param array $required Array med navn på påkrevde felt
 * @return array Array med 'valid' (bool) og 'errors' (array av feilmeldinger)
 */
function validerPakrevdeFelt($data, $required) {
    $feil = array();
    $valid = true;

    foreach ($required as $felt) {
        if (!isset($data[$felt]) || empty($data[$felt])) {
            $valid = false;
            $feil[$felt] = "Feltet '{$felt}' er påkrevd.";
        }
    }

    return array(
        'valid' => $valid,
        'errors' => $feil
    );
}

/**
 * Kombinert validering - sjekker både påkrevde felt og lengde
 * @param array $data Assosiativ array med felt-navn som nøkkel og verdi som data
 * @param array $limits Assosiativ array med felt-navn som nøkkel og maksimal lengde som verdi
 * @param array $required Array med navn på påkrevde felt (valgfritt)
 * @return array Array med 'valid' (bool) og 'errors' (array av feilmeldinger)
 */
function validerData($data, $limits, $required = array()) {
    $alleFeil = array();
    $valid = true;

    // Sjekk påkrevde felt først
    if (!empty($required)) {
        $pakrevdResultat = validerPakrevdeFelt($data, $required);
        if (!$pakrevdResultat['valid']) {
            $valid = false;
            $alleFeil = array_merge($alleFeil, $pakrevdResultat['errors']);
        }
    }

    // Sjekk lengde
    $lengdeResultat = validerInputLengde($data, $limits);
    if (!$lengdeResultat['valid']) {
        $valid = false;
        $alleFeil = array_merge($alleFeil, $lengdeResultat['errors']);
    }

    return array(
        'valid' => $valid,
        'errors' => $alleFeil
    );
}

/**
 * Viser feilmeldinger i HTML-format
 * @param array $errors Array av feilmeldinger
 */
function visFeilmeldinger($errors) {
    if (!empty($errors)) {
        echo "<div style='background-color: #ffcccc; border: 1px solid #ff0000; padding: 10px; margin: 10px 0; border-radius: 4px;'>";
        echo "<strong style='color: #cc0000;'>Feil i skjemaet:</strong><ul>";
        foreach ($errors as $feil) {
            echo "<li>" . htmlspecialchars($feil) . "</li>";
        }
        echo "</ul></div>";
    }
}
?>
