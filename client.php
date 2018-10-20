<?php
/* File contenente il codice sorgente del client */

//includiamo file contenente le funzioni usate dal client
require 'functions.php';

//stampa info programmatore e client
echo "\n------------------------------------\n";
echo "|  Progetto PDGT  A.A. 2017/2018   |\n";
echo "|   Studente: Giacomo Colonesi     |\n";
echo "|        Matricola: 274146         |\n";
echo "|                                  |\n";
echo "| Servizio client per collegamento |\n";
echo "|    al database dei trasporti     |\n";
echo "|           veneziani              |\n";
echo "------------------------------------\n\n";

$close_client = 1;    //impostiamo variabile di controllo ciclo do-while del menù

//entriamo nel menù
do {
  echo "\n\nSelezionare la richiesta da eseguire al database: \n";
  echo "\t[1] Stampa completa dei vaporetti.\n";
  echo "\t[2] Stampa dei vaporetti filtrati secondo una caratteristica.\n";
  echo "\t[3] Stampa completa dei bus.\n";
  echo "\t[4] Stampa dei bus filtrati secondo una caratteristica.\n";
  echo "\t[5] Stampa informazioni meteo in tempo reale.\n\n";
  echo "\t[6] Chiusura del client.\n\n";

  $first_ch = readline();    //acquisizione scelta dell'utente
  $first_ch = intval($first_ch);

  if ($first_ch === 1) {
    //inizializzazione richiesta HTTP tramite CURL
    $handle = curl_init('http://cololoco.altervista.org/PDGT/progetto/stampa_db_vapor_json.php');
    //richiesta della risposta HTTP come stringa
    curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
    //esecuzione della richiesta HTTP
    $response = curl_exec($handle);
    //estrazione del codice di risposta (HTTP status)
    $http_code = intval(curl_getinfo($handle, CURLINFO_HTTP_CODE));

    //stampa ordinata delle info dei vaporetti
    stampa_vapor($http_code,$response);
  //TERMINE del codice eseguito con la prima scelta del menù
  } elseif ($first_ch === 2) {
    //ciclo per assicurarsi una corretta scelta da parte dell'utente
    do {
      echo "\nScegliere secondo quale caratteristica effettuare la ricerca dei vaporetti:\n";
      echo "\t[1] Id vaporetto.\t[2] Partenza del vaporetto.\t[3] Id percorso del vaporetto.\n";
      $second_ch = null;     //inizializziamo la variabile
      $second_ch = readline();    //caratteristica scelta dall'utente per il filtraggio
      $second_ch = intval($second_ch);
      if ((($second_ch !== 1) && ($second_ch !== 2) && ($second_ch !== 3))) {
        echo "\n\nATTENZIONE --> È stato inserito un valore non ammesso!\n\n";
      }
    } while (($second_ch !== 1) && ($second_ch !== 2) && ($second_ch !== 3));   //end do-while di controllo

    echo "\n\nInserire i caratteri/numeri da ricercare:\n";
    $research = readline();    //acquisizione caratteri da filtrare
    //selezione dell'url a cui effettuare richiesta HTTP
    if ($second_ch === 1) {
      $research = intval($research);
      $handle = curl_init('http://cololoco.altervista.org/PDGT/progetto/stampa_vapor_sel_json.php?route_id='.$research);
    } elseif ($second_ch === 2){
      $handle = curl_init('http://cololoco.altervista.org/PDGT/progetto/stampa_vapor_sel_json.php?route_long_name='.$research);
    } elseif ($second_ch === 3) {
      $handle = curl_init('http://cololoco.altervista.org/PDGT/progetto/stampa_vapor_sel_json.php?route_short_name='.$research);
    } else {
      echo "ATTENZIONE --> È stata inserita un'opzione di ricerca errata." . PHP_EOL;
    }

    //settaggio della risposta HTTP come stringa
    curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
    //esecuzione della richiesta HTTP
    $response = curl_exec($handle);
    //estrazione del codice di risposta (HTTP status)
    $http_code = intval(curl_getinfo($handle, CURLINFO_HTTP_CODE));

    //stampa ordinata delle info dei vaporetti
    stampa_vapor($http_code,$response);
  //TERMINE del codice eseguito con la seconda scelta del menù
  } elseif ($first_ch === 3) {
    //inizializzazione richiesta HTTP tramite CURL
    $handle = curl_init('http://cololoco.altervista.org/PDGT/progetto/stampa_db_bus_json.php');
    //richiesta della risposta HTTP come stringa
    curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
    //esecuzione della richiesta HTTP
    $response = curl_exec($handle);
    //estrazione del codice di risposta (HTTP status)
    $http_code = intval(curl_getinfo($handle, CURLINFO_HTTP_CODE));

    //stampa ordinata delle info dei vaporetti
    stampa_bus($http_code,$response);
  //TERMINE del codice eseguito con la terza scelta del menù
  } elseif ($first_ch === 4) {
    //ciclo per assicurarsi una corretta scelta da parte dell'utente
    do {
      echo "\nScegliere secondo quale caratteristica effettuare la ricerca dei bus:\n";
      echo "\t[1] Id bus.\t[2] Partenza del bus.\t[3] Id percorso del bus.\n";
      $second_ch = null;     //inizializziamo la variabile
      $second_ch = readline();    //caratteristica scelta dall'utente per il filtraggio
      $second_ch = intval($second_ch);
      if ((($second_ch !== 1) && ($second_ch !== 2) && ($second_ch !== 3))) {
        echo "\n\nATTENZIONE --> È stato inserito un valore non ammesso.\n\n";
      }
    } while (($second_ch !== 1) && ($second_ch !== 2) && ($second_ch !== 3));   //end do-while di controllo
    echo "\n\nInserire i caratteri/numeri da ricercare:\n";
    $research = readline();

    //selezione dell'url a cui effettuare richiesta HTTP
    if ($second_ch === 1) {
      $handle = curl_init('http://cololoco.altervista.org/PDGT/progetto/stampa_bus_sel_json.php?route_id='.$research);
    } elseif ($second_ch === 2){
      $handle = curl_init('http://cololoco.altervista.org/PDGT/progetto/stampa_bus_sel_json.php?route_long_name='.$research);
    } elseif ($second_ch === 3) {
      $handle = curl_init('http://cololoco.altervista.org/PDGT/progetto/stampa_bus_sel_json.php?route_short_name='.$research);
    } else {
      echo "ATTENZIONE --> È stata inserita un'opzione di ricerca errata." . PHP_EOL;
    }

    //settaggio della risposta HTTP come stringa
    curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
    //esecuzione della richiesta HTTP
    $response = curl_exec($handle);
    //estrazione del codice di risposta (HTTP status)
    $http_code = intval(curl_getinfo($handle, CURLINFO_HTTP_CODE));

    //stampa ordinata delle info dei vaporetti
    stampa_bus($http_code,$response);
  //TERMINE del codice eseguito con la quarta scelta del menù
  } elseif ($first_ch === 5) {
    //stampa a schermo delle informazioni meteo veneziane
    stampa_meteo();
  //TERMINE del codice eseguito con la quinta scelta del menù
  } elseif ($first_ch === 6) {
    $close_client = 0;    //impostando la variabile a 0 interrompiamo l'esecuzione del client
    echo "\n\nTerminazione corretta del client, arrivederci !\n\n";
    exit;    //terminazione del programma
  //TERMINE del codice eseguito con la sesta scelta del menù
  } else {
    //se viene inserito un carattere del menù differente da quelli richiesti
    echo "\n\nATTENZIONE --> È stato inserito un valore diverso da quelli previsti." . PHP_EOL;
  }
} while ($close_client !== 0);    //end do-while

//chiusura della sessione CURL
curl_close($handle);
?>
