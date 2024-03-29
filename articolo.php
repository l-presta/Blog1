<html>

<head>
  <title>Il mio Blog</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>

<body style="background-color:#00bcd4;">
  <center>
    <h1>ARTICOLO</h1>
  </center>
  <div class="container cyan brackets">
    <a href="index.php">HOME</a>
    <a href="articoli.php">ARTICOLI</a>
    <a href="insert_post.php">INSERISCI ARTICOLO</a>
  </div>
  <center>
    <?
// controlliamo che sia stato inviato un id numerico alla pagina
if(isset($_GET['id'])&&(is_numeric($_GET['id']))){
  // valorizziamo la variabile relativa all'id dell'articolo e includiamo il file di configurazione
  $art_id = $_GET['id'];
  @include "config.php";

  // selezioniamo dalla tabella i dati relativi all'articolo
  $sql = "SELECT art_autore,art_titolo,art_data,art_articolo FROM articoli WHERE art_id='$art_id'";
  $query = @mysqli_query($db, $sql) or die (mysql_error($db));

  // se per quell'id esiste un articolo..
  if(mysqli_num_rows($query) > 0){
    // ...estraiamo i dati e mostriamoli a video
    $row = mysqli_fetch_array($query) or die (mysqli_error($db));
    $autore = stripslashes($row['art_autore']);
    $titolo = stripslashes($row['art_titolo']);
    $data = $row['art_data'];
    $articolo = stripslashes($row['art_articolo']);
    echo "<h2>".$titolo."</h2>" . $articolo . "<br><br>";
    $data = preg_replace('/^(.{4})-(.{2})-(.{2})$/','$3-$2-$1', $data);
    echo "Scritto da <b>". $autore . "</b>";
    echo "| Articolo postato il <b>" . $data . "</b></br>"; 
    echo "id articolo: $art_id";
    // var_dump($titolo);
    // link alla pagina dei commenti  
    echo "</br> <a class=\"btn btn-primary\" href=\"insert_comment.php?id=$art_id\" >Invia un commento</a></br></br>";

    // visualizzianmo tutti i commenti
    $sql_com = "SELECT com_autore, com_testo FROM commenti WHERE com_art='$art_id'";
    $query_com = @mysqli_query($db, $sql_com) or die (mysql_error($db));
    if(mysqli_num_rows($query_com) > 0){
      echo "Commenti:<br>";
      while($row_com = mysqli_fetch_array($query_com)){
        $com_autore = stripslashes($row_com['com_autore']);
        $com_testo = stripslashes($row_com['com_testo']);
        echo $com_testo . "<br>";
        echo "Inserito da <b>". $com_autore . "</b>";
        echo "<hr>"; 
      }
    }
  }
}else{
  // se per l'id non esiste un articolo..
  echo "Nessun articolo trovato.";
}
$myArr = array($autore, $titolo, $data, $articolo, $art_id);
$myJSON = json_encode($myArr);
// echo $myJSON;
?>
  </center>
  <script>
    //Get the button
    var mybutton = document.getElementById("myBtn");

    // When the user scrolls down 20px from the top of the document, show the button
    window.onscroll = function() {
      scrollFunction()
    };

    function scrollFunction() {
      if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        mybutton.style.display = "block";
      } else {
        mybutton.style.display = "none";
      }
    }
    // When the user clicks on the button, scroll to the top of the document
    function topFunction() {
      document.body.scrollTop = 0;
      document.documentElement.scrollTop = 0;
    }
  </script>
  <button class="btn btn-primary" onclick="topFunction()" id="myBtn" title="Go to top">Top</button>