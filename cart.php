<?php

class Panier {

    public function getProductInCart($idUtilisateur, $bdd) {
        $getProduits = $bdd->execute("SELECT * FROM boutique_panier WHERE id_utilisateur = \"$idUtilisateur\"");

        return $getProduits;
    }

    public function delProductInCart($idProduct, $idUtilisateur, $bdd) {
        $delProduits = $bdd->executeonly("DELETE FROM boutique_panier WHERE id = \"$idProduct\" AND id_utilisateur = \"$idUtilisateur\"");
    }

    public function showAll($idUtilisateur, $bdd) {
        $getProduits = $bdd->execute("SELECT * FROM boutique_panier WHERE id_utilisateur = \"$idUtilisateur\"");

        foreach ( $getProduits as $key => $value ) {
            $requeteconc = "SELECT * FROM boutique_articles WHERE id = ".$value[2];
            $getProduitsInfos = $bdd->execute("$requeteconc");
            ?>
            <section class="cpproduit">
                <section class="pcnomimg">
                    <article class="pcimg">
                        <img class="imgproduitpanier" src="<?php echo $getProduitsInfos[0][5]; ?>" alt="imgproduit" />
                    </article>
                    <article class="pcnom">
                        <p class="pnom"><?php echo $getProduitsInfos[0][2]; ?></p>
                            <?php
                                if ( $getProduitsInfos[0][7] - $value[3] >= 0 ) {
                                    echo "<p class=\"pstock green\">En stock</p>";
                                }
                                else {
                                    echo "<p class=\"pstock red\">Pas disponible</p>";
                                }
                            ?>
                    </article>
                </section>
                <section class="pcquantite">
                    <article class="pquantite">
                        <form method="post" action="panier.php">
                            <?php
                            if ($value[3] > 1 ) {
                                ?>
                                <input class="moins" type="submit" name="moins" value="moins<?php echo $value[0]; ?>" />
                                <?php
                            }
                            else {
                                ?>
                                <input class="moins" type="submit" name="moins" value="moins<?php echo "nope"; ?>" />
                                <?php
                            }
                            ?>
                                <p><?php echo $value[3]; ?></p>
                                <input class="plus" type="submit" name="plus" value="plus<?php echo $value[0]; ?>" />
                        </form>
                    </article>
                </section>
                <section class="pcprix">
                    <p><?php echo $value[4]; ?> €</p>
                </section>
                <section class="pdel">
                    <form method="post" action="panier.php">
                        <input type="submit" name="delCart" value="delCart<?php echo $value[0]; ?>" />
                    </form>
                </section>
            </section>
            <?php
        }

    }

    public function panierRecap($idUtilisateur, $bdd) {
        $getProduits = $bdd->execute("SELECT * FROM boutique_panier WHERE id_utilisateur = \"$idUtilisateur\"");
        $prixtotal = 0;
        foreach ( $getProduits as $key => $value ) {
            $prixtotal += $value[4];
        }
        ?>
        <section class="cprecap">
            <h1 class="oldblack titlerecap">Récapitulatif</h1>
            <p class="recapltext">Sous-total: <?php echo $prixtotal; ?>€</p>
            <p class="recapltext recapborderbottom">Livraison:
            <?php if ( $prixtotal >= 50 ) {
                echo "<span class=\"green\">GRATUIT</span>";
            }
            else {
                echo "3€";
            }
            ?>
            </p>
            <p class="recapbtext">Total:
            <?php if ( $prixtotal >= 50 ) {
                echo $prixtotal;
            }
            else {
                echo $prixtotal + 3;
            }
            ?>
            €</p>
            <?php ?>
            <p class="recapbtext2">Moyen de paiement:</p>
            <form class="formcheck" method="post" action="panier.php">
                <div class="checkrow"><input type="radio" class="check" value="1" name="1" /><img src="img/cb.png" alt="cb" /></div>
                <div class="checkrow"><input type="radio" class="check" value="2" name="1" /><img src="img/paypal.png" alt="paypal" /></div>
                <input class="btnpayer" type="submit" value="PAYER" name="payer" />
            </form>
        </section>
        <?php
    }

    public function updateQuantite($idUtilisateur, $bdd) {
        $getProduits = $bdd->execute("SELECT * FROM boutique_panier WHERE id_utilisateur = \"$idUtilisateur\"");

        foreach ( $getProduits as $key => $value ) {
            $getProduitsInfos = $bdd->execute("SELECT * FROM boutique_articles WHERE id = \"$value[2]\"");
            // echo $getProduitsInfos[0][4];
            if ( isset($_POST["moins"]) ) {
                if ( $_POST["moins"] == "moins".$value[0]) {
                    if ( $getProduitsInfos[0][4] != 0 ) {
                        $prix = intval($getProduitsInfos[0][3]);
                        $promo = intval($getProduitsInfos[0][4]);
                        $newprix = ($prix - (($prix * $promo)/100));
                        $bdd->executeonly("UPDATE boutique_panier SET quantite = quantite - 1, prix = prix - \"$newprix\" WHERE id = \"$value[0]\" AND id_utilisateur = \"$idUtilisateur\"");
                    }
                    else {
                        $prixArt = $getProduitsInfos[0][3];
                        $bdd->executeonly("UPDATE boutique_panier SET quantite = quantite - 1, prix = prix - \"$prixArt\" WHERE id = \"$value[0]\" AND id_utilisateur = \"$idUtilisateur\"");
                    }
                }
            }
            if ( isset($_POST["plus"]) ) {

                if ( $_POST["plus"] == "plus".$value[0]) {
                    if ( $getProduitsInfos[0][4] != 0 ) {
                        $prix = intval($getProduitsInfos[0][3]);
                        $promo = intval($getProduitsInfos[0][4]);
                        $newprix = ($prix - (($prix * $promo)/100));
                        $bdd->executeonly("UPDATE boutique_panier SET quantite = quantite + 1, prix = prix + \"$newprix\" WHERE id = \"$value[0]\" AND id_utilisateur = \"$idUtilisateur\"");
                    }
                    else {
                        $prixArt = $getProduitsInfos[0][3];
                        $bdd->executeonly("UPDATE boutique_panier SET quantite = quantite + 1, prix = prix + \"$prixArt\" WHERE id = \"$value[0]\" AND id_utilisateur = \"$idUtilisateur\"");
                    }
                }
            }
        }
    }
    
    public function validPanier($idUtilisateur, $bdd) {
        $getProduits = $bdd->execute("SELECT * FROM boutique_panier WHERE id_utilisateur = \"$idUtilisateur\"");
        $stop = false;

        foreach ( $getProduits as $key => $value ) {
            $getProduitsInfos = $bdd->execute("SELECT * FROM boutique_articles WHERE id = \"$value[2]\"");
            if ( $getProduitsInfos[0][7] - $value[3] >= 0 ) {
            }
            else {
                $stop = true;
            }
        }

        if ( $stop == false ) {
            foreach ( $getProduits as $key => $value ) {
                $idArticle = $value[2];
                $quantite = $value[3];
                $prix = $value[4];
                $bdd->executeonly("INSERT INTO boutique_achats (id_utilisateur, id_article, quantite, prix) VALUES ('$idUtilisateur', '$idArticle', '$quantite', '$prix')");
                $bdd->executeonly("UPDATE boutique_articles SET stock = stock - $quantite WHERE id = \"$value[2]\"");
            }
            $bdd->executeonly("DELETE FROM boutique_panier WHERE id_utilisateur = \"$idUtilisateur\"");
        }
    }

    public function removeFromCart($idUtilisateur, $bdd) {
        $getProduits = $bdd->execute("SELECT * FROM boutique_panier WHERE id_utilisateur = \"$idUtilisateur\"");
        foreach ( $getProduits as $key => $value ) {
            if ( isset($_POST["delCart"]) ) {
                if ( $_POST["delCart"] == "delCart".$value[0]) {
                    $bdd->executeonly("DELETE FROM boutique_panier WHERE id = \"$value[0]\" AND id_utilisateur = \"$idUtilisateur\"");
                }
            }
        }
    }
}