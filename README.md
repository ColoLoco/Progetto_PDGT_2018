# Progetto_PDGT_2018
Progetto d'esame per PDGT A.A. 2017/2018 

Studente: Giacomo Colonesi  &nbsp;&nbsp;&nbsp;&nbsp;  Matricola: 274146

<br />

# Documentazione API

<strong>stampa_db_vapor_json.php</strong> <br />
Usare questa API per richiedere al server la visualizzazione completa di tutti i vaporetti presenti all'interno del database.
Non richiede parametri. Se la richiesta HTTP ha successo restituisce la lista dei vaporetti in formato JSON, altrimenti ritorna lo stato HTTP #400.
<br /><br /><i>Esempio di lista in JSON restituita:</i><br /><br />
[<br />
 &nbsp;&nbsp;&nbsp;{<br />
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"idVaporetto":"10",<br />
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"percorsoVaporetto":"Lido (S.M.E.) \"D\" - P.le Roma (S. Chiara) \"G\"",<br />
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"idPercorsoVaporetto":"1"<br />
 &nbsp;&nbsp;&nbsp;},<br />
 &nbsp;&nbsp;&nbsp;{<br />
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"idVaporetto":"11",<br />
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"percorsoVaporetto":"Lido (S.M.E.) \"D\" - P.le Roma (S. Chiara) \"G\"",<br />
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"idPercorsoVaporetto":"1"<br />
 &nbsp;&nbsp;&nbsp;},<br />
 &nbsp;&nbsp;&nbsp;{<br />
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"idVaporetto":"12",<br />
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"percorsoVaporetto":"Lido (S.M.E.) \"D\" - P.le Roma (S. Chiara) \"G\"",<br />
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"idPercorsoVaporetto":"1"<br />
 &nbsp;&nbsp;&nbsp;}<br />
]<br />

<br /><br />

<strong>stampa_vapor_sel_json.php</strong> <br />
Usare questa API per effettuare una ricerca specifica nel database, andando a cercare l'unico parametro passato nella query. Se la richiesta HTTP ha successo restituisce la lista dei vaporetti trovati in formato JSON, altrimenti ritorna lo stato HTTP #400.
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

<br /><i>Esempio di URL valido, completo di query:</i><br />
http://cololoco.altervista.org/PDGT/progetto/stampa_vapor_sel_json.php?route_id=100

<br /><br />

<strong>stampa_db_bus_json.php</strong> <br />
Usare questa API per richiedere al server la visualizzazione completa di tutti i bus presenti all'interno del database.
Non richiede parametri. Se la richiesta HTTP ha successo restituisce la lista completa dei bus in formato JSON, altrimenti ritorna lo stato HTTP #400.
<br /><br /><i>Esempio di lista in JSON restituita:</i><br /><br />
[<br />
 &nbsp;&nbsp;&nbsp;{<br />
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"idBus":"53",<br />
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"percorsoBus":"Scuole - Scorze'",<br />
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"idPercorsoBus":"11E"<br />
 &nbsp;&nbsp;&nbsp;},<br />
 &nbsp;&nbsp;&nbsp;{<br />
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"idBus":"54",<br />
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"percorsoBus":"Scuole - Municipio",<br />
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"idPercorsoBus":"11E"<br />
 &nbsp;&nbsp;&nbsp;},<br />
 &nbsp;&nbsp;&nbsp;{<br />
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"idBus":"55",<br />
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"percorsoBus":"Scuole - Cavalieri Vittorio Veneto",<br />
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"idPercorsoBus":"11E"<br />
 &nbsp;&nbsp;&nbsp;}<br />
]<br />

<br /><br />

<strong>stampa_bus_sel_json.php</strong> <br />
Usare questa API per effettuare una ricerca specifica nel database, andando a cercare l'unico parametro passato nella query. Se la richiesta HTTP ha successo restituisce la lista dei bus trovati in formato JSON, altrimenti ritorna lo stato HTTP #400.
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

<br /><i>Esempio di URL valido, completo di query:</i><br />
http://cololoco.altervista.org/PDGT/progetto/stampa_bus_sel_json.php?route_long_name=DE

<br /><br />

<strong>meteo.php</strong> <br />
Tramite questa API vengono raccolte le info riguardanti il meteo di Venezia, prese direttamente dal sito "openweathermap.org".
Non richiede parametri. Se la richiesta HTTP ha successo restituisce una stringa di testo contenente le previsioni meteo, la data e l'ora corrente, altrimenti ritorna lo stato HTTP #400.

<br /><i>Esempio di URL valido:</i><br />
http://cololoco.altervista.org/PDGT/progetto/meteo.php

<br /><br /><br />


# Documentazione CLIENT

Il client, sviluppato per interagire con le API, è scritto in linguaggio PHP ed è stato ottimizzato per un'esecuzione da CLI. <br />
Una volta aperto da riga di comando, il programma stampa a video un breve messaggio di introduzione (info programmatore e info del client) seguito da un menù di selezione riguardante le varie funzioni messe a disposizione dal client, ognuna delle quali selezionabile inserendo il numero che le precede ed identifica, seguito dal tasto 'invio'. <br />
Selezionando le opzioni '1' e '3' viene stampata a schermo la lista completa dei vaporetti o degli autobus, rispettivamente, le cui informazioni vengono prelevate tramite richiesta HTTP alle due API 'stampa_db_vapor_json.php' e 'stampa_db_bus_json.php'. <br />
Premendo invece il pulsante '2' o '4' si entra in un secondo menù, dove poter scegliere secondo quale tra i 3 possibili criteri effettuare la ricerca nel database. Il primo criterio cerca il cod. ID del mezzo di trasporto, il secondo la location di partenza ed il terzo il cod. ID del percorso svolto dal veicolo. Una volta scelto un criterio ed inserita la stringa secondo cui fare il confronto, il client stampa a schermo le informazioni avute in risposta dall'API 'stampa_vapor_sel_json.php' e 'stampa_bus_sel_json.php'. <br />
Tramite l'opzione '5' del menù viene eseguita una richiesta HTTP all'API 'meteo.php', il cui messaggio di ritorno contenente le informazioni meteo in tempo reale è stampato a schermo dal client. <br />
L'utente può effettuare tutte le interrogazioni che vuole con il client, una volta trovata l'informazione che stava cercando gli basterà inserire il numero '6' dal menù principale per terminare l'esecuzione di quest'ultimo; confermata da un opportuno messaggio.

<br /><br /><br />

# OpenAPI specification
Il file "OpenAPI_specification.yaml" è stato scritto secondo le specifiche di OpenAPI 3.0 e di Swagger 2.0.<br />
Importando il file nell'editor di testo offerto da Swagger si ha l'opportunità di poter osservare più intuitivamente il comportamento delle API, con quali informazioni interagiscono e quali metodi HTTP sfruttano per le loro richieste.
