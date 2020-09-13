<?php
ob_start();
session_start();
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
    <title>NTCoffee - AddToCart</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php
    include("header.php");
?>
<main>
   
<section class="erreurs">
<?php
if (isset($_SESSION['id'])) {
	        $getiduser = $_SESSION['id'];
            if(isset($_GET['idpro']) && isset($_GET['qte']) && isset($_GET['prix']) && isset($_GET['promo']))
            { 
                $getidprod = $_GET['idpro'];
                $getquatite = $_GET['qte'];
                $getprix = $_GET['prix'];
                $getpromo = $_GET['promo'];
                $gestion->addToCart($getidprod, $getiduser, $getquatite, $getprix, $getpromo, $bdd);
                echo "Succes, Produit ajouté au panier";
                header('Location:panier.php');
            }
            else { 
	        echo "Erreur, produit non ajouté au panier";
            }
} else echo "<p class=\"red\">Connectez-vous afin de pouvoir ajouter des produits à votre panier.</p>";
?>
</section>
</main>
<?php
    include("footer.php");
    $bdd->close();
    ob_end_flush();
?>
</body>
</html>
