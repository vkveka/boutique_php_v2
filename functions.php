<?php

function createCart()
{
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }
}

function getArticles()
{
    return [
        [
            'name' => 'Dark Watch',
            'id' => '1',
            'price' => 149.99,
            'description' => 'Moderne et élégante',
            'detailedDescription' => 'Designée par nos experts, elle impose son style partout où elle passe. 
                                  Elle allie le noir profond au plus beau bleu royal.
                                  Equipée d\'un altimètre, elle affiche également la météo.  
                                  Prix agressif et allure avant-gardiste : vous ne serez pas déçu.',
            'picture' => 'watch1.jpg'
        ],
        [
            'name' => 'Classic Leather',
            'id' => '2',
            'price' => 229.49,
            'description' => 'Affiche l\'heure de 250 pays',
            'detailedDescription' => 'Une montre qui respire la maturité avec son superbe bracelet en cuir authentique. 
                                  Fonction incroyable permettant de consulter toutes les heures du globe.
                                  Elégance garantie avec son cadran cerclé d\'or.
                                  Elle est destinée aux pères de famille qui aiment se faire plaisir.',
            'picture' => 'watch2.jpg'
        ],
        [
            'name' => 'Silver Star',
            'id' => '3',
            'price' => 345.99,
            'description' => 'La classe à l\'état pur',
            'detailedDescription' => '100% acier inoxydable haute résistance. 
                                  Vous allez impressionner la galerie avec cette merveille !
                                  Aiguilles phosphorescentes et cadran incassable avec vitre en plexiglas.  
                                  N\'attendez plus et révélez le sportif en vous !',
            'picture' => 'watch3.jpg'
        ]
    ];
}


function showArticles()
{
    $articles = getArticles();  // RECUPERATION DES ARTICLES
    foreach ($articles as $article) {
        echo "<div class=\"card col-md-4 mx-auto m-5 p-4 text-center\" style=\"width: 18rem;\">
                <img src=\"./images/" . $article['picture'] . "\" class=\"card-img-top\" alt=\"images des produits\">
                <div class=\"card-body\">
                    <h5 class=\"card-title\">" . $article['name'] . "</h5>
                    <p class=\"card-text\">" . $article['description'] . "</p>
                    <form action=\"product.php\" method=\"POST\">
                        <input type=\"hidden\" name=\"id_article\" value=\"" . $article['id'] . "\" >
                        <button type=\"submit\" class=\"btn btn-dark\">Watch Me !</button>
                    </form>
                    <form action=\"panier.php\" method=\"POST\">
                        <p></p>
                        <input type=\"hidden\" name=\"chosenArticle\" value=\"" . $article['id'] . "\" >
                        <button type=\"submit\" class=\"btn btn-dark\">Add to Cart !</button>
                    </form>
                </div>
            </div>";
    }
}


function getArticleFromId($id)
{
    foreach (getArticles() as $article) {
        if ($article['id'] == $id) {
            return $article;
        }
    }
}


//************************ AJOUT D'UN ARTICLE DANS LE PANIER ****************** */


function addToCart($article)
{
    for ($i = 0; $i < count($_SESSION['cart']); $i++) {
        if ($_SESSION['cart'][$i]['id'] == $article['id']) {
            echo "<script> alert(\"Article déjà présent dans le panier !\");</script>";
            return;
        }
    }

    $article['quantity'] = 1;
    array_push($_SESSION['cart'], $article);
}

//************************ MODIFICATION DE LA QUANTITE D'UN ARTICLE DANS LE PANIER ****************** */


function updateQuantity()
{
    for ($i = 0; $i < count($_SESSION['cart']); $i++) {
        if ($_SESSION['cart'][$i]['id'] == $_POST['modif_article_id']) {
            $_SESSION['cart'][$i]['quantity'] = $_POST['nb_article'];
            echo "<script> alert(\"Quantitée modifiée !\");</script>";
        }
    }
}

//************************ SUPPRESSION DE LA QUANTITE D'UN ARTICLE DANS LE PANIER ****************** */

function deleteArticle($articleId)
{
    for ($i = 0; $i < count($_SESSION['cart']); $i++) {
        if ($_SESSION['cart'][$i]['id'] == $articleId) {
            array_splice($_SESSION['cart'], $i, 1);
            echo "<script> alert(\"Article supprimé !\");</script>";
        }
    }
}

//************************ SUPPRESSION DU PANIER ****************** */


function deleteCart()
{
    for ($i = 0; $i < count($_SESSION['cart']); $i++) {
        array_splice($_SESSION['cart'], $i, count($_SESSION['cart']));
        echo "<script> alert(\"Panier supprimé !\");</script>";
    }
}

//************************ CALCUL DU PRIX TOTAL ****************** */

function totalPrice($total)
{
    $total = 0;
    for ($i = 0; $i < count($_SESSION['cart']); $i++) {
        $total += $_SESSION['cart'][$i]['price'] * $_SESSION['cart'][$i]['quantity'];
    }
    return $total;
}

//************************ CALCUL DES FRAIS DE PORT ****************** */

function calculate_fdp($fdp)
{
    $fdp = 0;
    foreach ($_SESSION['cart'] as $article) {
        $fdp += 3 * $article['quantity'];
    }
    return $fdp;
}

//************************ CALCUL FDP + PRIX DU PANIER ****************** */

function valid_total($fdp, $total)
{
    return $fdp + $total;
}

//************************ VISUALISATION DES ARTICLES DANS LA PAGE PANIER ****************** */

function showArticleCart()
{
    foreach ($_SESSION['cart'] as $article) { ?>
        <div class="card mt-5 mx-auto" style="max-width: 1000px; border-radius:50px; background-color:azure">
            <div class="row g-0 text-dark">
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
                        <form action="validation.php" method="POST">
                            <input type="hidden" name="modif_article_id" value="<?php echo $article['id'] ?>">
                            <input type="number" min="1" max="10" name="nb_article" value="<?php echo $article['quantity'] ?>" style="width:60px; border:dark">
                            <button class="btn btn-light ms-3" type="submit" name="modif_quantity" style="width:120px">Modifier quantité</button>
                        </form>
                    </div>
                </div>
                <div class="col-md-1 my-auto">
                    <h5 class="card-title" style="font-weight:600"><?php echo $article['price'] * $article['quantity'] . " €" ?></h5>
                </div>
                <div class="col-md-2 my-auto">
                    <form action="validation.php" method="POST">
                        <input type="hidden" name="delete_article" value="<?php echo $article['id'] ?>">
                        <button class="btn btn-danger" style="width:120px">Supprimer <i class="fa-solid fa-xmark"></i></button>
                    </form>
                </div>
            </div>
        </div>
    <?php }
    ?>
    <div class="container mx-auto m-5">
        <div class="row text-center">
            <div class="col-md-4 mx-auto p-2 bg-dark text-white" style="font-size:24px; font-family:Handlee; border-radius:10px">
                <?= "Votre panier s'élève à : <b>" . totalPrice($_SESSION['cart']) . " €</b>"; ?>
            </div>
        </div>
    </div>
    <div class="row text-center">
        <div class="col-md-1 mx-auto p-2 bg-dark text-white" style="font-size:18px; font-family:Handlee; border-radius:10px">
            <?= "Frais de port : <b>" . calculate_fdp($_SESSION['cart']) . " €</b>"; ?>
        </div>
    </div>

    <div class="card mx-auto m-5" style="width: 18rem;">
        <div class="card-body">
            <h5 class="card-title text-center">Choisissez votre mode de livraison</h5>
            <br>
            <form action="" method="POST">
                <div class="form-check">
                    <input type="hidden" name="colissimo">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                    <label class="form-check-label" for="flexRadioDefault1">
                        Colissimo ( GRATUIT )
                    </label>
                </div>
                <div class="form-check">
                    <input type="hidden" name="express_deli">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
                    <label class="form-check-label" for="flexRadioDefault2">
                        Livraison Express ( 10 € )
                    </label>
                </div>
            </form>
        </div>
    </div>

    <div class="row mx-auto text-center mb-5">
        <div class="col-md-3 mx-auto p-2 bg-dark text-white" style="font-size:24px; font-family:Handlee; border-radius:10px">
            <?= "Prix total : <b>" . valid_total(totalPrice($_SESSION['cart']), calculate_fdp($_SESSION['cart'])) . " €</b>"; ?>
        </div>
    </div>

    <div class="row text-center">
        <div class="col-md-4 mx-auto">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Confirmer la commande
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-dark text-white">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Félicitations !</h1>
                            <form action="index.php" method="POST">
                                <input type="hidden" name="empty_cart_home">
                                <button type="submit" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </form>
                        </div>
                        <div class="modal-body" style="color:green">
                            Votre commande a bien été validée !<br><br>
                        </div>
                        <div style="color:black">
                            Elle sera expédiée le <?= shwoDateShip() ?>
                            <br><br>
                            Livraison prévue pour le <?= shwoDateDeli()?>
                            <br><br>
                            Merci pour votre confiance !
                            <br><br>
                        </div>
                        <div class="modal-footer bg-dark">
                            <form action="index.php" method="POST">
                                <input type="hidden" name="empty_cart_home" value="<?php $_SESSION['cart'] ?>">
                                <button type="submit" class="btn" style="background-color:white">Accueil <i class="fa-solid fa-door-open"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row text-center">
        <div class="col-md-4 mx-auto">
            <form action="panier.php" method="POST">
                <button class="btn text-dark m-3" type="submit" style="background-color:beige">Retour <i class="fa-solid fa-rotate-left"></i></button>
            </form>
        </div>
    </div>




<?php
}

// VOIR LA DATE EN FRANCAIS

function shwoDateShip()
{
    setlocale(LC_TIME, 'fr_FR.utf8', 'fra');
    $date = date('');
    return utf8_encode(strftime("%A %d %B %Y", strtotime($date . '+ 1 day')));
}

function shwoDateDeli()
{
    setlocale(LC_TIME, 'fr_FR.utf8', 'fra');
    $date = date('');
    return utf8_encode(strftime("%A %d %B %Y", strtotime($date . '+ 5 day')));
}

