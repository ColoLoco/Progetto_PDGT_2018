<?php
require 'functions.php';    //file contenente le funzioni usate dal client

echo "\n------------------------------------\n";
echo "|  Progetto PDGT  A.A. 2017/2018   |\n";
echo "|   Studente: Giacomo Colonesi     |\n";
echo "|        Matricola: 274146         |\n";
echo "|                                  |\n";
echo "| Servizio client per collegamento |\n";
echo "|    al database dei trasporti     |\n";
echo "|           veneziani              |\n";
echo "------------------------------------\n";

$close_client = 1;    //impostiamo variabile per permettere esecuzione di più richieste da parte dell'utente
do {
  echo "\n\nSelezionare la richiesta da eseguire al database: \n";
  echo "\t[1] Stampa completa dei vaporetti.\n";
  echo "\t[2] Stampa dei vaporetti filtrati secondo una caratteristica.\n";
  echo "\t[3] Stampa completa dei bus.\n";
  echo "\t[4] Stampa dei bus filtrati secondo una caratteristica.\n\n";
  echo "\t[5] Chiusura del client.\n\n";

  $first_ch = readline();    //la funzione readline() attende la lettura di un valore immesso dall'utente (come la scanf nel C)
  /*
  $cmd = fopen("php://stdin","r");
  $first_ch = fgets($cmd);                          //Per il momento uso la readline() perchè sembra lavorare meglio durante l'esecuzione di php
  fclose($cmd);
  */
  $first_ch = intval($first_ch);
  var_dump($first_ch);

  if ($first_ch === 1) {    //uso due uguale perchè il valore passato tramite readline é 'string' --> posso risolvere usando un cast sul valore
    // Inizializza la richiesta HTTP tramite CURL
    $handle = curl_init('http://cololoco.altervista.org/PDGT/progetto/stampa_db_vapor_json.php');
    // Richiedi la risposta HTTP come stringa
    curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
    // Esegui la richiesta HTTP
    $response = curl_exec($handle);
    // Estrai il codice di risposta (HTTP status)
    $http_code = intval(curl_getinfo($handle, CURLINFO_HTTP_CODE));

    //stampa ordinata delle info dei vaporetti
    stampa_vapor($http_code,$response);
  //TERMINE del codice eseguito con la prima scelta del menù

  } elseif ($first_ch === 2) {
    //uso due uguale perchè il valore passato tramite readline é 'string' --> posso risolvere usando un cast sul valore

    echo "\nScegliere secondo quale caratteristica effettuare la ricerca dei vaporetti:\n";
    echo "\t[1] Id vaporetto.\t[2] Percorso del vaporetto.\t[3] Id percorso del vaporetto.\n";
    $second_ch = 0;     //inizializziamo la variabile
    $second_ch = readline();    //caratteristica scelta dall'utente per il filtraggio
    $second_ch = intval($second_ch);
    echo "\n\nInserire i caratteri/numeri da ricercare:\n\t";
    $research = readline();

    //selezione dell'url a cui effettuare richiesta http
    if ($second_ch === 1) {
    $research = intval($research);
    var_dump($research);
      $handle = curl_init('http://cololoco.altervista.org/PDGT/progetto/stampa_vapor_sel_json.php?route_id='.$research);
    } elseif ($second_ch === 2){
      $handle = curl_init('http://cololoco.altervista.org/PDGT/progetto/stampa_vapor_sel_json.php?route_long_name='.$research.'%');
      var_dump($research);
    } elseif ($second_ch === 3) {
      $handle = curl_init('http://cololoco.altervista.org/PDGT/progetto/stampa_vapor_sel_json.php?route_short_name='.$research);
      var_dump($research);
    } else {
      echo "ATTENZIONE --> È stata inserita un'opzione di ricerca errata.";
    }

    // Richiedi la risposta HTTP come stringa
    curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
    // Esegui la richiesta HTTP
    $response = curl_exec($handle);
    // Estrai il codice di risposta (HTTP status)
    $http_code = intval(curl_getinfo($handle, CURLINFO_HTTP_CODE));

    //stampa ordinata delle info dei vaporetti
    stampa_vapor($http_code,$response);
  //TERMINE del codice eseguito con la seconda scelta del menù

  } elseif ($first_ch === 3) {    //uso due uguale perchè il valore passato trmite readline é 'string' --> posso risolvere usando un cast sul valore
    // Inizializza la richiesta HTTP tramite CURL
    $handle = curl_init('http://cololoco.altervista.org/PDGT/progetto/stampa_db_bus_json.php');
    // Richiedi la risposta HTTP come stringa
    curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
    // Esegui la richiesta HTTP
    $response = curl_exec($handle);
    // Estrai il codice di risposta (HTTP status)
    $http_code = intval(curl_getinfo($handle, CURLINFO_HTTP_CODE));

    //stampa ordinata delle info dei vaporetti
    stampa_bus($http_code,$response);
  //TERMINE del codice eseguito con la terza scelta del menù

  }elseif ($first_ch === 4) {       //uso due uguale perchè il valore passato tramite readline é 'string' --> posso risolvere usando un cast sul valore
    echo "\nScegliere secondo quale caratteristica effettuare la ricerca dei bus:\n";
    echo "\t[1] Id bus.\t[2] Partenza del bus.\t[3] Id percorso del bus.\n";
    $second_ch = null;     //inizializziamo la variabile
    $second_ch = readline();    //caratteristica scelta dall'utente per il filtraggio
    $second_ch = intval($second_ch);
    echo "\n\nInserire i caratteri/numeri da ricercare:\n\t";
    $research = readline();

    //selezione dell'url a cui effettuare richiesta HTTP
    if ($second_ch === 1) {
      $handle = curl_init('http://cololoco.altervista.org/PDGT/progetto/stampa_bus_sel_json.php?route_id='.$research);
    } elseif ($second_ch === 2){
      $handle = curl_init('http://cololoco.altervista.org/PDGT/progetto/stampa_bus_sel_json.php?route_long_name='.$research);
    } elseif ($second_ch === 3) {
      $handle = curl_init('http://cololoco.altervista.org/PDGT/progetto/stampa_bus_sel_json.php?route_short_name='.$research);
    } else {
      echo "ATTENZIONE --> È stata inserita un'opzione di ricerca errata.";
    }

    //richiesta della risposta HTTP come stringa
    curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
    //esecuzione della richiesta HTTP
    $response = curl_exec($handle);
    //estrazione del codice di risposta (HTTP status)
    $http_code = intval(curl_getinfo($handle, CURLINFO_HTTP_CODE));

    //stampa ordinata delle info dei vaporetti
    stampa_bus($http_code,$response);
    //TERMINE del codice eseguito con la quarta scelta del menù

  } elseif ($first_ch === 5) {
    $close_client = 0;    //impostando la variabile a 0 interrompiamo l'esecuzione del client
    echo "\n\nTerminazione corretta del client, arrivederci !\n\n";
    exit;    //terminazione del programma
  } else {
    //se viene inserito un carattere del menù differente da quelli richiesti
    echo "\n\nATTENZIONE --> È stato inserita una scelta diversa da quelle possibili.";
    var_dump($first_ch);
  }
} while ($close_client !== 0);
curl_close($handle);
echo "\n\nTerminazione corretta del client, arrivederci !\n\n";
?>
