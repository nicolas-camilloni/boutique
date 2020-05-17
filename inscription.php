<?php
ob_start();

session_start();
include("utilisateur.php");
include("bdd.php");
$bdd = new BDD;
$user = new Utilisateur;
$connect = $bdd->connect("localhost", "root", "", "boutique");
?>

<!DOCTYPE html>

<html>

<head>
    <title>NTCoffee - Inscription</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
<?php include("header.php"); ?>
    <main>
        <?php
        if (isset($_SESSION["login"])) {
            echo "<p class=\"titleerror\">Vous êtes déjà connecté!</p>";
        }
        else {
        ?>
        <section class="formpage">
            <h1 class="brown titleform1">MON COMPTE</h1>
            <h1 class="oldblack titleform2">Inscription</h1>
                        <form action="inscription.php" method="post">
                            <section class="cform">
                                <label>Identifiant <span class="brown">*</span></label>
                                <input type="text" name="login" required><br />
                                <label>Mot de passe <span class="brown">*</span></label>
                                <input type="password" name="mdp" required><br />
                                <label>Confirmation du mot de passe <span class="brown">*</span></label>
                                <input type="password" name="mdpval" required><br />
                                <label>Email <span class="brown">*</span></label>
                                <input type="email" name="email" required><br />
                                <label>Adresse <span class="brown">*</span></label>
                                <input type="text" name="adresse" required><br />
                                <label>Téléphone <span class="brown">*</span></label>
                                <input type="tel" name="tel" required><br />
                                <div class="centerform"><input class="mybutton" type="submit" value="S'inscrire" name="valider">
                                <p class="pnotsub">Vous avez déjà un compte ? <a href="connexion.php">Connectez-vous.</a></p></div>
                            </section>
                        </form>
                    <?php
        }

        if ( isset($_POST["valider"]) ) {
            $user->inscription($_POST["login"], $_POST["mdp"], $_POST["mdpval"], $_POST["email"], $_POST["adresse"], $_POST["tel"], $connect);
        }
        ?>
        </section>
    </main>
<?php
include("footer.php");
?>
</body>

</html>

<?php
ob_end_flush();
?>