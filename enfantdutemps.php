<?php
session_start();
include("bd.php");
?>
<!doctype html>
<html lang="en">
    <head>
        <title>Les enfants du temps</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
        <link rel="stylesheet" media="all" type="text/css" href="CSS/loveanime.css">
    </head>

    <body>
        <header>
          <?php
          include("header.php");
          ?>
        </header>
        <main>
          <div class="card" style="background-color:#ebebeb">
            <div class="row g-0 w-100">
              <div class="col m-3">
                <img src="images/enfantdutemps.jpg" class="img-fluid rounded-start h-100 ms-5" alt="enfantdutemps" title="enfantdutemps">
              </div>
              <div class="col-md-8">
                    <div class="card-body text-start border m-5" style="background-color: #F6F6F6;">
                        <h5 class="card-title">Les Enfant du Temps</h5>
                        <div class="card-text">Titre original : 天気の子
                                  </br>Durée : 1h54
                                  </br>Réalisateur : Shinkai Makoto
                                  </br>Genres : Drame - Fantastique - Fantasy - Mystère - Romance - Surnaturel
                                  </br>Thèmes : Environnement - Quotidien
                                  </br>Studio d'animation : CoMix Wave Films
                      </div>
                    </div>
                    <div class="card text-bg-light m-5">
                        <div class="card-header text-white" style="background-color: #4F76BB;">Synopsis</div>
                        <div class="card-body">
                          <p class="card-text">Jeune lycéen, Hodaka fuit son île pour rejoindre Tokyo. Sans argent ni emploi, il tente de survivre dans la jungle urbaine et trouve un poste dans une revue dédiée au paranormal. Un phénomène météorologique extrême touche alors le Japon, exposé à de constantes pluies. Hodaka est dépêché pour enquêter sur l'existence de prêtresses du temps. Peu convaincu par cette légende, il change soudainement d'avis lorsqu'il croise la jeune Hina...</p>
                        </div>
                      </div>
                    </div>
                    <div class="card text-bg-light mb-3">
                        <div class="card-header text-white" style="background-color: #4F76BB;">Personnages</div>
                        <div class="card-body text-center">
                          <p class="card-text">
                            <div class="container text-center">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <img style="height: 150px;" src="images/hodaka.jpg" alt="hodaka" title="hodaka">
                                        <p>Morishima Hodaka</p>
                                    </div>
                                    <div class="col">
                                        <img style="height: 150px;" src="images/hina2.jpg" alt="hina2" title="hina2">
                                        <p>Amano Hina</p>
                                    </div>
                                    <div class="col">
                                        <img style="height: 150px;" src="images/keisuke.jpg" alt="keisuke" title="keisuke">
                                        <p>Suga Keisuke</p>
                                    </div>
                                    <div class="col">
                                        <img style="height: 150px;" src="images/natsumi.jpg" alt="natsumi" title="natsumi">
                                        <p>Natsumi</p>
                                    </div>
                                    <div class="col">
                                        <img style="height: 150px;" src="images/nagi.jpg" alt="nagi" title="nagi">
                                        <p>Amano Nagi</p>
                                    </div>
                                    <div class="col">
                                      <img style="height: 150px;" src="images/fumi.jpg" alt="fumi" title="fumi">
                                      <p>Tachibana Fumi</p>
                                  </div>
                                </div>
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
        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"
        ></script>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        ></script>
    </body>
</html>
