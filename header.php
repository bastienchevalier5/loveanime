    <nav class="navbar navbar-expand-lg">
      <div class="container text-center">
          <div class="row align-items-start mx-auto p-1">
              <div class="container-fluid">
                  <div class="col">
                      <a class="navbar-brand" href="index.php"><img src="images/loveanime.jpeg" alt="anime" title="anime"></a>
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
                      <form class="d-flex mx-auto p-5" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                      </form>
                    </div>
                    <div class="btn_compte">
                      <?php
                      if (isset($_SESSION['connected']) && $_SESSION['connected'] = 1) {
                      echo '<a href="moncompte.php" class="btn btn-primary ms-5" role="button" aria-disabled="true">Mon Compte</a>';
                      } else {
                      echo '<a href="inscription.php"><button class="btn-19"><span>Inscription</span></button></a>';
                      echo '<a href="connexion.php"><button class="btn-19"><span>Connexion</span></button></a>';                                }
                      ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
      </div>
  </nav>