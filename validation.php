<?php
include './functions.php';
session_start();
include 'head.php';
createCart();

//Ajout d'un article au panier
if (isset($_POST['chosenArticle'])) {
    $article = getArticleFromId($_POST['chosenArticle']);
    addToCart($article);
}
?>

<body>
    <?php
    include 'header.php';
    //Voir les articles sur la page validation
    if (isset($_POST['valid_cart']) && count($_SESSION['cart']) > 0) {
        showArticleCart();
    }

    // Modifier la quantité sur la page validation
    if (isset($_POST['nb_article'])) {
        updateQuantity();
        showArticleCart();
    }

    // Supprimer un article sur la page validation
    if (isset($_POST['delete_article'])) {
        $articleId = $_POST['delete_article'];
        deleteArticle($articleId);
        if (count($_SESSION['cart']) > 0) {
            showArticleCart();
        } 
    }

    include 'footer.php';
    ?>