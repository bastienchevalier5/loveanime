<?php
session_start();
include "bd.php";
if (isset($_GET['genre'])){
    $genre = $_GET['genre'];
    $sql2 = "SELECT COUNT(id) AS cpt FROM animes WHERE genres LIKE '%" . $genre . "%'";
    $temp2 = $pdo->query($sql2);
    $resultats2 = $temp2->fetchAll();
    @$page = $_GET['page'] ?? 1;
    if (empty($page)) $page=1;
    $nb_par_pages = 5;
    $nb_pages = ceil($resultats2[0]["cpt"]/$nb_par_pages);
    $debut = ($page-1)*$nb_par_pages;
    $sql = "SELECT * FROM animes  WHERE genres LIKE '%" . $genre . "%' ORDER BY titre LIMIT ".$debut.",".$nb_par_pages;
    $temp = $pdo->query($sql);
}
?>
<!doctype html>
<html lang="en">
    <head>
        <title><?=$genre?></title>
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
            include "header.php";
            ?>
        </header>
        <main>
            <h1 class="titre-genre"><?=$genre?></h1>
            <?php
            while ($resultats = $temp -> fetch()) {
                echo "<div class='card-animes'>";
                echo "<a href='info_anime?id=".$resultats['id']."'><img src='".$resultats['img']."' class='card-img-bottom' alt='anime' title='anime'>";
                echo "<div class='card-body' style='box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);width:25em'>";
                echo "<h2 class='card-title-animes'>".$resultats['titre']."</h2>";
                echo "<p class='card-text-animes'>".$resultats['synopsis']."</p>";
                echo '</a>';
                echo '</div>';
                echo '</div>';
                }
                echo "<div class='pagination'>";
                $range = 2; // Définit le range de pages autour de la page actuelle à afficher
                if ($page > 1) {
                echo "<a href='?page=1&genre=$genre' class='first-last'>First</a> "; // Lien vers la première page
                }
                for ($i = max(1, $page - $range); $i <= min($page + $range, $nb_pages); $i++) {
                if ($page == $i) {
                    echo "<a class='active'>$i</a> ";
                } else {
                    echo "<a href='?page=$i&genre=$genre'>$i</a> ";
                }
                }
                if ($page < $nb_pages) {
                echo "<a href='?page=$nb_pages&genre=$genre' class='first-last'>Last</a>"; // Lien vers la dernière page
                }
                echo "</div>";
                ?>

        </main>
        <footer>
            <?php
            include "footer.php";
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