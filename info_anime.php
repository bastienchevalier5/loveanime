<?php
session_start();
include "bd.php";
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
        <link rel="stylesheet" href="CSS/loveanime.css">
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
                <div class="col m-3">
                    <?php
                    echo "<img style='width:350px' src=".$resultats['img']." class='img-fluid rounded-start h-100 ms-5' alt='image' title='image'>";
                    ?>
                </div>
                <div class='col-md-8'>
                    <div class='card-body text-start border m-5'>
                        <?php
                        echo "<h5 class='card-title'>".$resultats['titre']."</h5>";
                        echo "<p class='card-text'>Titre original :".$resultats['titre_original'];
                        echo "</br>Statut : ".$resultats['statut'];
                        echo "</br>Genres : ".$resultats['genres'];
                        echo "</br>Thèmes : ".$resultats['themes'];
                        echo "</br>Studio d'animation : ".$resultats['studio_animation'];
                        echo "</br>Disponible sur : ".$resultats['streaming'];
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
                                    echo "<img style='height: 150px;' src='".$resultats['img_perso1']."' alt='perso1' title='perso1'>
                                    <p>".$resultats['nom_perso1']."</p>
                                    </div>
                                    <div class='col'>
                                    <img style='height: 150px;' src='".$resultats['img_perso2']."' alt='perso2' title='perso2'>
                                    <p>".$resultats['nom_perso2']."</p>
                                    </div>
                                    <div class='col'>
                                    <img style='height: 150px;' src='".$resultats['img_perso3']."' alt='perso3' title='perso3'>
                                    <p>".$resultats['nom_perso3']."</p>
                                    </div>
                                    <div class='col'>
                                    <img style='height: 150px;' src='".$resultats['img_perso4']."' alt='perso4' title='perso4'>
                                    <p>".$resultats['nom_perso4']."</p>
                                    </div>
                                    <div class='col'>
                                    <img style='height: 150px;' src='".$resultats['img_perso5']."' alt='perso5' title='perso5'>
                                    <p>".$resultats['nom_perso5']."</p>
                                    </div>
                                    <div class='col'>
                                    <img style='height: 150px;' src='".$resultats['img_perso6']."' alt='perso6' title='perso6'>
                                    <p>".$resultats['nom_perso6']."</p>
                                    </div>";?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card text-bg-light mb-3">
                        <div class="card-header text-white" style="background-color: #4F76BB;">Episodes</div>
                        <div class="card-body" style="max-height: 300px;overflow-y: auto;">
                          <p class="card-text">
                          <?php
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
    </body>
</html>