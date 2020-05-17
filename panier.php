<?php

session_start();

include("utilisateur.php");
include("bdd.php");
include("cart.php");
$bdd = new BDD;
$user = new Utilisateur;
$cart = new Panier;
$connect = $bdd->connect("localhost", "root", "", "boutique");

if ( isset($_POST["moins"]) || isset($_POST["plus"]) ) {
    $cart->updateQuantite($_SESSION["id"], $bdd);
}

if ( isset($_POST["delCart"]) ) {
    $cart->removeFromCart($_SESSION["id"], $bdd);
}

if ( isset($_POST["payer"]) ) {
    $cart->validPanier($_SESSION["id"], $bdd);
}

?>

<!DOCTYPE html>

<html>

<head>
    <title>NTCoffee - Panier</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
<?php include("header.php"); ?>
    <main>
        <?php
        if ( isset($_SESSION["login"]) ) {
        ?>
            <section class="cartpage">
                <h1 class="brown titleform1">NT Coffee</h1>
                <h1 class="oldblack titleform2">Mon panier</h1>
                <section class="cpanierrecap">
                    <section class="pannierg">
                        <?php
                            $cart->showAll($_SESSION["id"], $bdd);
                        ?>
                    </section>
                    <section class="pannierd">
                        <?php
                            $cart->panierRecap($_SESSION["id"], $bdd);
                        ?>
                    </section>
                </section>
            </section>
        <?php
        }
        else {
            echo "<p class=\"titleerror\">Vous devez être connecté pour accéder à cette page</p>";
        }
        ?>
    </main>
<?php include("footer.php"); ?>
</body>

</html>