<?php
/*
Codice per la stampa del giorno corrente e della situazione meteo a Venezia
*/

require 'config.php';

//inizializzazione della richiesta HTTP tramite CURL
$url = 'http://api.openweathermap.org/data/2.5/weather?id='.$id_city.'&appid='.$appid;
$handle = curl_init($url);

//richiesta della risposta HTTP come stringa
curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
//esecuzione della richiesta HTTP
$response = curl_exec($handle);
//estrazione del codice di risposta (HTTP status)
$http_code = intval(curl_getinfo($handle, CURLINFO_HTTP_CODE));

if($http_code == 200) {
  // risposta HTTP ok
  $data = json_decode($response, TRUE);
  $location = $data[name];               //nome del luogo di cui sono state richieste le info meteo
  $weather = $data[weather][0][main];    /* sostituire 'main' con 'description' per avere stampato il meteo "effettivo" (es: light rain, very sunny...)
                                            da notare l'indice intermedio dell'array [0] --> ASSOLUTAMENTE NECESSARIO */
  $today = date("d F Y");
  $hour = date("H");
  $minute = date("i");
  //stampa del messaggio contenente le info di meteo ed ora corrente
  echo "Today $today at the hour $hour.$minute the weather in $location is: $weather." . PHP_EOL;
} else {
    //qualche errore
    echo "Qualcosa riguardante la richiesta meteo non ha funzionato! #{$http_code}" . PHP_EOL;
}
?>
