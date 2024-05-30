<?php
session_start();
include "bd.php";

$isFavori = false;
$isInWatchlist = false;

if (isset($_SESSION['connected']) && $_SESSION['connected'] == 1 && isset($_GET['id'])) {
    $id = $_GET['id'];
    $utilisateur_id = $_SESSION['id_user'];

    // Vérifier si l'anime est dans les favoris
    $sqlFavori = 'SELECT * FROM favoris WHERE utilisateur_id = '.$utilisateur_id.' AND anime_id = '.$id;
    $tempFavori = $pdo->query($sqlFavori);
    if ($tempFavori->rowCount() > 0) {
        $isFavori = true;
    }

    // Vérifier si l'anime est dans la watchlist
    $sqlWatchlist = 'SELECT * FROM watchlist WHERE utilisateur_id = '.$utilisateur_id.' AND anime_id = '.$id;
    $tempWatchlist = $pdo->query($sqlWatchlist);
    if ($tempWatchlist->rowCount() > 0) {
        $isInWatchlist = true;
    }
}

if (isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = 'SELECT * FROM animes WHERE id='.$id;
    $temp = $pdo->query($sql);
    $resultats = $temp -> fetch();
    $sql2 = 'SELECT *, DATE_FORMAT(diffusion, "%d/%m/%Y") AS date FROM episodes_s1 WHERE id_anime='.$id.' ORDER BY episodes_s1.id';
    $temp2 = $pdo->query($sql2);
    $sql3 = 'SELECT *, DATE_FORMAT(diffusion, "%d/%m/%Y") AS date FROM episodes_s2 WHERE id_anime='.$id.' ORDER BY episodes_s2.id';
    $temp3 = $pdo->query($sql3);
    $sql4 = 'SELECT *, DATE_FORMAT(diffusion, "%d/%m/%Y") AS date FROM episodes_s3 WHERE id_anime='.$id.' ORDER BY episodes_s3.id';
    $temp4 = $pdo->query($sql4);
    $sql5 = 'SELECT *, DATE_FORMAT(diffusion, "%d/%m/%Y") AS date FROM episodes_sans_saisons WHERE id_anime='.$id.' ORDER BY episodes_sans_saisons.id';
    $temp5 = $pdo->query($sql5);
    $sql6 = 'SELECT *, DATE_FORMAT(diffusion, "%d/%m/%Y") AS date FROM episodes_speciaux WHERE id_anime='.$id.' ORDER BY episodes_speciaux.id';
    $temp6 = $pdo->query($sql6);
    $sql7 = 'SELECT *, DATE_FORMAT(diffusion, "%d/%m/%Y") AS date FROM episodes_s4 WHERE id_anime='.$id.' ORDER BY episodes_s4.id';
    $temp7 = $pdo->query($sql7);
}
if (isset($_POST['anime_id_favori'],$_POST['utilisateur_id_favori'])) {
  $utilisateur_id = $_POST['utilisateur_id_favori'];
  $animeId = $_POST['anime_id_favori'];
  $sql = 'SELECT * FROM favoris WHERE utilisateur_id = '.$utilisateur_id.' AND anime_id = '.$animeId;
  $temp = $pdo->query($sql);
  if ($temp->rowCount() > 0){
    $resultats = $temp->fetch();
    $sql2 = 'DELETE FROM favoris WHERE utilisateur_id = '.$utilisateur_id.' AND anime_id = '.$animeId;
    $pdo->exec($sql2);
    echo json_encode(['message' => 'supp']);
    exit;
  }
  else{
    $sql3 = 'INSERT INTO favoris (utilisateur_id,anime_id) VALUES ('.$utilisateur_id.','.$animeId.')';
    $pdo->exec($sql3);
    echo json_encode(['message' => 'new']);
    exit;
  }
}

if (isset($_POST['anime_id_watchlist'],$_POST['utilisateur_id_watchlist'])) {
  $utilisateur_id = $_POST['utilisateur_id_watchlist'];
  $animeId = $_POST['anime_id_watchlist'];
  $sql = 'SELECT * FROM watchlist WHERE utilisateur_id = '.$utilisateur_id.' AND anime_id = '.$animeId;
  $temp = $pdo->query($sql);
  if ($temp->rowCount() > 0){
    $resultats = $temp->fetch();
    $sql2 = 'DELETE FROM watchlist WHERE utilisateur_id = '.$utilisateur_id.' AND anime_id = '.$animeId;
    $pdo->exec($sql2);
    echo json_encode(['message' => 'supp']);
    exit;
  }
  else{
    $sql3 = 'INSERT INTO watchlist (utilisateur_id,anime_id) VALUES ('.$utilisateur_id.','.$animeId.')';
    $pdo->exec($sql3);
    echo json_encode(['message' => 'new']);
    exit;
  }
}
?>
<!doctype html>
<html lang="en">
    <head>
        <title><?php echo $resultats['titre']?></title>
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
        <link rel="stylesheet" href="loveanime.css">
        <script src="https://kit.fontawesome.com/cb5071b44a.js" crossorigin="anonymous"></script>
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    </head>

    <body>
        <header>
            <?php
            include "header.php"
            ?>
        </header>
        <main>
        <div class="card" style="background-color:#ebebeb">
            <div class="row g-0 w-100">
                <div class="col m-3 d-flex">
                    <?php
                    echo "<img src=".$resultats['img']." class='img-fluid rounded-start m-5' alt='image' title='image'>";
                    ?>
                </div>
                <div class='col-md-8'>
                    <div class='card-body text-start border m-5'>
                        <?php
                        echo "<h5 class='card-title'>".$resultats['titre']."</h5>";
                        echo "<p class='card-text'>Titre original : ".$resultats['titre_original'];
                        if ($resultats["type"] == "anime"){
                            echo "</br>Statut : ".$resultats['statut'];
                        }
                        echo "</br>Genres : ".$resultats['genres'];
                        echo "</br>Thèmes : ".$resultats['themes'];
                        echo "</br>Studio d'animation : ".$resultats['studio_animation'];
                        if ($resultats['streaming'] != ""){
                            echo "</br>Disponible sur   ".$resultats['streaming'];
                        }
                        if (isset($_SESSION['connected']) && $_SESSION['connected'] == 1) {
                          echo "<div class='ajouts'>";
                      
                          $heartClass = $isFavori ? "fa-solid fa-heart fa-xl" : "fa-regular fa-heart fa-xl";
                          $favoriText = $isFavori ? "Retirer de mes favoris" : "Ajouter à mes favoris";
                          echo "<button class='ajouter-favori' data-utilisateur-id='".$_SESSION['id_user']."' data-anime-id='".$id."'><i id='heart' class='$heartClass red'></i><p id='text-favori'>$favoriText</p></button>";
                      
                          $listClass = $isInWatchlist ? "bx bx-md bx-list-check" : "bx bx-md bx-list-plus";
                          $watchlistText = $isInWatchlist ? "Retirer de ma watchlist" : "Ajouter à ma watchlist";
                          echo "<button class='ajouter-watchlist' data-utilisateur-id='".$_SESSION['id_user']."' data-anime-id='".$id."'><i id='list' class='$listClass'></i><p id='text-watchlist'>$watchlistText</p></button>";
                      
                          echo "</div>";
                      }
                        ?>
                    </div>
                    <div class="card text-bg-light m-5">
                        <div class="card-header text-white" style="background-color: #4F76BB;">Synopsis</div>
                        <div class="card-body">
                        <?php echo "<p class='card-text'>".$resultats['synopsis']."</p>";?>
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
                                    <?php
                                    echo "<img style='height: 150px;' src='".$resultats['img_perso1']."' alt='".$resultats['nom_perso1']."' title='".$resultats['nom_perso1']."'>
                                    <p>".$resultats['nom_perso1']."</p>
                                    </div>
                                    <div class='col'>
                                    <img style='height: 150px;' src='".$resultats['img_perso2']."' alt='".$resultats['nom_perso2']."' title='".$resultats['nom_perso2']."'>
                                    <p>".$resultats['nom_perso2']."</p>
                                    </div>
                                    <div class='col'>
                                    <img style='height: 150px;' src='".$resultats['img_perso3']."' alt='".$resultats['nom_perso3']."' title='".$resultats['nom_perso3']."'>
                                    <p>".$resultats['nom_perso3']."</p>
                                    </div>
                                    <div class='col'>
                                    <img style='height: 150px;' src='".$resultats['img_perso4']."' alt='".$resultats['nom_perso4']."' title='".$resultats['nom_perso4']."'>
                                    <p>".$resultats['nom_perso4']."</p>
                                    </div>
                                    <div class='col'>
                                    <img style='height: 150px;' src='".$resultats['img_perso5']."' alt='".$resultats['nom_perso5']."' title='".$resultats['nom_perso5']."'>
                                    <p>".$resultats['nom_perso5']."</p>
                                    </div>
                                    <div class='col'>
                                    <img style='height: 150px;' src='".$resultats['img_perso6']."' alt='".$resultats['nom_perso6']."' title='".$resultats['nom_perso6']."'>
                                    <p>".$resultats['nom_perso6']."</p>
                                    </div>";?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    if ($resultats["type"] == "anime"){
                    echo '<div class="card text-bg-light mb-3">
                        <div class="card-header text-white" style="background-color: #4F76BB;">Episodes</div>
                        <div class="card-body" style="max-height: 300px;overflow-y: auto;">
                          <p class="card-text">';
                            if ($temp2->rowCount() > 0) {
                                echo "
                            <table class='table table-bordered caption-top text-center'><h6>Saison 1</h6>
                              <thead>
                                <tr>
                                  <th scope='col'>N°</th>
                                  <th scope='col'>Titre français</th>
                                  <th scope='col'>Titre japonais</th>
                                  <th scope='col'>Date</th>
                                </tr>
                              </thead>
                              <tbody>";
                                while ($resultats2 = $temp2 -> fetch()){
                                echo "
                                <tr>
                                  <th scope='row'>".$resultats2['numero']."</th>
                                  <td>".$resultats2['titre_francais']."</td>
                                  <td>".$resultats2['titre_japonais']."</td>
                                  <td>".$resultats2['date']."</td>
                                </tr>";
                                }}
                                ?>
                              </tbody>
                            </table>
                            <?php
                            if ($temp6->rowCount() > 0) {
                                echo "
                            <table class='table table-bordered caption-top text-center'><h6>Episodes spéciaux</h6>
                              <thead>
                                <tr>
                                  <th scope='col'>N°</th>
                                  <th scope='col'>Titre français</th>
                                  <th scope='col'>Titre japonais</th>
                                  <th scope='col'>Date</th>
                                </tr>
                              </thead>
                              <tbody>";
                                while ($resultats6 = $temp6 -> fetch()){
                                echo "
                                <tr>
                                  <th scope='row'>".$resultats6['numero']."</th>
                                  <td>".$resultats6['titre_francais']."</td>
                                  <td>".$resultats6['titre_japonais']."</td>
                                  <td>".$resultats6['date']."</td>
                                </tr>";
                                }}
                                ?>
                              </tbody>
                            </table>
                            <?php
                            if ($temp5->rowCount() > 0) {
                                echo "
                            <table class='table table-bordered caption-top text-center'>
                              <thead>
                                <tr>
                                  <th scope='col'>N°</th>
                                  <th scope='col'>Titre français</th>
                                  <th scope='col'>Titre japonais</th>
                                  <th scope='col'>Date</th>
                                </tr>
                              </thead>
                              <tbody>";
                                while ($resultats5 = $temp5 -> fetch()){
                                echo "
                                <tr>
                                  <th scope='row'>".$resultats5['numero']."</th>
                                  <td>".$resultats5['titre_francais']."</td>
                                  <td>".$resultats5['titre_japonais']."</td>
                                  <td>".$resultats5['date']."</td>
                                </tr>";
                                }}
                                ?>
                              </tbody>
                            </table>
                            <?php
                            if ($temp3->rowCount() > 0) {
                                echo "
                            <table class='table table-bordered caption-top text-center'><h6>Saison 2</h6>
                              <thead>
                                <tr>
                                  <th scope='col'>N°</th>
                                  <th scope='col'>Titre français</th>
                                  <th scope='col'>Titre japonais</th>
                                  <th scope='col'>Date</th>
                                </tr>
                              </thead>
                              <tbody>";
                                while ($resultats3 = $temp3 -> fetch()){
                                echo "
                                <tr>
                                  <th scope='row'>".$resultats3['numero']."</th>
                                  <td>".$resultats3['titre_francais']."</td>
                                  <td>".$resultats3['titre_japonais']."</td>
                                  <td>".$resultats3['date']."</td>
                                </tr>";
                                }
                                echo "
                              </tbody>
                            </table>";
                            }
                            ?>
                            <?php
                            if ($temp4->rowCount() > 0) {
                                echo "
                            <table class='table table-bordered caption-top text-center'><h6>Saison 3</h6>
                              <thead>
                                <tr>
                                  <th scope='col'>N°</th>
                                  <th scope='col'>Titre français</th>
                                  <th scope='col'>Titre japonais</th>
                                  <th scope='col'>Date</th>
                                </tr>
                              </thead>
                              <tbody>";
                                while ($resultats4 = $temp4 -> fetch()){
                                echo "
                                <tr>
                                  <th scope='row'>".$resultats4['numero']."</th>
                                  <td>".$resultats4['titre_francais']."</td>
                                  <td>".$resultats4['titre_japonais']."</td>
                                  <td>".$resultats4['date']."</td>
                                </tr>";
                                }
                                echo "
                              </tbody>
                            </table>";
                            }
                            ?>
                            <?php
                            if ($temp7->rowCount() > 0) {
                                echo "
                            <table class='table table-bordered caption-top text-center'><h6>Saison 4</h6>
                              <thead>
                                <tr>
                                  <th scope='col'>N°</th>
                                  <th scope='col'>Titre français</th>
                                  <th scope='col'>Titre japonais</th>
                                  <th scope='col'>Date</th>
                                </tr>
                              </thead>
                              <tbody>";
                                while ($resultats7 = $temp7 -> fetch()){
                                echo "
                                <tr>
                                  <th scope='row'>".$resultats7['numero']."</th>
                                  <td>".$resultats7['titre_francais']."</td>
                                  <td>".$resultats7['titre_japonais']."</td>
                                  <td>".$resultats7['date']."</td>
                                </tr>";
                                }
                                echo "
                              </tbody>
                            </table>";
                            }
                            }
                            ?>
        </main>
        <footer>
            <?php
            include "footer.php"
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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js" crossorigin="anonymous"></script>
        <script>
            $(document).ready(function() {
              $(".ajouter-favori").click(function() {
                  var button = $(this);
                  var data = {
                      anime_id_favori: button.data("anime-id"),
                      utilisateur_id_favori: button.data("utilisateur-id")
                  };
                  
                  $.ajax({
                      type: "POST",
                      url: "info_anime.php",
                      data: data,
                      success: function(response) {
                          console.log(response);
                          if (response === '{"message":"new"}') {
                              updateFavoriIcon(true, button);
                              button.find("#text-favori").text('Retirer de mes favoris');
                          } else if (response === '{"message":"supp"}') {
                              updateFavoriIcon(false, button);
                              button.find("#text-favori").text('Ajouter à mes favoris');
                          }
                      },
                      error: function(xhr, status, error) {
                          console.error(error);
                      }
                  });
              });

              function updateFavoriIcon(isFilled, button) {
                  var icon = button.find("#heart");
                  if (isFilled) {
                      icon.removeClass("fa-regular fa-heart fa-xl").addClass("fa-solid fa-heart fa-xl");
                  } else {
                      icon.removeClass("fa-solid fa-heart fa-xl").addClass("fa-regular fa-heart fa-xl");
                  }
              }

              $(".ajouter-watchlist").click(function() {
                  var button = $(this);
                  var data = {
                      anime_id_watchlist: button.data("anime-id"),
                      utilisateur_id_watchlist: button.data("utilisateur-id")
                  };
                  
                  $.ajax({
                      type: "POST",
                      url: "info_anime.php",
                      data: data,
                      success: function(response) {
                          console.log(response);
                          if (response === '{"message":"new"}') {
                              updateWatchlistIcon(true, button);
                              button.find("#text-watchlist").text('Retirer de ma watchlist');
                          } else if (response === '{"message":"supp"}') {
                              updateWatchlistIcon(false, button);
                              button.find("#text-watchlist").text('Ajouter à ma watchlist');
                          }
                      },
                      error: function(xhr, status, error) {
                          console.error(error);
                      }
                  });
              });

              function updateWatchlistIcon(isFilled, button) {
                  var icon = button.find("#list");
                  if (isFilled) {
                      icon.removeClass("bx bx-md bx-list-plus").addClass("bx bx-md bx-list-check");
                  } else {
                      icon.removeClass("bx bx-md bx-list-check").addClass("bx bx-md bx-list-plus");
                  }
              }
          });

        </script>
    </body>
</html>