<?php
session_start();
require_once "../inc/User.php";
require_once "../inc/config.php";

if (!isset($_SESSION['gestionnaire'])) {
  header("Location: login.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Accueil - <?php echo $_SESSION['prenom'] . " " . $_SESSION['nom']; ?></title>
  <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
  <link href="../assets/css/nice-select.css" rel="stylesheet" />
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="../assets/css/styles.css" rel="stylesheet" />
</head>

<body>
  <nav class="navbar navbar-expand-lg py-3 mb-3 bg-white">
    <div class="container-fluid px-0">
      <div class="d-flex align-items-center">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      </div>
      <div class="collapse navbar-collapse" id="navbarToggler">
        <div class="d-flex flex-column w-100">
          <div class="d-flex border-bottom flex-column flex-lg-row justify-content-center justify-content-lg-between pb-3 mb-3 mt-3 mt-lg-0 px-3 px-lg-0">
            <a href="/gestionnaire" class="d-lg-flex align-items-center ms-3 mb-lg-0 text-dark text-decoration-none">
              <svg width="40" height="40" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5.75 6.75C5.75 5.64543 6.64543 4.75 7.75 4.75H16.25C17.3546 4.75 18.25 5.64543 18.25 6.75V19.25H5.75V6.75Z"></path>
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.25 19.25H4.75"></path>
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.75 15.75C9.75 14.6454 10.6454 13.75 11.75 13.75H12.25C13.3546 13.75 14.25 14.6454 14.25 15.75V19.25H9.75V15.75Z"></path>
                <circle cx="10" cy="10" r="1" fill="currentColor"></circle>
                <circle cx="14" cy="10" r="1" fill="currentColor"></circle>
              </svg>
              <span class="fs-5 ms-2">Gestio</span>
            </a>
            <div class="ms-5 collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="/gestionnaire">Accueil</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="/gestionnaire/stagiaires.php">Stagiaires</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="/gestionnaire/salles.php">Salles</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="/gestionnaire/groupes.php">Groupes</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="/gestionnaire/emploi.php">Emploi de temps</a>
                </li>
              </ul>
            </div>

            <div class="d-flex mt-4 mt-lg-0 justify-content-center align-items-center me-3">
              <div class="dropdown text-end d-flex align-items-center ms-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="me-2" height="30" width="30" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <a href="#" class="link-dark text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                  <?php echo $_SESSION["prenom"] . " " . $_SESSION["nom"] ?>
                </a>
                <ul class="dropdown-menu text-small dropdown-menu-end" aria-labelledby="dropdownUser1">
                  <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                  <i></i>
                  <li>
                    <hr class="dropdown-divider" />
                  </li>
                  <li><a class="dropdown-item" href="../logout.php">Logout</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
  </nav>
  <main>
    <div class="container">
      <div>
        <div class="row h-100 justify-content-center">
          <div class="col-12 d-flex flex-column align-items-center">
            <div class="p-4 p-lg-5 w-100">
              <div class="text-center text-md-center mb-4 mt-md-0">
                <div class="row justify-content-between">
                  <a href="stagiaires.php" class="btn btn-p-dark col-lg-5 d-flex justify-content-center align-items-center fs-3 text-uppercase" style="height: 100px;">
                    Stagiaires</a>
                  <a href="salles.php" class="btn btn-p-dark col-lg-5 d-flex justify-content-center align-items-center fs-3 text-uppercase mb-4" style="height: 100px;">
                    Salles</a>
                </div>
                <div class="row justify-content-between">
                  <a href="groupes.php" class="btn btn-p-dark col-lg-5 d-flex justify-content-center align-items-center fs-3 text-uppercase" style="height: 100px;">
                    Groupes</a>
                  <a href="emploi.php" class="btn btn-p-dark col-lg-5 d-flex justify-content-center align-items-center fs-3 text-uppercase mb-4" style="height: 100px;">
                    Emploi de temps</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  </main>
  <script src="../assets/js/jquery-3.6.0.min.js"></script>
  <script src="../assets/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/js/jquery.nice-select.min.js"></script>
  <script src="../assets/js/simple-bootstrap-paginator.min.js"></script>
  <script>
    $(document).ready(function() {
      $("select").niceSelect();
    });
  </script>
</body>

</html>