<?php
@include "config.php";
// includiamo la pagina contenente il codice per la creazione delle anteprime
@require "anteprima.php";
// estraiamo i dati relativi agli articoli dalla tabella
$sql = "SELECT * FROM articoli ORDER BY art_data DESC";
$query = @mysqli_query($db, $sql) or die(mysqli_error($db));
//verifichiamo che siano presenti records
if (mysqli_num_rows($query) > 0) {
?>
  <html>

  <head>
    <title>Lorenzo's Blog</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
  </head>

  <body style="background-color:#00bcd4;">
    <h1 style="text-align:center;">LORENZO'S BLOG</h1>
    <div class="container cyan brackets">
      <a href="index.php">HOME</a>
      <a href="articoli.php">ARTICOLI</a>
      <a href="insert_post.php">INSERISCI ARTICOLO</a>
    </div>
    <?php
    // se la tabella contiene records mostriamo tutti gli articoli attraverso un ciclo
    while ($row = mysqli_fetch_array($query)) {
    ?>
      <div class="container">
        <div class="row">
          <div class="card">
            <div class="card-body">
              <div class="card-title">
                <p class="card-text">
                  <?php
                  $art_id = $row['art_id'];
                  $autore = stripslashes($row['art_autore']);
                  $titolo = stripslashes($row['art_titolo']);
                  $data = $row['art_data'];
                  $articolo = stripslashes($row['art_articolo']);
                  echo "<h2>" . $titolo . "</h2>";
                  echo @anteprima($articolo, 30, $link) . "<br>";
                  echo "</br>";
                  echo "<hr>";
                  echo  " <a class=\"btn btn-primary\" href=\"articolo.php?id=$art_id\">Leggi tutto</a>";
                  ?>
                </p>
                <div class="card-footer text-muted">
                  <?php
                  echo  "Scritto da <b>" . $autore . "</b> </br>";
                  echo  " Commenti:";
                  $conta = "SELECT COUNT(com_id) as conta from commenti WHERE com_art = '$art_id'";
                  $conto = @mysqli_query($db, $conta);
                  $tot = @mysqli_fetch_array($conto);
                  echo $sum2 = $tot['conta'];
                  echo  "</br> Articolo postato il <b>" . $data . "</b> </br>";
                  ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  <?php
    }
  } else
    echo "<h1>Nessun articolo trovato</h1>"
  ?>
  </body>
  </br>
  </br>
  <div class="container">
    <hr>
  </div>
  <!-- Footer -->
  <div class="container">
    <footer class="bg-light text-center text-lg-start site-footer">

      <!-- Grid container -->
      <div class="container p-4">
        <!--Grid row-->
        <div class="row">
          <!--Grid column-->
          <div class="col-lg-6 col-md-12 mb-4 mb-md-0">
            <h5 class="text-uppercase">Lorenzo's Blog</h5>
          </div>
          <!--Grid column-->

          <!--Grid column-->
          <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
            <h5 class="text-uppercase">Links</h5>

            <ul class="list-unstyled mb-0">
              <li>
                <a href="#!" class="text-dark">Link 1</a>
              </li>
              <li>
                <a href="#!" class="text-dark">Link 2</a>
              </li>
              <li>
                <a href="#!" class="text-dark">Link 3</a>
              </li>
              <li>
                <a href="#!" class="text-dark">Link 4</a>
              </li>
            </ul>
          </div>
          <!--Grid column-->

          <!--Grid column-->
          <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
            <h5 class="text-uppercase mb-0">Links</h5>

            <ul class="list-unstyled">
              <li>
                <a href="#!" class="text-dark">Link 1</a>
              </li>
              <li>
                <a href="#!" class="text-dark">Link 2</a>
              </li>
              <li>
                <a href="#!" class="text-dark">Link 3</a>
              </li>
              <li>
                <a href="#!" class="text-dark">Link 4</a>
              </li>
            </ul>
          </div>
          <!--Grid column-->
        </div>
        <!--Grid row-->
      </div>
      <!-- Grid container -->

      <!-- Copyright -->
      <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2)">
        © 2021 Copyright:
        <a class="text-dark" href="https://github.com/l-presta/Blog">GitHub Lorenzo Presta</a>
      </div>
  </div>
  <!-- Copyright -->
  </footer>
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
  <!-- Footer -->

  </html>