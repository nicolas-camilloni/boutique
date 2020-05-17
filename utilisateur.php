<?php

class Utilisateur {

    public $isMdpWrong = false;
    public $isIdInconnu = false;


    public function connexion($login, $password, $bdd) {

        $isUserAlreadyExist = $bdd->execute("SELECT * FROM utilisateurs WHERE login = \"$login\"");
        // echo $requete;
        // var_dump($isUserAlreadyExist);
        if ( !empty($isUserAlreadyExist) ) {
            if ( password_verify($password, $isUserAlreadyExist[0][2]) ) {
                $_SESSION['login'] = $login;
                $_SESSION['id'] = $isUserAlreadyExist[0][0];
                $_SESSION['rank'] = $isUserAlreadyExist[0][5];
                header('Location:index.php');
            }
            else {
                return $this->isMdpWrong = true;
            }
        }
        else {
            return $this->isIdInconnu = true;
        }
    }

    public function inscription($login, $password, $cpassword, $mail, $adresse, $tel, $connect) {
                    $mdp = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));
                    $requete3 = "SELECT login FROM utilisateurs WHERE login = '$login'";
                    $query3 = mysqli_query($connect, $requete3);
                    $resultat3 = mysqli_fetch_all($query3);

                    if (!empty($resultat3)) {
                    ?>
                        <p>Ce Login est déjà prit</p>
                    <?php
                    }
                    elseif ($password != $cpassword) {
                    ?>
                        <p>Attention ! Mot de passe différents</p>
                    <?php
                    }
                    else 
                    {
                        $requete = "INSERT INTO utilisateurs (login, password, mail, adresse, rank, tel) VALUES ('$login','$mdp', '$mail', '$adresse', 0, '$tel')";
                        $query = mysqli_query($connect, $requete);
                        header('Location:connexion.php');
                    }
    }

    public function updateProfil($password, $cpassword, $email, $adresse, $tel, $connect) {
            $id = $_SESSION['id'];
            if(isset($password) && !empty($password)){
                if ($password != $cpassword) {
                    ?>
                    <p>Attention ! Mot de passe différents</p>
                    <?php
                }
                else {
                    $mdp = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));
                    $updatemdp = "UPDATE utilisateurs SET password = '$mdp' WHERE id = $id";
                    $query2 = mysqli_query($connect, $updatemdp);
                    $updatelog = "UPDATE utilisateurs SET mail = '$email', adresse = '$adresse', tel = '$tel' WHERE id = '$id'";
                    $querylog = mysqli_query($connect, $updatelog);
                    header('Location:profil.php');
                }
            }
            if ( empty($password) ) {
                $updatelog2 = "UPDATE utilisateurs SET mail = '$email', adresse = '$adresse', tel = '$tel' WHERE id = '$id'";
                $querylog2 = mysqli_query($connect, $updatelog2);
                header("Location:profil.php");
            }
    }

    public function mesAchats($bdd) {
        $id = $_SESSION['id'];
        $myAchats = $bdd->execute("SELECT * FROM achats WHERE id_utilisateur = $id");
        foreach ( $myAchats as $key => $value ) {
            $achatInfos = $bdd->execute("SELECT * FROM articles WHERE id = $value[2]");
            $achat = $achatInfos[0][2];
            ?>
            <p class="title1"><?php echo "- <span class=\"brown gras\">$achat</span> | Quantité: <span class=\"brown gras\">$value[3]</span> | Prix: <span class=\"brown gras\">$value[4]€</span>"; ?></p>
            <?php
        }

    }

}