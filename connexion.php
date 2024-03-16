<?php
session_start();
include("bd.php");

if (isset($_SESSION['connected']) && $_SESSION['connected'] == 1) {
    header("Location: index.php");
    exit(); // Terminer l'exécution du script après la redirection
}

if (isset($_POST['nom_utilisateur'], $_POST['mdp'])) {
    $nom_utilisateur = $_POST['nom_utilisateur'];
    $mdp = $_POST['mdp'];

    // Requête pour obtenir les informations de l'utilisateur
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
        exit(); // Terminer l'exécution du script après la redirection
    } else {
        $_SESSION['connected'] = 0;
        header("Location: connexion.php?erreur=1");
        exit(); // Terminer l'exécution du script après la redirection
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <title>Connexion</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="CSS/loveanime.css">
</head>

<body>
    <header>
        <?php include("header.php"); ?>
    </header>

    <main>
        <div class="inscription">
            <form class="col g-3 m-5" action="#" method="post">
                <h1 class="m-3 text-center">Connexion</h1>
                <?php
                if (isset($_REQUEST['erreur']) && $_REQUEST['erreur'] == 1) {
                    echo '<h3>Identifiant ou mot de passe incorrect</h3>';
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
                <div class="col-12 m-3">
                    <button class="btn btn-primary" type="submit">Se connecter</button>
                </div>
            </form>
        </div>
    </main>

    <footer>
        <?php include("footer.php"); ?>
    </footer>

    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
</body>
</html>
