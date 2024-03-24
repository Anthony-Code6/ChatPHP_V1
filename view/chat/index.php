<?php
session_start();
if($_SESSION['usuario']){
    
}else{
    echo "<script>window.location = '/logout'</script>";
}
?>

<div class="py-5">
    <div class="row justify-content-center">
        <div class="col-lg-4 col-md-6 col-sm-12">
            <?php include 'informacion.php'; ?>
        </div>
    </div>
</div>

<div class="row g-3 justify-content-start" id="friends"></div>

<script>
    const Listar = async () => {
        $.ajax({
            type: "GET",
            url: "/chat/users",
            data: false,
            dataType: "json",
            CORS: true,
            secure: true,
            success: function(response) {
                let temple = ''

                response.usuarios.forEach(element => {
                    temple += `
                    <div class="col-lg-4 col-md-4 col-sm-4 col-12">
                        <div class="card bg-dark text-success" style="border-radius: 20px;">
                            <div class="card-body" data-filter="${element.nombre.toUpperCase() +' '+element.apellido.toUpperCase()}" data-id="${element.id}" onclick="Mensaje(this)" style="cursor:pointer;">
                                <div class="d-flex">
                                    <div class="image me-4">
                                        <img src="${element.foto=='' ? '../../img/photo/users.jpg' : element.foto}" class="rounded-circle" id="img_friends" alt="">
                                    </div>
                                    <div class="text-success">
                                        <spam>${element.nombre +' '+element.apellido}</spam>
                                        ${element.estado==1 ? '<p class="text-success">Activo</p>' : '<p class="text-danger">Inactivo</p>'}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>`
                });

                $('#friends').html(temple);
            },
            beforeSend: function() {
                //console.log('en espera');
            }
        });
    }

    const Mensaje = (e) => {
        var id = $(e).attr('data-id');
        window.location = '/chat/' + id + '/message'
    }

    setInterval(() => {
        Listar()
    }, 1000);
</script>
