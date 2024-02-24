<?php
session_start();
include("bd.php");
?>
<!doctype html>
<html lang="en">

<head>
  <title>Loveanime</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Toutes les informations sur les animes et films d'animations les plus populaires !">
  
  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  
  <link rel="stylesheet" media="all" type="text/css" href="CSS/loveanime.css">
</head>

<body>
  <header>
    <nav class="navbar navbar-expand-lg">
      <div class="container text-center">
        <div class="row align-items-start mx-auto p-1">
          <div class="container-fluid">
            <div class="col">
              <a class="navbar-brand" href="index.php" alt="lienacceuil" title="lienacceuil"><img src="images/loveanime.jpeg" alt="anime" title="anime"></a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
            </div>
            <div class="collapse navbar-collapse fs-5" id="navbarSupportedContent">
              <div class="col">
                <ul class="navbar-nav">
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php"><button class="custom-btn btn-5"><span>Accueil</span></button></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="anime.php"><button class="custom-btn btn-5"><span>Animés</span></button></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="filmanimation.php"><button class="custom-btn btn-5"><span>Films</span></button></a>
                  </li>
                </ul>
              </div>
              <div class="col">
                <form class="d-flex mx-auto p-5" role="search">
                  <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                  <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
              </div>
              <div class="btn_compte">
                <?php
                if (isset($_SESSION['connected']) && $_SESSION['connected'] = 1) {
                echo '<a href="moncompte.php" class="btn btn-primary ms-5" role="button" aria-disabled="true">Mon Compte</a>';
                } else {
                echo '<a href="inscription.php"><button class="btn-19"><span>Inscription</span></button></a>';
                echo '<a href="connexion.php"><button class="btn-19"><span>Connexion</span></button></a>';                                }
                ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </nav>
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
              <a href="tr.php"><img src="images/tr.jpg" class="d-block w-100 h-100" alt="tokyorevengers" title="tokyorevengers"></a>
            </div>
            <div class="carousel-item" data-bs-interval="2000">
              <a href="ds.php"><img src="images/demon slayer.jpg" class="d-block w-100 h-100" alt="demonslayer" title="demonslayer"></a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <h3 class="text-center text-black m-5">Films d'animation</h3>
        <div id="carouselExampleAutoPlaying2" class="carousel carousel slide w-50 mx-auto border border-white rounded-3 border-5" data-bs-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item active" data-bs-interval="2000">
              <a href="yourname.php"><img src="images/yourname.jpg" class="d-block w-100 h-100" alt="yourname" title="yourname"></a>
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
    <nav class="navbar navbar-expand-lg m-1">
      <a class="navbar-brand" href="index.php"><a class="navbar-brand" href="index.php"><img src="images/loveanime.jpeg" alt="anime" title="anime"></a></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="container">
        <div class="elem">
          <a href="index.php" class="button">Accueil</a>
        </div>
      </div>
      <div class="container">
        <div class="elem">
          <a href="apropos.php" class="button">A propos</a>
        </div>
      </div>
      <div class="container">
        <div class="elem">
          <a href="contact.php" class="button">Contact</a>
        </div>
      </div>
      <div class="container">
        <div class="elem">
          <a href="#" class="button">Mentions légales</a>
        </div>
      </div>
    </nav>
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