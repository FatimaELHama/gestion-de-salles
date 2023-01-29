<?php
ob_start();
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
  <title>Stagiaires - <?php echo $_SESSION['prenom'] . " " . $_SESSION['nom']; ?></title>
  <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
  <link href="../assets/css/nice-select.css" rel="stylesheet" />
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="../assets/css/styles.css" rel="stylesheet" />
  <link href="../assets/css/jquery.dataTables.min.css" rel="stylesheet" />
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
      <div class="d-flex flex-column justify-content-between flex-wrap flex-md-nowrap pt-3">
        <?php if (!isset($_GET['a'])) : ?>
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-5">
            <h1 class="h2">Stagiaires</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
              <div class="btn-group me-2">
                <a href="stagiaires.php?a=add" class="btn btn-secondary btn-md">
                  Ajouter un stagiaire
                </a>
              </div>
            </div>
          </div>
          <?php
          $stagiaires = $user->getStagiaires();
          ?>
          <?php if (count($stagiaires) >= 1) : ?>
            <div class="table-responsive">
              <table class="table table-striped table-sm table-bordered table-hover" id="stagiairesTable">
                <thead class="table-dark">
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">CNE</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Prenom</th>
                    <th scope="col">Date de naissance</th>
                    <th scope="col">Email</th>
                    <th scope="col">Telephone</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody id="stagiairesSection">
                  <?php foreach ($stagiaires as $stagiaire) : ?>
                    <tr id="<?php echo $stagiaire['id']; ?>">
                      <th><?php echo $stagiaire['id']; ?></th>
                      <th><?php echo $stagiaire['CNE']; ?></th>
                      <th><?php echo $stagiaire['nom']; ?></th>
                      <th><?php echo $stagiaire['prenom']; ?></th>
                      <th><?php echo $stagiaire['date_naiss']; ?></th>
                      <th><?php echo $stagiaire['email']; ?></th>
                      <th><?php echo $stagiaire['telephone']; ?></th>
                      <th class="d-flex justify-content-between">
                        <a href="groupes.php?a=assign&id=<?php echo $stagiaire['id']; ?>" class="me-4" title="Affecter a un group">
                          <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                          </svg>
                        </a>
                        <a href="stagiaires.php?a=edit&id=<?php echo $stagiaire['id']; ?>" class="me-4" title="Modifier">
                          <svg width="28" height="28" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.75 19.25L9 18.25L18.2929 8.95711C18.6834 8.56658 18.6834 7.93342 18.2929 7.54289L16.4571 5.70711C16.0666 5.31658 15.4334 5.31658 15.0429 5.70711L5.75 15L4.75 19.25Z"></path>
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.25 19.25H13.75"></path>
                          </svg>
                        </a>
                        <form method="post" id="deleteStagiaireForm">
                          <input type="hidden" name="stagiaireID" value=<?php echo $stagiaire['id']; ?>>
                          <button title="Supprimer" type="submit" style="background: none;color: inherit;border: none;padding: 0;font: inherit;cursor: pointer;outline: inherit;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                          </button>
                        </form>
                      </th>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
              <div id="pagination"></div>
            </div>
          <?php else : ?>
            <?php echo "Pas du stagiaires" ?>
          <?php endif; ?>
        <?php endif; ?>
        <?php if (isset($_GET['a']) && $_GET['a'] == 'add') : ?>
          <section>
            <div class="container">
              <div class="row">
                <div class="col-12 d-flex align-items-center justify-content-center">
                  <div class="w-100">
                    <div class="text-center text-md-center mb-4 mt-md-0">
                      <h1 class="mb-0 h3">Ajouter un nouveau stagiaire</h1>
                      <div id="addStagiaireErrors" class="row"></div>
                    </div>
                    <form action="" class="mt-4 row d-flex justify-content-center" id="addStagiaireForm">
                      <div class="col-lg-4">
                        <div class="form-group mb-4">
                          <label for="cne" class="mb-1">CNE</label>
                          <div class="input-group">
                            <span class="input-group-text">
                              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                              </svg>
                            </span>
                            <input type="text" class="form-control" name="cne" placeholder="CNE" id="cne" autofocus required>
                          </div>
                        </div>
                        <div class="form-group mb-4">
                          <label for="nom" class="mb-1">Nom</label>
                          <div class="input-group">
                            <span class="input-group-text">
                              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                              </svg>
                            </span>
                            <input type="text" class="form-control" name="nom" placeholder="Nom" id="nom" autofocus required>
                          </div>
                        </div>
                        <div class="form-group mb-4">
                          <label for="prenom" class="mb-1">Prenom</label>
                          <div class="input-group">
                            <span class="input-group-text">
                              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                              </svg>
                            </span>
                            <input type="text" class="form-control" name="prenom" placeholder="Prenom" id="prenom" autofocus required>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="form-group mb-4">
                          <label for="dateNaiss" class="mb-1">Date de naissance</label>
                          <div class="input-group">
                            <span class="input-group-text">
                              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                              </svg>
                            </span>
                            <input type="date" name="dateNaiss" class="form-control" id="dateNaiss" required>
                          </div>
                        </div>
                        <div class="form-group mb-4">
                          <label for="email" class="mb-1">Email</label>
                          <div class="input-group">
                            <span class="input-group-text">
                              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                              </svg>
                            </span>
                            <input type="email" class="form-control" name="email" placeholder="example@gmail.com" id="email" autofocus required>
                          </div>
                        </div>
                        <div class="form-group mb-4">
                          <label for="telephone" class="mb-1">Telephone</label>
                          <div class="input-group">
                            <span class="input-group-text">
                              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M7 2a2 2 0 00-2 2v12a2 2 0 002 2h6a2 2 0 002-2V4a2 2 0 00-2-2H7zm3 14a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                              </svg>
                            </span>
                            <input type="text" class="form-control" name="telephone" placeholder="212612345678" id="telephone" autofocus required>
                          </div>
                        </div>
                      </div>
                      <div class="d-flex align-items-center col-lg-8">
                        <button type="submit" name="register" class="btn btn-p-dark d-inline-flex align-items-center justify-content-center">
                          <svg width="24" height="24" fill="none" viewBox="0 0 24 24" class="me-2">
                            <circle cx="12" cy="8" r="3.25" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5">
                            </circle>
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12.25 19.25H6.94953C5.77004 19.25 4.88989 18.2103 5.49085 17.1954C6.36247 15.7234 8.23935 14 12.25 14">
                            </path>
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14.75 17.75L16 19.25L19.25 14.75"></path>
                          </svg>
                          Ajouter
                        </button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </section>
        <?php elseif (isset($_GET['a']) && $_GET['a'] == 'edit' && isset($_GET['id'])) : ?>
          <?php
          $stagiaire = $user->getStagiaire($_GET['id']);
          // var_dump($stagiaire);
          ?>
          <?php if (count($stagiaire) == 1) : ?>
            <section>
              <div class="container">
                <div class="row">
                  <div class="col-12 d-flex align-items-center justify-content-center">
                    <div class="pt-4 w-100">
                      <div class="text-center text-md-center mb-4 mt-md-0">
                        <h1 class="mb-0 h3">Editer <?php echo $stagiaire[0]['nom'] . " " . $stagiaire[0]['prenom'] . " informations" ?></h1>
                        <div id="editStagiaireErrors"></div>
                      </div>
                      <form action="" method="post" class="mt-4 row d-flex justify-content-center" id="editStagiaireForm">
                        <div class="col-lg-4">
                          <div class="form-group mb-4">
                            <label for="cne" class="mb-1">CNE</label>
                            <div class="input-group">
                              <span class="input-group-text">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                                </svg>
                              </span>
                              <input type="text" class="form-control" name="cne" placeholder="CNE" id="cne" value="<?php echo  $stagiaire[0]['CNE'] ?>" autofocus required>
                            </div>
                          </div>
                          <div class="form-group mb-4">
                            <label for="nom" class="mb-1">Nom</label>
                            <div class="input-group">
                              <span class="input-group-text">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                                  <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                </svg>
                              </span>
                              <input type="text" class="form-control" name="nom" placeholder="Nom" id="nom" value="<?php echo  $stagiaire[0]['nom'] ?>" autofocus required>
                            </div>
                          </div>
                          <div class="form-group mb-4">
                            <label for="prenom" class="mb-1">Prenom</label>
                            <div class="input-group">
                              <span class="input-group-text">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                                  <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                </svg>
                              </span>
                              <input type="text" class="form-control" name="prenom" placeholder="Prenom" id="prenom" value="<?php echo  $stagiaire[0]['prenom'] ?>" autofocus required>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-4">
                          <div class="form-group mb-4">
                            <label for="dateNaiss" class="mb-1">Date de naissance</label>
                            <div class="input-group">
                              <span class="input-group-text">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                                  <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                                </svg>
                              </span>
                              <input type="date" name="dateNaiss" class="form-control" id="dateNaiss" value="<?php echo  $stagiaire[0]['date_naiss'] ?>" required>
                            </div>
                          </div>
                          <div class="form-group mb-4">
                            <label for="email" class="mb-1">Email</label>
                            <div class="input-group">
                              <span class="input-group-text">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                                  <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                  <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                </svg>
                              </span>
                              <input type="email" class="form-control" name="email" placeholder="example@gmail.com" id="email" value="<?php echo  $stagiaire[0]['email'] ?>" autofocus required>
                            </div>
                          </div>
                          <div class="form-group mb-4">
                            <label for="telephone" class="mb-1">Telephone</label>
                            <div class="input-group">
                              <span class="input-group-text">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                                  <path fill-rule="evenodd" d="M7 2a2 2 0 00-2 2v12a2 2 0 002 2h6a2 2 0 002-2V4a2 2 0 00-2-2H7zm3 14a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                                </svg>
                              </span>
                              <input type="text" class="form-control" name="telephone" placeholder="212612345678" id="telephone" value="<?php echo  $stagiaire[0]['telephone'] ?>" autofocus required>
                            </div>
                          </div>
                          <input type="hidden" name="id" value="<?php echo $stagiaire[0]['id']; ?>">
                        </div>
                        <div class="d-flex align-items-center col-lg-8">
                          <button type="submit" name="register" class="btn btn-p-dark d-inline-flex align-items-center justify-content-center">
                            <svg width="24" height="24" fill="none" viewBox="0 0 24 24" class="me-2">
                              <circle cx="12" cy="8" r="3.25" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5">
                              </circle>
                              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12.25 19.25H6.94953C5.77004 19.25 4.88989 18.2103 5.49085 17.1954C6.36247 15.7234 8.23935 14 12.25 14">
                              </path>
                              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14.75 17.75L16 19.25L19.25 14.75"></path>
                            </svg>
                            Souvez
                          </button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </section>
          <?php else : ?>
            <?php header("Location: stagiaires.php"); ?>
          <?php endif; ?>
          <?php
          ?>
        <?php endif; ?>
      </div>

    </div>
  </main>
  <script src="../assets/js/jquery-3.6.0.min.js"></script>
  <script src="../assets/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/js/jquery.nice-select.min.js"></script>
  <script src="../assets/js/simple-bootstrap-paginator.min.js"></script>
  <script src="../assets/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#stagiairesTable').DataTable();
      $("select").niceSelect();
      $("#addStagiaireForm").on("submit", function(e) {
        e.preventDefault();
        let formData = $(this).serialize();
        $.ajax({
          type: "POST",
          url: "../actions/gestionnaire/stagiaires/add.php",
          data: formData,
          dataType: "json",
          success: function(data) {
            console.log(data);
            if (data.status == "success") {
              window.location.replace("stagiaires.php");
            } else {
              let errors = "";
              for (const error of data) {
                errors += `<li>${error}</li>`;
              }

              let errorsD = `
            <div class="d-flex alert justify-content-between alert-danger text-start mt-4" role="alert">
                <ul>
                  ${errors}
                </ul>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
          `;
              $("#addStagiaireErrors").html(errorsD);
            }
          },
        });
      });
      $("#editStagiaireForm").on("submit", function(e) {
        e.preventDefault();
        let formData = $(this).serialize();
        $.ajax({
          type: "POST",
          url: "../actions/gestionnaire/stagiaires/edit.php",
          data: formData,
          dataType: "json",
          success: function(data) {
            if (data.status == "success") {
              window.location.replace("stagiaires.php");
            } else {
              let errors = "";
              for (const error of data) {
                errors += `<li>${error}</li>`;
              }

              let errorsD = `
            <div class="d-flex alert justify-content-between alert-danger text-start mt-4" role="alert">
                <ul>
                  ${errors}
                </ul>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
          `;
              $("#editStagiaireErrors").html(errorsD);
            }
          },
        });
      });
      $('#stagiairesTable tbody').on('submit', '#deleteStagiaireForm', function(e) {
        e.preventDefault();
        let sID = $(this).children()[0].defaultValue;
        let formData = $(this).serialize();
        $.ajax({
          type: "POST",
          url: "../actions/gestionnaire/stagiaires/delete.php",
          data: formData,
          dataType: "json",
          success: function(data) {
            if (data.status == "success") {
              var table = $('#stagiairesTable').DataTable();
              table
                .row('tr#' + sID)
                .remove()
                .draw();
            } else {
              return;
            }
          },
        });
      });
    });
  </script>
</body>

</html>