<?php
/* File contenente le varie funzioni usate dal client */

/* funzione per la stampa a schermo indentata delle info relative ai vaporetti */
function stampa_vapor($http_code, $response){
  if($http_code == 200) {
    //risposta HTTP ok
    $data = json_decode($response, true);

    //se è ritornata qualche info dalla richiesta HTTP
    if (count($data) != 0) {
      //stampa info vaporetti
      echo "\n\n-------------------------------------------------------------------------------------------------\n";
      echo "| Id vaporetto  |\t\tPercorso vaporetto\t\t\t| Id percorso vaporetto |";
      echo "\n-------------------------------------------------------------------------------------------------\n";
      foreach ($data as $info) {
        // stampa 'idVaporetto'
        printf("|\t%s\t|", $info['idVaporetto']);

        //stampa 'percorsoVaporetto'
        if ((strlen($info['percorsoVaporetto']) <= 53) && (strlen($info['percorsoVaporetto']) > 45)) {
          printf(" %s\t|", $info['percorsoVaporetto']);
          } elseif ((strlen($info['percorsoVaporetto']) <= 45) && (strlen($info['percorsoVaporetto']) > 37)){
              printf(" %s\t\t|", $info['percorsoVaporetto']);
          } elseif (((strlen($info['percorsoVaporetto']) <= 37) && (strlen($info['percorsoVaporetto']) > 29))) {
              printf(" %s\t\t\t|", $info['percorsoVaporetto']);
          } elseif ((strlen($info['percorsoVaporetto']) <= 29)) {
              printf(" %s\t\t\t\t|", $info['percorsoVaporetto']);
          }

        //stampa 'idPercorsoVaporetto'
        printf("\t%s\t\t|", $info['idPercorsoVaporetto']);
        echo "\n-------------------------------------------------------------------------------------------------\n";
      }   // end foreach
    } else {
        //se non sono ritornate info dalla richiesta HTTP stampiamo un messaggio di avviso
        echo "\nATTENZIONE --> L'informazione cercata non ha prodotto risultati.\n";
    }    //end if-else interno
  } else {
      //qualche errore
      echo "\nQualcosa non ha funzionato! #{$http_code}" . PHP_EOL;
  }    //end if-else esterno
}    //end function


/* funzione per la stampa a schermo indentata delle info relative ai bus */
function stampa_bus($http_code, $response){
  if ($http_code == 200) {
     //risposta HTTP ok
     $data = json_decode($response, true);
     
     //se è ritornata qualche info dalla richiesta HTTP
     if (count($data) != 0) {
       //stampa info bus
       echo "\n\n-------------------------------------------------------------------------------------------\n";
       echo "|    Id bus\t|\t\t\tPercorso bus\t\t\t| Id percorso bus |\n";
       echo "-------------------------------------------------------------------------------------------\n";
       foreach ($data as $info) {
          // stampa 'idBus'
          printf("|\t%s\t|", $info['idBus']);

          //stampa 'percorsoBus'
          if ((strlen($info['percorsoBus']) <= 53) && (strlen($info['percorsoBus']) > 45)){
              printf(" %s\t|", $info['percorsoBus']);
          } elseif ((strlen($info['percorsoBus']) <= 45) && (strlen($info['percorsoBus']) > 37)) {
              printf(" %s\t\t|", $info['percorsoBus']);
          } elseif ((strlen($info['percorsoBus']) <= 37) && (strlen($info['percorsoBus']) > 29)) {
              printf(" %s\t\t\t|", $info['percorsoBus']);
          } elseif ((strlen($info['percorsoBus']) <= 29) && (strlen($info['percorsoBus']) > 21)){
              printf(" %s\t\t\t\t|", $info['percorsoBus']);
          } elseif (((strlen($info['percorsoBus']) <= 21) && (strlen($info['percorsoBus']) > 13))) {
              printf(" %s\t\t\t\t\t|", $info['percorsoBus']);
          } elseif ((strlen($info['percorsoBus']) <= 13)) {
              printf(" %s\t\t\t\t\t\t|", $info['percorsoBus']);
          } else {
            printf(" %s |", $info['percorsoBus']);
          }

          //stampa 'idPercorsoBus'
          printf("\t%s\t  |", $info['idPercorsoBus']);
          echo "\n-------------------------------------------------------------------------------------------\n";
       }    //end foreach
    } else {
        //se non sono ritornate info dalla richiesta HTTP stampiamo un messaggio di avviso
        echo "\nATTENZIONE --> L'informazione cercata non ha prodotto risultati.\n";
    }    //end if-else interno
  } else {
      //qualche errore
      echo "Qualcosa non ha funzionato! #{$http_code}" . PHP_EOL;
  }    //end if-else esterno
}    //end function


/* funzione per la stampa del giorno corrente e della situazione meteo a Venezia */
function stampa_meteo(){
  //memorizziamo l'url a cui effettuare la richiesta HTTP
  $url = 'http://cololoco.altervista.org/PDGT/progetto/meteo.php';
  $handle = curl_init($url);

  //richiesta della risposta HTTP come stringa
  curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
  //esecuzione della richiesta HTTP
  $response = curl_exec($handle);
  //estrazione del codice di risposta (HTTP status)
  $http_code = intval(curl_getinfo($handle, CURLINFO_HTTP_CODE));

  //se risposta HTTP ok
  if($http_code == 200) {
    //stampa del messaggio contenente le info di meteo ed ora corrente
    echo "\n\n-------------------------------------------------------------------------------\n";
    echo "  $response";
    echo "-------------------------------------------------------------------------------\n";
  } else {
      //se avviene qualche errore
      echo "Qualcosa riguardante la richiesta meteo non ha funzionato! #{$http_code}" . PHP_EOL;
  }
  //chiusura della sessione CURL del meteo
  curl_close($handle);
}    //end function
?>
