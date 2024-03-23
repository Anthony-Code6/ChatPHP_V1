<?php
session_start();
if($_SESSION['usuario']){
    
}else{
    echo "<script>window.location = '/logout'</script>";
}
?>

<style>
    .right .direct-chat-text {
        margin-left: 0;
        margin-right: 0px;
    }

    .left .direct-chat-text {
        margin-left: 10px;
        margin-right: 0;
    }

    .direct-chat-messages {
        position: relative;
        min-height: 500px;
        max-height: 500px;
        overflow-y: auto;
        scrollbar-color: rgba(0, 0, 0, .5) rgba(0, 0, 0, 0);
        scrollbar-width: thin;
        padding: 10px 30px 20px 30px;
        box-shadow: inset 0 32px 32px -32px rgb(0 0 0 / 5%), inset 0 -32px 32px -32px rgb(0 0 0 / 5%);
    }
</style>

<div class="row justify-content-center">
    <div class="col--lg-6 col-md-8 col-sm-10 pt-5">
        <div class="card card-body bg-dark direct-chat" style="border-radius:30px;">
            <div class="d-flex">
                <div>
                    <a href="/chat" style="text-decoration: none;" class="text-success"><i class="fa-solid fa-chevron-left"></i></a>
                </div>
                <div class="image me-4">
                    <img src="../../img/photo/users.jpg" class="rounded-circle" id="photo_users" alt="">
                </div>
                <div class="detalles text-success">
                    <spam id="name_users"></spam>
                    <p id="status_users" class="text-success"></p>
                </div>
            </div>
            <hr />
            <div class="direct-chat-messages"></div>
            <form action="javascript:void(0)" method="post" enctype="multipart/form-data" autocomplete="off" onsubmit="EnviarMensaje()">
                <div class="input-group">
                    <input type="hidden" id="friend_id" name="friend_id" value="<?php echo $id ?>" />
                    <input type="text" name="message" id="message" class="form-control bg-dark border border-success text-success" placeholder="Ingrese el mensaje ....." />
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-outline-success bg-dark text-success enviar_mensaje"><i class="fas fa-paper-plane"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(".enviar_mensaje").attr({
        'disabled': true
    })
    $('#message').keyup(function(e) {
        e.preventDefault();
        if ($(this).val().length > 0) {
            $(".enviar_mensaje").attr({
                'disabled': false
            })
        } else {
            $(".enviar_mensaje").attr({
                'disabled': true
            })
        }
    });

    const EnviarMensaje = () => {
        let datos = {
            "envia":<?php echo $_SESSION['usuario'][0] ?>,
            "recibe": $('#friend_id').val(),
            "mensaje": $('#message').val(),
            "estado": $('#status_users').text() == "Activo" ? 1 : 0
        };

        console.log(datos);
        $.ajax({
            type: "POST",
            url: "/chat/message",
            data: JSON.stringify(datos),
            dataType: "json",
            //contentType:"application/json; charset=UTF-8",
            processData: false,
            CORS: true,
            secure: true,
            success: function(response) {
                $('#message').val('')
                console.log(response);
            },
            beforeSend: function() {
                //console.log('en espera');
            }
        });
    }

    const ListarMensajes = () => {
        $.ajax({
            type: "GET",
            url: "/chat/users/<?php echo $id ?>",
            data: false,
            dataType: "json",
            CORS: true,
            secure: true,
            success: function(response) {
                $('#photo_users').attr({
                    'src': response.amigo[0]['foto'] == '' ? '../../img/photo/users.jpg' : response.amigo[0]['foto']
                })
                $('#name_users').text(response.amigo[0]['nombre'] + ' ' + response.amigo[0]['apellido'])
                if (response.amigo[0]['estado'] == 0) {
                    $('#status_users').removeClass('text-success')
                    $('#status_users').addClass('text-danger')
                } else {
                    $('#status_users').removeClass('text-danger')
                    $('#status_users').addClass('text-success')
                }
                $('#status_users').text(response.amigo[0]['estado'] == 0 ? 'Inactivo' : 'Activo')

                let temple = ''
                response.mensaje.forEach(element => {
                    if (element.idenvia == response.usuario) {

                        temple += `<div class="direct-chat-msg right image">
                                    <img class="direct-chat-img" src="${element.foto == '' ? '../../img/photo/users.jpg' : element.foto}" alt="Message User Image">
                                    <div class="direct-chat-text d-inline-flex float-right">
                                        ${element.mensaje}
                                    </div>
                                </div>`
                    } else {

                        temple += `<div class="direct-chat-msg left image">
                                    <img class="direct-chat-img" src="${response.amigo[0]['foto'] == '' ? '../../img/photo/users.jpg' : response.amigo[0]['foto']}" alt="Message User Image">
                                    <div class="direct-chat-text d-inline-flex float-left">
                                        ${element.mensaje}
                                    </div>
                                </div>`


                    }
                });
                $('.direct-chat-messages').html(temple)
            },
            beforeSend: function() {
                //console.log('en espera');
            }
        });
    }

    setInterval(() => {
        ListarMensajes()
    }, 1000);
</script>