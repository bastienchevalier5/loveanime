<script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
<nav class="navbar navbar-expand-lg">
      <div class="container text-center">
        <div class="row align-items-start mx-auto p-1 text-center">
          <div class="container-fluid text-center">
            <div class="col text-center">
              <a class="navbar-brand" href="index" alt="lienacceuil" title="lienacceuil"><img src="loveanime.jpg" alt="anime" title="anime"></a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span style="margin:15px">Menu</span><span class="navbar-toggler-icon"></span>
              </button>
            </div>
            <div class="collapse navbar-collapse fs-5 text-center" id="navbarSupportedContent">
                <div class="col">
                    <ul class="navbar-nav" style="justify-content:center;align-items:center">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index"><button class="custom-btn btn-5"><span>Accueil</span></button></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="anime"><button class="custom-btn btn-5"><span>Animés</span></button></a>
                    </li>
                    </ul>
                    <div class="body-genres">
                        <div class="genres">
                        <a href="animes-genres?genre=Action">Action</a>
                        </div>
                        <div class="genres">
                        <a href="animes-genres?genre=Aventure">Aventure</a>
                        </div>
                        <div class="genres">
                        <a href="animes-genres?genre=Comédie">Comédie</a>
                        </div>
                        <div class="genres" style="margin: auto;">
                            <div class="btn-group dropdown d-flex justify-content-center">
                                <a class="btn dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                Plus
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <ul class="list-group list-group-horizontal">
                                        <a href="animes-genres?genre=Drame" class="list-group-item list-group-item-action">Drame</a>
                                        <a href="animes-genres?genre=Fantastique" class="list-group-item list-group-item-action">Fantastique</a>
                                        <a href="animes-genres?genre=Fantasy" class="list-group-item list-group-item-action">Fantasy</a>
                                        <a href="animes-genres?genre=Isekai" class="list-group-item list-group-item-action">Isekai</a>
                                        <a href="animes-genres?genre=Horreur" class="list-group-item list-group-item-action">Horreur</a>
                                        <a href="animes-genres?genre=Mystère" class="list-group-item list-group-item-action">Mystère</a>
                                        <a href="animes-genres?genre=Psychologique" class="list-group-item list-group-item-action">Psychologique</a>
                                    </ul>
                                    <ul class="list-group list-group-horizontal">
                                        <a href="animes-genres?genre=Romance" class="list-group-item list-group-item-action">Romance</a>
                                        <a href="animes-genres?genre=Science-fiction" class="list-group-item list-group-item-action">Sci-fi</a>
                                        <a href="animes-genres?genre=School life" class="list-group-item list-group-item-action">School life</a>
                                        <a href="animes-genres?genre=Seinen" class="list-group-item list-group-item-action">Seinen</a>
                                        <a href="animes-genres?genre=Slice of life" class="list-group-item list-group-item-action">Slice of life</a>
                                        <a href="animes-genres?genre=Shonen" class="list-group-item list-group-item-action">Shônen</a>
                                        <a href="animes-genres?genre=Surnaturel" class="list-group-item list-group-item-action">Surnaturel</a>
                                    </ul>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <form id="recherche" action="recherche" method="get" class="d-flex mx-auto p-5" role="search">
                    <input name="Search" class="form-control-recherche ms-0 me-2" type="search" placeholder="Rechercher..." aria-label="Search">
                    <button class="btn btn-rechercher" name="s" type="submit" value="rechercher">Rechercher</button>
                    </form>
                </div>
                <?php
                if (isset($_SESSION['connected']) && $_SESSION['connected'] == 1) {
                    echo "<div class='col mb-3 mb-sm-0'>
                            <div class='card-btn'>
                                <div class='card-body-btn'>
                                    <box-icon type='solid' name='user' size='lg'></box-icon><h4>Espace compte</h4>
                                    <div class='bouton_compte'>
                                        <a href='moncompte'><button style='letter-spacing:0' class='btn-19'><span>Mon compte</span></button></a><a href='deconnexion'><button              class='deconnexion'><span>Déconnexion</span></button></a>
                                    </div>
                                </div>
                            </div>
                            </div>";
                } else {
                        echo "<div class='col mb-3 mb-sm-0'>
                            <div class='card-btn'>
                                <div class='card-body-btn'>
                                    <box-icon type='solid' name='user' size='lg'></box-icon><h4>Espace compte</h4>
                                    <div class='bouton_compte'>
                                        <a href='inscription'><button class='btn-19'><span>Inscription</span></button></a><a href='connexion'><button class='btn-19'><span>Connexion</span></button></a>
                                    </div>
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