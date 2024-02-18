<?php
include("bd.php");
if (isset($_POST['nom']) and isset($_POST['prenom']) and isset($_POST['nom_utilisateur']) and isset($_POST['mail']) and isset($_POST['mdp'])) {
  $nom = $_POST['nom'];
  $prenom = $_POST['prenom'];
  $nom_utilisateur = $_POST['nom_utilisateur'];
  $mail = $_POST['mail'];
  $mdp = $_POST['mdp'];
  $sql = 'INSERT INTO comptes (nom,prenom,nom_utilisateur,mail,mdp) VALUES ("'.$nom.'","'.$prenom.'","'.$nom_utilisateur.'","'.$mail.'","'.$mdp.'")';
  $pdo->exec($sql);
}
?>
<!doctype html>
<html lang="en">

<head>
  <title>Loveanime</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  
  <link rel="stylesheet" media="all" type="text/css" href="CSS/loveanime.css">
</head>

<body>
  <header>
    <?php
    include("header.php");
    ?>
  </header>
  <main>
  <div class="presentation">
    <div class="bienvenue">
      <h1>Bienvenue sur Loveanime !</h1>
      <h3>Toutes les infos sur vos animés et films d'animation préférés !</h3>
    </div>
  </div>
  <div class="container mt-5 mb-5">
    <div class="row">
      <div class="col-md-6">
        <h3 class="text-center text-black m-5">Animés</h3>
        <div id="carouselExampleAutoPlaying" class="carousel carousel slide w-50 mx-auto border border-white rounded-3 border-5" data-bs-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item active" data-bs-interval="2000">
              <a href="drstone.php"><img src="images/Dr.stone.jpg" class="d-block w-100 h-100" alt="dr stone" title="dr stone"></a>
            </div>
            <div class="carousel-item" data-bs-interval="2000">
              <a href="tr.php"><img src="images/tr.jpg" class="d-block w-100 h-100" alt="tr" title="tr"></a>
            </div>
            <div class="carousel-item" data-bs-interval="2000">
              <a href="ds.php"><img src="images/demon slayer.jpg" class="d-block w-100 h-100" alt="ds" title="ds"></a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <h3 class="text-center text-black m-5">Films d'animation</h3>
        <div id="carouselExampleAutoPlaying2" class="carousel carousel slide w-50 mx-auto border border-white rounded-3 border-5" data-bs-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item active" data-bs-interval="2000">
              <a href="yourname.php"><img src="images/yourname.jpg" class="d-block w-100 h-100" alt="your name" title="your name"></a>
            </div>
            <div class="carousel-item" data-bs-interval="2000">
              <a href="silentvoice.php"><img src="images/silentvoice.jpg" class="d-block w-100" alt="silentvoice" title="silentvoice"></a>
            </div>
            <div class="carousel-item" data-bs-interval="2000">
              <a href="enfantdutemps.php"><img src="images/enfantdutemps.jpg" class="d-block w-100 h-100" alt="enfantdutemps" title="enfantdutemps"></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </main>
  <footer>
    <?php
    include("footer.php");
    ?>
  </footer>
  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
    integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
  </script>
</body>

</html>