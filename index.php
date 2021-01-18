<html>
<head>
<title>Lorenzo's Blog</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<h1 style="text-align:center;">Lorenzo's Blog</h1>
<div class="container cyan brackets">
  <a href="index.php">HOME</a>
  <a>ARTICOLI</a>
</div>
<?
// includiamo il file di configurazione
@include "config.php";

// includiamo la pagina contenente il codice per la creazione delle anteprime
@require "anteprima.php";

// estraiamo i dati relativi agli articoli dalla tabella
$sql = "SELECT * FROM articoli ORDER BY art_data DESC";
$query = @mysqli_query($db, $sql) or die (mysqli_error($db));

//verifichiamo che siano presenti records
if(mysqli_num_rows($query) > 0){
  // se la tabella contiene records mostriamo tutti gli articoli attraverso un ciclo
  while($row = mysqli_fetch_array($query)){
    $art_id = $row['art_id'];
    $autore = stripslashes($row['art_autore']);
    $titolo = stripslashes($row['art_titolo']);
    $data = $row['art_data'];
    $articolo = stripslashes($row['art_articolo']);
   
    //valorizziamo una variabili con il link all'intero articolo
    $link = " ..<br><a href=\"articolo.php?id=$art_id\">Leggi tutto</a>";

    echo "<h2>".$titolo."</h2>";
   
    // creaimo l'anteprima che mostra le prime 30 parole di ogni singolo articolo
    // per farlo utilizzo una funzione che vi presenterò più avanti
    echo @anteprima($articolo, 30, $link); 
    echo "<br><br>";
   
    // formattiamo la data nel formato europeo
    $data = preg_replace('/^(.{4})-(.{2})-(.{2})$/','$3-$2-$1', $data);

    // stampiamo una serie di informazioni
    echo  "Scritto da <b>". $autore . "</b>";
    echo  "| Articolo postato il <b>" . $data . "</b>";
    echo  "| Commenti: "; 
  
    // mostriamo il numero di commenti relativi ad ogni articolo
    $conta = "SELECT COUNT(com_id) as conta from commenti WHERE com_art = '$art_id'";
    $conto = @mysqli_query ($db, $conta);
    $tot = @mysqli_fetch_array ($conto);
    echo $sum2 = $tot['conta'];
    echo "<hr>";
  } 
}else{
  // se in tabella non ci sono records...
  echo "Nessun articolo presente.";
}
?>
</body>
</html>