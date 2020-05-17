<?php
ob_start();
session_start();
include("bdd.php");
include("gestion.php");
include("affichage.php");
$bdd = new BDD;
$gestion = new Gestion;
$affichage = new Affichage;
$connect = $bdd->connect("localhost", "root", "", "boutique");


if (isset($_POST['updatecat'])) {
    $newnom = $_POST['nom'];
    $newid = $_POST['idcat'];
    $bdd->executeonly("UPDATE categories SET nom = \"$newnom\"  WHERE id = \"$newid\"");
}

if (isset($_POST['addcat'])) {
    $newcatnom = $_POST['nomcat'];
    $newcatiduser = $_SESSION['id'];
    $gestion->addCategorie($newcatnom,$newcatiduser,$bdd);
}

if (isset($_POST['updatesubcat'])) {
    $newsubnom = $_POST['subnom'];
    $newsubid = $_POST['idsubcat'];
    $newidparentcat = $_POST['idparentcat'];
    $bdd->executeonly("UPDATE subcategories SET nom = \"$newsubnom\", id_categorie = \"$newidparentcat\"  WHERE id = \"$newsubid\"");
}

if (isset($_POST['addsubcat'])) {
    $newsubcatnom = $_POST['subnomcat'];
    $newsubcatwanted = $_POST['catid'];
    $newsubcatidcat = intval($newsubcatwanted);
    $gestion->addSubCategorie($newsubcatnom,$newsubcatidcat,$bdd);
}

if (isset($_POST['updateprod'])) {
    $upcatprod = $_POST['catprod'];
    $upsubcatprod = $_POST['subcatprod'];
    $upnomprod = $_POST['nomprod'];
    $upprixprod = $_POST['prixprod'];
    $uppromoprod = $_POST['promoprod'];
    $upimgprod = $_POST['imgprod'];
    $updescriptionprod = $_POST['descriptionprod'];
    $upstockprod = $_POST['stockprod'];
    $upidprod = $_POST['idprod'];
    $bdd->executeonly("UPDATE articles SET id_categorie = \"$upcatprod\",nom = \"$upnomprod\",prix = \"$upprixprod\",promo = \"$uppromoprod\",img = \"$upimgprod\",description = \"$updescriptionprod\",stock=\"$upstockprod\", id_subcat=\"$upsubcatprod\" WHERE id = \"$upidprod\"");
}

if (isset($_POST['addprod'])) {
    $newcatprod = $_POST['newcatprod'];
    $newsubcatprod = $_POST['newsubcatprod'];
    $newnomprod = $_POST['newnomprod'];
    $newprixprod = $_POST['newprixprod'];
    $newpromoprod = $_POST['newpromoprod'];
    $newimgprod = $_POST['newimgprod'];
    $newdescriptionprod = $_POST['newdescriptionprod'];
    $newstockprod = $_POST['newstockprod'];
    $gestion->addArticle($newcatprod, $newnomprod, $newprixprod, $newpromoprod, $newimgprod, $newdescriptionprod, $newstockprod, $newsubcatprod, $bdd);
}

if (isset($_POST['delprod'])) {
    $iddelprod = $_POST['iddelprod'];
    $gestion->delArticle($iddelprod,$bdd);
}

if (isset($_POST['delcat'])) {
    $iddelcat = $_POST['iddelcat'];
    $gestion->delCategorie($iddelcat,$bdd);
}

if (isset($_POST['delsubcat'])) {
    $iddelsubcat = $_POST['iddelsubcat'];
    $gestion->delSubCategorie($iddelsubcat,$bdd);
}

if (isset($_POST['promote'])) {
    $idtopromote = $_POST['idpromote'];
    $bdd->executeonly("UPDATE utilisateurs SET rank = \"1\" WHERE id = \"$idtopromote\"");
}
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>NTCoffee - AdminPanel</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php
    include("header.php");
?>
<main class="mainadmin">
<?php  
if (isset($_SESSION['login']) && $_SESSION['rank'] == 1) {
?>
<section class="contentadmin">
<section class="gestionCategories">
<h1>Modifier une categorie</h1>
<?php
  $getCats = $gestion->getCategories($bdd);
  $size = count($getCats);
  $i = 0;
  while ( $i < $size) {
?>
        <form  class="adminform" method="post" action="admin.php">
        <input type="hidden" name="idcat" value="<?php echo $getCats[$i]['id']; ?>">
        <label for="nom">Nom de la categorie:</label>    
        <input type="text" name="nom" value="<?php echo $getCats[$i]['nom']; ?>">
        <input type="submit" name="updatecat" value="Update Categorie">
        </form>
<?php  
$i++;
}  
?>
<h1>Ajouter une Categorie</h1>

 <form  class="adminform" method="post" action="admin.php">
        <label for="nom">Nom de la categorie:</label>    
        <input type="text" name="nomcat">
        <input type="submit" name="addcat" value="Add Categorie">
        </form>



<h1>Delete une Categorie</h1>

 <form  class="adminform" method="post" action="admin.php">
        <label for="iddelcat">L'ID de la categorie à supprimer:</label>
        <input type="text" name="iddelcat">
        <input type="submit" name="delcat" value="Delete Categorie">
</form>

<h1>Modifier une sous categorie</h1>
<?php
  $getSubCats = $gestion->getSubCategories($bdd);
  $size = count($getSubCats);
  $i = 0;
  while ( $i < $size) {
?>
        <form  class="adminform" method="post" action="admin.php">
        <input type="hidden" name="idsubcat" value="<?php echo $getSubCats[$i]['id']; ?>">
        <label for="nom">Nom de la sous categorie:</label>    
        <input type="text" name="subnom" value="<?php echo $getSubCats[$i]['nom']; ?>">
        <label for="nom">ID de la categorie parent:</label>    
        <input type="text" name="idparentcat" value="<?php echo $getSubCats[$i]['id_categorie']; ?>">
        <input type="submit" name="updatesubcat" value="Update SubCategory">
        </form>
<?php  
$i++;
}  
?>
<h1>Ajouter une sous Categorie</h1>

 <form  class="adminform" method="post" action="admin.php">
        <label for="subnomcat">Nom de la sous categorie:</label>    
        <input type="text" name="subnomcat">
        <label for="catid">ID de la categorie parent:</label>    
        <input type="text" name="catid">
        <input type="submit" name="addsubcat" value="Add SubCategory">
        </form>


<h1>Delete une sous Categorie</h1>

 <form  class="adminform" method="post" action="admin.php">
        <label for="iddelsubcat">L'ID de la sous categorie à supprimer:</label>
        <input type="text" name="iddelsubcat">
        <input type="submit" name="delsubcat" value="Delete SubCategory">
</form>

<h1>Modifier une Article</h1>
<?php
  $getArticles = $gestion->getArticles($bdd);
  $size = count($getArticles);
  $i = 0;
  while ( $i < $size) {
?>
        <form  class="adminform" method="post" action="admin.php">
        <input type="hidden" name="idprod" value="<?php echo $getArticles[$i]['id']; ?>">
        <label for="catprod">Categorie de l'article:</label>    
        <input type="text" name="catprod" value="<?php echo $getArticles[$i]['id_categorie']; ?>">
        <label for="catprod">Sous-categorie de l'article:</label>    
        <input type="text" name="subcatprod" value="<?php echo $getArticles[$i]['id_subcat']; ?>">
        <label for="nomprod">Nom de l'article:</label>    
        <input type="text" name="nomprod" value="<?php echo $getArticles[$i]['nom']; ?>">
        <label for="prixprod">Prix de l'article:</label>    
        <input type="text" name="prixprod" value="<?php echo $getArticles[$i]['prix']; ?>">
        <label for="promoprod">Promo de l'article:</label>    
        <input type="text" name="promoprod" value="<?php echo $getArticles[$i]['promo']; ?>">
        <label for="imgprod">Image de l'article:</label>
        <input type="text" name="imgprod" value="<?php echo $getArticles[$i]['img']; ?>">
        <label for="descriptionprod">Description de l'article:</label>
        <input type="text" name="descriptionprod" value="<?php echo $getArticles[$i]['description']; ?>">
        <label for="stockprod">Stock de l'article:</label>
        <input type="text" name="stockprod" value="<?php echo $getArticles[$i]['stock']; ?>">
        <input type="submit" name="updateprod" value="Update Article">
        </form>
<?php  
$i++;
}  
?>
<h1>Ajouter un Article</h1>

        <form  class="adminform" method="post" action="admin.php">
        <label for="newcatprod">Categorie de l'article:</label>    
        <input type="text" name="newcatprod" />
        <label for="newsubcatprod">Sous-categorie de l'article:</label>    
        <input type="text" name="newsubcatprod" />
        <label for="newnomprod">Nom de l'article:</label>    
        <input type="text" name="newnomprod" />
        <label for="newprixprod">Prix de l'article:</label>    
        <input type="text" name="newprixprod" />
        <label for="newpromoprod">Promo de l'article:</label>    
        <input type="text" name="newpromoprod" />
        <label for="newimgprod">Image de l'article:</label>
        <input type="text" name="newimgprod" />
        <label for="newdescriptionprod">Description de l'article:</label>
        <input type="text" name="newdescriptionprod" />
        <label for="newstockprod">Stock de l'article:</label>
        <input type="text" name="newstockprod" />
        <input type="submit" name="addprod" value="Add Article" />
        </form>


<h1>Delete un Article</h1>

 <form  class="adminform" method="post" action="admin.php">
        <label for="iddelprod">l'ID de l'article à supprimer:</label>
        <input type="text" name="iddelprod">
        <input type="submit" name="delprod" value="Delete Article">
</form>

<h1>Ajouter un Admin</h1>

 <form  class="adminform" method="post" action="admin.php">
        <label for="idpromote">l'ID de l'utilisateur a promouvoir:</label>
        <input type="text" name="idpromote">
        <input type="submit" name="promote" value="Promote User">
</form>
</section>
</section>
<?php
} else echo "<p class=\"red titleerror\">Vous n'avez pas accès à cette page.</p>";
?>
</main>
<?php
    include("footer.php");
    $bdd->close();
    ob_end_flush();
?>
</body>
</html>
