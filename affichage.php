<?php

class Affichage {


public function showCategorie($idCategorie, $showSub, $bdd) {
        
         $categorie = $bdd->executeassoc("SELECT * FROM categories WHERE id = \"$idCategorie\"");
         $subcategorie = $bdd->executeassoc("SELECT * FROM subcategories WHERE id = \"$idCategorie\"");
         $size = count($subcategorie);
         $i = 0;
         if ( isset($_GET["idcat"]) && !empty($categorie)) {
             ?>
             <p>Nom: <?php echo $categorie[0]["nom"]; ?></p>
             <img src="<?php echo $categorie[0]["icone"]; ?>" height="50" width="50">
             <?php
             if ($showSub == true) {
             while ($i < $size) {
             ?>
             <p>Nom: <?php echo $subcategorie[$i]["nom"]; ?></p>
             <img src="<?php echo $subcategorie[$i]["icone"]; ?>" height="50" width="50">
             <?php
             $i++;
             }  
             }  
       } else echo"Categorie introuvable dans notre base";     
}
  
public function showArticle($idarticle, $bdd) {
        
        $article = $bdd->executeassoc("SELECT * FROM articles WHERE id = \"$idarticle\"");
        $prix = intval($article[0]["prix"]);
        $promo = intval($article[0]["promo"]);
        $newprix = ($prix - (($prix * $promo)/100));
         if (isset($_GET["idprod"]) && !empty($article)) {
         ?>
             <h1 class="nproduit"><?php echo $article[0]["nom"]; ?></h1>
             <img src="<?php echo $article[0]["img"]; ?>" height="150" width="150">
             <p class="pproduit">
                <?php
                    if ( $article[0]["promo"] != "0" ) {
                        echo "<span class=\"red prixbcross\">$prix €</span>  <span class=\"green prixb\">$newprix €</span>";
                    }
                    else {
                        echo "<span class=\"oldblack prixb\">$prix €</span>";
                    }
                 ?>
                </p>
             <p class="pproduit"><?php echo $article[0]["description"]; ?></p>
             <p class="pproduit">Stock disponible: <?php echo $article[0]["stock"]; ?></p>
        <?php
       } else echo "<p class=\"error red\">Article introuvable dans la base</p>";
        
}

public function showArticles($id_categorie, $bdd){

        $showArticles = $bdd->executeassoc("SELECT * FROM articles WHERE id_categorie = \"$id_categorie\"");
        $size = count($showArticles);
        $i = 0;
        while ($i < $size) 
          {
          ?>
            <p><?php echo $showArticles[$i]["nom"]; ?></p>
            <p>Prix: <?php echo $showArticles[$i]["prix"]; ?></p>
            <p>Promo appliqué: <?php echo $showArticles[$i]["promo"]; ?></p>
            <img src="<?php echo $showArticles[$i]["img"]; ?>" height="150" width="150">
            <p>Description: <?php echo $showArticles[$i]["description"]; ?></p>
            <p>Stock: <?php echo $showArticles[$i]["stock"]; ?></p>
          <?php
            $i++;
          }  
}

public function showCategories($bdd){

        $showCategories = $bdd->executeassoc("SELECT * FROM categories");
        $size = count($showCategories);
        $i = 0;
        while ($i < $size) 
          {
          ?>
            <p>Nom: <?php echo $showCategories[$i]["nom"]; ?></p>
            <img src="<?php echo $showCategories[$i]["icone"]; ?>" height="50" width="50">
          <?php
            $i++;
          }  
     }

public function showRating($rating){
        if ($rating == 0) {
            echo "<img src=\"img/0.png\" id=\"rating\"><br>";
        }
        elseif ($rating > 0 && $rating < 1) {
            echo "<img src=\"img/0-5.png\" id=\"rating\"><br>";
        }
        elseif ($rating == 1) {
            echo "<img src=\"img/1.png\" id=\"rating\"><br>";
        }
        elseif ($rating > 1 && $rating < 2) {
            echo "<img src=\"img/1-5.png\" id=\"rating\"><br>";
        }
        elseif ($rating == 2) {
            echo "<img src=\"img/2.png\" id=\"rating\"><br>";
        }
        elseif ($rating > 2 && $rating < 3) {
            echo "<img src=\"img/2-5.png\" id=\"rating\"><br>";
        }
        elseif ($rating == 3) {
            echo "<img src=\"img/3.png\" id=\"rating\"><br>";
        }
        elseif ($rating > 3 && $rating < 4) {
            echo "<img src=\"img/3-5.png\" id=\"rating\"><br>";
        }
        elseif ($rating == 4) {
            echo "<img src=\"img/4.png\" id=\"rating\"><br>";
        }
        elseif ($rating > 4 && $rating < 5) {
            echo "<img src=\"img/4-5.png\" id=\"rating\"><br>";
        }
        elseif ($rating == 5) {
            echo "<img src=\"img/5.png\" id=\"rating\"><br>";
        }
        else echo"Ce Produit n'as pas de note";
     }

public function showLastreviews($bdd){

        $lastreviews = $bdd->executeassoc("SELECT * FROM avis INNER JOIN articles ON avis.id_article = articles.id INNER JOIN utilisateurs ON avis.id_utilisateur = utilisateurs.id ORDER BY avis.date DESC LIMIT 3 "); 
        $size = count($lastreviews);
        $x = 0;
        while ($x < $size) {
        $img = $lastreviews[$x]["img"];
        ?>
        <article id="item">
        <h2 class="title3"><?php echo $lastreviews[$x]["nom"]; ?></h2>
        <a href="produit.php?idprod=<?php echo $lastreviews[$x]["id_article"];; ?>"><img src="<?php echo $img; ?>" height="150" width="150"></a>
        <p class="title1">"<?php echo $lastreviews[$x]["message"]; ?>"</p>
        <?php 
        if ($lastreviews[$x]["note"] == 0) {
            echo "<img src=\"img/0.png\" id=\"rating\"><br>";
        }
        elseif ($lastreviews[$x]["note"] > 0 && $lastreviews[$x]["note"] < 1) {
            echo "<img src=\"img/0-5.png\" id=\"rating\"><br>";
        }
        elseif ($lastreviews[$x]["note"] == 1) {
            echo "<img src=\"img/1.png\" id=\"rating\"><br>";
        }
        elseif ($lastreviews[$x]["note"] > 1 && $lastreviews[$x]["note"] < 2) {
            echo "<img src=\"img/1-5.png\" id=\"rating\"><br>";
        }
        elseif ($lastreviews[$x]["note"] == 2) {
            echo "<img src=\"img/2.png\" id=\"rating\"><br>";
        }
        elseif ($lastreviews[$x]["note"] > 2 && $lastreviews[$x]["note"] < 3) {
            echo "<img src=\"img/2-5.png\" id=\"rating\"><br>";
        }
        elseif ($lastreviews[$x]["note"] == 3) {
            echo "<img src=\"img/3.png\" id=\"rating\"><br>";
        }
        elseif ($lastreviews[$x]["note"] > 3 && $lastreviews[$x]["note"] < 4) {
            echo "<img src=\"img/3-5.png\" id=\"rating\"><br>";
        }
        elseif ($lastreviews[$x]["note"] == 4) {
            echo "<img src=\"img/4.png\" id=\"rating\"><br>";
        }
        elseif ($lastreviews[$x]["note"] > 4 && $lastreviews[$x]["note"] < 5) {
            echo "<img src=\"img/4-5.png\" id=\"rating\"><br>";
        }
        elseif ($lastreviews[$x]["note"] == 5) {
            echo "<img src=\"img/5.png\" id=\"rating\"><br>";
        } ?>
        <p class="title1">Posté le <?php echo $lastreviews[$x]["date"]; ?> par <?php echo $lastreviews[$x]["login"]; ?></p>
        </article>
        <?php
        $x++;
    }
}
public function showLastproducts($bdd){

        $lastproducts = $bdd->executeassoc("SELECT * FROM articles ORDER BY id DESC LIMIT 3"); 
        $prix = intval($lastproducts[0]["prix"]);
        $promo = intval($lastproducts[0]["promo"]);
        $newprix = ($prix - (($prix * $promo)/100));
        $size = count($lastproducts);
        $i = 0;
        while ($i < $size) {
        $id = $lastproducts[$i]["id"];
        $img = $lastproducts[$i]["img"];
        $nom = $lastproducts[$i]["nom"];
        $prix = $lastproducts[$i]["prix"];
        $promo = $lastproducts[$i]["promo"];
        $description = $lastproducts[$i]["description"];
        $stock = $lastproducts[$i]["stock"];
        ?>
        <article id="item">
        <h2 class="title3"><?php echo $nom; ?></h2><br>
        <a href="produit.php?idprod=<?php echo $id; ?>"><img src="<?php echo $img; ?>" height="150" width="150"></a>
        <?php
            if ( $lastproducts[0]["promo"] != "0" ) {
                echo "<span class=\"red prixbcross\">$prix €</span>  <span class=\"green prixb\">$newprix €</span>";
            }
            else {
                echo "<span class=\"oldblack prixb\">$prix €</span>";
            }
        ?>
        <p><?php if($promo > 0){echo "Promo: ".$promo."%";} ?></p>
        <form  class="addtocartform" method="get" action="addtocart.php">
            <input type="hidden" name="idpro" value="<?php echo $id; ?>" />
            <input type="hidden" name="promo" value="<?php echo $promo; ?>" />
            <input type="hidden" name="prix" value="<?php echo $prix; ?>" />
            <input type="submit" class="btnadd" value="Ajouter au panier" />
            <input type="number" class="btnnumber" name="qte" value="1" />
        </form>
       </article>
    <?php
        $i++;
    }  
}

public function showTopproducts($bdd){

        $bestreviews = $bdd->executeassoc("SELECT AVG (note) as moyenne, id_article FROM avis GROUP BY id_article ORDER BY moyenne DESC LIMIT 3");
        foreach ( $bestreviews as $key => $value ) {
        if ( !empty($bestreviews) ) {
            $idtemp = $value['id_article'];
        }
        $infoprod = $bdd->executeassoc("SELECT * FROM articles WHERE id= \"$idtemp\"");
        $prix2 = intval($infoprod[0]["prix"]);
        $promo2 = intval($infoprod[0]["promo"]);
        $newprix = ($prix2 - (($prix2 * $promo2)/100));
        $img = $infoprod[0]["img"];
        $prix = $infoprod[0]["prix"];
        $promo = $infoprod[0]["promo"];
        ?>
        <article id="item">
        <h2 class="title3"><?php echo $infoprod[0]["nom"]; ?></h2>
        <a href="produit.php?idprod=<?php echo $idtemp; ?>"><img src="<?php echo $img; ?>" height="150" width="150"></a>
        <?php $this->showRating(round($value['moyenne'], 1));?>
        <?php
            if ( $infoprod[0]["promo"] != "0" ) {
                echo "<span class=\"red prixbcross\">$prix2 €</span>  <span class=\"green prixb\">$newprix €</span>";
            }
            else {
                echo "<span class=\"oldblack prixb\">$prix2 €</span>";
            }
        ?>
        <p><?php if($promo > 0){echo "Promo: ".$infoprod[0]["promo"]."%";} ?></p>
        <form  class="addtocartform" method="get" action="addtocart.php">
            <input type="hidden" name="idpro" value="<?php echo $idtemp; ?>" />
            <input type="hidden" name="promo" value="<?php echo $promo; ?>" />
            <input type="hidden" name="prix" value="<?php echo $prix; ?>" />
            <input type="submit" class="btnadd" value="Ajouter au panier" />
            <input type="number" class="btnnumber" name="qte" value="1" />
        </form>
        </article>
        <?php
        }    
     }

public function showShop($idcat, $idsubcat, $bdd) {
    if ( isset($idsubcat) && $idsubcat != "0"  && isset($idcat) ) {
        $products = $bdd->execute("SELECT * FROM articles WHERE id_categorie = $idcat AND id_subcat = $idsubcat");
        $cat = $bdd->execute("SELECT * FROM categories");
        ?>
            <section class="cbcat">
                <h1 class="titlebcat">Catégorie</h1>
                <?php
                    foreach ( $cat as $keys => $values ) {
                        $subcat = $bdd->execute("SELECT * FROM subcategories WHERE id_categorie = $values[0]");
                        ?>
                        <a href="boutique.php?idcat=<?php echo $values[0] ?>"><p class="bcat brown"><?php echo $values[1]; ?></p></a>
                        <?php
                        foreach ( $subcat as $key => $value ) {
                            ?>
                            <a href="boutique.php?idcat=<?php echo $values[0] ?>&idsubcat=<?php echo $value[0] ?>"><p class="bsubcat"><?php echo $value[2]; ?></p></a>
                            <?php
                        }
                    }
                ?>
            </section>
            <section class="cbshop">
            <?php
                foreach ( $products as $key => $value ) {
                    ?>
                    <section class="cbproduit">
                        <section class="bimgproduit">
                            <a href="produit?idprod=<?php echo $value[0]; ?>"><img src="<?php echo $value[5]; ?>" alt="imgproduit" class="imgproduitpanier" /></a>
                        </section>
                        <p class="title2 titlebart"><?php echo $value[2]; ?></p>
                        <p class="titlebart">
                            <?php
                                if ( $value[4] == 0 ) {
                                    echo "<span class=\"oldblack prixb\">$value[3] €</span>";
                                }
                                else {
                                    $prix = intval($value[3]);
                                    $promo = intval($value[4]);
                                    $newprix = ($prix - (($prix * $promo)/100));
                                    echo "<span class=\"red prixbcross\">$prix €</span>  <span class=\"green prixb\">$newprix €</span>";
                                }
                            ?>
                        </p>
                        <?php
                            $bestreviews = $bdd->executeassoc("SELECT AVG (note) as moyenne, id_article FROM avis WHERE id_article = $value[0] GROUP BY id_article");
                            if ( !empty($bestreviews) ) {
                                $this->showRating(round($bestreviews[0]['moyenne'], 1));
                            }
                            else {
                                echo "<img src=\"img/0.png\" id=\"rating\"><br>";
                            }
                        ?>
                        <form  class="addtocart" method="get" action="addtocart.php">
                            <input type="hidden" name="idpro" value="<?php echo $value[0]; ?>" />
                            <input type="hidden" name="prix" value="<?php echo $value[3]; ?>" />
                            <input type="hidden" name="promo" value="<?php echo $value[4]; ?>">
                            <input type="submit" value="Ajouter au panier" />
                            <input type="number" name="qte" value="1" />
                        </form>
                    </section>
                    <?php
                }
            ?>
            </section>
        <?php
    }
    elseif ( isset($idcat) && $idsubcat == "0" ) {
        $products = $bdd->execute("SELECT * FROM articles WHERE id_categorie = $idcat");
        $cat = $bdd->execute("SELECT * FROM categories");
        ?>
            <section class="cbcat">
                <h1 class="titlebcat">Catégorie</h1>
            <?php
                foreach ( $cat as $keys => $values ) {
                    $subcat = $bdd->execute("SELECT * FROM subcategories WHERE id_categorie = $values[0]");
                    ?>
                        <a href="boutique.php?idcat=<?php echo $values[0] ?>"><p class="bcat brown"><?php echo $values[1]; ?></p></a>
                    <?php
                    foreach ( $subcat as $key => $value ) {
                        ?>
                        <a href="boutique.php?idcat=<?php echo $values[0] ?>&idsubcat=<?php echo $value[0] ?>"><p class="bsubcat"><?php echo $value[2]; ?></p></a>
                        <?php
                    }
                }
            ?>
            </section>
            <section class="cbshop">
            <?php
                foreach ( $products as $key => $value ) {
                    ?>
                    <section class="cbproduit">
                        <section class="bimgproduit">
                            <a href="produit?idprod=<?php echo $value[0]; ?>"><img src="<?php echo $value[5]; ?>" alt="imgproduit" class="imgproduitpanier" /></a>
                        </section>
                        <p class="title2 titlebart"><?php echo $value[2]; ?></p>
                        <p class="titlebart">
                            <?php
                                if ( $value[4] == 0 ) {
                                    echo "<span class=\"oldblack prixb\">$value[3] €</span>";
                                }
                                else {
                                    $prix = intval($value[3]);
                                    $promo = intval($value[4]);
                                    $newprix = ($prix - (($prix * $promo)/100));
                                    echo "<span class=\"red prixbcross\">$prix €</span>  <span class=\"green prixb\">$newprix €</span>";
                                }
                            ?>
                        </p>
                        <?php
                            $bestreviews = $bdd->executeassoc("SELECT AVG (note) as moyenne, id_article FROM avis WHERE id_article = $value[0] GROUP BY id_article");
                            if ( !empty($bestreviews) ) {
                                $this->showRating(round($bestreviews[0]['moyenne'], 1));
                            }
                            else {
                                echo "<img src=\"img/0.png\" id=\"rating\"><br>";
                            }
                        ?>
                        <form  class="addtocart" method="get" action="addtocart.php">
                            <input type="hidden" name="idpro" value="<?php echo $value[0]; ?>" />
                            <input type="hidden" name="prix" value="
                            <?php 
                                if ( $value[4] == 0 ) {
                                    echo $value[3];
                                }
                                else {
                                    $prix = intval($value[3]);
                                    $promo = intval($value[4]);
                                    $newprix = ($prix - (($prix * $promo)/100));
                                    echo $newprix;
                                }
                            ?>" />
                            <input type="hidden" name="promo" value="<?php echo $value[4]; ?>">
                            <input type="submit" value="Ajouter au panier" />
                            <input type="number" name="qte" value="1" />
                        </form>
                    </section>
                    <?php
                }
            ?>
            </section>
        <?php
    }

}

public function showSearch($search, $bdd) {
        $products = $bdd->execute("SELECT * FROM articles WHERE nom LIKE '%".$search."%'");
        ?>
            <section class="cbshop">
            <?php
                foreach ( $products as $key => $value ) {
                    ?>
                    <section class="cbproduit">
                        <section class="bimgproduit">
                            <img src="<?php echo $value[5]; ?>" alt="imgproduit" class="imgproduitpanier" />
                        </section>
                        <p class="title2 titlebart"><?php echo $value[2]; ?></p>
                        <p class="titlebart">
                            <?php
                                if ( $value[4] == 0 ) {
                                    echo "<span class=\"oldblack prixb\">$value[3] €</span>";
                                }
                                else {
                                    $prix = intval($value[3]);
                                    $promo = intval($value[4]);
                                    $newprix = ($prix - (($prix * $promo)/100));
                                    echo "<span class=\"red prixbcross\">$prix €</span>  <span class=\"green prixb\">$newprix €</span>";
                                }
                            ?>
                        </p>
                        <?php
                            $bestreviews = $bdd->executeassoc("SELECT AVG (note) as moyenne, id_article FROM avis WHERE id_article = $value[0] GROUP BY id_article");
                            if ( !empty($bestreviews) ) {
                                $this->showRating(round($bestreviews[0]['moyenne'], 1));
                            }
                            else {
                                echo "<img src=\"img/0.png\" id=\"rating\"><br>";
                            }
                        ?>
                        <form  class="addtocart" method="get" action="addtocart.php">
                            <input type="hidden" name="idpro" value="<?php echo $value[0]; ?>" />
                            <input type="hidden" name="prix" value="<?php echo $value[3]; ?>" />
                            <input type="submit" value="Ajouter au panier" />
                            <input type="number" name="qte" value="1" />
                        </form>
                    </section>
                    <?php
                }
            ?>
            </section>
        <?php
}

}