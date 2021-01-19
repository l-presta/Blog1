<head>
<title>Lorenzo's Blog</title>
<link rel="stylesheet" type="text/css" href="style.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>
<body>
<h1><center>LISTA DEGLI ARTICOLI</center></h1>
<div class="container cyan brackets">
  <a href="index.php">HOME</a>
  <a href="articoli.php">ARTICOLI</a>
  <a href="insert_post.php">Inserisci articolo</a>

</div>
<?php 
 @include "config.php";

 // includiamo la pagina contenente il codice per la creazione delle anteprime
 @require "anteprima.php";
 
 // estraiamo i dati relativi agli articoli dalla tabella
 $sql = "SELECT * FROM articoli ORDER BY art_data DESC";
 $query = @mysqli_query($db, $sql) or die (mysqli_error($db));
 ?>
    <h5 class="card-title"><?php echo "<h2>".$titolo."</h2>"; ?></h5>
    <p class="card-text"><?php 

    //verifichiamo che siano presenti records
    if(mysqli_num_rows($query) > 0){
      // se la tabella contiene records mostriamo tutti gli articoli attraverso un ciclo
      while($row = mysqli_fetch_array($query)){
        $art_id = $row['art_id'];
        $autore = stripslashes($row['art_autore']);
        $titolo = stripslashes($row['art_titolo']);
        $data = $row['art_data'];
        $articolo = stripslashes($row['art_articolo']);
    echo @anteprima($articolo, 30, $link). "<br>"; 
    echo  "Scritto da <b>". $autore . "</b>";
    echo  "| Articolo postato il <b>" . $data . "</b>";
    echo  "| Commenti: <br>";  
    // mostriamo il numero di commenti relativi ad ogni articolo
    $conta = "SELECT COUNT(com_id) as conta from commenti WHERE com_art = '$art_id'";
    $conto = @mysqli_query ($db, $conta);
    $tot = @mysqli_fetch_array ($conto);
    echo $sum2 = $tot['conta'];
    echo "</br>";
    echo  " <a class=\"btn btn-primary\" href=\"articolo.php?id=$art_id\">Leggi tutto</a>";
    echo "<hr>";
      }}
  else
    echo "<h1>Nessun articolo trovato</h1>"
  
  ?>
