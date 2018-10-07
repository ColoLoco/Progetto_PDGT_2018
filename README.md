# Progetto_PDGT_2018
Progetto d'esame per PDGT A.A. 2017/2018 

Studente: Giacomo Colonesi  &nbsp;&nbsp;&nbsp;&nbsp;  Matricola: 274146

<br />

# Documentazione API

<strong>stampa_db_vapor.php</strong> <br />
Usare questo "metodo" per richiedere al server la stampa completa di tutti i vaporetti presenti all'interno del database.
Non richiede parametri. Restituisce la stampa a schermo dei vaporetti.

<br /><br />

<strong>stampa_vapor_sel.php</strong> <br />
Usare questo "metodo" per effettuare una ricerca specifica nel database, andando a cercare (ed eventualmente stampare) il parametro passato nell'URL assieme alle sue informazioni più importanti. Restituisce la stampa a schermo dei vaporetti cercati.
<table>
  <tr>
    <td><b>Parametri</b></td>
    <td><b>Tipo</b></td>
    <td><b>Descrizione</b></td>
  </tr>
  <tr>
    <td>route_short_name</td>
    <td>Integer o Stringa</td>
    <td>Identificatore vaporetto da cercare secondo il suo nome di "percorso abbreviato".</td>
  </tr>
  <tr>
    <td>route_id</td>
    <td>Integer</td>
    <td>Identificatore vaporetto da cercare secondo il suo "Id".</td>
  </tr>
  <tr>
    <td>route_long_name</td>
    <td>Stringa</td>
    <td>Identificatore località di partenza del vaporetto.</td>
  </tr>
