<?php

session_start();
include("bdd.php");
include("gestion.php");
include("affichage.php");
$affichage = new Affichage;
$bdd = new BDD;
$gestion = new Gestion;
$connect = $bdd->connect("db5000890310.hosting-data.io", "dbu594451", "S26n6j29p20m13!", "dbs781078");

?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>NTCoffee - Boutique</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php
    include("header.php");
?>
<main>
    <h1 class="titleb">Boutique</h1>
    <section class="cboutique">
        <?php
        if ( isset($_GET["idsubcat"]) && isset($_GET["idcat"]) ) {
            $idsubcat = $_GET["idsubcat"];
            $idcat = $_GET["idcat"];
            $affichage->showShop($idcat, $idsubcat, $bdd);
        }
        elseif ( isset($_GET["idcat"]) ) {
            $idcat = $_GET["idcat"];
            $idsubcat = "0";
            $affichage->showShop($idcat, $idsubcat, $bdd);
        }
        else {
            ?>
                <img src="img/404.png" alt="erreur404" />
            <?php
        }
        ?>
    </section>
</main>

<?php
    include("footer.php");
    $bdd->close();
?>

</body>
</html>