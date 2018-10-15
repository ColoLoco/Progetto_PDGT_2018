<?php
/*
file contenente le varie funzioni usate dal client
*/

/* funzione per la corretta stampa a schermo delle info relative ai vaporetti */
function stampa_vapor($http_code,$response){
  if($http_code == 200) {
      // Risposta OK
      $data = json_decode($response, true);
      echo "\n\n-------------------------------------------------------------------------------------------------\n";
      echo "| Id vaporetto  |\t\tPercorso vaporetto\t\t\t| Id percorso vaporetto |";
      echo "\n-------------------------------------------------------------------------------------------------\n";

      foreach ($data as $info) {
        // stampa 'idVaporetto'
        printf("|\t%s\t|", $info['idVaporetto']);

        //stampa 'percorsoVaporetto'
        if ((strlen($info['percorsoVaporetto']) <= 53) && (strlen($info['percorsoVaporetto']) > 45)) {
          printf(" %s\t|", $info['percorsoVaporetto']);
        }elseif ((strlen($info['percorsoVaporetto']) <= 45) && (strlen($info['percorsoVaporetto']) > 37)){
          printf(" %s\t\t|", $info['percorsoVaporetto']);
        }elseif (((strlen($info['percorsoVaporetto']) <= 37) && (strlen($info['percorsoVaporetto']) > 29))) {
          printf(" %s\t\t\t|", $info['percorsoVaporetto']);
        }elseif ((strlen($info['percorsoVaporetto']) <= 29)) {
          printf(" %s\t\t\t\t|", $info['percorsoVaporetto']);
        }

        //stampa 'idPercorsoVaporetto'
        printf(" %s\t\t\t|", $info['idPercorsoVaporetto']);
        echo "\n-------------------------------------------------------------------------------------------------\n";
      }   // end foreach
  } else {
      // Qualche errore
      echo "Qualcosa non ha funzionato! #{$http_code}" . PHP_EOL;
  }    //end if-else
}    //end function


/* funzione per la corretta stampa a schermo delle info relative ai bus */
function stampa_bus($http_code,$response){
  if($http_code == 200) {
      // Risposta OK
      $data = json_decode($response, true);
      echo "\n\n------------------------------------------------------------------------------------------\n";
      echo "|    Id bus\t|\t\t\tPercorso bus\t\t\t| Id percorso bus|\n";
      echo "------------------------------------------------------------------------------------------\n";

      foreach ($data as $info) {
        // stampa 'idBus'
        printf("|\t%s\t|", $info['idBus']);

        //stampa 'percorsoBus'
        if ((strlen($info['percorsoBus']) <= 53) && (strlen($info['percorsoBus']) > 45)){
          printf(" %s\t|", $info['percorsoBus']);
        }elseif ((strlen($info['percorsoBus']) <= 45) && (strlen($info['percorsoBus']) > 37)) {
          printf(" %s\t\t|", $info['percorsoBus']);
        }elseif ((strlen($info['percorsoBus']) <= 37) && (strlen($info['percorsoBus']) > 29)) {
          printf(" %s\t\t\t|", $info['percorsoBus']);
        }elseif ((strlen($info['percorsoBus']) <= 29) && (strlen($info['percorsoBus']) > 21)){
          printf(" %s\t\t\t\t|", $info['percorsoBus']);
        }elseif (((strlen($info['percorsoBus']) <= 21) && (strlen($info['percorsoBus']) > 13))) {
          printf(" %s\t\t\t\t\t|", $info['percorsoBus']);
        }elseif ((strlen($info['percorsoBus']) <= 13)) {
          printf(" %s\t\t\t\t\t\t|", $info['percorsoBus']);
        }

        //stampa 'idPercorsoBus'
        printf(" %s\t\t |", $info['idPercorsoBus']);
        echo "\n------------------------------------------------------------------------------------------\n";
      }    //end foreach
  }else{
      // Qualche errore
      echo "Qualcosa non ha funzionato! #{$http_code}" . PHP_EOL;
  }    //end if-else
}    //end function
?>
