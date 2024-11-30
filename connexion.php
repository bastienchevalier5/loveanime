<?php
session_start();
include("bd.php");
if (isset($_SESSION['connected']) && $_SESSION['connected'] == 1) {
    header("Location: index.php");
}
if (isset($_POST['nom_utilisateur'], $_POST['mdp'])) {
    $nom_utilisateur = $_POST['nom_utilisateur'];
    $mdp = $_POST['mdp'];

    $sql = "SELECT * FROM comptes WHERE nom_utilisateur = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nom_utilisateur]);
    $user = $stmt->fetch();

    if ($user && password_verify($mdp, $user['mdp'])) {
        $_SESSION['connected'] = 1;
        $_SESSION['id_user'] = $user['id'];
        $_SESSION['nom_utilisateur'] = $user['nom_utilisateur'];
        $_SESSION['mdp'] = $user['mdp'];
        header("Location: moncompte.php");
    } else {
        $_SESSION['connected'] = 0;
        header("Location: connexion.php?erreur=1");
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
        <link rel="stylesheet" href="loveanime.css">
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
                    <h2 class="m-3 text-center">Connexion</h2>
                    <?php
                    if (isset($_REQUEST['erreur']) && $_REQUEST['erreur'] == 1) {
                    echo '<h3>Identifiant ou mot de passe incorrect </h3>';
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
                    <div class="col-12 m-3" style="display:flex;justify-content:center" >
                    <button class="form-bouton" type="submit">Se connecter</button>
                    </div>
                </form>
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
