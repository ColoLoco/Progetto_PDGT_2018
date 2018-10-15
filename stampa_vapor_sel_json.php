<?php
require 'config.php';    //file di configurazione
header("Content-Type: application/json; charset=UTF-8");   /* info passate tramite header per indicare la tipologia di valore
                                                              ritornato in seguito all'elaborazione del codice della pagina web */
$link = mysqli_connect(DB_SERVER , DB_USER, DB_PASSWORD, DB_DATABASE);     //connessione al db

if (!$link) {      //se la connessione non è avvenuta stampiamo un messaggio di avvertimento
  echo "Errore: Impossibile connettersi al database MySQL." . PHP_EOL;
  echo "<br />Debugging errno: " . my_sqli_errno() . PHP_EOL;
  echo "<br />Debugging error: " . my_sqli_error() . PHP_EOL;
  exit;
}

if ($_GET['route_id'] !== null) {    //se effettuiamo la ricerca secondo il route_id
  $query = "SELECT * FROM VAPORETTI WHERE route_id = ".$_GET['route_id'];    //query che andremo ad eseguire
}elseif ($_GET['route_short_name'] !== null) {    //se effettuiamo la ricerca secondo il route_short_name
  switch ($_GET['route_short_name']) {
    case 'BLU':
    case 'N':
    case 'DE':    //nel caso il parametro passato sia una delle possibili stringhe
    case 'NMU':
    case 'NLN':
      $query = "SELECT * FROM VAPORETTI WHERE route_short_name = '".$_GET['route_short_name']."'";    //query che andremo ad eseguire
      break;
    default:
      $query = "SELECT * FROM VAPORETTI WHERE route_short_name = ".$_GET['route_short_name'];    //query che andremo ad eseguire
      break;
  }
}elseif ($_GET['route_long_name'] !== null) {    ////se effettuiamo la ricerca secondo il route_long_name di partenza
  $query = "SELECT * FROM VAPORETTI WHERE route_long_name like '".$_GET['route_long_name']."%'";  //query che andremo ad eseguire
}else{
  echo "\n\n";    //spaziatura
  echo "Attenzione ---> Non è stato passato alcun parametro alla query. (file server)";    //ATTENZIONE rimuovere (file server) a progetto finito
  exit;  //terminiamo l'esec. di php
}

echo "\n". PHP_EOL;    //spaziatura
$n = 0;    //contatore ciclo while
$array_data = array();    //creiamo array vuoto;
if (mysqli_real_query($link, $query)) {                  //tramite questa funz. eseguiamo la query memorizz. nella variabile
  if ($result = mysqli_use_result($link)) {              //tramite questa funzione preleviamo l'ultimo risultato (della query) eseguito sul database $link
    while ($row = mysqli_fetch_row($result)) {           //tramite questa funzione analizziamo tutte le righe (una dopo l'altra) partendo dalla 1° fino all'ultima, fermandoci appena viene restituito 'false'
        $array_data[$n] = array(
                    "idVaporetto" => "$row[0]",
                    "percorsoVaporetto" => "$row[3]",    //memorizziamo nell'array le info che ci interessano
                    "idPercorsoVaporetto" => "$row[2]"
                  );
        $n += 1;
    }
  }
} else {
  echo "ATTENZIONE ---> L'esecuzione della query non è andata a buon fine.";    //messaggio di controllo query non eseguita
}

$elencoVaporJson = json_encode($array_data);       //codifichiamo l'array in json per trasferimento dati tramite richiesta http
mysqli_free_result($result);    //questa funzione serve per indicare che il risultato della query non ci serve più e liberare la memoria
mysqli_close($link);            //questa funzione termina la connessione col db
echo "$elencoVaporJson";
?>
