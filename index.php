<?php
include './functions.php';
session_start();
include 'head.php';
createCart();


//Vider le panier après la commande
if (isset($_POST['empty_cart_home'])) {
    deleteCart();
}
?>

<body>
    <?php
    include 'header.php';
    ?>

    <main>
        <div class="container">
            <div class="row">
                <?php
                showArticles();
                ?>
            </div>
        </div>
    </main>


    <?php
    include 'footer.php';
    ?>