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
            <nav class="navbar navbar-expand-lg">
                <div class="container text-center">
                    <div class="row align-items-start mx-auto p-1">
                        <div class="container-fluid">
                            <div class="col">
                                <a class="navbar-brand" href="loveanime.php"><img src="images/loveanime.jpg" alt="anime" title="anime"></a>
                                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                                </button>
                            </div>
                                <div class="collapse navbar-collapse fs-5" id="navbarSupportedContent">
                                    <div class="col">
                                      <div class="categorie">
                                        <ul class="navbar-nav">
                                        <li class="nav-item">
                                        <a class="nav-link active" aria-current="page" href="loveanime.php">Accueil</a>
                                        </li>
                                        <li class="nav-item">
                                        <a class="nav-link active" href="anime.php">Animés</a>
                                        </li>
                                        <li class="nav-item">
                                        <a class="nav-link active" href="filmanimation.php">Films d'animation</a>
                                        </li>
                                        </ul>
                                      </div>
                                    </div>
                                    <div class="col">
                                        <form class="d-flex mx-auto p-5" role="search">
                                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                                        <button class="btn btn-outline-success" type="submit">Search</button>
                                        </form>
                                    </div>
                                    <a href="inscription.php" class="btn btn-primary ms-5" role="button" aria-disabled="true">Inscription</a>
                                    <a href="connexion.php" class="btn btn-secondary m-5" role="button" aria-disabled="true">Connexion</a>
                                </div>
                             </div>
                        </div>
                    </div>
                </div>
            </nav>
        </header>
        <main>
            <div class="inscription">
                <form class="col g-3 m-5">
                    <h2 class="m-3">Connexion</h2>
                    <div class="col-md-12 m-3">
                        <label for="validationServerUsername" class="form-label">Nom d'utilisateur</label>
                        <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend3">@</span>
                        <input type="text" class="form-control" id="validationServerUsername" aria-describedby="inputGroupPrepend3 validationServerUsernameFeedback" required>
                        </div>
                    </div>
                    <div class="col-md-12 m-3">
                        <label for="exampleInputPassword1" class="form-label">Mot de passe</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" required>
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
            <nav class="navbar navbar-expand-lg">
                <div class="container-fluid">
                  <a class="navbar-brand" href="loveanime.php"><a class="navbar-brand" href="loveanime.php"><img src="images/loveanime.jpg" alt="anime" title="anime"></a></a>
                  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>
                  <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <div class="categorie">
                      <ul class="navbar-nav fs-5">
                        <li class="nav-item">
                          <a class="nav-link active" aria-current="page" href="loveanime.php">Accueil</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link active" href="apropos.php">A propos</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link active" href="#">Mentions légales</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link active" href="contact.php">Contactez-nous</a>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </nav>
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