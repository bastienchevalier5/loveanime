<?php
session_start();
include "bd.php";
if (isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = 'SELECT * FROM films WHERE id='.$id;
    $temp = $pdo->query($sql);
    $resultats = $temp -> fetch();
}


?>
<!doctype html>
<html lang="en">
    <head>
        <title><?php echo $resultats['titre_film']?></title>
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
                    echo "<img style='width:300px' src=".$resultats['img']." class='img-fluid rounded-start h-100 ms-5' alt='image' title='image'>";
                    ?>
                </div>
                <div class='col-md-8'>
                    <div class='card-body text-start border m-5' style=' margin-left:50px'>
                        <?php
                        echo "<h5 class='card-title'>".$resultats['titre']."</h5>";
                        echo "<p class='card-text'>Titre original :".$resultats['titre_original'];
                        echo "</br>Durée : ".$resultats['duree'];
                        echo "</br>Réalisateur : ".$resultats['realisateur'];
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