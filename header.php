<header>
    <div class="container-fluid bg-dark text-white text-center" id="the_header">
        <div class="row mx-auto">
            <div class="col-md-2 m-5">
                <img src="images/gifheader.gif" alt="" style="width:150px">
            </div>
            <div class="col-md-7 mt-5">
                <h1 id="wmw">W.M.W.</h1>
                <?php
                setlocale(LC_TIME, 'fr_FR.utf8', 'fra');
                echo date('l jS F h:i:s A')
                ?>
            </div>
        </div>
    </div>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav mx-auto ">
                    <a class="nav-link active" aria-current="page" href="index.php">ACCUEIL</a>
                    <a class="nav-link" href="panier.php">Panier</a>
                </div>
            </div>
        </div>
    </nav>
</header>