<?php
include './functions.php';
session_start();
include 'head.php';
?>



<body>
    <?php
    include 'header.php';
    ?>

    <main>
        <div class="col-md-6">
            <?php
            showArticles()
            ?>
        </div>
    </main>


    <?php
    include 'footer.php';
    ?>