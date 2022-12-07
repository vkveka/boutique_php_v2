<?php
include './functions.php';
session_start();
include 'head.php';
createCart();
?>

<body>

    <?php
    include 'header.php';
    ?>

    <main>
        <div class="container">
            <div class="row">
                <?php
                // Récupération des articles
                $article = getArticleFromId($_POST['id_article']);
                ?>

                <div class="card mb-3 mt-5 text-center">
                    <div class="row mx-auto mt-5" id="imgart1">
                        <img src="./images/<?php echo $article['picture'] ?>" class="card-img-top" style="width:18rem" alt="...">
                        <img src="./images/<?php echo $article['picture'] ?>" class="card-img-top" style="width:18rem" alt="...">
                        <img src="./images/<?php echo $article['picture'] ?>" class="card-img-top" style="width:18rem" alt="...">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $article['name'] ?></h5>
                        <p class="card-text"><?php echo $article['detailedDescription'] ?></p>
                        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                        <?php
                        ?>
                        <form action="panier.php" method="POST">
                            <input type="hidden" name="chosenArticle" value="<?php echo $article['id'] ?>">
                            <button type="submit" class="btn btn-dark">Add to Cart !</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </main>

    <?php
    include 'footer.php';
    ?>