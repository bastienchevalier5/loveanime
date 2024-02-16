<?php
include("bd.php");
?>
<!doctype html>
<html lang="en">
    <head>
        <title>Inscription</title>
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
                <form class="col g-3 m-5" action="index.php" method="post">
                    <h2 class="m-3">Inscription</h2>
                    <div class="col-md-12 m-3">  
                        <label for="validationServer01" class="form-label">Nom</label>
                        <input type="text" name="nom" class="form-control" id="validationServer01" required>
                    </div>
                    <div class="col-md-12 m-3">
                        <label for="validationServer02" class="form-label">Prénom</label>
                        <input type="text" name="prenom" class="form-control" id="validationServer02" required>
                    </div>
                    <div class="col-md-12 m-3">
                        <label for="validationServerUsername" class="form-label">Nom d'utilisateur</label>
                        <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend3">@</span>
                        <input type="text" name="nom_utilisateur" class="form-control" id="validationServerUsername" aria-describedby="inputGroupPrepend3 validationServerUsernameFeedback" required>
                        </div>
                    </div>
                    <div class="col-md-12 m-3">
                        <label for="validationServer03" class="form-label">Adresse mail</label>
                        <input type="email" name="mail" class="form-control" id="validationServer03" required>
                        <div id="emailHelp" class="form-text">Nous ne partagerons jamais votre adresse mail</div>
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
                        <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="invalidCheck3" aria-describedby="invalidCheck3Feedback" required>
                        <label class="form-check-label" for="invalidCheck3">
                            J'accepte les termes et les conditions
                        </label>
                        <div id="invalidCheck3Feedback" class="invalid-feedback">
                            Vous devez accepter pour continuer
                        </div>
                        </div>
                    </div>
                    <div class="col-12 m-3">
                    <button class="btn btn-primary" type="submit">S'inscrire</button>
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
