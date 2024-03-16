<?php
include "bd.php";
session_start();
$rowcount = 0;
if (isset($_GET['s'])) {
    $search = htmlspecialchars($_GET['Search']);
    $search = trim($search);
    $search = strip_tags($search);
    $sql2 = 'SELECT COUNT(*) AS cpt FROM animes WHERE titre LIKE "%' . $search . '%" OR genres LIKE "%' . $search . '%"';
    $temp2 = $pdo->query($sql2);
    $resultats2 = $temp2->fetchAll();
    @$page = $_GET['page'];
    if (empty($page)) $page=1;
    $nb_par_pages = 5;
    $nb_pages = ceil($resultats2[0]["cpt"]/$nb_par_pages);
    $debut = ($page-1)*$nb_par_pages;
    $sql = 'SELECT DISTINCT * FROM animes WHERE titre LIKE "%'.$search.'%" OR genres LIKE "%' . $search . '%" ORDER BY titre LIMIT '.$debut.','.$nb_par_pages;
    $temp = $pdo->query($sql);
    $rowcount = $temp->rowCount();
}
?>

<!doctype html>
<html lang="en">
<head>
    <title>Recherche</title>
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
        include "header.php";
        ?>
    </header>
    <main>
        <?php
        if ($rowcount > 0) {
            while ($resultats = $temp->fetch()) {
                echo "<div class='card-animes'>";
                echo "<a href='info_anime.php?id=" . $resultats['id'] . "'><img style='width: 350px;height: 500px' src='" . $resultats['img'] . "' class='card-img-bottom' alt='anime' title='anime'>";
                echo "<div class='card-body' style='box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);height:500px;width:250px'>";
                echo "<h2 class='card-title-animes'>" . $resultats['titre'] . "</h2>";
                echo "<p class='card-text-animes'>" . $resultats['synopsis'] . "</p>";
                echo '</a>';
                echo '</div>';
                echo '</div>';
            }

            echo "<div class='pagination'>";
                for ($i = 1; $i <= $nb_pages; $i++) {
                    $params = $_GET;
                    $params['page'] = $i;
                    $query_string = http_build_query($params);

                    if ($page != $i)
                        echo "<a href='?$query_string'>$i</a>&nbsp;";
                    else
                        echo "<a>$i</a>&nbsp;";
                }
                echo "</div>";
            
        } elseif ($rowcount == 0) {
            echo "<h1 style='text-align:center;margin:50px'>Il n'y a aucun résultat pour cette recherche</br></br>Avez-vous utilisé le bon filtre ou mal écrit votre recherche?</h1>";
        }
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
