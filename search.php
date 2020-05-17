<?php

session_start();
include("bdd.php");
include("affichage.php");
$bdd = new BDD;
$affichage = new Affichage;
$connect = $bdd->connect("localhost", "root", "", "boutique");
$search = $_POST['search'];

?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>NTCoffee - Recherche</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php
  include("header.php");
?>
<main>
  <section class="search">
    <h1 class="titleb">Résultat pour "<?php echo $search; ?>"</h1>
    <?php
      if(isset($_POST['submit'])) { 
        if(isset($_GET['go'])) {
          $affichage->showSearch($search, $bdd);
        }
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