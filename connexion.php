<?php
session_start();
include("bd.php");
if (isset($_SESSION['connected'])) {
    header("Location: index.php");
}
if (isset($_POST['nom_utilisateur'], $_POST['mdp'])) {
    $sql = "SELECT * FROM comptes";
    $temp = $pdo->query($sql);
    $nom_utilisateur = '';
    $mdp = '';
    $id_user = '';
    while ($resultats = $temp->fetch()) {
        $id_user = $resultats['id'];
        $nom_utilisateur = $resultats['nom_utilisateur'];
        $mdp = $resultats['mdp'];
        echo $resultats['id'];
        echo $resultats['nom_utilisateur'];
        echo $resultats['mdp'];
        if ($_POST['nom_utilisateur'] == $nom_utilisateur && password_verify($_POST['mdp'],$resultats['mdp'])) {
            $_SESSION['connected'] = true;
            $_SESSION['id_user'] = $id_user; // Set the id_user session variable
            $_SESSION['nom_utilisateur'] = $nom_utilisateur;
            $_SESSION['mdp'] = $mdp;
            header("Location: index.php");
        } else {
            $_SESSION['connected'] = 0;
            }   
    }
}

?>
<!doctype html>
<html lang="en">
    <head>
        <title>Connexion</title>
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
            <div class="inscription">
                <form class="col g-3 m-5" action="#" method="post">
                    <h2 class="m-3">Connexion</h2>
                    <?php
                    if (isset($_REQUEST['erreur']) && $_REQUEST['erreur'] == 1) {
                    echo '<h3 style="color: red;"> Identifiant ou mot de passe incorrect </h3>';
                    }
                    ?>
                    <div class="col-md-12 m-3">
                        <label for="validationServerUsername" class="form-label">Nom d'utilisateur</label>
                        <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend3">@</span>
                        <input type="text" name="nom_utilisateur" class="form-control" id="validationServerUsername" aria-describedby="inputGroupPrepend3 validationServerUsernameFeedback" required>
                        </div>
                    </div>
                    <div class="col-md-12 m-3">
                        <label for="exampleInputPassword1" class="form-label">Mot de passe</label>
                        <input type="password" name="mdp" class="form-control" id="exampleInputPassword1" required>
                    </div>
                    <div class="mb-3 form-check m-3">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Se souvenir</label>
                    </div>
                    <div class="col-12 m-3">
                    <button class="btn btn-primary" type="submit">Se connecter</button>
                    </div>
                </form></div>
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
