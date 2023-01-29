<?php
session_start();

if (isset($_SESSION['gestionnaire'])) {
  header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Connexion du gestionnaire</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link type="text/css" href="../assets/css/bootstrap.min.css" rel="stylesheet">
  <link type="text/css" href="../assets/css/styles.css" rel="stylesheet">
</head>

<body class="bg-gray">
  <main>
    <section class="vh-100 d-flex">
      <div class="container">
        <div class="row h-100 justify-content-center">
          <div class="col-12 d-flex align-items-center justify-content-center">
            <div class="bg-white shadow border-0 rounded border-light p-4 p-lg-5 w-100 mw-500">
              <div class="text-center text-md-center mb-4 mt-md-0">
                <h1 class="mb-0 h3">Connexion du gestionnaire</h1>
                <div id="adminLoginErrors"></div>
              </div>
              <form action="#" class="mt-4" id="adminLoginForm">
                <div class="form-group mb-4">
                  <label for="email" class="mb-1">Email</label>
                  <div class="input-group">
                    <span class="input-group-text" id="basic-addon1">
                      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                        <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                      </svg>
                    </span>
                    <input type="email" name="email" class="form-control" placeholder="example@example.com" id="email" autofocus required>
                  </div>
                </div>
                <div class="form-group">
                  <div class="form-group mb-4">
                    <label for="password" class="mb-1">Mot de passe</label>
                    <div class="input-group">
                      <span class="input-group-text" id="basic-addon2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                          <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path>
                        </svg>
                      </span>
                      <input type="password" name="password" placeholder="Mot de passe" class="form-control" id="password" required>
                    </div>
                  </div>
                </div>
                <div class="d-grid">
                  <button type="submit" class="btn btn-p-dark text-white">Connectez-vous</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
  <script src="../assets/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/js/jquery-3.6.0.min.js"></script>
  <script>
    $("#adminLoginForm").on("submit", function(e) {
      e.preventDefault();
      let formData = $(this).serialize();
      $.ajax({
        type: "POST",
        url: "../actions/gestionnaire/signin.php",
        data: formData,
        dataType: "json",
        success: function(data) {
          if (data.status == "success") {
            window.location.replace("index.php");
          } else {
            let errors = "";
            for (const error of data) {
              errors += `<li>${error}</li>`;
            }

            let errorsD = `
            <div class="d-flex alert justify-content-between alert-danger px-2" role="alert">
                <ul>
                  ${errors}
                </ul>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
          `;
            $("#adminLoginErrors").html(errorsD);
          }
        },
      });
    });
  </script>
</body>

</html>