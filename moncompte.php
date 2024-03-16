<?php
session_start();
include("bd.php");
if (isset($_SESSION['connected']) && $_SESSION['connected'] == 1) {
} else {
  header("Location: connexion.php");
}
$sql = 'SELECT nom, prenom, nom_utilisateur, mail FROM comptes WHERE id=' . $_SESSION['id_user'];
$temp = $pdo->query($sql);
$resultat = $temp->fetch();
$nom = $resultat['nom'];
$prenom = $resultat['prenom'];
$nom_utilisateur = $resultat['nom_utilisateur'];
$mail = $resultat['mail'];
if (isset($_POST['nom'],$_POST['prenom'],$_POST['nom_utilisateur'],$_POST['mail'],$_POST['mdp'])){
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $nom_utilisateur = $_POST['nom_utilisateur'];
    $mail = $_POST['mail'];
    $mdp = password_hash($_POST['mdp'],PASSWORD_DEFAULT);
    $sql2 = 'UPDATE comptes SET nom = "'.$nom.'", prenom = "'.$prenom.'", nom_utilisateur = "'.$nom_utilisateur.'", mail = "'.$mail.'", mdp = "'.$mdp.'" WHERE id ='.$_SESSION['id_user'];
    $temp2 = $pdo->exec($sql2);
}
$sql3 = 'SELECT * FROM favoris,animes WHERE utilisateur_id='.$_SESSION['id_user'].' AND anime_id = animes.id';
$temp3 = $pdo->query($sql3);
$sql4 = 'SELECT * FROM watchlist,animes WHERE utilisateur_id='.$_SESSION['id_user'].' AND anime_id = animes.id';
$temp4 = $pdo->query($sql4);
?>

<!doctype html>
<html lang="en">
    <head>
        <title>Mon compte</title>
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
            include("header.php");
            ?>
        </header>
        <main>
            <div class="moncompte">
                <h1 class="text-center">Compte de <?php echo $nom_utilisateur ?></h1>
                
                <div class="profil">
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Profil</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Mes favoris</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Ma Watchlist</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
                            <form class="col g-3 m-5" action="" method="post" id="modifier">
                                <h2 class="m-3 text-center">Modification de mes informations</h2>
                                <div class="col-md-12 m-3">  
                                    <label for="validationServer01" class="form-label">Nom</label>
                                    <input type="text" name="nom" class="form-control" id="validationServer01" value="<?=$nom?>">
                                </div>
                                <div class="col-md-12 m-3">
                                    <label for="validationServer02" class="form-label">Prénom</label>
                                    <input type="text" name="prenom" class="form-control" id="validationServer02" value="<?=$prenom?>">
                                </div>
                                <div class="col-md-12 m-3">
                                    <label for="validationServerUsername" class="form-label">Nom d'utilisateur</label>
                                    <div class="input-group has-validation">
                                        <span class="input-group-text" id="inputGroupPrepend3">@</span>
                                        <input type="text" name="nom_utilisateur" class="form-control" id="validationServerUsername" aria-describedby="inputGroupPrepend3 validationServerUsernameFeedback" value="<?=$nom_utilisateur?>">
                                    </div>
                                </div>
                                <div class="col-md-12 m-3">
                                    <label for="validationServer03" class="form-label">Adresse mail</label>
                                    <input type="email" name="mail" class="form-control" id="validationServer03" value="<?=$mail?>">
                                </div>
                                <div class="col-md-12 m-3">
                                    <label for="exampleInputPassword1" class="form-label">Mot de passe</label>
                                    <input type="password" name="mdp" class="form-control" id="exampleInputPassword1" placeholder="Nouveau mot de passe">
                                </div>
                                <div class="col-12 m-3 text-center">
                                    <button class="btn btn-primary" onclick="alert('Vos informations ont bien été modifiés')" type="submit">Modifier</button>
                                </div>
                            </form>
                            <div class="col-12 ms-4 text-center">
                                <a href="delete.php?id=<?=$_SESSION['id_user']?>" onclick="alert('Voulez-vous vraiment supprimer ce compte?')" class="btn btn-danger text-center">Supprimer mon compte</a>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
                            <div>
                                <?php
                                while ($resultats3 = $temp3->fetch()){
                                    echo "<div class='card-animes'>";
                                    echo "<a href='info_anime.php?id=".$resultats3['id']."'><img style='width: 350px;height: 500px' src='".$resultats3['img']."' class='card-img-bottom' alt='anime' title='anime'>";
                                    echo "<div class='card-body' style='box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);height:500px;width:250px'>";
                                    echo "<h2 class='card-title-animes'>".$resultats3['titre']."</h2>";
                                    echo "<p class='card-text-animes'>".$resultats3['synopsis']."</p>";
                                    echo '</a>';
                                    echo '</div>';
                                    echo '</div>';
                                }
                                ?>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab" tabindex="0">
                            <div>
                            <?php
                                while ($resultats4 = $temp4->fetch()){
                                    echo "<div class='card-animes'>";
                                    echo "<a href='info_anime.php?id=".$resultats4['id']."'><img style='width: 350px;height: 500px' src='".$resultats4['img']."' class='card-img-bottom' alt='anime' title='anime'>";
                                    echo "<div class='card-body' style='box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);height:500px;width:250px'>";
                                    echo "<h2 class='card-title-animes'>".$resultats4['titre']."</h2>";
                                    echo "<p class='card-text-animes'>".$resultats4['synopsis']."</p>";
                                    echo '</a>';
                                    echo '</div>';
                                    echo '</div>';
                                }
                                ?>
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
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $('#pills-tab').on('click', '.nav-link', function () {
            $('.tab-pane').addClass('d-none'); // Masquer tous les contenus d'onglet
            $($(this).attr('data-bs-target')).removeClass('d-none'); // Afficher le contenu d'onglet correspondant
            });
        </script>

    </body>
</html>
