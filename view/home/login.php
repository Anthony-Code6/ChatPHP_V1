<div class="login">
    <h4 class="text-center text-success"><i class="fa-solid fa-skull"></i> Inicio de Session</h4>
    <hr>
    <form action="javascript:void(0)" method="post" enctype="multipart/form-data" autocomplete="off">
        <div class="form-grpuo mb-3">
            <label for="login_correo" class="form-label text-success"><i class="fa-solid fa-envelope"></i> Correo Eléctronico</label>
            <input type="text" name="login_correo" id="login_correo" class="form-control border border-success bg-dark text-success" placeholder="Correo Eléctronico ..." />
        </div>

        <div class="form-grpuo mb-3">
            <label for="login_password" class="form-label text-success"><i class="fa-solid fa-lock"></i> Contraseña</label>
            <input type="password" name="login_password" id="login_password" class="form-control border border-success bg-dark text-success" placeholder="Contraseña ..." />
        </div>

        <div class="float-end">
            <p class=" text-success">¿Aun no eres mienbro? <a href="/crear" class="text-success" style="text-decoration: none;"><b>Unete</b></a></p>

        </div>

        <div class="form-grpuo mb-3 text-center  pt-5">
            <button type="submit" class="btn btn-success bg-dark text-success" onclick="Login()"><i class="fa-solid fa-right-to-bracket"></i> Ingresar</button>
        </div>
    </form>
</div>

<script>
    const Login = () => {
        var correo = $('#login_correo').val()
        var password = $('#login_password').val()

        var mensaje = ''

        if (correo == '' || password == '') {
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
                    "correo": correo,
                    "password": password
                }

                $.ajax({
                    type: "POST",
                    url: "/login",
                    data: JSON.stringify(datos),
                    //contentType:"application/json; charset=UTF-8",
                    processData: false,
                    dataType: "json",
                    CORS: true,
                    secure: true,
                    success: function(response) {
                        if(response.exito == true){
                            window.location = '/chat'
                        }
                        if(response.exito == false){
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