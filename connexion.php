<?php

session_start();
include("utilisateur.php");
include("bdd.php");
$bdd = new BDD;
$user = new Utilisateur;
$connect = $bdd->connect("db5000890310.hosting-data.io", "dbu594451", "S26n6j29p20m13!", "dbs781078");
$ischampremplis = false;

if ( isset($_POST['connexion']) == true && isset($_POST['login']) && strlen($_POST['login']) != 0 && isset($_POST['password']) && strlen($_POST['password']) != 0 ) {
    $user->connexion($_POST["login"], $_POST["password"], $bdd);
}
elseif ( isset($_POST['connexion']) == true && isset($_POST['login']) && strlen($_POST['login']) == 0 || isset($_POST['password']) && strlen($_POST['password']) == 0 ) {
    $ischampremplis = true;
}

?>

<!DOCTYPE html>

<html>
<head>
    <title>NTCoffee - Connexion</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <?php include("header.php"); ?>
    <main>
        <?php
        if ( !isset($_SESSION['login']) ) {
        ?>
        <section class="formpage">
        <h1 class="brown titleform1">MON COMPTE</h1>
        <h1 class="oldblack titleform2">Connexion</h1>
            <form class="form_site" method="post" action="connexion.php">
                <section class="cform">
                    <label>Identifiant <span class="brown">*</span></label>
                    <input type="text" name="login" ><br />
                    <label>Mot de passe <span class="brown">*</span></label>
                    <input type="password" name="password" ><br />
                    <div class="centerform"><input class="mybutton" type="submit" value="CONNEXION" name="connexion" />
                    <p class="pnotsub">Pas encore inscrit ? <a href="inscription.php">Créez un compte client.</a></p></div>
                    <?php
                    if ( $user->isMdpWrong == true ) {
                    ?>
                        <p><span class="red pmsgform">Identifiant ou mot de passe incorrect.</span></p>
                    <?php
                    }
                    elseif ( $user->isIdInconnu == true ) {
                    ?>
                        <p><span class="red pmsgform">Cet identifiant n'exsite pas.</span></p>
                    <?php
                    }
                    elseif ( $ischampremplis == true ) {
                    ?>
                        <p><span class="red pmsgform">Merci de remplir tous les champs!</span></p>
                    <?php
                    }
                    ?>
                </section>
            </form>
        </section>
        <?php
        }
        elseif ( isset($_SESSION['login']) ) {
            echo "<p class=\"titleerror\">Vous êtes déjà connecté!</p>";
        }
        ?>
    </main>
    <?php
    include("footer.php");
    ?>
</body>
</html>