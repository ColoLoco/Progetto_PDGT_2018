<!DOCTYPE html>
<!--- File per connettersi al database e stampare tutte le info relative ai vaporetti --->
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
      echo "<br /><br />\n<table border=\"3\" align=\"center\">\n";
      echo "<tr>\n<td><h2>Elenco completo dei vaporetti e del loro percorso su territorio veneziano.</h2></td>\n";
      echo "</table>";
    }

    $query = "SELECT * FROM VAPORETTI";    //query che andremo ad eseguire
    echo "<br /><br />\n";    //spaziatura

    if (mysqli_real_query($link, $query)) {                 //tramite questa funz. eseguiamo la query memorizz. nella variabile
      if ($result = mysqli_use_result($link)) {             //tramite questa funzione preleviamo l'ultimo risultato (della query) eseguito sul database $link
        printf("<table border=\"2\" align=\"center\">\n");
        printf("<tr>\n<td>route_id</td>\n<td>route_long_name</td>\n<td>route_short_name</td>\n");    //legenda informazioni
        while ($row = mysqli_fetch_row($result)) {          //tramite questa funzione analizziamo tutte le righe (una dopo l'altra) partendo dalla 1° fino all'ultima, fermandoci appena viene restituito 'false'
          printf("<tr>\n<td>%s</td>\n<td>%s</td>\n<td>%s</td>\n</tr>\n", $row[0], $row[3], $row[2]);    //stampiamo i tre campi del db a cui siamo interessati
        }
        printf("</table>\n");
      }
    }

    mysqli_free_result($result);    //questa funzione serve per indicare che il risultato della query non ci serve più e liberare la memoria
    mysqli_close($link);            //questa funzione termina la connessione col db
    ?>
  </body>
</html>
