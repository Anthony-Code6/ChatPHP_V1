<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $titulo ?></title>
    <link rel="icon" href="/img/icon.jpg" type="image/x-icon">
    <link rel="stylesheet" href="/dist/css/chat.css">

    <!-- FONTAWESOME -->
    <script src="https://kit.fontawesome.com/a2aaea5898.js" crossorigin="anonymous"></script>

    <!-- ADMINLTE -->
    <link rel="stylesheet" href="/dist/css/adminlte/adminlte.min.css">
    <script src="/dist/js/adminlte/adminlte.js"></script>

    <!-- BOOTSTRAP -->
    <link rel="stylesheet" href="/dist/css/bootstrap/bootstrap.min.css">
    <script src="/dist/js/bootstrap/bootstrap.bundle.min.js"></script>

    <!-- JQUERY -->
    <script src="/dist/js/jquery/jquery-3.7.1.min.js"></script>
    <!-- SWEETALERT 2 -->
    <script src="/dist/js/sweetalert2/sweetalert2.min.js"></script>
    <!--  BS CUSTOM FILE INPUT-->
    <script src="/dist/js/bs-custom-file-input/bs-custom-file-input.js"></script>

    <script>
        bsCustomFileInput.init()

        const Alertas = (icono, titulo, texto) => {
            Swal.fire({
                title: titulo,
                html: texto,
                icon: icono
            });
        }
    </script>
</head>

<body>
    <!--
        <section>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="/">Navbar</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/abaout">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Link</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Dropdown
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </section>
     -->
    <div class="container">