<!DOCTYPE html>
<!--- File per stampare tutte le info relative ai bus ricercati dall'utente --->
<html>
  <head>
    <title><?php echo "Progetto PDGT 2018"; ?></title>
  </head>
  <body>
    <?php
    require 'config.php';  //file di configurazione
    $link = mysqli_connect(DB_SERVER , DB_USER, DB_PASSWORD, DB_DATABASE);     //connessione al db

    if (!$link) {      //se la connessione non è avvenuta stampiamo un messaggio di avvertimento
      echo "Errore: Impossibile connettersi al database MySQL." . PHP_EOL;
      echo "<br />Debugging errno: " . my_sqli_errno() . PHP_EOL;
      echo "<br />Debugging error: " . my_sqli_error() . PHP_EOL;
      exit;
    } else {     //se la connessione è avvenuta stampiamo un messaggio di successo
      echo "<br /><br />\n<table border=\"5\" align=\"center\">\n". PHP_EOL;
      echo "<tr>\n<td><h2>Lista dei bus ricercati dall'utente che lavorano su territorio veneziano.</h2></td>\n". PHP_EOL;
      echo "</table>". PHP_EOL;
    }

    /*
    A seconda delle informazioni passate dall'utente effettuiamo una ricerca differente
    */

    if ($_GET['route_id'] !== null) {    //se effettuiamo la ricerca secondo il route_id
      $query = "SELECT * FROM BUS WHERE route_id = ".$_GET['route_id'];    //query che andremo ad eseguire
    }elseif ($_GET['route_short_name'] !== null) {    //se effettuiamo la ricerca secondo il route_short_name
      switch ($_GET['route_short_name']) {
        case 'A':
        case 'N':
        case 'B':                  //nel caso il parametro passato sia una delle possibili stringhe
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
    }elseif ($_GET['route_long_name'] !== null) {    ////se effettuiamo la ricerca secondo il route_long_name di partenza
      $query = "SELECT * FROM BUS WHERE route_long_name like '".$_GET['route_long_name']."%'";  //query che andremo ad eseguire
    }else {
      echo "<br /><br />\n". PHP_EOL;    //spaziatura
      echo "<div align=center><big><strong>Attenzione ---> Non è stato passato alcun parametro alla query.</strong></big></div>";
      exit;  //forse ci va un altro comando per terminare l'esec. di php
    }

    echo "<br /><br />\n". PHP_EOL;    //spaziatura
    $count = 0;    //contatore righe informazioni stampate
    if (mysqli_real_query($link, $query)) {                 //tramite questa funz. eseguiamo la query memorizz. nella variabile
      if ($result = mysqli_use_result($link)) {             //tramite questa funzione preleviamo l'ultimo risultato (della query) eseguito sul database $link
        printf("<table border=\"2\" align=\"center\">\n");
        printf("<tr>\n<td>route_id</td>\n<td>route_long_name</td>\n<td>route_short_name</td>\n");    //legenda informazioni
        while ($row = mysqli_fetch_row($result)) {          //tramite questa funzione analizziamo tutte le righe (una dopo l'altra) partendo dalla 1° fino all'ultima, fermandoci appena viene restituito 'false'
          printf("<tr>\n<td>%s</td>\n<td>%s</td>\n<td>%s</td>\n</tr>\n", $row[0], $row[3], $row[2]);    //stampiamo i tre campi del db a cui siamo interessati
          $count += 1;
        }
        printf("</table>\n");
        if ($count === 0) {    //se non viene stampato alcun vaporetto con il parametro immesso dall'utente
          echo "<br /><br />\n". PHP_EOL;    //spaziatura
          echo "<div align=center><big><strong>ATTENZIONE ---> Il parametro che si è cercato non è presente nel database.</strong></big></div>";
        }
      }
    } else {
      echo "<div align=center><big><strong>ATTENZIONE ---> L'esecuzione della query non è andata a buon fine.</strong></big></div>";    //messaggio di controllo query non eseguita
    }

    mysqli_free_result($result);    //questa funzione serve per indicare che il risultato della query non ci serve più e per liberare la memoria
    mysqli_close($link);            //questa funzione termina la connessione col db
    ?>
  </body>
</html>
