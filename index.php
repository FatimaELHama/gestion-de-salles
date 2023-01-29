<?php
session_start();

if (isset($_SESSION['gestionnaire'])) {
    header("Location: gestionnaire/index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Gestion Salles et Emploi de temps</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link type="text/css" href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link type="text/css" href="assets/css/styles.css" rel="stylesheet">
</head>

<body class="bg-gray">
    <main>
        <section class="vh-100 d-flex">
            <div class="container">
                <div class="row h-100 justify-content-center">
                    <div class="col-12 d-flex flex-column align-items-center">
                        <svg width="260" height="260" viewBox="0 0 160 160" version="1.1" id="svg_null">
                            <g id="root" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <path d="M80 42l0 0c26.51 0 48 21.49 48 48l0 28l-96 0l0 -28c0 -26.51 21.49 -48 48 -48z" id="shape.secondary" fill="#ffc55c"></path>
                                <path d="M30 120l100 0l0 -30c0 -27.614 -22.386 -50 -50 -50c-27.614 0 -50 22.386 -50 50l0 30zm50 -82c28.719 0 52 23.281 52 52l0 32l-104 0l0 -32c0 -28.719 23.281 -52 52 -52z" id="shape.secondary" fill="#ffc55c" fill-rule="nonzero"></path>
                                <g id="group" transform="translate(38.000000, 92.000000)">
                                    <rect id="Rectangle-14" x="0" y="0" width="84" height="22"></rect><text id="headerText.primary" font-family="Roboto" font-size="18" font-weight="700" letter-spacing=".81" fill="#272e6e" data-text-alignment="C" font-style="normal">
                                        <tspan x="13.434566497802734" y="17.5">Gestio</tspan>
                                    </text>
                                </g>
                                <rect id="icon.primary" x="64" y="56" width="32" height="32" display="none" fill="#272e6e"></rect><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 50 50" version="1.1" fill="#272e6e" id="svg_icon.primary" x="64" y="56" width="32" height="32">
                                    <g id="surface1">
                                        <path style="" d="M 25 2 C 23.355469 2 22 3.355469 22 5 L 22 6 L 5 6 C 4.96875 6 4.9375 6 4.90625 6 C 4.390625 6.046875 3.996094 6.480469 4 7 L 4 26 C 4 26.550781 4.449219 27 5 27 L 22 27 L 22 42.03125 L 22.40625 42.3125 C 22.40625 42.3125 22.722656 42.53125 23.15625 42.6875 C 23.589844 42.84375 24.203125 43 25 43 C 25.796875 43 26.410156 42.84375 26.84375 42.6875 C 27.277344 42.53125 27.59375 42.3125 27.59375 42.3125 L 28 42.03125 L 28 27 L 45 27 C 45.550781 27 46 26.550781 46 26 L 46 7 C 46 6.449219 45.550781 6 45 6 L 28 6 L 28 5 C 28 3.355469 26.644531 2 25 2 Z M 25 4 C 25.566406 4 26 4.433594 26 5 L 26 6 L 24 6 L 24 5 C 24 4.433594 24.433594 4 25 4 Z M 6 8 L 44 8 L 44 25 L 6 25 Z M 12.28125 11.78125 C 10.21875 11.78125 8.875 12.910156 8.875 14.59375 C 8.875 15.957031 9.683594 16.785156 11.3125 17.125 L 12.46875 17.375 C 13.566406 17.609375 14 17.960938 14 18.53125 C 14 19.207031 13.316406 19.65625 12.34375 19.65625 C 11.289063 19.65625 10.554688 19.191406 10.46875 18.46875 L 8.65625 18.46875 C 8.726563 20.132813 10.121094 21.1875 12.25 21.1875 C 14.492188 21.1875 15.875 20.082031 15.875 18.28125 C 15.875 16.894531 15.109375 16.128906 13.3125 15.75 L 12.21875 15.5 C 11.171875 15.277344 10.75 14.988281 10.75 14.4375 C 10.75 13.757813 11.378906 13.3125 12.3125 13.3125 C 13.214844 13.3125 13.851563 13.792969 13.9375 14.5 L 15.71875 14.5 C 15.664063 12.90625 14.25 11.78125 12.28125 11.78125 Z M 20.40625 12.03125 L 17.3125 20.96875 L 19.1875 20.96875 L 19.875 18.8125 L 23 18.8125 L 23.6875 20.96875 L 25.71875 20.96875 L 22.625 12.03125 Z M 27.5625 12.03125 L 27.5625 20.96875 L 33.40625 20.96875 L 33.40625 19.3125 L 29.4375 19.3125 L 29.4375 12.03125 Z M 35.40625 12.03125 L 35.40625 20.96875 L 41.34375 20.96875 L 41.34375 19.34375 L 37.28125 19.34375 L 37.28125 17.1875 L 41.09375 17.1875 L 41.09375 15.71875 L 37.28125 15.71875 L 37.28125 13.625 L 41.34375 13.625 L 41.34375 12.03125 Z M 21.40625 13.875 L 21.5 13.875 L 22.625 17.375 L 20.28125 17.375 Z M 24 27 L 26 27 L 26 40.84375 C 25.769531 40.917969 25.488281 41 25 41 C 24.511719 41 24.234375 40.917969 24 40.84375 Z M 8.8125 32 C 8.488281 32.066406 8.222656 32.289063 8.09375 32.59375 L 2.09375 46.59375 C 1.957031 46.902344 1.984375 47.257813 2.167969 47.542969 C 2.351563 47.824219 2.664063 47.996094 3 48 L 47 48 C 47.335938 47.996094 47.648438 47.824219 47.832031 47.542969 C 48.015625 47.257813 48.042969 46.902344 47.90625 46.59375 L 41.90625 32.59375 C 41.746094 32.234375 41.390625 32.003906 41 32 L 30 32 L 30 34 L 40.34375 34 L 45.5 46 L 4.5 46 L 9.65625 34 L 20 34 L 20 32 L 9 32 C 8.96875 32 8.9375 32 8.90625 32 C 8.875 32 8.84375 32 8.8125 32 Z "></path>
                                    </g>
                                </svg>
                            </g>
                        </svg>
                        <div class="bg-white shadow border-0 border-light p-4 p-lg-5 w-100">
                            <div class="text-center text-md-center mb-4 mt-md-0">
                                <div class="row justify-content-center">
                                    <a href="gestionnaire/login.php" class="btn btn-p-dark col-lg-5 d-flex justify-content-center align-items-center fs-3 text-uppercase mb-4" style="height: 100px;">
                                        <svg width="60" height="60" fill="none" viewBox="0 0 24 24" class="me-3">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.75 6.75C4.75 5.64543 5.64543 4.75 6.75 4.75H17.25C18.3546 4.75 19.25 5.64543 19.25 6.75V17.25C19.25 18.3546 18.3546 19.25 17.25 19.25H6.75C5.64543 19.25 4.75 18.3546 4.75 17.25V6.75Z"></path>
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.75 8.75V19"></path>
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 8.25H19"></path>
                                        </svg>
                                        Gestionnaire</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <script src="/assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>