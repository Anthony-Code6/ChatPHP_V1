<div class="row justify-content-center">
    <div class="col-lg-6 col-md-6 col-sm-10 pt-5">
        <div class="card bg-dark text-success" style="border-radius: 20px;">
            <div class="card-body">
                <?php
                include 'registrar.php';
                ?>
            </div>
        </div>
    </div>
</div>

<?php
include '_scripthome.php';
?>

<script>
    const Usuario = () => {
        var nombre = $('#registrar_nombre').val()
        var apellido = $('#registrar_apellido').val()
        var correo = $('#registrar_correo').val()
        var password = $('#registrar_password').val()
        var foto = $('#logobase64').val()

        var mensaje = ''


        if (nombre == '' || apellido == '' || correo == '' || password == '') {
            if (nombre == '') {
                mensaje += '+ El nombre es requerido. <br/>'
            }
            if (apellido == '') {
                mensaje += '+ El apellido es requerido. <br/>'
            }
            if (correo == '') {
                mensaje += '+ El correo eléctronico es requerido. <br/>'
            }
            if (password == '') {
                mensaje += '+ La contraña es requerida. <br/>'
            }

            Alertas('error', 'Error', '<b>' + mensaje + '</b>')
        } else {
            var validEmail = /^\w+([.-_+]?\w+)*@\w+([.-]?\w+)*(\.\w{2,10})+$/;
            if (!validEmail.test(correo)) {
                console.log(validEmail.test(correo));
                Alertas('error', 'Error', '+ El Correo Eléctronico es invalido.')
            } else {


                let datos = {
                    "nombre": nombre,
                    "apellido": apellido,
                    "correo": correo,
                    "password": password,
                    "foto": foto,
                };


                $.ajax({
                    type: "POST",
                    url: "/crear",
                    data: JSON.stringify(datos),
                    dataType: "json",
                    //contentType:"application/json; charset=UTF-8",
                    processData: false,
                    CORS: true,
                    secure: true,
                    success: function(response) {
                        console.log(response);
                        if (response.exito == true) {
                            window.location = '/'
                        }

                        if (response.exito == false) {
                            Alertas('error', 'Error', '<b>' + response.mensajeError + '</b>')
                        }
                    },
                    beforeSend: function() {
                        console.log('en espera');
                    }
                });

            }
        }
    }
</script>