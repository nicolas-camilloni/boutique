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
    <title>NTCoffee - Mon compte</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
<?php include("header.php"); ?>
    <main>
        <section class="cprofil">
            <?php
            if ( isset($_SESSION["login"]) ) {
            ?>
                <section class="formpageprofil">
                    <h1 class="oldblack titleform2">Mon profil</h1>
                        <?php
                            $id = $_SESSION["id"];
                            $myInfos = $bdd->execute("SELECT * FROM utilisateurs WHERE id = $id");
                            ?>
                            <form action="profil.php" method="post">
                                <section class="cform">
                                    <label>Mot de passe</label>
                                    <input type="password" name="mdp" /><br />
                                    <label>Confirmation du mot de passe</label>
                                    <input type="password" name="mdpval" /><br />
                                    <label>Email</label>
                                    <input type="email" name="email" value="<?php echo $myInfos[0][3]; ?>" required /><br />
                                    <label>Adresse</label>
                                    <input type="text" name="adresse" value="<?php echo $myInfos[0][4]; ?>" required /><br />
                                    <label>Téléphone</label>
                                    <input type="tel" name="tel" value="<?php echo $myInfos[0][6]; ?>" required /><br />
                                    <div class="centerform"><input class="mybutton" type="submit" value="Mettre à jour" name="modifierprofil"></div>
                                </section>
                            </form>
                            <?php
                            if ( isset($_POST["modifierprofil"]) ) {
                                $user->updateProfil($_POST["mdp"], $_POST["mdpval"], $_POST["email"], $_POST["adresse"], $_POST["tel"], $connect);
                            }
                            ?>
                </section>
                <section class="pageachats">
                    <h1 class="oldblack titleform2">Mes achats</h1>
                    <?php
                        $user->mesAchats($bdd);
                        ?>
                </section>
            <?php
            }
            else {
                echo "<p class=\"titleerror\">Vous devez être connecté pour accéder à cette page</p>";
            }
            ?>
        </section>
    </main>
<?php include("footer.php"); ?>
</body>

</html>

<?php
ob_end_flush();
?>