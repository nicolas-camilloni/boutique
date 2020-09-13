<?php

class Gestion {

public function getCategorie($idCategorie, $bdd) {
        
        $getCat = $bdd->executeassoc("SELECT * FROM boutique_categories WHERE id = \"$idCategorie\"");
         
        return $getCat;
        
    }

public function addCategorie($nom, $id_utilisateur, $bdd){

        $addCat = $bdd->executeonly("INSERT INTO boutique_categories (nom, id_utilisateur) VALUES ('$nom', '$id_utilisateur')");

        return $addCat;
}

public function addSubCategorie($nom, $id_categorie, $bdd){

        $addSubCat = $bdd->executeonly("INSERT INTO boutique_subcategories (id_categorie, nom) VALUES ('$id_categorie','$nom')");

        return $addSubCat;
}

public function delSubCategorie($idSubCategorie, $bdd){

        $delSubCat = $bdd->executeonly("DELETE FROM boutique_subcategories WHERE id = \"$idSubCategorie\"");

        return $delSubCat;
}

public function getSubCategories($bdd) {
        
        $getSubCats = $bdd->executeassoc("SELECT * FROM boutique_subcategories");
         
        return $getSubCats;
        
    }


public function getCategories($bdd) {
        
        $getCats = $bdd->executeassoc("SELECT * FROM boutique_categories");
         
        return $getCats;
        
    }

public function getArticle($idarticle, $bdd) {
        
        $getArticle = $bdd->executeassoc("SELECT * FROM boutique_articles WHERE id = \"$idarticle\"");
         
        return $getArticle;
        
    }

public function getArticles($bdd) {
        
        $getArticles = $bdd->executeassoc("SELECT * FROM boutique_articles");
         
        return $getArticles;
        
    }

public function addArticle($id_categorie, $nom, $prix, $promo, $img, $description, $stock, $subcat, $bdd){

        $addArticle = $bdd->executeonly("INSERT INTO boutique_articles (id_categorie, nom, prix, promo, img, description, stock, id_subcat) VALUES ('$id_categorie', '$nom', '$prix', '$promo', '$img', '$description', '$stock', '$subcat')");

        return $addArticle;
}


public function delArticle($idArticle, $bdd){

        $delArticle = $bdd->executeonly("DELETE FROM boutique_articles WHERE id = \"$idArticle\"");

        return $delArticle;
}

public function delCategorie($idCategorie, $bdd){

        $delCat = $bdd->executeonly("DELETE FROM boutique_categories WHERE id = \"$idCategorie\"");

        return $delCat;
}

public function addToCart($idarticle, $iduser, $qte, $prix, $promo, $bdd){
        $prixpromo = $prix - ($prix * ($promo/100));
        $prixtotal = $qte * $prixpromo;
        $addArticle = $bdd->executeonly("INSERT INTO boutique_panier (id_utilisateur, id_article, quantite, prix) VALUES ('$iduser', '$idarticle', '$qte', '$prixtotal')");

        }

}