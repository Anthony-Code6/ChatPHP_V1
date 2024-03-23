<?php
$router->get('/', function () {
    $titulo = 'App Chat';
    require './view/header.php';
    require './view/home/index.php';
    require './view/footer.php';
});


$router->get('/crear', function () {
    $titulo = 'App Chat - Crear';
    require './view/header.php';
    require './view/home/crear.php';
    require './view/footer.php';
});

$router->get('/logout', function () {
    session_start();
    if ($_SESSION['usuario']) {
        $usuario = R::load('usuarios', $_SESSION['usuario'][0]);
        $usuario->estado = 0;
        R::store($usuario);

        session_destroy();
        echo "<script>window.location = '/'</script>";
    }

    echo "<script>window.location = '/'</script>";

    exit();
});

$router->post('/crear', function () {
    $data = json_decode(file_get_contents("php://input"), true);

    header('Access-Control-Allow-Origin: *');
    header("Content-Type: application/json; charset=UTF-8");

    $validar_correo = R::findOne('usuarios', 'correo=?', [$data['correo']]);

    if ($validar_correo) {
        echo json_encode(['exito' => false, 'mensajeError' => '+ El correo eléctronico ya existe.']);
    } else {
        $encriptar = new Encryptar();

        $usuario = R::dispense('usuarios');
        $usuario->nombre = $data['nombre'];
        $usuario->apellido = $data['apellido'];
        $usuario->correo = $data['correo'];
        $usuario->password = $encriptar->Encrypt($data['password']);
        $usuario->foto = $data['foto'] == '' ? '../../img/photo/users.jpg' : $data['foto'];
        R::store($usuario);

        echo json_encode(['exito' => true, 'mensaje' => $data]);
    }
    exit();
});

$router->post('/login', function () {
    $data = json_decode(file_get_contents("php://input"), true);

    header('Access-Control-Allow-Origin: *');
    header("Content-Type: application/json; charset=UTF-8");

    $encriptar = new Encryptar();

    $validar_correo = R::findOne('usuarios', 'correo=? and password=?', [$data['correo'], $encriptar->Encrypt($data['password'])]);

    if (!$validar_correo) {
        echo json_encode(['exito' => false, 'mensajeError' => '+ El correo eléctronico y/o la contraseña no existe.']);
    } else {

        $usuario = R::load('usuarios', $validar_correo->id);
        $usuario->estado = 1;
        R::store($usuario);

        session_start();

        $_SESSION['usuario'] = array();
        $_SESSION['usuario'][0] = $validar_correo->id;
        $_SESSION['usuario'][1] = $validar_correo->nombre;
        $_SESSION['usuario'][2] = $validar_correo->apellido;
        $_SESSION['usuario'][3] = $validar_correo->correo;
        $_SESSION['usuario'][4] = $validar_correo->foto;
        $_SESSION['usuario'][5] = $validar_correo->estado;

        echo json_encode(['exito' => true]);
    }
    exit();
});

