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
                            <table class="table table-bordered caption-top text-center"><h6>Episodes spéciaux - Signs of Holy War</h6>
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
                                  <td>Signs of Holy War - Le rêve noir débute</td>
                                  <td>黒き夢のはじまり / Kuroki yume no hajimari</td>
                                  <td>28/08/2016</td>
                                </tr>
                                <tr>
                                  <th scope="row">2</th>
                                  <td>Signs of Holy War - Notre foire du combat à tous les deux !</td>
                                  <td>二人の喧嘩祭り / Futari no kenka matsuri</td>
                                  <td>04/09/2016</td>
                                </tr>
                                <tr>
                                  <th scope="row">3</th>
                                  <td>Signs of Holy War - À la recherche du premier amour !</td>
                                  <td>初恋を追いかけて / Hatsukoi wo oikakete</td>
                                  <td>11/09/2016</td>
                                </tr>
                                <tr>
                                  <th scope="row">4</th>
                                  <td>Signs of Holy War - Les formes de l’amour</td>
                                  <td>愛のかたち / Ai no katachi</td>
                                  <td>18/09/2016</td>
                                </tr>
                              </tbody>
                            </table>
                            <table class="table table-bordered caption-top text-center"><h6>Saison 2 - Revival of the Commandments</h6>
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
                                  <th scope="row">0</th>
                                  <td>Les Seven Deadly Sins - La renaissance des commandements - Prologue</td>
                                  <td>七つの大罪 戒めの復活 -序章- / Nanatsu no Taizai Imashime no Fukkatsu -Joshō-</td>
                                  <td>06/01/2018</td>
                                </tr>
                                <tr>
                                  <th scope="row">1</th>
                                  <td>Le retour du clan des démons</td>
                                  <td>魔神族復活 / Majin-zoku fukkatsu</td>
                                  <td>13/01/2018</td>
                                </tr>
                                <tr>
                                  <th scope="row">2</th>
                                  <td>Existence et preuve</td>
                                  <td>存在と証明 / Sonzai to Shōmei</td>
                                  <td>20/01/2018</td>
                                </tr>
                                <tr>
                                  <th scope="row">3</th>
                                  <td>Trésor sacré : Lostvayne</td>
                                  <td>神器ロストヴェイン / Jingi Rosutovuein</td>
                                  <td>27/01/2018</td>
                                </tr>
                                <tr>
                                  <th scope="row">4</th>
                                  <td>Les Dix Commandements en mouvement</td>
                                  <td>〈十戒〉始動 / "〈Jikkai〉Shidō"</td>
                                  <td>03/02/2018</td>
                                </tr>
                                <tr>
                                  <th scope="row">5</th>
                                  <td>Violence Absolue</td>
                                  <td>圧倒的暴力 / Attōteki Bōryoku</td>
                                  <td>10/02/2018</td>
                                </tr>
                                <tr>
                                  <th scope="row">6</th>
                                  <td>Le Grand Chevalier Sacré repenti</td>
                                  <td>償いの聖騎士長 / Tsugunai no Seikishi-chō</td>
                                  <td>17/02/2018</td>
                                </tr>
                                <tr>
                                  <th scope="row">7</th>
                                  <td>Là où les souvenirs s'éveillent</td>
                                  <td>記憶が目指す場所 / Kioku ga Mezasu Basho</td>
                                  <td>24/02/2018</td>
                                </tr>
                                <tr>
                                  <th scope="row">8</th>
                                  <td>La Terre Sainte des Druides</td>
                                  <td>ドルイドの聖地 / Doruido no Seichi</td>
                                  <td>03/03/2018</td>
                                </tr>
                                <tr>
                                  <th scope="row">9</th>
                                  <td>La Promesse Faite à Celle Que J’aime</td>
                                  <td>愛する者との約束 / Ai suru Mono to no Yakusoku</td>
                                  <td>10/03/2018</td>
                                </tr>
                                <tr>
                                  <th scope="row">10</th>
                                  <td>Ce qu'il nous manquent</td>
                                  <td>僕 た ち に け の の の / Bokutachi ni Kaketa Mono</td>
                                  <td>17/03/2018</td>
                                </tr>
                                <tr>
                                  <th scope="row">11</th>
                                  <td>Père et fils</td>
                                  <td>父親と息子 /Chichioya to Musuko</td>
                                  <td>24/03/2018</td>
                                </tr>
                                <tr>
                                  <th scope="row">12</th>
                                  <td>Là, où se trouve l'amour</td>
                                  <td>愛の在り処 / Ai no Arika</td>
                                  <td>31/03/2018</td>
                                </tr>
                                <tr>
                                  <th scope="row">13</th>
                                  <td>Adieu, bandit de mon cœur</td>
                                  <td>さらば愛しき盗賊 / Saraba Itoshiki Tōzoku</td>
                                  <td>14/04/2018</td>
                                </tr>
                                <tr>
                                  <th scope="row">14</th>
                                  <td>Le maître du Soleil</td>
                                  <td>太陽の主 / Taiyō no Aruji</td>
                                  <td>21/04/2018</td>
                                </tr>
                                <tr>
                                  <th scope="row">15</th>
                                  <td>Le frisson de la déclaration</td>
                                  <td>戦慄の告白 / Senritsu no Kokuhaku</td>
                                  <td>28/04/2018</td>
                                </tr>
                                <tr>
                                  <th scope="row">16</th>
                                  <td>Le Labyrinthe du Piège Mortel</td>
                                  <td>死の罠の迷宮 / Shi no Wana no Meikyū</td>
                                  <td>05/05/2018</td>
                                </tr>
                                <tr>
                                  <th scope="row">17</th>
                                  <td>Ceux de la légende</td>
                                  <td>伝承の者共 / Denshō no Monodomo</td>
                                  <td>12/05/2018</td>
                                </tr>
                                <tr>
                                  <th scope="row">18</th>
                                  <td>Cette lumière pour le bien d'un autre</td>
                                  <td>その光は誰が為に / Sono Hikari wa Ta ga tame ni</td>
                                  <td>19/05/2018</td>
                                </tr>
                                <tr>
                                  <th scope="row">19</th>
                                  <td>Meliodas vs Les Dix Commandements</td>
                                  <td>メリオダスvs<十戒> / Meriodasu vs <Jikkai></td>
                                  <td>26/05/2018</td>
                                </tr>
                                <tr>
                                  <th scope="row">20</th>
                                  <td>À la recherche de l’espoir</td>
                                  <td>希望を求めて / Kibō wo Motomete</td>
                                  <td>02/06/2018</td>
                                </tr>
                                <tr>
                                  <th scope="row">21</th>
                                  <td>Une chaleur certaine</td>
                                  <td>たしかな ぬくもり / Tashika na Nukumori</td>
                                  <td>09/06/2018</td>
                                </tr>
                                <tr>
                                  <th scope="row">22</th>
                                  <td>Le retour du péché</td>
                                  <td>〈罪〉の帰還 / Tsumi no Kikan</td>
                                  <td>16/06/2018</td>
                                </tr>
                                <tr>
                                  <th scope="row">23</th>
                                  <td>Héros, debout !</td>
                                  <td>英雄、立つ！ / Eiyū, Tatsu!</td>
                                  <td>23/06/2018</td>
                                </tr>
                                <tr>
                                  <th scope="row">24</th>
                                  <td>Tant que tu es là</td>
                                  <td>君がいるだけで / Kimi ga Iru Dake de</td>
                                  <td>30/06/2018</td>
                                </tr>
                              </tbody>
                            </table>
                            <table class="table table-bordered caption-top text-center"><h6>Saison 3 - Wrath of the Gods</h6>
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
                                  <td>La lumière qui chasse les ténèbres</td>
                                  <td>闇を払う光 / Yami wo Harau Hikari</td>
                                  <td>09/10/2019</td>
                                </tr>
                                <tr>
                                  <th scope="row">2</th>
                                  <td>Les souvenirs de la Guerre Sainte</td>
                                  <td>聖戦の記憶 / Seisen no Kioku</td>
                                  <td>16/10/2019</td>
                                </tr>
                                <tr>
                                  <th scope="row">3</th>
                                  <td>Que la lumière soit</td>
                                  <td>光あれ / Hikari Are</td>
                                  <td>23/10/2019</td>
                                </tr>
                                <tr>
                                  <th scope="row">4</th>
                                  <td>Hurlement des bêtes sauvages</td>
                                  <td>獣吼える / Yajū Hoeru</td>
                                  <td>30/10/2019</td>
                                </tr>
                                <tr>
                                  <th scope="row">5</th>
                                  <td>Maelstrom de sentiments</td>
                                  <td>感情メイルシュトローム / Kanjō Meirushutorōmu</td>
                                  <td>06/11/2019</td>
                                </tr>
                                <tr>
                                  <th scope="row">6</th>
                                  <td>C'est ce qu'on appelle l'amour</td>
                                  <td>それをボクらは愛と呼ぶ / Sore wo Bokura wa Ai to Yobu</td>
                                  <td>13/11/2019</td>
                                </tr>
                                <tr>
                                  <th scope="row">7</th>
                                  <td>La Réunion des Sept Pêchés Capitaux</td>
                                  <td>いざ、大罪集結へ！！ / Iza, Taizai Shūketsu e!!</td>
                                  <td>20/11/2019</td>
                                </tr>
                                <tr>
                                  <th scope="row">8</th>
                                  <td>La poupée recherche l'amour</td>
                                  <td>人形は愛を乞う / Ningyō wa Ai wo Kou</td>
                                  <td>27/11/2019</td>
                                </tr>
                                <tr>
                                  <th scope="row">9</th>
                                  <td>Les amants maudits</td>
                                  <td>呪われし恋人たち / Norowareshi Koibito-tachi</td>
                                  <td>04/12/2019</td>
                                </tr>
                                <tr>
                                  <th scope="row">10</th>
                                  <td>C'est notre mode de vie</td>
                                  <td>それが僕らの生きる道  / Sore ga Bokura no Ikirumichi</td>
                                  <td>11/12/2019</td>
                                </tr>
                                <tr>
                                  <th scope="row">11</th>
                                  <td>L'odieux ne peut se reposer</td>
                                  <td>怨念たちは眠らない / Onnen-tachi wa Nemuranai</td>
                                  <td>18/12/2019</td>
                                </tr>
                                <tr>
                                  <th scope="row">12</th>
                                  <td>Les jeunes filles puisent leur force dans l'amour</td>
                                  <td>愛は乙女の力 / Ai wa Otome no Chikara</td>
                                  <td>25/12/2019</td>
                                </tr>
                                <tr>
                                  <th scope="row">13</th>
                                  <td>Le tout-puissant contre le mal absolu</td>
                                  <td>最強 vs. 最凶 / Saikyō vs. Saikyō</td>
                                  <td>08/01/2020</td>
                                </tr>
                                <tr>
                                  <th scope="row">14</th>
                                  <td>Une nouvelle menace</td>
                                  <td>新たなる脅威/ Aratanaru Kyōi</td>
                                  <td>15/01/2020</td>
                                </tr>
                                <tr>
                                  <th scope="row">15</th>
                                  <td>Pour notre capitaine</td>
                                  <td>団長へ / Danchō e</td>
                                  <td>22/01/2020</td>
                                </tr>
                                <tr>
                                  <th scope="row">16</th>
                                  <td>La dissolution des Sept Péchés Capitaux</td>
                                  <td>七つの大罪〉終結 / Nanatsu no Taizai Shūketsu</td>
                                  <td>29/01/2020</td>
                                </tr>
                                <tr>
                                  <th scope="row">17</th>
                                  <td>Notre choix</td>
                                  <td>ボクたちの選択 / Boku-tachi no Sentaku</td>
                                  <td>05/02/2020</td>
                                </tr>
                                <tr>
                                  <th scope="row">18</th>
                                  <td>La marche des saints</td>
                                  <td>聖者の行進 / Seija no Kōshin</td>
                                  <td>12/02/2020</td>
                                </tr>
                                <tr>
                                  <th scope="row">19</th>
                                  <td>Le traité de la Guerre sainte</td>
                                  <td>聖戦協定 / Seisen Kyōtei</td>
                                  <td>19/02/2020</td>
                                </tr>
                                <tr>
                                  <th scope="row">20</th>
                                  <td>L'enfant de l'espoir</td>
                                  <td>希望の子 / Kibō no Ko</td>
                                  <td>26/02/2020</td>
                                </tr>
                                <tr>
                                  <th scope="row">21</th>
                                  <td>La colère impériale des dieux</td>
                                  <td>聖戦の幕開け / Seisen no Makuake</td>
                                  <td>04/03/2020</td>
                                </tr>
                                <tr>
                                  <th scope="row">22</th>
                                  <td>Britannia en guerre</td>
                                  <td>戦渦のブリタニア / Senka no Buritania</td>
                                  <td>11/03/2020</td>
                                </tr>
                                <tr>
                                  <th scope="row">23</th>
                                  <td>Se tordre dans les ténèbres</td>
                                  <td>闇に歪む者 / Yami ni Yugamu Mono</td>
                                  <td>18/03/2020</td>
                                </tr>
                                <tr>
                                  <th scope="row">24</th>
                                  <td>Amour effréné</td>
                                  <td>暴走する愛 / Bōsō suru Ai</td>
                                  <td>25/03/2020</td>
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
