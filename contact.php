<!doctype html>
<html lang="en">
    <head>
        <title>Contact</title>
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
            
            <div class="m-5">
                <h4 class="text-center">Un problème ? Contactez-nous</h4>
                <label for="exampleFormControlInput1" class="form-label">Votre Nom</label>
                <input type="text" class="form-control" id="exampleFormControlInput1">
            </br>
                <label for="exampleFormControlInput1" class="form-label">Votre Adresse Mail</label>
                <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="nom@exemple.com">
            </br>
                <label for="exampleFormControlTextarea1" class="form-label">Votre Message</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
            </br>
                <button type="submit" class="btn btn-primary">Envoyer</button>

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
