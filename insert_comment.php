<html>
<head>
<title>Blog: inserimento commenti</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<h1>Inserisci un tuo commento:</h1>
<div class="container cyan brackets">
  <a href="index.php">HOME</a>
  <a href="articoli.php">ARTICOLI</a>
  <a href="insert_post.php">Inserisci articolo</a>
</div>
<?
// includiamo il file di configurazione
@include "config.php";

// se sono stati inviati dei parametri valorizziamo con essi le variabili
// per l'inserimento nella tabella
if(isset($_POST['submit'])){
  if(isset($_POST['autore'])){
    $autore = addslashes($_POST['autore']);
  }
  if(isset($_POST['testo'])){
    $testo = addslashes($_POST['testo']);
  }
  if(isset($_POST['id'])){
    $com_art = addslashes($_POST['id']);
  }

  // popoliamo i campi della tabella commenti con i dati ricevuti dal form
  $sql = "INSERT INTO commenti (com_autore, com_testo, com_art) VALUES ('$autore', '$testo', '$com_art')";
  
  // se l'inserimento ha avuto successo inviamo una notifica
  if (@mysqli_query($db, $sql) or die (mysqli_error($db))){
    echo "Commento inserito con successo.";
  } 
}else{
  //controlliamo che l'id dell'articolo sia realamente esistente
  if(isset($_GET['id'])&&(is_numeric($_GET['id']))){
    $com_art = addslashes($_GET['id']);
    $sql = "SELECT art_id FROM articoli WHERE art_id='$com_art'";
    $query = @mysqli_query($db, $sql) or die (mysqli_error($db));
    if(mysqli_num_rows($query) > 0){
      // se non sono stati inviati dati dal form mostriamo il modulo per l'inserimento
      ?>
<form action="insert_comment.php" method="post">
Autore:<br>
<input name="autore" type="text" size="20"><br>
Testo:<br>
<textarea name="testo" cols="40" rows="10"></textarea><br>
<input name="id" type="hidden" value="<? echo $com_art; ?>">
<input name="submit" type="submit" value="Invia">
</form>
      <?
      // se l'id dell'articolo non esiste o non è numerico inviamo delle notifiche
    }else{
      echo "Impossibile inserire un commento.";
    }
  }else{
    echo "Impossibile inserire un commento.";
  }
}
?>
</body>
</html>