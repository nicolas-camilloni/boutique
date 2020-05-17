<?php

session_start();

include("bdd.php");
include("gestion.php");
include("affichage.php");
$affichage = new Affichage;
$bdd = new BDD;
$gestion = new Gestion;
$connect = $bdd->connect("localhost", "root", "", "boutique");
$idprod = $_GET["idprod"];
$intidprod = intval($idprod);
$getavis = $bdd->executeassoc("SELECT * FROM avis INNER JOIN articles ON avis.id_article = \"$idprod\" INNER JOIN utilisateurs ON avis.id_utilisateur = utilisateurs.id GROUP BY avis.id");

$getInfos = $bdd->execute("SELECT * FROM articles WHERE id = $idprod");

$prix = intval($getInfos[0][3]);
$promo = intval($getInfos[0][4]);
$newprix = ($prix - (($prix * $promo)/100));

$getmoyenne = $bdd->executeassoc("SELECT AVG (note) as moyenne FROM avis WHERE id_article = \"$idprod\"");
$floatmoyenne = floatval($getmoyenne[0]['moyenne']);
date_default_timezone_set('Europe/Paris');
$is10car = false;
if (isset($_SESSION['login'])) {
$getiduser = $bdd->executeassoc("SELECT * FROM utilisateurs WHERE login='".$_SESSION['login']."'");
}
if ( isset($_POST['envoyer']) == true && isset($_POST['message']) && strlen($_POST['message']) >= 10 ) {
    
    $msg = $_POST['message'];
    $note = $_POST['note'];
    $intnote = intval($note);
    $remsg = addslashes($msg);
    $bdd->executeonly("INSERT INTO avis (id_utilisateur, id_article, message, note, date) VALUES (".$getiduser[0]['id'].", $intidprod ,'$remsg', $intnote, '".date("Y-m-d H:i:s")."')");
    header("Location: produit.php?idprod=$intidprod");
    }
    elseif ( isset($_POST['envoyer']) == true && isset($_POST['message']) && strlen($_POST['message']) < 10 ) {
        $is10car = true;
    }

?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>NTCoffee - Produit</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php
    include("header.php");
?>
<main  class="mainproduit">
    <section class="contentproduit">
        <article id="item">
            <?php
            $produit = $affichage->showArticle($idprod, $bdd);
            $affichage->showRating(round($floatmoyenne, 1));
            ?>
            <form  class="addtocartform" method="get" action="addtocart.php">
                <input type="hidden" name="idpro" value="<?php echo $idprod; ?>">
                <input type="hidden" name="prix" value="<?php echo $newprix; ?>">
                <input type="hidden" name="promo" value="<?php echo $getInfos[0][4]; ?>">
                <input class="btnadd" type="submit" value="Ajouter au panier" />
                <input class="btnnumber" type="number" name="qte" value="1" />
            </form>
        </article>
    <section class="avis">
    <?php
    if (!empty($getavis)) {
            
            $size = count($getavis);
            $i = 0;
            while ($i < $size) 
            {
                $datesql = $getavis[$i]["date"];
                $newdate = date('d-m-Y à H:i:s', strtotime($datesql));
                echo "<article class=\"pmsg\"><p class=\"pproduit\">".$getavis[$i]["message"]."<br>";
                echo "Note: ".$getavis[$i]["note"]."/5<br>";
                echo "le: $newdate par: ".$getavis[$i]["login"]."</p></article>";
                $i++;
            }
    } else echo "Ce Produit n'as pas d'avis !";
    ?>
    <section>
<?php
if (isset($_SESSION['login'])) {
 ?>
                <form class="cform" method="post" action="produit.php?idprod=<?php echo $intidprod; ?>">
                    <label>Votre avis</label>
                    <textarea name="message"></textarea><br />
                    <select name="note">
                        <option value="">Votre note</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                    <input type="submit" value="Envoyer" name="envoyer" >
                </form>
                <?php
                if ( $is10car == true ) {
                ?>
                    <p>Votre message doit comporter au moins 10 caractères.</p>
                <?php
                }
            }

            elseif ( !isset($_SESSION['login']) ) {
            ?>
                <center><p><b>ERREUR</b><br />
                Vous devez être connecté pour pouvoir laisser un avis.</p></center>
            <?php
}
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