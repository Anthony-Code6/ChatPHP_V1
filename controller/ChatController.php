<?php

$router->get('/chat', function () {
    $titulo = 'App Chat - Chat';
    require './view/header.php';
    require './view/chat/index.php';
    require './view/footer.php';
});

$router->get('/chat/{id}/message', function ($id) {
    session_start();

    $mensaje = R::getAll("select * from usuarios as u 
                            where u.id=:id", [':id' => $id]);
    if ($mensaje) {
        $titulo = 'App Chat - Mensaje';
        require './view/header.php';
        require './view/chat/chat.php';
        require './view/footer.php';
    } else {
        echo "<script>window.location = '/chat'</script>";
    }
});


$router->get('/chat/users', function () {
    session_start();
    header('Access-Control-Allow-Origin: *');
    header("Content-Type: application/json; charset=UTF-8");
    if ($_SESSION['usuario']) {
        $usuarios = R::find('usuarios', 'id not in (?)', [$_SESSION['usuario'][0]]);
        echo json_encode(['exito' => true, 'usuarios' => R::exportAll($usuarios)]);
    } else {
        echo json_encode(['exito' => false, 'errorMensaje' => 'No estas autenticado.']);
    }

    exit();
});

$router->get('/chat/users/{id}', function ($id) {
    session_start();
    header('Access-Control-Allow-Origin: *');
    header("Content-Type: application/json; charset=UTF-8");
    if ($_SESSION['usuario']) {
        $usuario = R::getAll("select * from usuarios as u 
        where u.id=:id", [':id' => $id]);

        $mensaje = R::getAll("select m.*,u.foto from usuarios as u inner join mensajes as m 
                                on u.id=m.idenvia 
                                where (m.idenvia=:idenvia or m.idrecibe=:idamigo) or (m.idenvia=:idamigo or m.idrecibe=:idenvia)
                                order by m.id asc", [':idenvia' => $_SESSION['usuario'][0], ':idamigo' => $id]);


        echo json_encode(['exito' => true, 'mensaje' => $mensaje, 'usuario' => $_SESSION['usuario'][0],'amigo'=> $usuario ]);
    } else {
        echo json_encode(['exito' => false, 'errorMensaje' => 'No estas autenticado.']);
    }
    exit();
});

$router->post('/chat/message', function () {
    $data = json_decode(file_get_contents("php://input"), true);

    header('Access-Control-Allow-Origin: *');
    header("Content-Type: application/json; charset=UTF-8");

    $mensaje = R::dispense('mensajes');
    $mensaje->idenvia = $data['envia'];
    $mensaje->idrecibe = $data['recibe'];
    $mensaje->mensaje = $data['mensaje'];
    $mensaje->estado = $data['estado'];
    R::store($mensaje);
    
    echo json_encode(['exito' => true]);
    exit();
});

