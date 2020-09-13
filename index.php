<?php

session_start();

if (isset($_GET["deco"])) {
    session_unset();
    session_destroy();
    header('Location:index.php');
}

include("bdd.php");
include("gestion.php");
include("affichage.php");
$bdd = new BDD;
$gestion = new Gestion;
$affichage = new Affichage;
$connect = $bdd->connect("db5000890310.hosting-data.io", "dbu594451", "S26n6j29p20m13!", "dbs781078");
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>NTCoffee - Accueil</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php
    include("header.php");
?>
<main>
<img class="top" src="img/subheaderindex.png" alt="indextop">
   
<section class="content">
    <h1 class="oldblack indextitle">Produits Phares</h1>
    <section class="mieuxnotes">
    <?php
    $affichage->showTopproducts($bdd);
    ?>    
    </section>
    <h1 class="oldblack indextitle">Nouveautés</h1>
    <section class="lastproducts">
    <?php 
    $affichage->showLastproducts($bdd);
    ?>
    </section>
    <h1 class="oldblack indextitle">Derniers Avis</h1>
    <section class="lastreviews">
    <?php 
    $affichage->showLastreviews($bdd);
    ?>
    </section>
</section>
</main>
<?php
    include("footer.php");
    $bdd->close();
?>
</body>
</html>