<?php
/* API per la stampa dei bus filtrati secondo un criterio */

require 'config.php';    //includiamo file di configurazione
header("Content-Type: application/json; charset=UTF-8");   /* info passate tramite header per indicare la tipologia di valore
                                                              ritornato in seguito all'elaborazione del codice della pagina web */
$link = mysqli_connect(DB_SERVER , DB_USER, DB_PASSWORD, DB_DATABASE);     //connessione al db

if (!$link) {      //se la connessione non è avvenuta stampiamo un messaggio di avvertimento
  echo "Errore: Impossibile connettersi al database MySQL." . PHP_EOL;
  echo "<br />Debugging errno: " . my_sqli_errno() . PHP_EOL;
  echo "<br />Debugging error: " . my_sqli_error() . PHP_EOL;
  exit;
}

//a seconda delle informazioni passate dall'utente effettuiamo una ricerca differente
if ($_GET['route_id'] !== null) {    //se effettuiamo la ricerca secondo il route_id
  $query = "SELECT * FROM BUS WHERE route_id = ".$_GET['route_id'];    //query che andremo ad eseguire
} elseif ($_GET['route_short_name'] !== null) {    //se effettuiamo la ricerca secondo il route_short_name
  switch ($_GET['route_short_name']) {    //nel caso il parametro passato sia una delle possibili stringhe
    case 'A':
    case 'N':
    case 'B':
    case 'C':
    case 'V':
    case 'OMN':
    case 'NAV':
    case 'GSB':
    case 'GSG':
    case 'CAR':
    case 'HE':
    case '10E':
    case '11E':
    case '12E':
    case '14E':
    case '16E':
    case '17E':
    case '2E':
    case '3E':
    case '4E':
    case '5E':
    case '6E':
    case '7E':
    case '8E':
    case '8AE':
    case '9E':
    case '53E':
    case '54E':
    case '55E':
    case '55SE':
    case '56E':
    case '57E':
    case '58E':
    case '58RE':
    case '59E':
    case '60E':
    case '66E':
    case '67E':
    case '67RE':
    case '72E':
    case '73E':
    case '81E':
    case '82E':
    case '83E':
    case '12L':
    case '7L':
    case '8/':
    case '81F':
    case 'N1':
    case '4L':
    case 'T1':
    case '45H':
    case '6L':
    case '24H':
    case '34H':
    case '33H':
    case '4DE':
    case '7DE':
    case 'T2':
    case '47H':
    case '54RE':
    case '24B':
    case '31H':
    case '32H':
    case 'HE':
    case 'N3':
    case 'N4':
    case 'N5':
    case '48H':
    case '10S':
    case '9H':
      $query = "SELECT * FROM BUS WHERE route_short_name = '".$_GET['route_short_name']."'";    //query che andremo ad eseguire
      break;
    default:
      $query = "SELECT * FROM BUS WHERE route_short_name = ".$_GET['route_short_name'];    //query che andremo ad eseguire
      break;
  }
} elseif ($_GET['route_long_name'] !== null) {    //se effettuiamo la ricerca secondo il route_long_name di partenza
  $query = "SELECT * FROM BUS WHERE route_long_name like '".$_GET['route_long_name']."%'";  //query che andremo ad eseguire
} else {
  http_response_code(400);        //modifichiamo il codice di risposta di HTTP impostandolo 400
  exit;    //terminiamo l'esecuzione dello script
}

$array_data = array();    //creiamo array vuoto;
if (mysqli_real_query($link, $query)) {                  //tramite questa funz. eseguiamo la query memorizz. nella variabile
  if ($result = mysqli_use_result($link)) {              //tramite questa funzione preleviamo l'ultimo risultato (della query) eseguito sul database $link
    while ($row = mysqli_fetch_row($result)) {           //tramite questa funzione analizziamo tutte le righe (una dopo l'altra) partendo dalla 1° fino all'ultima, fermandoci appena viene restituito 'false'
      $array_data[] = array(
                  "idBus" => "$row[0]",
                  "percorsoBus" => "$row[3]",    //memorizziamo nell'array le info che ci interessano
                  "idPercorsoBus" => "$row[2]"
                );
    }
    //se l'array risulta essere vuoto
    if (count($array_data) == 0) {
      http_response_code(400);        //modifichiamo il codice di risposta di HTTP impostandolo 400
      exit;                           //terminiamo l'esecuzione dello script
    }
  }
} else {
  //risposta HTTP con errore
  http_response_code(400);        //modifichiamo il codice di risposta di HTTP impostandolo 400
  exit;                           //terminiamo l'esecuzione dello script
}

$elencoBusJson = json_encode($array_data);       //codifichiamo l'array in json per trasferimento dati tramite richiesta HTTP
mysqli_free_result($result);    //questa funzione serve per indicare che il risultato della query non ci serve più e liberare la memoria
mysqli_close($link);            //questa funzione termina la connessione col db
echo "$elencoBusJson";
?>
