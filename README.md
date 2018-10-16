# Progetto_PDGT_2018
Progetto d'esame per PDGT A.A. 2017/2018 

Studente: Giacomo Colonesi  &nbsp;&nbsp;&nbsp;&nbsp;  Matricola: 274146

<br />

# Documentazione API

<strong>stampa_db_vapor_json.php</strong> <br />
Usare questo "metodo" per richiedere al server la visualizzazione completa di tutti i vaporetti presenti all'interno del database.
Non richiede parametri. Restituisce la lista dei vaporetti in formato JSON.

<br /><br />

<strong>stampa_vapor_sel_json.php</strong> <br />
Usare questo "metodo" per effettuare una ricerca specifica nel database, andando a cercare il parametro passato nell'URL all'interno del database. Se la ricerca è positiva restituisce la lista dei vaporetti trovati in formato JSON.
<table>
  <tr>
    <td><b>Parametri</b></td>
    <td><b>Tipo</b></td>
    <td><b>Descrizione</b></td>
  </tr>
  <tr>
    <td>route_short_name</td>
    <td>Integer o Stringa</td>
    <td>Identificatore vaporetto da cercare secondo il suo ID del percorso.</td>
  </tr>
  <tr>
    <td>route_id</td>
    <td>Integer</td>
    <td>Identificatore vaporetto da cercare secondo il suo ID.</td>
  </tr>
  <tr>
    <td>route_long_name</td>
    <td>Stringa</td>
    <td>Identificatore località di partenza del vaporetto.</td>
  </tr>
</table>

<br /><br />

<strong>stampa_db_bus_json.php</strong> <br />
Usare questo "metodo" per richiedere al server la visualizzazione completa di tutti i bus presenti all'interno del database.
Non richiede parametri. Restituisce la lista completa dei bus in formato JSON.

<br /><br />

<strong>stampa_bus_sel_json.php</strong> <br />
Usare questo "metodo" per effettuare una ricerca specifica nel database, andando a cercare il parametro passato nell'URL all'interno del database. Se la ricerca è positiva restituisce la lista dei bus trovati in formato JSON.
<table>
  <tr>
    <td><b>Parametri</b></td>
    <td><b>Tipo</b></td>
    <td><b>Descrizione</b></td>
  </tr>
  <tr>
    <td>route_short_name</td>
    <td>Integer o Stringa</td>
    <td>Identificatore bus da cercare secondo il suo ID del percorso.</td>
  </tr>
  <tr>
    <td>route_id</td>
    <td>Integer</td>
    <td>Identificatore bus da cercare secondo il suo ID.</td>
  </tr>
  <tr>
    <td>route_long_name</td>
    <td>Stringa</td>
    <td>Identificatore località di partenza del bus.</td>
  </tr>
</table>


<br /><br />

<strong>meteo.php</strong> <br />
Tramite questo "metodo" vengono raccolte le info riguardanti il meteo di Venezia, prese direttamente dal sito "openweathermap.org".
Non richiede parametri. Restituisce una stringa di testo contenente le previsioni meteo, la data e l'ora corrente.

<br /><br /><br />


# Documentazione CLIENT

Il client sviluppato per interagire con le API è in formato .php e sfrutta alcune funzioni presenti dalla versione 7.0 del linguaggio, inoltre è stato ottimizzato per un'esecuzione da CLI. <br />
Una volta aperto da riga di comando, il programma stampa a video un breve messaggio di introduzione (info programmatore e info del client) seguito da un menù di selezione riguardante le varie funzioni messe a disposizione dal client, ognuna delle quali selezionabile inserendo il numero che le precede ed identifica, seguito dal tasto 'invio'. <br />
Selezionando le opzioni '1' e '3' viene stampata a schermo la lista completa dei vaporetti o degli autobus, rispettivamente, le cui informazioni sono prelevate tramite richiesta HTTP alle due API 'stampa_db_vapor_json.php' e 'stampa_db_bus_json.php'. <br />
Premendo invece il pulsante '2' o '4' si entra in un secondo menù, dove poter scegliere secondo quale tra i 3 possibili criteri effettuare la ricerca nel database. Il primo criterio cerca il cod. ID del mezzo di trasporto, il secondo la location di partenza ed il terzo il cod. ID del percorso svolto dal veicolo. Una volta scelto un criterio ed inserita la stringa secondo cui fare il confronto, il client stampa a schermo le informazioni avute in risposta dall'API 'stampa_vapor_sel_json.php' e 'stampa_bus_sel_json.php'. <br />
Tramite l'opzione '5' del menù viene eseguita una richiesta HTTP all'API 'meteo.php', il cui messaggio di ritorno contenente le informazioni meteo in tempo reale è stampato a schermo dal client. <br />
L'utente può effettuare tutte le interrogazioni che vuole con il client, una volta trovata l'informazione che stava cercando gli basterà inserire il numero '6' dal menù principale per terminare l'esecuzione di quest'ultimo; confermata da un opportuno messaggio.
