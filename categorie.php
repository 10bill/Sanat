<?php

include 'connexion.php';

session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
}
include 'wishlist_cart.php';
?>



<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catégories</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <?php include 'user_header.php'; ?>

    <section class="produits">
        <h1 class="heading">Catégories de produits</h1>
        <div class="box-container">

            <?php
            $categorie = $_GET['categorie'];
            $select_produit = $conn->prepare("SELECT * FROM `produits` WHERE name LIKE '%{$categorie}%' ");
            $select_produit->execute();
            if ($select_produit->rowCount() > 0) {
                while ($fetch_produit = $select_produit->fetch(PDO::FETCH_ASSOC)) {
            ?>
                    <form action="" method="post" class="box">
                        <input type="hidden" name="pid" value="<?= $fetch_produit['id']; ?>">
                        <input type="hidden" name="name" value="<?= $fetch_produit['name']; ?>">
                        <input type="hidden" name="prix" value="<?= $fetch_produit['prix']; ?>">
                        <input type="hidden" name="image" value="<?= $fetch_produit['image_01']; ?>">


                        <button type="submit" name="ajouter_à_la_liste" class="fas fa-heart"></button>
                        <a href="vue_rapide.php?pid=<?= $fetch_produit['id']; ?>" class="fas fa-eye"></a>
                        <img src="uploaded_img/<?= $fetch_produit['image_01']; ?> " class="image" alt="">
                        <div class="name"><?= $fetch_produit['name']; ?></div>
                        <div class="flex">
                            <div class="prix">$<span><?= $fetch_produit['prix']; ?></span>/-
                            </div>
                            <input type="number" name="qte" class="qte" min="1" max="99" value="1" onkeypress="if(this.value.length ==2) return false;">
                        </div>
                        <input type="submit" value="ajouter au panier" name="ajouter_au_panier" class="btn">
                    </form>
            <?php
                }
            } else {
                echo '<p class="empty"> pas de produit trouvé</p>';
            }
            ?>
        </div>
    </section>




    <?php include 'footer.php'; ?>
    <script type="text/javascript" src="./script.js"></script>

</body>

</html>