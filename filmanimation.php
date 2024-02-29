<?php
session_start();
include("bd.php");
?>
<!doctype html>
<html lang="en">
    <head>
        <title>Films d'animation - Loveanime</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"/>

        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"/>
        <link rel="stylesheet" media="all" type="text/css" href="CSS/loveanime.css">
    </head>

    <body>
        <header>
           <?php
           include("header.php");
           ?>
        </header>
        <main>
            <div class="card-group">
                <div class="card m-5">
                   <a href="yourname.php"><img src="images/yourname.jpg" class="card-img-bottom h-100" alt="your name" title="your name">
                    <div class="card-body" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                        <h5 class="card-title">Your Name</h5>
                        <p class="card-text">Mitsuha est une jeune lycéenne qui vit dans un village au milieu des montagnes. Taki, lui, vit au centre de Tokyo. Un jour Mitsuha rêve qu'elle est un jeune homme à Tokyo, et Taki rêve qu'il est une jeune fille dans un village de montagne. Quel secret se cache dans ces rêves ?</p>
                    </a></div>
                </div>
                <div class="card m-5">
                   <a href="silentvoice.php"><img src="images/silentvoice.jpg" class="card-img-bottom h-100" alt="silentvoice" title="silentvoice">
                    <div class="card-body" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                        <h5 class="card-title">Silent Voice</h5>
                        <p class="card-text">Nishimiya est une élève douce et attentionnée. Chaque jour, pourtant, elle est harcelée par Ishida, car elle est sourde. Dénoncé pour son comportement, le garçon est à son tour mis à l’écart et rejeté par ses camarades. Des années plus tard, il apprend la langue des signes… et part à la recherche de la jeune fille.</p>
                    </a></div>
                </div>
                <div class="card m-5">
                   <a href="enfantdutemps.php"><img src="images/enfantdutemps.jpg" class="card-img-bottom h-100" alt="enfantdutemps" title="enfantdutemps">
                    <div class="card-body" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                        <h5 class="card-title">Les enfants du temps</h5>
                        <p class="card-text">Jeune lycéen, Hodaka fuit son île pour rejoindre Tokyo. Sans argent ni emploi, il tente de survivre dans la jungle urbaine et trouve un poste dans une revue dédiée au paranormal. Un phénomène météorologique extrême touche alors le Japon, exposé à de constantes pluies. Hodaka est dépêché pour enquêter sur l'existence de prêtresses du temps. Peu convaincu par cette légende, il change soudainement d'avis lorsqu'il croise la jeune Hina...</p>
                    </a></div>
                </div>
            </div>
            <div class="card-group">
                <div class="card m-5">
                   <a href="jvmtp.php"><img src="images/jvmtp.jpg" class="card-img-bottom h-100" alt="jvmtp" title="jvmtp">
                    <div class="card-body" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                        <h5 class="card-title">Je veux manger ton pancréas</h5>
                        <p class="card-text">Sakura est une lycéenne populaire et pleine de vie. Tout l’opposé d'un de ses camarades solitaires qui, tombant par mégarde sur son journal intime, découvre qu’elle n’a plus que quelques mois à vivre... Unis par ce secret, ils se rapprochent et s'apprivoisent. Sakura lui fait alors une proposition : vivre ensemble toute une vie en accéléré, le temps d’un printemps.</p>
                    </a></div>
                </div>
                <div class="card m-5">
                   <a href="suzume.php"><img src="images/suzume.png" class="card-img-bottom h-100" alt="suzume" title="suzume">
                    <div class="card-body" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                        <h5 class="card-title">Suzume</h5>
                        <p class="card-text">Dans une petite ville paisible de Kyushu, une jeune fille de 17 ans, Suzume, rencontre un homme qui dit voyager afin de chercher une porte. Décidant de le suivre dans les montagnes, elle découvre une unique porte délabrée trônant au milieu des ruines, seul vestige ayant survécu au passage du temps. Cédant à une inexplicable impulsion, Suzume tourne la poignée, et d'autres portes s'ouvrent alors aux quatre coins du Japon, laissant entrer toutes les catastrophes qu'elles renferment.</p>
                    </a></div>
                </div>
                <div class="card m-5">
                   <a href="bcfilm.php"><img src="images/bcfilm.png" class="card-img-bottom h-100" alt="bcfilm" title="bcfilm">
                    <div class="card-body" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                        <h5 class="card-title">Black Clover : L'épée de l'Empereur Mage</h5>
                        <p class="card-text">Conrad Leto, le prédécesseur de l’actuel Empereur-Mage, Julius Novachrono, s’est libéré des chaînes qui le gardaient enfermé depuis qu’il s’est rebellé face à son royaume autrefois. De retour et prêt à en découdre, il projette d’utiliser « l’épée impériale » pour ramener à la vie les trois Empereurs-Mage les plus redoutés de l’histoire : Edward Avalaché, Princia Funnybunny et Jester Garandaros.</p>
                    </a></div>
                </div>
            </div>
            <div class="card-group">
                <div class="card m-5">
                   <a href="train_de_l'infini.php"><img src="images/train_de_l'infini.jpg" class="card-img-bottom h-100" alt="train de l'infini" title="train de l'infini">
                    <div class="card-body" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                        <h5 class="card-title">Demon Slayer, le film : Le Train de l'Infini</h5>
                        <p class="card-text">Après avoir terminé leur rééducation et entraînement au domaine des papillons, Tanjirō, Nezuko, Zenitsu et Inosuke montent à bord du train de l'Infini afin de rencontrer le pilier de la Flamme, Kyōjurō Rengoku, et l'assister dans sa mission pour éliminer un démon ayant fait plus de 40 victimes. </p>
                    </a></div>
                </div>
                <div class="card m-5">
                   <a href="jujutsukaisen0.php"><img src="images/jujutsukaisen0.jpg" class="card-img-bottom h-100" alt="jujutsukaisen0" title="jujutsukaisen0">
                    <div class="card-body" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                        <h5 class="card-title">Jujutsu kaisen 0</h5>
                        <p class="card-text">Yuta Okkotsu est hanté par l’esprit de Rika, son amie d’enfance morte dans un accident de la route. Cette dernière n’est plus la petite fille qu’il a connu et se manifeste sous la forme d’une entité monstrueuse qui le protège contre sa volonté. Après un énième accident causé par ce fléau, Yuta est récupéré par Satoru Gojo, professeur à l’école d’exorcisme de Tokyo, qui le convainc de rejoindre l’établissement pour maîtriser son énergie occulte.</p>
                    </a></div>
                </div>
                <div class="card m-5">
                   <a href="filmtensura.php"><img src="images/filmtensura.jpg" class="card-img-bottom h-100" alt="filmtensura" title="filmtensura">
                    <div class="card-body" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                        <h5 class="card-title">Moi, quand je me réincarne en Slime - Le Film : Scarlet Bond</h5>
                        <p class="card-text">Il s’agit d’une histoire inédite par rapport aux romans originaux. L’histoire conduira Rimuru Tempest et ses compagnons au royaume de Raza.</p>
                    </a></div>
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
    </body>
</html>
