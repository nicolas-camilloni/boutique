  <footer>
        <section class="footertop">
            <img src="img/footer1.jpg">
            <img src="img/footer2.jpg">
            <img src="img/footer3.jpg">
        </section>
        <section class="footerbottom">
            <nav id="navfooter">
            <section class="navbtn">
                <a class="link1" href="index.php">Accueil</a>
            </section>
            <?php if( !isset($_SESSION['login']) ) { ?>
            <section class="navbtn">
            <a class="link1" href="connexion.php">Connexion</a>
            </section>
            <section class="navbtn">
                <a class="link1" href="inscription.php">Inscription</a>
            </section>
            <?php
            } 
            if( isset($_SESSION['login']) ){ ?>
             <section class="navbtn">
                <a class="link1" href="profil.php">Mon compte</a>
            </section>
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
            <article id="copyright">
            <img height="150" width="150" src="img/logoheader.png">
            <p>Copyright 2020 Coding School | All Rights Reserved | Project by Thierry, Nicolas.</p>
            </article>
        </section>
    </footer>
