<?php
/*
Codice per la stampa del giorno corrente e della situazione meteo a Venezia
*/

require 'config.php';  //file di configurazione
$id = '3164603';       //id che identifica la città di Venezia su openweather.org

// Inizializza la richiesta HTTP tramite CURL
$url = 'http://api.openweathermap.org/data/2.5/weather?id='.$id.'&appid='.$appid;
$handle = curl_init($url);

// Richiedi la risposta HTTP come stringa
curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
// Esegui la richiesta HTTP
$response = curl_exec($handle);

// Estrai il codice di risposta (HTTP status)
$http_code = intval(curl_getinfo($handle, CURLINFO_HTTP_CODE));

if($http_code == 200) {
    // Risposta OK
    $data = json_decode($response, TRUE);
    $location = $data[name];               //nome del luogo di cui sono state richieste le info meteo
    $weather = $data[weather][0][main];    /* sostituire 'main' con 'description' per avere stampato il meteo "effettivo" (es: light rain, very sunny...)
                                              da notare l'indice intermedio dell'array [0] --> ASSOLUTAMENTE NECESSARIO */
    $today = date("d F Y");
    $hour = date("H i");
    echo "Today $today at the hour $hour the weather in $location is: $weather.";
}
else {
    // Qualche errore
    echo "Qualcosa non ha funzionato! #{$http_code}" . PHP_EOL;
}
?>
