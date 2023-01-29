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
  <title>Emploi du temps - <?php echo $_SESSION['prenom'] . " " . $_SESSION['nom']; ?></title>
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
      <div class="d-flex flex-column justify-content-between flex-wrap flex-md-nowrap pt-3 mb-5">
        <?php if (!isset($_GET['a'])) : ?>
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-5">
            <h1 class="h2">Emplois du temps</h1>
          </div>
          <?php
          $emplois = $user->getEmplois();
          ?>
          <?php if (count($emplois) >= 1) : ?>
            <div class="table-responsive d-flex flex-column">
              <table class="table table-striped table-sm table-bordered table-hover" id="emploisTable">
                <thead class="table-dark">
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Groupe</th>
                    <th scope="col">Modifier / Supprimer</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($emplois as $emploi) : ?>
                    <tr id="<?php echo $emploi['id']; ?>">
                      <th><?php echo $emploi['id']; ?></th>
                      <th>
                        <?php
                        $groupe = $user->getGroupe($emploi['id']);
                        ?>
                        <?php if (count($groupe) > 0) : ?>
                          <?php echo $groupe[0]['nom_groupe']; ?>
                        <?php else :  ?>
                          <h5 class="text-warning">Groupe supprimé</h5>
                        <?php endif;  ?>
                      </th>
                      <th>
                        <a href="emploi.php?a=show&id=<?php echo $emploi['id']; ?>" class="d-inline me-4">
                          <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                          </svg>
                        </a>
                        <a href="emploi.php?a=edit&id=<?php echo $emploi['id']; ?>" class="d-inline me-4">
                          <svg width="28" height="28" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.75 19.25L9 18.25L18.2929 8.95711C18.6834 8.56658 18.6834 7.93342 18.2929 7.54289L16.4571 5.70711C16.0666 5.31658 15.4334 5.31658 15.0429 5.70711L5.75 15L4.75 19.25Z"></path>
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.25 19.25H13.75"></path>
                          </svg>
                        </a>
                        <form method="post" id="deleteEmploiForm" class="d-inline">
                          <input type="hidden" name="emploiID" value=<?php echo $emploi['id']; ?>>
                          <button type="submit" style="background: none;color: inherit;border: none;padding: 0;font: inherit;cursor: pointer;outline: inherit;">
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
            <?php echo "Pas du Emplois" ?>
          <?php endif; ?>
        <?php endif; ?>
        <?php if (isset($_GET['a']) && $_GET['a'] == 'edit' && isset($_GET['id'])) : ?>
          <?php
          $salles = $user->getSalles();
          $groupe = $user->getGroupe($_GET['id']);
          $emploi  = $user->getEmploi($_GET['id']);
          ?>
          <?php if (count($groupe) > 0) : ?>
            <h1 class="h2 mb-5"> Modifier l'emploi du temp pour : <?php echo $groupe[0]['nom_groupe']; ?></h1>
          <?php else :  ?>
            <?php header("Location: emploi.php"); ?>
          <?php endif;  ?>
          <?php echo $groupe[0]['nom_groupe']; ?>

          </h1>
          <form action="" method="POST" class="mt-4 row d-flex flex-column" id="editEmploiForm">
            <div class="col-lg-6">
              <div class="d-flex justify-content-between">
                <h1 class="h3 col-lg-4">Lundi :</h1>
                <div class="form-group mb-4">
                  <label for="lundi_matin" class="mb-1">Matin</label>
                  <div class="input-group">
                    <span class="input-group-text">
                      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                      </svg>
                    </span>
                    <input type="hidden" name="emploiID" value="<?php echo $emploi[0]['id'] ?>">
                    <select class="h-100" name="lundi_matin">
                      <option value="non" selected>--------</option>
                      <?php foreach ($salles as $salle) : ?>
                        <?php if ($salle['nom'] == $emploi[0]['m_lundi']) : ?>
                          <option value="<?php echo $salle['nom']; ?>" selected><?php echo $salle['nom']; ?></option>
                        <?php endif; ?>
                        <?php
                        $dispo = $user->checkDispo($salle['nom'], 'm_lundi');
                        if ($dispo == 1) :
                        ?>
                          <option value="<?php echo $salle['nom']; ?>"><?php echo $salle['nom']; ?></option>
                        <?php endif; ?>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
                <div class="form-group mb-4">
                  <label for="groupeSelect" class="mb-1">Apres medit</label>
                  <div class="input-group">
                    <span class="input-group-text">
                      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                      </svg>
                    </span>
                    <select class="h-100" name="lundi_apres">
                      <option value="non" selected>--------</option>
                      <?php foreach ($salles as $salle) : ?>
                        <?php if ($salle['nom'] == $emploi[0]['ap_lundi']) : ?>
                          <option value="<?php echo $salle['nom']; ?>" selected><?php echo $salle['nom']; ?></option>
                        <?php endif; ?>
                        <?php
                        $dispo = $user->checkDispo($salle['nom'], 'ap_lundi');
                        if ($dispo == 1) :
                        ?>
                          <option value="<?php echo $salle['nom']; ?>"><?php echo $salle['nom']; ?></option>
                        <?php endif; ?>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="d-flex justify-content-between">
                <h1 class="h3 col-lg-4">Mardi :</h1>
                <div class="form-group mb-4">
                  <label for="groupeSelect" class="mb-1">Matin</label>
                  <div class="input-group">
                    <span class="input-group-text">
                      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                      </svg>
                    </span>
                    <select class="h-100" name="mardi_matin">
                      <option value="non" selected>--------</option>
                      <?php foreach ($salles as $salle) : ?>
                        <?php if ($salle['nom'] == $emploi[0]['m_mardi']) : ?>
                          <option value="<?php echo $salle['nom']; ?>" selected><?php echo $salle['nom']; ?></option>
                        <?php endif; ?>
                        <?php
                        $dispo = $user->checkDispo($salle['nom'], 'm_mardi');
                        if ($dispo == 1) :
                        ?>
                          <option value="<?php echo $salle['nom']; ?>"><?php echo $salle['nom']; ?></option>
                        <?php endif; ?>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
                <div class="form-group mb-4">
                  <label for="groupeSelect" class="mb-1">Apres medit</label>
                  <div class="input-group">
                    <span class="input-group-text">
                      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                      </svg>
                    </span>
                    <select class="h-100" name="mardi_apres">
                      <option value="non" selected>--------</option>
                      <?php foreach ($salles as $salle) : ?>
                        <?php if ($salle['nom'] == $emploi[0]['ap_mardi']) : ?>
                          <option value="<?php echo $salle['nom']; ?>" selected><?php echo $salle['nom']; ?></option>
                        <?php endif; ?>
                        <?php
                        $dispo = $user->checkDispo($salle['nom'], 'ap_mardi');
                        if ($dispo == 1) :
                        ?>
                          <option value="<?php echo $salle['nom']; ?>"><?php echo $salle['nom']; ?></option>
                        <?php endif; ?>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="d-flex justify-content-between">
                <h1 class="h3 col-lg-4">Mercredi :</h1>
                <div class="form-group mb-4">
                  <label for="groupeSelect" class="mb-1">Matin</label>
                  <div class="input-group">
                    <span class="input-group-text">
                      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                      </svg>
                    </span>
                    <select class="h-100" name="mercredi_matin">
                      <option value="non" selected>--------</option>
                      <?php foreach ($salles as $salle) : ?>
                        <?php if ($salle['nom'] == $emploi[0]['m_mercredi']) : ?>
                          <option value="<?php echo $salle['nom']; ?>" selected><?php echo $salle['nom']; ?></option>
                        <?php endif; ?>
                        <?php
                        $dispo = $user->checkDispo($salle['nom'], 'm_mercredi');
                        if ($dispo == 1) :
                        ?>
                          <option value="<?php echo $salle['nom']; ?>"><?php echo $salle['nom']; ?></option>
                        <?php endif; ?>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
                <div class="form-group mb-4">
                  <label for="groupeSelect" class="mb-1">Apres medit</label>
                  <div class="input-group">
                    <span class="input-group-text">
                      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                      </svg>
                    </span>
                    <select class="h-100" name="mercredi_apres">
                      <option value="non" selected>--------</option>
                      <?php foreach ($salles as $salle) : ?>
                        <?php if ($salle['nom'] == $emploi[0]['ap_mercredi']) : ?>
                          <option value="<?php echo $salle['nom']; ?>" selected><?php echo $salle['nom']; ?></option>
                        <?php endif; ?>
                        <?php
                        $dispo = $user->checkDispo($salle['nom'], 'ap_mercredi');
                        if ($dispo == 1) :
                        ?>
                          <option value="<?php echo $salle['nom']; ?>"><?php echo $salle['nom']; ?></option>
                        <?php endif; ?>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="d-flex justify-content-between">
                <h1 class="h3 col-lg-4">Jeudi :</h1>
                <div class="form-group mb-4">
                  <label for="groupeSelect" class="mb-1">Matin</label>
                  <div class="input-group">
                    <span class="input-group-text">
                      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                      </svg>
                    </span>
                    <select class="h-100" name="jeudi_matin">
                      <option value="non" selected>--------</option>
                      <?php foreach ($salles as $salle) : ?>
                        <?php if ($salle['nom'] == $emploi[0]['m_jeudi']) : ?>
                          <option value="<?php echo $salle['nom']; ?>" selected><?php echo $salle['nom']; ?></option>
                        <?php endif; ?>
                        <?php
                        $dispo = $user->checkDispo($salle['nom'], 'm_jeudi');
                        if ($dispo == 1) :
                        ?>
                          <option value="<?php echo $salle['nom']; ?>"><?php echo $salle['nom']; ?></option>
                        <?php endif; ?>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
                <div class="form-group mb-4">
                  <label for="groupeSelect" class="mb-1">Apres medit</label>
                  <div class="input-group">
                    <span class="input-group-text">
                      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                      </svg>
                    </span>
                    <select class="h-100" name="jeudi_apres">
                      <option value="non" selected>--------</option>
                      <?php foreach ($salles as $salle) : ?>
                        <?php if ($salle['nom'] == $emploi[0]['ap_jeudi']) : ?>
                          <option value="<?php echo $salle['nom']; ?>" selected><?php echo $salle['nom']; ?></option>
                        <?php endif; ?>
                        <?php
                        $dispo = $user->checkDispo($salle['nom'], 'ap_jeudi');
                        if ($dispo == 1) :
                        ?>
                          <option value="<?php echo $salle['nom']; ?>"><?php echo $salle['nom']; ?></option>
                        <?php endif; ?>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="d-flex justify-content-between">
                <h1 class="h3 col-lg-4">Vendredi :</h1>
                <div class="form-group mb-4">
                  <label for="groupeSelect" class="mb-1">Matin</label>
                  <div class="input-group">
                    <span class="input-group-text">
                      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                      </svg>
                    </span>
                    <select class="h-100" name="vendredi_matin">
                      <option value="non" selected>--------</option>
                      <?php foreach ($salles as $salle) : ?>
                        <?php if ($salle['nom'] == $emploi[0]['m_venredi']) : ?>
                          <option value="<?php echo $salle['nom']; ?>" selected><?php echo $salle['nom']; ?></option>
                        <?php endif; ?>
                        <?php
                        $dispo = $user->checkDispo($salle['nom'], 'm_vendredi');
                        if ($dispo == 1) :
                        ?>
                          <option value="<?php echo $salle['nom']; ?>"><?php echo $salle['nom']; ?></option>
                        <?php endif; ?>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
                <div class="form-group mb-4">
                  <label for="groupeSelect" class="mb-1">Apres medit</label>
                  <div class="input-group">
                    <span class="input-group-text">
                      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                      </svg>
                    </span>
                    <select class="h-100" name="vendredi_apres">
                      <option value="non" selected>--------</option>
                      <?php foreach ($salles as $salle) : ?>
                        <?php if ($salle['nom'] == $emploi[0]['ap_vendredi']) : ?>
                          <option value="<?php echo $salle['nom']; ?>" selected><?php echo $salle['nom']; ?></option>
                        <?php endif; ?>
                        <?php
                        $dispo = $user->checkDispo($salle['nom'], 'ap_vendredi');
                        if ($dispo == 1) :
                        ?>
                          <option value="<?php echo $salle['nom']; ?>"><?php echo $salle['nom']; ?></option>
                        <?php endif; ?>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="d-flex justify-content-between">
                <h1 class="h3 col-lg-4">Samedi :</h1>
                <div class="form-group mb-4">
                  <label for="groupeSelect" class="mb-1">Matin</label>
                  <div class="input-group">
                    <span class="input-group-text">
                      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                      </svg>
                    </span>
                    <select class="h-100" name="samedi_matin">
                      <option value="non" selected>--------</option>
                      <?php foreach ($salles as $salle) : ?>
                        <?php if ($salle['nom'] == $emploi[0]['m_samedi']) : ?>
                          <option value="<?php echo $salle['nom']; ?>" selected><?php echo $salle['nom']; ?></option>
                        <?php endif; ?>
                        <?php
                        $dispo = $user->checkDispo($salle['nom'], 'm_samedi');
                        if ($dispo == 1) :
                        ?>
                          <option value="<?php echo $salle['nom']; ?>"><?php echo $salle['nom']; ?></option>
                        <?php endif; ?>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
                <div class="form-group mb-4">
                  <label for="groupeSelect" class="mb-1">Apres medit</label>
                  <div class="input-group">
                    <span class="input-group-text">
                      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                      </svg>
                    </span>
                    <select class="h-100" name="samedi_apres">
                      <option value="non" selected>--------</option>
                      <?php foreach ($salles as $salle) : ?>
                        <?php if ($salle['nom'] == $emploi[0]['ap_samedi']) : ?>
                          <option value="<?php echo $salle['nom']; ?>" selected><?php echo $salle['nom']; ?></option>
                        <?php endif; ?>
                        <?php
                        $dispo = $user->checkDispo($salle['nom'], 'ap_samedi');
                        if ($dispo == 1) :
                        ?>
                          <option value="<?php echo $salle['nom']; ?>"><?php echo $salle['nom']; ?></option>
                        <?php endif; ?>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="d-flex align-items-center">
                <input type="hidden" name="groupeID" value="<?php echo $_GET['id'] ?>">
                <button type="submit" class="btn btn-p-dark d-inline-flex align-items-center justify-content-center">
                  <svg width="24" height="24" fill="none" viewBox="0 0 24 24" class="me-2">
                    <circle cx="12" cy="8" r="3.25" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5">
                    </circle>
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12.25 19.25H6.94953C5.77004 19.25 4.88989 18.2103 5.49085 17.1954C6.36247 15.7234 8.23935 14 12.25 14">
                    </path>
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14.75 17.75L16 19.25L19.25 14.75"></path>
                  </svg>
                  Affecter
                </button>
              </div>
          </form>
        <?php elseif (isset($_GET['a']) && $_GET['a'] == 'affectez' && isset($_GET['id'])) : ?>
          <?php
          $salles = $user->getSalles();
          $groupe = $user->getGroupe($_GET['id']);
          $checkEmploi = $user->checkEmploi($_GET['id']);

          if ($checkEmploi) {
            header("Location: emploi.php?a=edit&id=" . $_GET['id']);
          }
          ?>
          <?php if (count($groupe) > 0) : ?>
            <h1 class="h2 mb-5"> Affectez l'emploi du temp pour : <?php echo $groupe[0]['nom_groupe']; ?></h1>
          <?php else :  ?>
            <?php header("Location: emploi.php"); ?>
          <?php endif;  ?>
          <form action="" method="POST" class="mt-4 row d-flex flex-column" id="addEmploiForm">
            <div class="col-lg-6">
              <div class="d-flex justify-content-between">
                <h1 class="h3 col-lg-4">Lundi :</h1>
                <div class="form-group mb-4">
                  <label for="lundi_matin" class="mb-1">Matin</label>
                  <div class="input-group">
                    <span class="input-group-text">
                      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                      </svg>
                    </span>
                    <select class="h-100" name="lundi_matin">
                      <option value="non" selected>--------</option>
                      <?php foreach ($salles as $salle) : ?>
                        <?php
                        $dispo = $user->checkDispo($salle['nom'], 'm_lundi');
                        if ($dispo == 1) :
                        ?>
                          <option value="<?php echo $salle['nom']; ?>"><?php echo $salle['nom']; ?></option>
                        <?php endif; ?>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
                <div class="form-group mb-4">
                  <label for="groupeSelect" class="mb-1">Apres medit</label>
                  <div class="input-group">
                    <span class="input-group-text">
                      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                      </svg>
                    </span>
                    <select class="h-100" name="lundi_apres">
                      <option value="non" selected>--------</option>
                      <?php foreach ($salles as $salle) : ?>
                        <?php
                        $dispo = $user->checkDispo($salle['nom'], 'ap_lundi');
                        if ($dispo == 1) :
                        ?>
                          <option value="<?php echo $salle['nom']; ?>"><?php echo $salle['nom']; ?></option>
                        <?php endif; ?>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="d-flex justify-content-between">
                <h1 class="h3 col-lg-4">Mardi :</h1>
                <div class="form-group mb-4">
                  <label for="groupeSelect" class="mb-1">Matin</label>
                  <div class="input-group">
                    <span class="input-group-text">
                      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                      </svg>
                    </span>
                    <select class="h-100" name="mardi_matin">
                      <option value="non" selected>--------</option>
                      <?php foreach ($salles as $salle) : ?>
                        <?php
                        $dispo = $user->checkDispo($salle['nom'], 'm_mardi');
                        if ($dispo == 1) :
                        ?>
                          <option value="<?php echo $salle['nom']; ?>"><?php echo $salle['nom']; ?></option>
                        <?php endif; ?>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
                <div class="form-group mb-4">
                  <label for="groupeSelect" class="mb-1">Apres medit</label>
                  <div class="input-group">
                    <span class="input-group-text">
                      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                      </svg>
                    </span>
                    <select class="h-100" name="mardi_apres">
                      <option value="non" selected>--------</option>
                      <?php foreach ($salles as $salle) : ?>
                        <?php
                        $dispo = $user->checkDispo($salle['nom'], 'ap_mardi');
                        if ($dispo == 1) :
                        ?>
                          <option value="<?php echo $salle['nom']; ?>"><?php echo $salle['nom']; ?></option>
                        <?php endif; ?>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="d-flex justify-content-between">
                <h1 class="h3 col-lg-4">Mercredi :</h1>
                <div class="form-group mb-4">
                  <label for="groupeSelect" class="mb-1">Matin</label>
                  <div class="input-group">
                    <span class="input-group-text">
                      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                      </svg>
                    </span>
                    <select class="h-100" name="mercredi_matin">
                      <option value="non" selected>--------</option>
                      <?php foreach ($salles as $salle) : ?>
                        <?php
                        $dispo = $user->checkDispo($salle['nom'], 'm_mercredi');
                        if ($dispo == 1) :
                        ?>
                          <option value="<?php echo $salle['nom']; ?>"><?php echo $salle['nom']; ?></option>
                        <?php endif; ?>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
                <div class="form-group mb-4">
                  <label for="groupeSelect" class="mb-1">Apres medit</label>
                  <div class="input-group">
                    <span class="input-group-text">
                      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                      </svg>
                    </span>
                    <select class="h-100" name="mercredi_apres">
                      <option value="non" selected>--------</option>
                      <?php foreach ($salles as $salle) : ?>
                        <?php
                        $dispo = $user->checkDispo($salle['nom'], 'ap_mercredi');
                        if ($dispo == 1) :
                        ?>
                          <option value="<?php echo $salle['nom']; ?>"><?php echo $salle['nom']; ?></option>
                        <?php endif; ?>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="d-flex justify-content-between">
                <h1 class="h3 col-lg-4">Jeudi :</h1>
                <div class="form-group mb-4">
                  <label for="groupeSelect" class="mb-1">Matin</label>
                  <div class="input-group">
                    <span class="input-group-text">
                      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                      </svg>
                    </span>
                    <select class="h-100" name="jeudi_matin">
                      <option value="non" selected>--------</option>
                      <?php foreach ($salles as $salle) : ?>
                        <?php
                        $dispo = $user->checkDispo($salle['nom'], 'm_jeudi');
                        if ($dispo == 1) :
                        ?>
                          <option value="<?php echo $salle['nom']; ?>"><?php echo $salle['nom']; ?></option>
                        <?php endif; ?>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
                <div class="form-group mb-4">
                  <label for="groupeSelect" class="mb-1">Apres medit</label>
                  <div class="input-group">
                    <span class="input-group-text">
                      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                      </svg>
                    </span>
                    <select class="h-100" name="jeudi_apres">
                      <option value="non" selected>--------</option>
                      <?php foreach ($salles as $salle) : ?>
                        <?php
                        $dispo = $user->checkDispo($salle['nom'], 'ap_jeudi');
                        if ($dispo == 1) :
                        ?>
                          <option value="<?php echo $salle['nom']; ?>"><?php echo $salle['nom']; ?></option>
                        <?php endif; ?>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="d-flex justify-content-between">
                <h1 class="h3 col-lg-4">Vendredi :</h1>
                <div class="form-group mb-4">
                  <label for="groupeSelect" class="mb-1">Matin</label>
                  <div class="input-group">
                    <span class="input-group-text">
                      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                      </svg>
                    </span>
                    <select class="h-100" name="vendredi_matin">
                      <option value="non" selected>--------</option>
                      <?php foreach ($salles as $salle) : ?>
                        <?php
                        $dispo = $user->checkDispo($salle['nom'], 'm_vendredi');
                        if ($dispo == 1) :
                        ?>
                          <option value="<?php echo $salle['nom']; ?>"><?php echo $salle['nom']; ?></option>
                        <?php endif; ?>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
                <div class="form-group mb-4">
                  <label for="groupeSelect" class="mb-1">Apres medit</label>
                  <div class="input-group">
                    <span class="input-group-text">
                      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                      </svg>
                    </span>
                    <select class="h-100" name="vendredi_apres">
                      <option value="non" selected>--------</option>
                      <?php foreach ($salles as $salle) : ?>
                        <?php
                        $dispo = $user->checkDispo($salle['nom'], 'ap_vendredi');
                        if ($dispo == 1) :
                        ?>
                          <option value="<?php echo $salle['nom']; ?>"><?php echo $salle['nom']; ?></option>
                        <?php endif; ?>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="d-flex justify-content-between">
                <h1 class="h3 col-lg-4">Samedi :</h1>
                <div class="form-group mb-4">
                  <label for="groupeSelect" class="mb-1">Matin</label>
                  <div class="input-group">
                    <span class="input-group-text">
                      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                      </svg>
                    </span>
                    <select class="h-100" name="samedi_matin">
                      <option value="non" selected>--------</option>
                      <?php foreach ($salles as $salle) : ?>
                        <?php
                        $dispo = $user->checkDispo($salle['nom'], 'm_samedi');
                        if ($dispo == 1) :
                        ?>
                          <option value="<?php echo $salle['nom']; ?>"><?php echo $salle['nom']; ?></option>
                        <?php endif; ?>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
                <div class="form-group mb-4">
                  <label for="groupeSelect" class="mb-1">Apres medit</label>
                  <div class="input-group">
                    <span class="input-group-text">
                      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                      </svg>
                    </span>
                    <select class="h-100" name="samedi_apres">
                      <option value="non" selected>--------</option>
                      <?php foreach ($salles as $salle) : ?>
                        <?php
                        $dispo = $user->checkDispo($salle['nom'], 'ap_samedi');
                        if ($dispo == 1) :
                        ?>
                          <option value="<?php echo $salle['nom']; ?>"><?php echo $salle['nom']; ?></option>
                        <?php endif; ?>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="d-flex align-items-center">
                <input type="hidden" name="groupeID" value="<?php echo $_GET['id'] ?>">
                <button type="submit" class="btn btn-p-dark d-inline-flex align-items-center justify-content-center">
                  <svg width="24" height="24" fill="none" viewBox="0 0 24 24" class="me-2">
                    <circle cx="12" cy="8" r="3.25" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5">
                    </circle>
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12.25 19.25H6.94953C5.77004 19.25 4.88989 18.2103 5.49085 17.1954C6.36247 15.7234 8.23935 14 12.25 14">
                    </path>
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14.75 17.75L16 19.25L19.25 14.75"></path>
                  </svg>
                  Affecter
                </button>
              </div>
          </form>
        <?php elseif (isset($_GET['a']) && $_GET['a'] == 'show' && isset($_GET['id'])) : ?>
          <?php
          $groupe = $user->getGroupe($_GET['id']);
          $emploi = $user->getEmploi($_GET['id']);
          if (count($emploi) == 0) {
            header("Location: emploi.php");
          }
          ?>
          <div class="mb-5">
            <a href="#" class="btn btn-secondary" id="printEmploi">
              <svg xmlns="http://www.w3.org/2000/svg" widht="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
              </svg>
            </a>
          </div>
          <table cellspacing="0" align="center" class="table table-striped table-sm table-bordered" id="emploiTable">
            <tr>
              <td colspan="8" class="pt-5 ps-5">

                <?php if (count($groupe) > 0) : ?>
                  <h1 class="h2 mb-5"> l'emploi du temps pour : <?php echo $groupe[0]['nom_groupe']; ?></h1>
                <?php else :  ?>
                  <?php header("Location: emploi.php"); ?>
                <?php endif;  ?>

              </td>
            </tr>
            <tr>
              <td align="center" height="50" width="100" class="pb-4"><br>
                <b>Jour / Période</b></br>
              </td>
              <td align="center" height="50" width="100">
                <b>I<br>8:30-9:30</b>
              </td>
              <td align="center" height="50" width="100">
                <b>II<br>10:20-11:10</b>
              </td>
              <td align="center" height="50" width="100">
                <b>III<br>11:10-12:00</b>
              </td>
              <td align="center" height="50" width="100">
                <b>12:00-12:40</b>
              </td>
              <td align="center" height="50" width="100">
                <b>IV<br>12:40-1:30</b>
              </td>
              <td align="center" height="50" width="100">
                <b>V<br>1:30-2:20</b>
              </td>
              <td align="center" height="50" width="100">
                <b>VI<br>2:20-3:10</b>
              </td>
            </tr>
            <tr>
              <td align="center" height="50" class="pt-2">
                <b>Monday</b>
              </td>
              <td colspan="3" align="center" height="50" class="pt-3 h5"><?php
                                                                          if ($emploi[0]['m_lundi'] == 'non') {
                                                                          } else {
                                                                            echo $emploi[0]['m_lundi'];
                                                                          }
                                                                          ?></td>
              </td>
              <td rowspan="6" align="center" height="50" class="pt-2">
                <h2>D<br>É<br>J<br>E<br>U<br>N<br>E<br>R</h2>
              </td>
              <td colspan="3" align="center" height="50" class="pt-3 h5"><?php
                                                                          if ($emploi[0]['ap_lundi'] == 'non') {
                                                                          } else {
                                                                            echo $emploi[0]['ap_lundi'];
                                                                          }
                                                                          ?></td>
            </tr>
            <tr>
              <td align="center" height="50" class="pt-2">
                <b>Tuesday</b>
              </td>
              <td colspan="3" align="center" height="50" class="pt-3 h5"><?php
                                                                          if ($emploi[0]['m_mardi'] == 'non') {
                                                                          } else {
                                                                            echo $emploi[0]['m_mardi'];
                                                                          }
                                                                          ?></td>
              <td colspan="3" align="center" height="50" class="pt-3 h5"><?php
                                                                          if ($emploi[0]['ap_mardi'] == 'non') {
                                                                          } else {
                                                                            echo $emploi[0]['ap_mardi'];
                                                                          }
                                                                          ?></td>
            </tr>
            <tr>
              <td align="center" height="50" class="pt-2">
                <b>Wednesday</b>
              </td>
              <td colspan="3" align="center" height="50" class="pt-3 h5"><?php
                                                                          if ($emploi[0]['m_mercredi'] == 'non') {
                                                                          } else {
                                                                            echo $emploi[0]['m_mercredi'];
                                                                          }
                                                                          ?></td>
              <td colspan="3" align="center" height="50" class="pt-3 h5"><?php
                                                                          if ($emploi[0]['ap_mercredi'] == 'non') {
                                                                          } else {
                                                                            echo $emploi[0]['ap_mercredi'];
                                                                          }
                                                                          ?></td>
            </tr>
            <tr>
              <td align="center" height="50" class="pt-2">
                <b>Thursday</b>
              </td>
              <td colspan="3" align="center" height="50" class="pt-3 h5"><?php
                                                                          if ($emploi[0]['m_jeudi'] == 'non') {
                                                                          } else {
                                                                            echo $emploi[0]['m_jeudi'];
                                                                          }
                                                                          ?></td>
              <td colspan="3" align="center" height="50" class="pt-3 h5"><?php
                                                                          if ($emploi[0]['ap_jeudi'] == 'non') {
                                                                          } else {
                                                                            echo $emploi[0]['ap_jeudi'];
                                                                          }
                                                                          ?></td>
            </tr>
            <tr>
              <td align="center" height="50" class="pt-2">
                <b>Friday</b>
              </td>
              <td colspan="3" align="center" height="50" class="pt-3 h5"><?php
                                                                          if ($emploi[0]['m_vendredi'] == 'non') {
                                                                          } else {
                                                                            echo $emploi[0]['m_vendredi'];
                                                                          }
                                                                          ?></td>
              <td colspan="3" align="center" height="50" class="pt-3 h5"><?php
                                                                          if ($emploi[0]['ap_vendredi'] == 'non') {
                                                                          } else {
                                                                            echo $emploi[0]['ap_vendredi'];
                                                                          }
                                                                          ?></td>
            </tr>
            <tr>
              <td align="center" height="50" class="pt-2">
                <b>Saturday</b>
              </td>
              <td colspan="3" align="center" height="50" class="pt-3 h5"><?php
                                                                          if ($emploi[0]['m_samedi'] == 'non') {
                                                                          } else {
                                                                            echo $emploi[0]['m_samedi'];
                                                                          }
                                                                          ?></td>
              <td colspan="3" align="center" height="50" class="pt-3 h5"><?php
                                                                          if ($emploi[0]['ap_samedi'] == 'non') {
                                                                          } else {
                                                                            echo $emploi[0]['ap_samedi'];
                                                                          }
                                                                          ?></td>
            </tr>
          </table>
        <?php endif; ?>
      </div>
    </div>
  </main>
  <script src="../assets/js/jquery-3.6.0.min.js"></script>
  <script src="../assets/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/js/jquery.nice-select.min.js"></script>
  <script src="../assets/js/jquery.dataTables.min.js"></script>
  <script src="../assets/js/printThis.js"></script>
  <script>
    $(document).ready(function() {
      $("select").niceSelect();
      $("#printEmploi").on("click", function() {
        $('#emploiTable').printThis();
      });
      $('#emploisTable').DataTable();
      $("#addEmploiForm").on("submit", function(e) {
        e.preventDefault();
        let formData = $(this).serialize();
        $.ajax({
          type: "POST",
          url: "../actions/gestionnaire/emploi/add.php",
          data: formData,
          dataType: "json",
          success: function(data) {
            if (data.status == "success") {
              window.location.replace("emploi.php");
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
              $("#editEmploiErrors").html(errorsD);
            }
          },
        });
      });
      $("#editEmploiForm").on("submit", function(e) {
        e.preventDefault();
        let formData = $(this).serialize();
        $.ajax({
          type: "POST",
          url: "../actions/gestionnaire/emploi/edit.php",
          data: formData,
          dataType: "json",
          success: function(data) {
            if (data.status == "success") {
              window.location.replace("emploi.php");
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
              $("#editEmploiErrors").html(errorsD);
            }
          },
        });
      });
      $('#emploisTable tbody').on('submit', '#deleteEmploiForm', function(e) {
        e.preventDefault();
        let eID = $(this).children()[0].defaultValue;
        let formData = $(this).serialize();
        $.ajax({
          type: "POST",
          url: "../actions/gestionnaire/emploi/delete.php",
          data: formData,
          dataType: "json",
          success: function(data) {
            if (data.status == "success") {
              var table = $('#sallesTable').DataTable();
              table
                .row('tr#' + eID)
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