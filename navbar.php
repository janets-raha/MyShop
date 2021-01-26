<!DOCTYPE html>
<html lang="fr" dir="ltr">
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">
                <a href="/index.php"><img src="img/header/logo-fruities.png" width="70" height="70"
                    alt="logo association Fruities représentant un arbre et un sourire" loading="lazy">
              </a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">ACCUEIL </a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="kisomnous.php">QUI SOMMES-NOUS </a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="ounoustrouver.php">OU TROUVER FRUITIES </a>
                    </li>
                </ul>
            </div>
            <ul class="nav navbar-nav navbar-right">
                    <li class="nav-item active">
                        <a class="nav-link" href="signup.php">INSCRIPTION</a>
                    </li>
                    <li class="nav-item active">
                        <?php
                                if (isset($_SESSION['Pseudo']))
                                {
                                    echo "<a class='nav-link' href='admin_logout.php'>DECONNEXION</a>";
                                }
                                else
                                {
                                    echo "<a class='nav-link' href='signin.php'>CONNEXION</a>";
                                }
                            ?>
                    </li>
            </ul>
        </nav>
    </body>
</html>