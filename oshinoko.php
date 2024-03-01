<?php
session_start();
include("bd.php");
?>
<!doctype html>
<html lang="en">
    <head>
        <title>Oshi No Ko</title>
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
                <img src="images/oshinoko.jpg" class="img-fluid rounded-start h-100 ms-5" alt="oshinoko" title="oshinoko">
              </div>
              <div class="col-md-8">
                <div class="card-body text-start border m-5" style="background-color: #F6F6F6;">
                  <h5 class="card-title">Oshi No Ko</h5>
                  <div class="card-text">Titre original :【Oshi no Ko】 / 【推しの子】
                    </br>Saison 1 : 11 épisodes
                    </br>Statut : En cours
                    </br>Genres :  Drame - Psychologique - Slice of Life
                    </br>Thèmes :  Idols - Réincarnation / transmigration - Vengeance
                    </br>Studio d'animation : Doga Kobo
                    </br>Disponible sur : <a href="https://animationdigitalnetwork.fr/video/oshi-no-ko"><img src=images/adn.jpg alt="adn" title="adn"></a></div>
                  </div>
                  <div class="card text-bg-light m-5">
                    <div class="card-header text-white" style="background-color: #4F76BB;">Synopsis</div>
                      <div class="card-body">
                        <p class="card-text">Le docteur Gorô est obstétricien dans un hôpital de campagne. Il est loin du monde de paillettes dans lequel évolue Ai Hoshino, une chanteuse au succès grandissant dont il est "un fan absolu". Ces deux-là vont peut-être se rencontrer dans des circonstances peu favorables, mais cet événement changera leur vie à jamais !</p>
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
                              <img style="height: 150px;" src="images/ai.jpg" alt="ai" title="ai">
                              <p>Hoshino Ai</p>
                            </div>
                            <div class="col">
                              <img style="height: 150px;" src="images/aqua.jpg" alt="aqua" title="aqua">
                              <p>Hoshino Aquamarine</p>
                            </div>
                            <div class="col">
                              <img style="height: 150px;" src="images/ruby.jpg" alt="ruby" title="ruby">
                              <p>Hoshino Ruby</p>
                            </div>
                            <div class="col">
                              <img style="height: 150px;" src="images/kana.jpg" alt="kana" title="kana">
                              <p>Arima Kana</p>
                            </div>
                            <div class="col">
                              <img style="height: 150px;" src="images/akane.webp" alt="akane" title="akane">
                              <p>Kurokawa Akane</p>
                            </div>
                            <div class="col">
                              <img style="height: 150px;" src="images/memcho.jpg" alt="memcho" title="memcho">
                              <p>MEM-cho</p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card text-bg-light mb-3">
                    <div class="card-header text-white" style="background-color: #4F76BB;">Episodes</div>
                    <div class="card-body" style="max-height: 300px;overflow-y: auto;">
                      <p class="card-text"><table class="table table-bordered caption-top text-center"><h6>Saison 1</h6>
                        <thead>
                          <tr>
                            <th scope="col">N°</th>
                            <th scope="col">Titre français</th>
                            <th scope="col">Titre japonais</th>
                            <th scope="col">Date</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <th scope="row">1</th>
                            <td>Une mère et ses enfants</td>
                            <td>Mother and Children</td>
                            <td>12/04/2023</td>
                          </tr>
                          <tr>
                            <th scope="row">2</th>
                            <td>La troisième option</td>
                            <td>三つ目の選択肢 / Mittsume no sentakushi</td>
                            <td>19/04/2023</td>
                          </tr>
                          <tr>
                            <th scope="row">3</th>
                            <td>Une série adaptée d'un manga</td>
                            <td>漫画原作ドラマ / Manga gensaku dorama</td>
                            <td>26/04/2023</td>
                          </tr>
                          <tr>
                            <th scope="row">4</th>
                            <td>Acteur</td>
                            <td>役者 / Yakusha</td>
                            <td>03/05/2023</td>
                          </tr>
                          <tr>
                            <th scope="row">5</th>
                            <td>Téléréalité de rencontre</td>
                            <td>恋愛リアリティーショー / Ren'ai riaritī shō</td>
                            <td>10/05/2023</td>
                          </tr>
                          <tr>
                            <th scope="row">6</th>
                            <td>Ego-surfing</td>
                            <td>エゴサーチ / Ego sāchi</td>
                            <td>17/05/2023</td>
                          </tr>
                          <tr>
                            <th scope="row">7</th>
                            <td>Buzz</td>
                            <td>バズ	Bazu</td>
                            <td>24/05/2023</td>
                          </tr>
                          <tr>
                            <th scope="row">SP</th>
                            <td>Episode récapitulatif</td>
                            <td></td>
                            <td>31/05/2023</td>
                          </tr>
                          <tr>
                            <th scope="row">8</th>
                            <td>Première fois</td>
                            <td>初めて / Hajimete</td>
                            <td>07/06/2023</td>
                          </tr>
                          <tr>
                            <th scope="row">9</th>
                            <td>B Komachi</td>
                            <td>B小町 / B Komachi</td>
                            <td>14/06/2023</td>
                          </tr>
                          <tr>
                            <th scope="row">10</th>
                            <td>Pression</td>
                            <td>プレッシャー / Puresshā</td>
                            <td>21/06/2023</td>
                          </tr>
                          <tr>
                            <th scope="row">11</th>
                            <td>Idoles</td>
                            <td>アイドル / Aidoru</td>
                            <td>28/06/2023</td>
                          </tr>
                        </tbody>
                      </table>
                    </p>
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
