<?php
    include_once("db_crud.php");
?>

<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css">

        <title>Fruities - fruits frais et locaux</title>
    </head>

    <body>

        <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
            <a class="navbar-brand" href="#">
                <a href="/index.php"><img src="img/header/logo-fruities.png" width="70" height="70" alt="" loading="lazy">
              </a>
            
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">HOME </a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="kisomnous.php">QUI SOMMES NOUS </a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="ounoustrouver.php">OU TROUVER FRUITIES </a>
                    </li>
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    <li class="nav-item active">
                        <a class="nav-link" href="signup.php">INSCRIPTION</a>
                    </li>
                    <li class="nav-item active">
                        <?php
                                if (isset($_SESSION['Pseudo']))
                                {
                                    echo "<a class='nav-link' href='admin_logout.php'>LOGOUT</a>";
                                }
                                else
                                {
                                    echo "<a class='nav-link' href='signin.php'>LOGIN</a>";
                                }
                            ?>
                    </li>
                  </ul>
            </div>
        </nav>        

        <main>
            <div class="jumbotron">
                <div class="container text-center">
                    <h1> Vente de fruits de saison et frais, </h1>      
                    <h2>recoltes des cultivateurs locaux et engagés</h2>
                </div>
            </div>

            <div class="d-flex bg-secondary mb-3">   
                            
                <div class="dropdown-searchbar">
                       
                <label for="Categorie">Quel type de fruits cherchez vous ?</label>
                    <select id="Categorie" name="category" onchange="location = this.value;">
                        <option value="">Categorie</option>
                        <option value="agrumes">Agrumes</option>
                        <option value="fruitsanoyau">Fruits à noyau</option>
                        <option value="fruitsrouges">Fruits rouges</option>
                        <option value="fruitsexotiques">Fruits exotiques</option>
                    </select>
                </div>
            </div>

            <!-- Gallery CSS -->

            <div class="row row-cols-1 row-cols-md-4">

                <?php
                    $displayProductsAndCategorynames = new Crud();
                    $stmt = $displayProductsAndCategorynames->getProductsAndCategorynames();

                    

                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)): 
                ?>
                        <div class="col mb-4">
                            <div class="card h-100">
                                <a target="_blank" href="<?php echo $row['image']; ?>">
                                    <img src="<?php echo $row['image']; ?>" class="card-img-top" alt="...">
                                </a>
                                <div class="card-body">
                                    <div class="card-left">
                                        <h4 class="card-title"><?php echo $row['name']; ?></h4>
                                        <p class="card-text"><?php echo $row['categoryname']; ?></p>
                                    </div>
                                    <div class="card-right">
                                        <h5 class="price">€<?php echo $row['price']; ?></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php 
                    endwhile; 
                ?>
            </div>

            <!-- Pagination CSS -->

            <nav aria-label="...">

                <ul class="pagination pagination-lg">
                    <li class="page-item active" aria-current="page">
                    <span class="page-link">
                        1
                        <span class="sr-only">(current)</span>
                    </span>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">></a></li>
                </ul>
            </nav>
            
        </main>


        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    </body>
</html>
