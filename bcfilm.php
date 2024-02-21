<?php
session_start();
include("bd.php");
?>
<!doctype html>
<html lang="en">
    <head>
        <title>Black Clover : L'épée de l'Empereur-Mage</title>
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
                <img src="images/bcfilm.png" class="img-fluid rounded-start h-100 ms-5" alt="bcfilm" title="bcfilm">
              </div>
              <div class="col-md-8">
                    <div class="card-body text-start border m-5" style="background-color: #F6F6F6;">
                        <h5 class="card-title">Black Clover : L'épée de l'Empereur-Mage</h5>
                        <div class="card-text">Titre original : ブラッククローバー 魔法帝の剣
                                  </br>Durée : 1h53
                                  </br>Réalisateur : Tanemura Ayataka
                                  </br>Genres : Action - Aventure - Comédie - Fantasy - Nekketsu - Surnaturel
                                  </br>Thèmes : Amitié - Magie
                                  </br>Studio d'animation : Studio Pierrot
                                  </br>Disponible sur : <a href="https://www.netflix.com/title/81448990"><img src="images/netflix.png" alt="netflix" title="netflix"></a></div>
                    </div>
                    <div class="card text-bg-light m-5">
                        <div class="card-header text-white" style="background-color: #4F76BB;">Synopsis</div>
                        <div class="card-body">
                          <p class="card-text">Conrad Leto, le prédécesseur de l’actuel Empereur-Mage, Julius Novachrono, s’est libéré des chaînes qui le gardaient enfermé depuis qu’il s’est rebellé face à son royaume autrefois. De retour et prêt à en découdre, il projette d’utiliser « l’épée impériale » pour ramener à la vie les trois Empereurs-Mage les plus redoutés de l’histoire : Edward Avalaché, Princia Funnybunny et Jester Garandaros.</p>
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
                                        <img style="height: 150px;" src="images/asta.jpg" alt="asta" title="asta">
                                        <p>Asta</p>
                                    </div>
                                    <div class="col">
                                        <img style="height: 150px;" src="images/yuno.png" alt="yuno" title="yuno">
                                        <p>Yuno</p>
                                    </div>
                                    <div class="col">
                                        <img style="height: 150px;" src="images/conrad.jpg" alt="conrad" title="conrad">
                                        <p>Conrad Leto</p>
                                    </div>
                                    <div class="col">
                                        <img style="height: 150px;" src="images/julius2.png" alt="julius" title="julius">
                                        <p>Julius Novachrono</p>
                                    </div>
                                    <div class="col">
                                        <img style="height: 150px;" src="images/noelle.jpg" alt="noelle" title="noelle">
                                        <p>Noelle Silva</p>
                                    </div>
                                    <div class="col">
                                      <img style="height: 150px;" src="images/yami.jpg" alt="yami" title="yami">
                                      <p>Yami Sukehiro</p>
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
