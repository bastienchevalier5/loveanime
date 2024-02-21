<?php
session_start();
include("bd.php");
?>
<!doctype html>
<html lang="en">
    <head>
        <title>Je veux manger ton pancréas</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />
        <link rel="stylesheet" media="all" type="text/css" href="CSS/loveanime.css">

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
                <img src="images/jvmtp.jpg" class="img-fluid rounded-start h-100 ms-5" alt="jvmtp" title="jvmtp">
              </div>
              <div class="col-md-8">
                    <div class="card-body text-start border m-5" style="background-color: #F6F6F6;">
                        <h5 class="card-title">Je veux manger ton pancréas</h5>
                        <div class="card-text">Titre original : 君の膵臓をたべたい
                                  </br>Durée : 1h48
                                  </br>Réalisateur : Ushijima Shinichiro
                                  </br>Genres : Drame - Romance - School Life - Slice of Life
                                  </br>Thèmes : Amitié - Ecole - Quotidien
                                  </br>Studio d'animation : Studio VOLN
                        </div>
                    </div>
                    <div class="card text-bg-light m-5">
                        <div class="card-header text-white" style="background-color: #4F76BB;">Synopsis</div>
                        <div class="card-body">
                          <p class="card-text">Sakura est une lycéenne populaire et pleine de vie. Tout l’opposé d'un de ses camarades solitaires qui, tombant par mégarde sur son journal intime, découvre qu’elle n’a plus que quelques mois à vivre... Unis par ce secret, ils se rapprochent et s'apprivoisent. Sakura lui fait alors une proposition : vivre ensemble toute une vie en accéléré, le temps d’un printemps.</p>
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
                                        <img style="height: 150px;" src="images/sakura2.jpg" alt="sakura2" title="sakura2">
                                        <p>Yamauchi Sakura</p>
                                    </div>
                                    <div class="col">
                                        <img style="height: 150px;" src="images/haruki.jpg" alt="haruki" title="haruki">
                                        <p>Shiga Haruki</p>
                                    </div>
                                    <div class="col">
                                        <img style="height: 150px;" src="images/kyoko.jpg" alt="kyoko" title="kyoko">
                                        <p>Takimoto Kyôko</p>
                                    </div>
                                    <div class="col">
                                        <img style="height: 150px;" src="images/takahiro.jpg" alt="takahiro" title="takahiro">
                                        <p>Takahiro</p>
                                    </div>
                                    <div class="col">
                                        <img style="height: 150px;" src="images/issei.jpg" alt="issei" title="issei">
                                        <p>Miyata Issei</p>
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
