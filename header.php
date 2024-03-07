<script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
<nav class="navbar navbar-expand-lg">
      <div class="container text-center">
        <div class="row align-items-start mx-auto p-1">
          <div class="container-fluid">
            <div class="col">
              <a class="navbar-brand" href="index.php" alt="lienacceuil" title="lienacceuil"><img src="images/loveanime.jpeg" alt="anime" title="anime"></a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
            </div>
            <div class="collapse navbar-collapse fs-5" id="navbarSupportedContent">
              <div class="col">
                <ul class="navbar-nav">
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php"><button class="custom-btn btn-5"><span>Accueil</span></button></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="anime.php"><button class="custom-btn btn-5"><span>Animés</span></button></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="filmanimation.php"><button class="custom-btn btn-5"><span>Films</span></button></a>
                  </li> 
                </ul>
              </div>
              <div class="col">
                <form action="recherche.php" method="get" class="d-flex mx-auto p-5" role="search">
                  <input name="Search" class="form-control-recherche ms-0 me-2" type="search" placeholder="Rechercher..." aria-label="Search">
                  <select class="form-select me-2" name="categorie">
                    <option value="titres_animes">Animés par titres</option>
                    <option value="genres_animes">Animés par genres</option>
                    <option value="titres_films">Films par titres</option>
                    <option value="genres_films">Films par genres</option>
                  </select>
                  <button class="btn btn-outline-success" name="s" type="submit" value="rechercher">Rechercher</button>
                </form>
              </div>
                <?php
                if (isset($_SESSION['connected'])) {
                echo '<a href="moncompte.php" class="btn btn-primary ms-5" role="button" aria-disabled="true">Mon Compte</a>';
                } else {
                  echo "<div class='col mb-3 mb-sm-0'>
                          <div class='card-btn'>
                            <div class='card-body-btn'>
                              <box-icon type='solid' name='user' size='lg'></box-icon><h4>Espace compte</h4>
                              <a href='inscription.php'><button class='btn-19'><span>Inscription</span></button></a><a href='connexion.php'><button class='btn-19'><span>Connexion</span></button></a>
                            </div>
                          </div>
                        </div>";
                         }
                ?>
            </div>
          </div>
        </div>
      </div>
    </nav>