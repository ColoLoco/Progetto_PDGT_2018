<?php
/* API per la stampa del giorno corrente e della situazione meteo a Venezia */

//includiamo file di configurazione
require 'config.php';

//impostiamo informazioni header richiesta HTTP
header("Content-Type: text/plain; charset=UTF-8");
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
  //risposta HTTP ok
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
  //risposta HTTP con errore
  http_response_code(400);        //modifichiamo il codice di risposta di HTTP impostandolo 400
  exit;                           //terminiamo l'esecuzione dello script
}
?>
