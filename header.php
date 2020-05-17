<?php

$hcat = $bdd->execute("SELECT * FROM categories");

?>

<header>
    <section class="headertop">
        <section class="headertopleft">
            <article class="twitter"></article>
            <article class="facebook"></article>
            <article class="instagram"></article>
            <div class="searchBox">
                <form id="searchform" method="post" action="search.php?go">
                <input class="searchInput" type="text" name="search" placeholder="Rechercher un produit">
                <button id="searchSubmit" type="submit" name="submit">
                    <div id="isearch" class="material-icons">
                    </div>
                </button>
                </form>
            </div>
        </section>
        <section class="headertopright">
        <?php if( isset($_SESSION['login']) ) {
            if ( $_SESSION["rank"] == "1" ) {
                ?>
                <a href="admin.php"><article class="iconadmin"></article></a>
                <?php
            }
            ?>
            <a href="panier.php">
                <article class="iconpanier">
                <?php
                    $idUtilisateur = $_SESSION["id"];
                    $countProduits = $bdd->execute("SELECT COUNT(*) FROM panier WHERE id_utilisateur = \"$idUtilisateur\"");
                    if ( !empty($countProduits) ) {
                ?>
                    <div class="pointp">
                        <?php
                            echo $countProduits[0][0];
                        ?>
                    </div>
                <?php
                    }
                ?>
                </article>
            </a>
        <?php } ?>
        </section>
    </section>
    <section class="headerbot">
        <a class="logoheader" href="index.php"><img class="logoheader" src="img/logoheader.png" alt="logoheader" /></a>
        <nav class="nav">
            <section class="navbtn">
                <a class="link1" href="index.php">Accueil</a>
            </section>
            <section class="navbtn marginright">
                <a class="link1" href="boutique.php?idcat=1">Boutique</a>
                <?php
                    if ( !empty($hcat) ) {
                        ?>
                        <section class="submenu">
                            <?php
                                foreach ( $hcat as $key => $value ) {
                                    $hsubcat = $bdd->execute("SELECT * FROM subcategories WHERE id_categorie = $value[0]");
                                    ?>
                                        <article class="dropdownsubmenu1">
                                            <a class="link2" href="boutique.php?idcat=<?php echo $value[0]; ?>"><p><?php echo $value[1]; ?></p></a>
                                            <?php
                                                if ( !empty($hsubcat) ) {
                                                    ?>
                                                        <section class="submenu1">
                                                            <?php
                                                            foreach ( $hsubcat as $key => $values ) {
                                                            ?>
                                                                <article class="dropdownsubmenu2">
                                                                    <a class="link2" href="boutique.php?idcat=<?php echo $value[0]; ?>&idsubcat=<?php echo $values[0]; ?>"><p><?php echo $values[2]; ?></p></a>
                                                                </article>
                                                            <?php
                                                            }
                                                            ?>
                                                        </section>
                                                    <?php
                                                }
                                            ?>
                                        </article>
                                    <?php
                                }
                            ?>
                        </section>
                        <?php
                    }
                ?>
            </section>

            <?php if( !isset($_SESSION['login']) ) { ?>
            <section class="navbtn marginleft">
                <a class="link1" href="connexion.php">Connexion</a>
            </section>
            <section class="navbtn">
                <a class="link1" href="inscription.php">Inscription</a>
            </section>

            <?php
            } 
            
            if( isset($_SESSION['login']) ){ ?>
             <section class="navbtn marginleft">
                <a class="link1" href="profil.php">Mon compte</a>
            </section>
             <?php if( $_SESSION['rank'] == 42 || $_SESSION['rank'] == 1337 ){ ?>
             <section class="navbtn">
                <a class="link1" href="creer-article.php">Créer un Article</a>
            </section>
             <?php } ?>
              <?php if( $_SESSION['rank'] == 1337 ){ ?>
            <section class="navbtn">
                <a class="link1" href="admin.php">Admin</a>
            </section>
             <?php } ?>
            <section class="navbtn">
                <a class="link1" href="index.php?deco">Déconnexion</a>
            </section>
            <?php } ?>
        </nav>
    </section>
</header>