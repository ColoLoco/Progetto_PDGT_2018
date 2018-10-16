<?php
/* API per la stampa di tutti i bus */

require 'config.php';    //includiamo file di configurazione
header("Content-Type: application/json; charset=UTF-8");   /* info passate tramite header per indicare la tipologia di valore
                                                              ritornato in seguito all'elaborazione del codice della pagina web */
$link = mysqli_connect(DB_SERVER , DB_USER, DB_PASSWORD, DB_DATABASE);     //connessione al db

if (!$link) {      //se la connessione non è avvenuta stampiamo un messaggio di avvertimento
  echo "Errore: Impossibile connettersi al database MySQL." . PHP_EOL;
  echo "<br />Debugging errno: " . my_sqli_errno() . PHP_EOL;
  echo "<br />Debugging error: " . my_sqli_error() . PHP_EOL;
  exit;    //terminiamo l'esec. dello script
}

$query = "SELECT * FROM BUS";    //query che andremo ad eseguire
$array_data = array();    //creiamo array vuoto;
if (mysqli_real_query($link, $query)) {                 //tramite questa funz. eseguiamo la query memorizz. nella variabile
  if ($result = mysqli_use_result($link)) {             //tramite questa funzione preleviamo l'ultimo risultato (della query) eseguito sul database $link
    while ($row = mysqli_fetch_row($result)) {          //tramite questa funzione analizziamo tutte le righe (una dopo l'altra) partendo dalla 1° fino all'ultima, fermandoci appena viene restituito 'false'
      $array_data[] = array(
                  "idBus" => "$row[0]",
                  "percorsoBus" => "$row[3]",         //memorizziamo nell'array le info che ci interessano
                  "idPercorsoBus" => "$row[2]"
                );
    }
  }
}

$elencoBusJson = json_encode($array_data);       //codifichiamo l'array in json per trasferimento dati tramite richiesta HTTP
mysqli_free_result($result);    //questa funzione serve per indicare che il risultato della query non ci serve più e liberare la memoria
mysqli_close($link);            //questa funzione termina la connessione col db
echo "$elencoBusJson";
?>
