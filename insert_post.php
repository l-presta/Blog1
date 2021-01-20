<html>

<head>
  <link rel="stylesheet" type="text/css" href="style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
  <title>Blog: Lorenzo's Blog</title>
</head>

<body style="background-color:#00bcd4;">
  <center>
    <h1>Inserisci un articolo</h1>
  </center>
  <div class="container cyan brackets">
    <a href="index.php">HOME</a>
    <a href="articoli.php">ARTICOLI</a>
    <a href="insert_post.php">INSERISCI ARTICOLO</a>
  </div>
  <?

//includiamo il file di configurazione
@include "config.php";

//valorizziamo le variabili con i dati ricevuti dal form
if(isset($_POST['submit'])){
  if(isset($_POST['autore'])){
    $autore = addslashes($_POST['autore']);
  }
  if(isset($_POST['titolo'])){
    $titolo = addslashes($_POST['titolo']);
  }
  if(isset($_POST['articolo'])){
    $articolo = addslashes($_POST['articolo']);
  }

  // popoliamo i campi della tabella articoli con i dati ricevuti dal form
  $sql = "INSERT INTO articoli (art_autore, art_titolo, art_articolo, art_data) VALUES ('$autore', '$titolo', '$articolo', now())";

  // se l'inserimento ha avuto successo inviamo una notifica
  if (@mysqli_query($db, $sql) or die (mysqli_error($db))){
    echo "Articolo inserito con successo.";
  } 
}else{
  // se non sono stati inviati dati dal form mostriamo il modulo per l'inserimento
  ?>
  </br>
  </br>
  </br>
  <center>
    <form action="insert_post.php" method="post">
      Autore:<br>
      <input name="autore" type="text" size="20">
      </br>
      Titolo:<br>
      <input name="titolo" type="text" size="30">
      </br>
      Articolo:<br>
      <textarea name="articolo" cols="40" rows="10"></textarea><br>
      </br>
      <input class="btn btn-primary" name="submit" type="submit" value="Invia">
    </form>
  </center>
  <?
}
?>
</body>

</html>