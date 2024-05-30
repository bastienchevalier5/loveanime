<?php
session_start();
include("bd.php");
$sql = 'SELECT * FROM animes WHERE type = "anime" ORDER BY id DESC LIMIT 5';
$temp = $pdo->query($sql);
$sql2 = 'SELECT * FROM animes WHERE type = "film" ORDER BY id DESC LIMIT 5';
$temp2 = $pdo->query($sql2);
$sql3 = 'SELECT * FROM animes WHERE classique = true ORDER BY titre';
$temp3 = $pdo->query($sql3);
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
  
  <link rel="shortcut-icon" href="favicon.ico">
  <link rel="stylesheet" href="loveanime.css">
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
    <div class="presentation-animes">
      <h1>Derniers animes ajoutés</h1>
      <div class="animes">
        <?php
        while ($resultats = $temp->fetch()) {
          echo "<div class='card-animes' style='flex-direction:column;align-items:normal'>";
          echo "<a href='info_anime.php?id=".$resultats['id']."'><img style='width:22em' src='".$resultats['img']."' alt='anime' title='anime'>";
          echo "<div class='card-body' style='box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);height:7em'>";
          echo "<h2 class='card-title-animes text-center'>".$resultats['titre']."</h2>";
          echo '</a>';
          echo '</div>';
          echo '</div>';
        }
        ?>
      </div>
      <h1>Derniers films ajoutés</h1>
      <div class="animes">
        <?php
        while ($resultats2 = $temp2->fetch()) {
          echo "<div class='card-animes' style='flex-direction:column;align-items:normal'>";
          echo "<a href='info_anime.php?id=".$resultats2['id']."'><img style='width:22em' src='".$resultats2['img']."' alt='anime' title='anime'>";
          echo "<div class='card-body' style='box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);height:10em'>";
          echo "<h2 class='card-title-animes text-center'>".$resultats2['titre']."</h2>";
          echo '</a>';
          echo '</div>';
          echo '</div>';
        }
        ?>
      </div>
      <h1>Les Classiques</h1>
      <div class="animes">
        <?php
        while ($resultats3 = $temp3->fetch()) {
          echo "<div class='card-animes' style='flex-direction:column;align-items:normal'>";
          echo "<a href='info_anime.php?id=".$resultats3['id']."'><img style='width:22em' src='".$resultats3['img']."' alt='anime' title='anime'>";
          echo "<div class='card-body' style='box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);height:10em'>";
          echo "<h2 class='card-title-animes text-center'>".$resultats3['titre']."</h2>";
          echo '</a>';
          echo '</div>';
          echo '</div>';
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
