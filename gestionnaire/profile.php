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
    <title>Profile - <?php echo $_SESSION['prenom'] . " " . $_SESSION['nom']; ?></title>
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
    <main id="pageContent">
        <div class="container">
            <h2 class="text-center mb-5"><?php echo $_SESSION['prenom'] . " " . $_SESSION['nom']; ?> </h2>
            <div>
                <h5>Mes information:</h5>
                <div class="row">
                    <div class="col-12 d-flex align-items-center justify-content-center">
                        <div class="pt-4 w-100">
                            <div id="adminProfileEditErrors"></div>
                            <form action="" method="post" class="mt-4 row" id="adminProfileEditForm">
                                <div class="form-group mb-4 col-lg-4">
                                    <label for="nom" class="mb-1">Nom</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                            </svg>
                                        </span>
                                        <input type="text" class="form-control" name="nom" value="<?php echo $_SESSION['nom'] ?>" placeholder="Nom" id="nom" autofocus required>
                                    </div>
                                </div>
                                <div class="form-group mb-4 col-lg-4">
                                    <label for="prenom" class="mb-1">Prenom</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                            </svg>
                                        </span>
                                        <input type="text" class="form-control" name="prenom" value="<?php echo $_SESSION['prenom'] ?>" placeholder="Prenom" id="prenom" autofocus required>
                                    </div>
                                </div>
                                <div class="form-group mb-4 col-lg-4">
                                    <label for="email" class="mb-1">Email</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                            </svg>
                                        </span>
                                        <input type="email" class="form-control" name="email" value="<?php echo $_SESSION['email'] ?>" placeholder="example@company.com" id="email" autofocus disabled>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <button type="submit" class="btn btn-p-dark d-inline-flex align-items-center justify-content-center">
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
                <div class="border-bottom my-4"></div>
                <h5>Change mon mot de pass:</h5>
                <div class="row">
                    <div class="col-12 d-flex align-items-center justify-content-center">
                        <div class="w-100">
                            <div id="adminProfilePasswordErrors"></div>
                            <form action="" method="post" class="mt-4 row" id="adminProfilePasswordForm">
                                <div class="form-group mb-4 col-lg-4">
                                    <label for="current_password" class="mb-1">Current Password</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                                            </svg>
                                        </span>
                                        <input type="password" placeholder="Confirm Password" name="current_password" class="form-control" id="current_password" required>
                                    </div>
                                </div>
                                <div class="form-group mb-4 col-lg-4">
                                    <label for="new_password" class="mb-1">New Password</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                                            </svg>
                                        </span>
                                        </span>
                                        <input type="password" placeholder="Password" name="new_password" class="form-control" id="new_password" required>
                                    </div>
                                </div>
                                <div class="form-group mb-4 col-lg-4">
                                    <label for="confirm_password" class="mb-1">Confirm Password</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                                            </svg>
                                        </span>
                                        <input type="password" placeholder="Confirm Password" name="confirm_password" class="form-control" id="confirm_password" required>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <button type="submit" class="btn btn-p-dark d-inline-flex align-items-center justify-content-center">
                                        <svg width="24" height="24" fill="none" viewBox="0 0 24 24" class="me-2">
                                            <circle cx="12" cy="8" r="3.25" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5">
                                            </circle>
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12.25 19.25H6.94953C5.77004 19.25 4.88989 18.2103 5.49085 17.1954C6.36247 15.7234 8.23935 14 12.25 14">
                                            </path>
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14.75 17.75L16 19.25L19.25 14.75"></path>
                                        </svg>
                                        Save
                                    </button>
                                </div>
                            </form>
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
            $("#adminProfileEditForm").on("submit", function(e) {
                e.preventDefault();
                let formData = $(this).serialize();
                $.ajax({
                    type: "POST",
                    url: "../actions/gestionnaire/profile/edit.php",
                    data: formData,
                    dataType: "json",
                    success: function(data) {
                        if (data.status == "success") {
                            window.location.replace("profile.php");
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
                            $("#adminProfileEditErrors").html(errorsD);
                        }
                    },
                });
            });
            $("#adminProfilePasswordForm").on("submit", function(e) {
                e.preventDefault();
                let formData = $(this).serialize();
                $.ajax({
                    type: "POST",
                    url: "../actions/gestionnaire/profile/changePassword.php",
                    data: formData,
                    dataType: "json",
                    success: function(data) {
                        if (data.status == "success") {
                            window.location.replace("profile.php");
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
                            $("#adminProfilePasswordErrors").html(errorsD);
                        }
                    },
                });
            });
        });
    </script>
</body>

</html>