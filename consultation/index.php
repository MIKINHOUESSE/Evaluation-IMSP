<?php
session_start();
include_once("../functions.php");

$_SESSION['nbretotal'] = 0;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TP2 | Evaluation IMSP</title>
    <link rel="shortcut icon" href="/assets/images/imsp.jpeg" type="image/x-icon">
    <link rel="stylesheet" href="../assets/style/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/style/style.css">
</head>

<body>
    <header>
        <div class="container tete p-2">
            <span>
                <img src="../assets/images/uac.jpeg" alt="" width="50px">
            </span>
            <span class=" text-center h3">
                Institut de Mathématiques et de Sciences Physiques
            </span>
            <span>
                <img src="../assets/images/imsp.jpeg" alt="" width="50px">
            </span>
        </div>
        <nav class="navbar navbar-expand-lg bg-custom">
            <div class="container">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link text-white" href="/">Accueil</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-warning fw-bold " href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Evaluation
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="/saisie/">Saisie Note</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="/consultation/">Consultation</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="/contact/">Contactez-nous !</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <div class="container corps pt-2 ">
        <div class="card">
            <div class="card-header fw-bold ">
                <h2 class=" text-center p-2 border mt-2 ">Consultation</h2>
            </div>
            <div class="card-body">
                <form action="/saisie/enregistre.php" class="stocknote" method="post">
                    <div class="p-4 meseltop">
                        <div class="mesel">
                            <label for="mat">Matière : </label>
                            <select name="matiere" id="matiere" class=" px-3 py-2 ">
                                <?php
                                $pdo = connectToDB();
                                $sql = 'SELECT * FROM matiere';
                                $req = $pdo->prepare($sql);
                                $req->execute();
                                $reqs = $req->fetchAll();

                                foreach ($reqs as $a) {
                                    echo '<option value="' . $a['codmat'] . '">' . $a['libmat'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mesel">
                            <label for="filiere">Filière : </label>
                            <select name="filiere" id="filiere" class=" px-3 py-2 ">
                                <?php
                                $pdo = connectToDB();
                                $sql = 'SELECT * FROM filiere';
                                $req = $pdo->prepare($sql);
                                $req->execute();
                                $reqs = $req->fetchAll();

                                foreach ($reqs as $a) {
                                    echo '<option value="' . $a['codfil'] . '">' . $a['libfil'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <table class="table">
                        <thead class="table-dark">
                            <tr>
                                <th>N°</th>
                                <th>Nom</th>
                                <th>Prénoms</th>
                                <th>Note</th>
                            </tr>
                        </thead>
                        <tbody class="block-etu">

                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>
    <footer class=" bg-custom text-white text-center fw-bold p-3 ">
        <p>
            &copy; CopyRight - IMSP <span class="annee"></span> - Tout droit résevé !
        </p>
    </footer>

    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/script2.js"></script>

</body>

</html>