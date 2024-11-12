<?php
session_start();
include("bd.php");
if (isset($_SESSION['connected'])){
    $sql = 'SELECT nom_utilisateur,mail FROM comptes WHERE id=' . $_SESSION['id_user'];
    $temp = $pdo->query($sql);
    $resultat = $temp->fetch();
    $nom_utilisateur = $resultat["nom_utilisateur"];
    $email = $resultat["mail"];
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require "phpmailer/src/Exception.php";
require "phpmailer/src/PHPMailer.php";
require "phpmailer/src/SMTP.php";

if (isset($_POST['nom'], $_POST['email'], $_POST['message'])) {
    $nom = $_POST["nom"];
    $email = $_POST["email"];
    $message = $_POST["message"];

    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'chevalierbastien770@gmail.com';
    $mail->Password = 'opebcbzrajmkslnj';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    $mail->setFrom('chevalierbastien770@gmail.com',"Loveanime");
    $mail->addAddress('chevalierbastien770@gmail.com');
    $mail->addReplyTo($email,$nom);
    

    $mail->isHTML(true);

    $mail->Subject = "Message de : " . $nom;
    $mail->Body = $message;

    if ($mail->send()) {
        echo "
        <script>
        alert('Votre message a bien été envoyé');
        document.location.href = 'index';
        </script>
        ";
    } else {
        echo "
        <script>
        alert('Une erreur s'est produite lors de l'envoi du message');
        document.location.href = 'index';
        </script>
        ";
    }
}
?>

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
        <link rel="stylesheet" href="loveanime.css">
    </head>

    <body>
        <header>
            <?php
            include("header.php");
            ?>
        </header>
        <main>
            
            <form class="contact" action="" method="post">
                <h4 class="text-center">Un problème ? Contactez-nous</h4>
                <div class="input-group mb-5 mt-5">
                    <span class="input-group-text">@</span>
                    <div class="form-floating">
                        <input name="nom" type="text" class="form-control" id="floatingInputGroup1" placeholder="Username" value="<?php if(isset($_SESSION['connected'])){echo $nom_utilisateur;}?>">
                        <label for="floatingInputGroup1">Nom d'utilisateur</label>
                    </div>
                </div>
                <div class="form-floating mb-5 mt-5">
                    <input name="email" type="email" class="form-control" id="floatingInput" placeholder="name@example.com" value="<?php if(isset($_SESSION['connected'])) {echo $email;}?>">
                    <label for="floatingInput">Adresse mail</label>
                </div>
                <div class="form-floating mb-5 mt-5">
                    <textarea name="message" class="form-control" placeholder="Message" id="floatingTextarea2" style="height: 100px"></textarea>
                    <label for="floatingTextarea2">Message</label>
                </div>
                <div class="bouton-contact">
                    <button type="submit" name="send" class="form-bouton">Envoyer</button>
                </div>
            </form>
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
