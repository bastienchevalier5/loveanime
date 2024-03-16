<?php
session_start();
include("bd.php");
$sql = 'SELECT * FROM animes';
$temp = $pdo->query($sql);
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Loveanime</title>
  <!-- Inclure Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Inclure les bibliothèques nécessaires pour le carrousel -->
  <link rel="stylesheet" type="text/css" href="slick/slick.css" />
  <link rel="stylesheet" type="text/css" href="slick/slick-theme.css" />
  <link rel="stylesheet" href="CSS/loveanime.css">
</head>

<body>
  <header>
    <?php
    include "header.php";
    ?>
  </header>
  <main>
    <div class="presentation">
      <div class="bienvenue">
        <h1>Bienvenue sur Loveanime !</h1>
        <h2>Toutes les infos sur vos animés et films d'animation préférés !</h2>
      </div>
    </div>
    <div class="animes">
      <?php
      while ($resultats = $temp->fetch()) {
        echo "<div class='presentation-anime'>";
        echo "";
      }
      ?>
      
        
      </div>    
    </div>
  </main>
  <footer>
    <?php
    include "footer.php";
    ?>
  </footer>
  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>

</body>

</html>
