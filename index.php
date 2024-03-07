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
    session_start();
    include("bd.php");
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
    <div class="container mt-5 mb-5">
      <div class="row">
        <div class="col-md-6">
          <h3 class="text-center text-black m-5">Animés</h3>
          <div id="carouselExampleAutoPlaying" class="carousel carousel slide w-50 mx-auto border border-white rounded-3 border-5" data-bs-ride="carousel">
            <div class="carousel-inner">
              <?php
              $sql = "SELECT * FROM animes ORDER BY id DESC LIMIT 5";
              $temp = $pdo->query($sql);
              $first = true;
              while ($resultats = $temp->fetch()) {
                $active_class = ($first) ? "active" : "";
                echo '<div class="carousel-item ' . $active_class . '" data-bs-interval="2000">';
                echo '<a href="info_anime.php?id=' . $resultats["id"] . '"><img src="' . $resultats["img"] . '" class="d-block w-100 h-100" alt="' . $resultats["titre"] . '" title="' . $resultats["titre"] . '"></a>';
                echo '</div>';
                $first = false;
                }
              
              ?>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <h3 class="text-center text-black m-5">Films d'animation</h3>
          <div id="carouselExampleAutoPlaying2" class="carousel carousel slide w-50 mx-auto border border-white rounded-3 border-5" data-bs-ride="carousel">
            <div class="carousel-inner">
              <?php
              $sql2 = "SELECT * FROM films ORDER BY id DESC LIMIT 5";
              $temp2 = $pdo->query($sql2); 
              $first = true;
              while ($resultats2 = $temp2->fetch()) {
                $active_class = ($first) ? "active" : "";
                echo '<div class="carousel-item ' . $active_class . '" data-bs-interval="2000">';
                echo '<a href="info_film.php?id=' . $resultats2["id"] . '"><img src="' . $resultats2["img"] . '" class="d-block w-100 h-100" alt="' . $resultats2["titre"] . '" title="' . $resultats2["titre"] . '"></a>';
                echo '</div>';
                $first = false;
                }
              ?>
            </div>
          </div>
        </div>
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
