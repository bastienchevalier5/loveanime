<?php
session_start();
include("bd.php");
?>
<!doctype html>
<html lang="en">
    <head>
        <title>Nanatsu no Taizai</title>
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
                  <img src="images/nanatsu.jpg" class="img-fluid rounded-start h-100 ms-5" alt="nanatsu" title="nanatsu">
                </div>
                <div class="col-md-8">
                  <div class="card-body text-start border m-5" style="background-color: #F6F6F6;">
                    <h5 class="card-title">Nanatsu no Taizai</h5>
                    <div class="card-text">Titre original : 七つの大罪
                      </br>Saison 1 : 24 épisodes
                      </br>Spéciaux : 4 épisodes
                      </br>Saison 2 : 24 épisodes + 1 spécial
                      </br>Saison 3 : 24 épisodes
                      </br>Saison 4 : 24 épisodes + 1 spécial
                      </br>Statut : Terminé
                      </br>Genres : Action - Aventure - Comédie - Fantasy - Nekketsu - Romance - Shônen - Surnaturel
                      </br>Thèmes : Combats - Démons - Magie
                      </br>Studio d'animation : A-1 Pictures
                      </br>Disponible sur : <a href="https://animationdigitalnetwork.fr/video/deadlysins_tv"><img src="images/adn.jpg" alt="adn" title="adn"></a></div>
                    </div>
                    <div class="card text-bg-light m-5">
                      <div class="card-header text-white" style="background-color: #4F76BB;">Synopsis</div>
                        <div class="card-body">
                          <p class="card-text">Quand son royaume est renversé par des tyrans, une princesse écartée du trône cherche à se rapprocher d'une bande de chevaliers surpuissants pour récupérer son fief.</p>
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
                                <img style="height: 150px;" src="images/meliodas.jpg" alt="meliodas" title="meliodas">
                                <p>Meliodas</p>
                              </div>
                              <div class="col">
                                <img style="height: 150px;" src="images/hawk.jpeg" alt="Hawk" title="hawk">
                                <p>Hawk</p>
                              </div>
                              <div class="col">
                                <img style="height: 150px;" src="images/elizabeth.jpeg" alt="elizabeth" title="elizabeth">
                                <p>Elizabeth Liones</p>
                              </div>
                              <div class="col">
                                <img style="height: 150px;" src="images/ban.avif" alt="ban" title="ban">
                                <p>Ban</p>
                              </div>
                              <div class="col">
                                <img style="height: 150px;" src="images/diane.webp" alt="diane" title="diane">
                                <p>Diane</p>
                              </div>
                              <div class="col">
                                <img style="height: 150px;" src="images/arthur.webp" alt="arthur" title="arthur">
                                <p>Arthur Perndragon</p>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="card text-bg-light mb-3">
                      <div class="card-header text-white" style="background-color: #4F76BB;">Episodes</div>
                        <div class="card-body" style="max-height: 300px;overflow-y: auto;">
                          <p class="card-text">
                            <table class="table table-bordered caption-top text-center"><h6>Saison 1</h6>
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
                                  <td>Les 7 péchés capitaux</td>
                                  <td>七つの大罪 / Nanatsu no taizai</td>
                                  <td>05/10/2014</td>
                                </tr>
                                <tr>
                                  <th scope="row">2</th>
                                  <td>L’épée du Chevalier Sacré</td>
                                  <td>聖騎士の剣 / Seikishi no ken</td>
                                  <td>12/10/2014</td>
                                </tr>
                                <tr>
                                  <th scope="row">3</th>
                                  <td>La forêt des rêves blancs</td>
                                  <td>眠れる森の罪 / Nemureru mori no tsumi</td>
                                  <td>19/10/2014</td>
                                </tr>
                                <tr>
                                  <th scope="row">4</th>
                                  <td>Un rêve de petite fille</td>
                                  <td>少女の夢 / Shōjo no yume</td>
                                  <td>26/10/2014</td>
                                </tr>
                                <tr>
                                  <th scope="row">5</th>
                                  <td>Même si tu devais mourir</td>
                                  <td>たとえあなたが死んでも / Tatoe anata ga shindemo</td>
                                  <td>02/11/2014</td>
                                </tr>
                                <tr>
                                  <th scope="row">6</th>
                                  <td>Le poème des origines</td>
                                  <td>はじまりの詩 / Hajimari no shi</td>
                                  <td>09/11/2014</td>
                                </tr>
                                <tr>
                                  <th scope="row">7</th>
                                  <td>Des retrouvailles émouvantes</td>
                                  <td>感動の再会 / Kandō no saikai</td>
                                  <td>16/11/2014</td>
                                </tr>
                                <tr>
                                  <th scope="row">8</th>
                                  <td>Une chasseresse de feu</td>
                                  <td>恐るべき追跡者 / Osorubeki tsuiseki-sha</td>
                                  <td>23/11/2014</td>
                                </tr>
                                <tr>
                                  <th scope="row">9</th>
                                  <td>Une pulsation obscure</td>
                                  <td>暗黒の脈動 / Ankoku no myakudō</td>
                                  <td>30/11/2014</td>
                                </tr>
                                <tr>
                                  <th scope="row">10</th>
                                  <td>Le tournoi de lutte de Vaizel</td>
                                  <td>バイゼル喧嘩祭り / Baizeru kenka matsuri</td>
                                  <td>07/12/2014</td>
                                </tr>
                                <tr>
                                  <th scope="row">11</th>
                                  <td>Des sentiments refoulés</td>
                                  <td>積年の想い / Sekinen no omoi</td>
                                  <td>14/12/2014</td>
                                </tr>
                                <tr>
                                  <th scope="row">12</th>
                                  <td>Un canon à te glacer le sang</td>
                                  <td>戦慄のカノン / Senritsu no kanon</td>
                                  <td>21/12/2014</td>
                                </tr>
                                <tr>
                                  <th scope="row">13</th>
                                  <td>L'ange de la destruction</td>
                                  <td>破壊の使徒 / Hakai no shito</td>
                                  <td>11/01/2015</td>
                                </tr>
                                <tr>
                                  <th scope="row">14</th>
                                  <td>Le lecteur</td>
                                  <td>本を読むひと/ Hon wo yomu hito</td>
                                  <td>18/01/2015</td>
                                </tr>
                                <tr>
                                  <th scope="row">15</th>
                                  <td>Le Chevalier impie</td>
                                  <td>アンホーリィ・ナイト/ Anhōryi Naito</td>
                                  <td>25/01/2015</td>
                                </tr>
                                <tr>
                                  <th scope="row">16</th>
                                  <td>Les légendes dans la tourmente</td>
                                  <td>駆りたてられる伝説たち/ Karitaterareru densetsu-tachi</td>
                                  <td>01/02/2015</td>
                                </tr>
                                <tr>
                                  <th scope="row">17</th>
                                  <td>Le premier sacrifice</td>
                                  <td>最初の犠牲/ Saisho no gisei</td>
                                  <td>08/02/2015</td>
                                </tr>
                                <tr>
                                  <th scope="row">18</th>
                                  <td>Même si cela doit me coûter la vie</td>
                                  <td>この命にかえても / Kono inochi ni kaete mo</td>
                                  <td>15/02/2015</td>
                                </tr>
                                <tr>
                                  <th scope="row">19</th>
                                  <td>Le roi des fées attend en vain</td>
                                  <td>まちぼうけの妖精王 / Machi bō ke no yōsei-ō</td>
                                  <td>22/02/2015</td>
                                </tr>
                                <tr>
                                  <th scope="row">20</th>
                                  <td>Le sortilège du courage</td>
                                  <td>勇気のまじない / Yūki no majinai</td>
                                  <td>01/03/2015</td>
                                </tr>
                                <tr>
                                  <th scope="row">21</th>
                                  <td>La menace est imminente</td>
                                  <td>今、そこにせまる脅威 / Ima, soko ni semaru kyōi</td>
                                  <td>08/03/2015</td>
                                </tr>
                                <tr>
                                  <th scope="row">22</th>
                                  <td>Je ferais tout pour toi</td>
                                  <td>君のためにできること / Kimi no tame ni dekiru koto</td>
                                  <td>15/03/2015</td>
                                </tr>
                                <tr>
                                  <th scope="row">23</th>
                                  <td>Lorsque survient le désespoir</td>
                                  <td>絶望降臨 / Zetsubō kōrin</td>
                                  <td>22/03/2015</td>
                                </tr>
                                <tr>
                                  <th scope="row">24</th>
                                  <td>Les Héros</td>
                                  <td>英雄たち / Eiyū-tachi</td>
                                  <td>29/03/2015</td>
                                </tr>
                              </tbody>
                            </table>
                            <table class="table table-bordered caption-top text-center"><h6>Saison 2</h6>
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
                                  <td>Trésor caché</td>
                                  <td>懐玉 / Kaigyoku</td>
                                  <td>06/07/2023</td>
                                </tr>
                                <tr>
                                  <th scope="row">2</th>
                                  <td>Trésor caché (2)</td>
                                  <td>懐玉－弐－ / Kaigyoku -Ni-</td>
                                  <td>13/07/2023</td>
                                </tr>
                                <tr>
                                  <th scope="row">3</th>
                                  <td>Trésor caché (3)</td>
                                  <td>懐玉－参－ / Kaigyoku -San-</td>
                                  <td>20/07/2023</td>
                                </tr>
                                <tr>
                                  <th scope="row">4</th>
                                  <td>Trésor caché (4)</td>
                                  <td>懐玉－肆－ / Kaigyoku -Shi-</td>
                                  <td>27/07/2023</td>
                                </tr>
                                <tr>
                                  <th scope="row">5</th>
                                  <td>Mort prématurée</td>
                                  <td>玉折 / Gyokusetsu</td>
                                  <td>03/08/2023</td>
                                </tr>
                                <tr>
                                  <th scope="row">6</th>
                                  <td>C'est bien ce que tu crois</td>
                                  <td>そういうこと / Sō iu koto</td>
                                  <td>31/08/2023</td>
                                </tr>
                                <tr>
                                  <th scope="row">7</th>
                                  <td>La veille de la fête</td>
                                  <td>宵祭り / Yoimatsuri</td>
                                  <td>07/09/2023</td>
                                </tr>
                                <tr>
                                  <th scope="row">8</th>
                                  <td>Le drame de Shibuya</td>
                                  <td>渋谷事変 / Shibuya jihen</td>
                                  <td>15/09/2023</td>
                                </tr>
                                <tr>
                                  <th scope="row">9</th>
                                  <td>Le drame de Shibuya - Ouverture</td>
                                  <td>渋谷事変 開門 / Shibuya jihen kaimon</td>
                                  <td>22/09/2023</td>
                                </tr>
                                <tr>
                                  <th scope="row">10</th>
                                  <td>Confusion</td>
                                  <td>混乱 / Konran</td>
                                  <td>29/09/2023</td>
                                </tr>
                                <tr>
                                  <th scope="row">11</th>
                                  <td>Invocation de l'âme</td>
                                  <td>降霊 /Kōrei</td>
                                  <td>06/10/2023</td>
                                </tr>
                                <tr>
                                  <th scope="row">12</th>
                                  <td>Lame émoussée</td>
                                  <td>鈍刀 / Dontō</td>
                                  <td>12/10/2023</td>
                                </tr>
                                <tr>
                                  <th scope="row">13</th>
                                  <td>Les écailles rouges</td>
                                  <td>赫鱗 / Sekirin</td>
                                  <td>19/10/2023</td>
                                </tr>
                                <tr>
                                  <th scope="row">14</th>
                                  <td>Oscillations (1)</td>
                                  <td>揺蕩 / Youtou</td>
                                  <td>26/10/2023</td>
                                </tr>
                                <tr>
                                  <th scope="row">15</th>
                                  <td>Oscillations (2)</td>
                                  <td>揺蕩-弐- / Youtou -Ni-</td>
                                  <td>02/11/2023</td>
                                </tr>
                                <tr>
                                  <th scope="row">16</th>
                                  <td>Un coup de tonnerre (1)</td>
                                  <td>雷鳴 / Raimei</td>
                                  <td>09/11/2023</td>
                                </tr>
                                <tr>
                                  <th scope="row">17</th>
                                  <td>Un coup de tonnerre (2)</td>
                                  <td>雷鳴-弐- / Raimei -Ni-</td>
                                  <td>16/11/2023</td>
                                </tr>
                                <tr>
                                  <th scope="row">18</th>
                                  <td>Le bien et le mal</td>
                                  <td>理非 / Rihi</td>
                                  <td>23/11/2023</td>
                                </tr>
                                <tr>
                                  <th scope="row">19</th>
                                  <td>Le bien et le mal (2)</td>
                                  <td>理非-弐- / Rihi -Ni-</td>
                                  <td>30/11/2023</td>
                                </tr>
                                <tr>
                                  <th scope="row">20</th>
                                  <td>Le bien et le mal (3)</td>
                                  <td>理非-参- / Rihi -San-</td>
                                  <td>07/12/2023</td>
                                </tr>
                                <tr>
                                  <th scope="row">21</th>
                                  <td>Métamorphose</td>
                                  <td>変身 / Henshin</td>
                                  <td>14/12/2023</td>
                                </tr>
                                <tr>
                                  <th scope="row">22</th>
                                  <td>Métamorphose (2)</td>
                                  <td>変身-弐- / Henshin -Ni-</td>
                                  <td>21/12/2023</td>
                                </tr>
                                <tr>
                                  <th scope="row">23</th>
                                  <td>Le drame de Shibuya - Fermeture</td>
                                  <td>渋谷事変 閉門 / Shibuya jihen heimon</td>
                                  <td>28/12/2023</td>
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
