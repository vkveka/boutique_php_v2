<?php
include './functions.php';
session_start();
include 'head.php';
createCart();

//Modifier la quantité du panier
if (isset($_POST['nb_article'])) {
    updateQuantity();
}

//Supprimer un articel du panier
if (isset($_POST['delete_article'])) {
    $articleId = $_POST['delete_article'];
    deleteArticle($articleId);
}

//Vider le panier
if (isset($_POST['delete_cart'])) {
    deleteCart();
}
?>

<body>
    <?php
    include 'header.php';


    // Ajout d'un article au panier
    if (isset($_POST['chosenArticle'])) {
        $article = getArticleFromId($_POST['chosenArticle']);
        addToCart($article);
    }

    // Panier vide !
    if (count($_SESSION['cart']) == 0) { ?>
        <div class="card mx-auto m-5" style="width: 18rem; font-family:Handlee; font-size:22px">
            <img src="images/empty_cart.png" class="card-img-top" alt="...">
            <div class="card-body">
                <p class="card-text text-center">Votre panier est vide...</p>
            </div>
        </div>
    <?php
    }

    // Visualisation des articles dans le panier
    if (count($_SESSION['cart']) > 0) {
        foreach ($_SESSION['cart'] as $article) {
    ?>
            <div class="card mx-auto m-5" style="max-width: 1000px;">
                <div class="row g-0 bg-dark text-white">
                    <div class="col-md-2">
                        <img src="./images/<?php echo $article['picture'] ?>" class="img-fluid rounded-start p-5" style="width:11rem" alt="...">
                    </div>
                    <div class="col-md-2 my-auto">
                        <h5 class="card-title" style="font-weight:600"><?php echo $article['name'] ?></h5>
                        <h5 class="card-title" style="font-size:12px; font-style:italic"><?php echo $article['description'] ?></h5>
                    </div>
                    <div class="col-md-2 my-auto">
                        <h5 class="card-title" style="font-weight:600"><?php echo $article['price'] . " €" ?></h5>
                    </div>
                    <div class="col-md-3 my-auto">
                        <div class="card-body">
                            <form action="panier.php" method="POST">
                                <input type="hidden" name="modif_article_id" value="<?php echo $article['id'] ?>">
                                <input type="number" min="1" max="10" name="nb_article" value="<?php echo $article['quantity'] ?>" style="width:60px; background-color:azure; border:azure">
                                <button class="btn btn-light ms-3" type="submit" name="modif_quantity" style="width:120px">Modifier quantité</button>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-1 my-auto">
                        <h5 class="card-title" style="font-weight:600"><?php echo $article['price'] * $article['quantity'] . " €" ?></h5>
                    </div>
                    <div class="col-md-2 my-auto">
                        <form action="panier.php" method="POST">
                            <input type="hidden" name="delete_article" value="<?php echo $article['id'] ?>">
                            <button class="btn btn-danger" style="width:120px">Supprimer <i class="fa-solid fa-xmark"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>

        <div class="container">
            <div class="row text-center">
                <div class="col-md-4 mx-auto p-2 mb-5 bg-dark text-white" style="font-size:28px; font-family:Handlee; border-radius:10px">
                    <?= "Votre panier s'élève à : <b>" . totalPrice($_SESSION['cart']) . " €</b>"; ?>
                </div>
            </div>
        </div>

        <div class="col-md-3 p-4 mb-5 mx-auto text-center" style="border-radius:50px; box-shadow:1px 1px 30px #e8e8e8">
            <form action="validation.php" method="POST">
                <input type="hidden" name="valid_cart" value="<?php $_SESSION['cart'] ?>">
                <button class="btn btn-dark m-3" type="submit" style="width:155px">Valider <i class="fa-solid fa-check"></i></button>
            </form>
            <form action="panier.php" method="POST">
                <input type="hidden" name="delete_cart" value="<?php $_SESSION['cart'] ?>">
                <button class="btn btn-danger m-3" type="submit" style="width:155px">Vider le panier <i class="fa-solid fa-xmark"></i></button>
            </form>
        </div>
    <?php
    }

    include 'footer.php';
    ?>