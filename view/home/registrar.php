<div class="registrar">
    <div class="float-start">
        <a href="/" class="text-success"><i class="fas fa-chevron-left"></i></a>
    </div>
    <h4 class="text-center text-success"><i class="fa-solid fa-user-plus"></i> Crear Nuevo Usuario</h4>

    <hr>
    <form action="javascript:void(0)" method="post" enctype="multipart/form-data" autocomplete="off">
        <div class="row justify-content-start">
            <div class="col">
                <div class="form-grpuo mb-3">
                    <label for="registrar_nombre" class="form-label text-success"><i class="fa-solid fa-user"></i> Nombre</label>
                    <input type="text" name="registrar_nombre" id="registrar_nombre" class="form-control border border-success bg-dark text-success" placeholder="Nombre ..." onkeyup="return ValidarTexto(this)" />
                </div>
            </div>
            <div class="col">
                <div class="form-grpuo mb-3">
                    <label for="registrar_apellido" class="form-label text-success"><i class="fa-solid fa-user"></i> Apellido</label>
                    <input type="text" name="registrar_apellido" id="registrar_apellido" class="form-control border border-success bg-dark text-success" placeholder="Apellido ..." onkeyup="return ValidarTexto(this)" />
                </div>
            </div>
        </div>

        <div class="form-grpuo mb-3">
            <label for="registrar_correo" class="form-label text-success"><i class="fa-solid fa-envelope"></i> Correo Eléctronico</label>
            <input type="text" name="registrar_correo" id="registrar_correo" class="form-control border border-success bg-dark text-success" placeholder="Correo Eléctronico ..." />
        </div>

        <div class="form-grpuo mb-3">
            <label for="registrar_password" class="form-label text-success"><i class="fa-solid fa-lock"></i> Contraseña</label>
            <input type="password" name="registrar_password" id="registrar_password" class="form-control border border-success bg-dark text-success" placeholder="Contraseña ..." />
        </div>

        <div class="d-flex">
            <button class="contenedor-btn-file bordeado mb-3">
                <i class="fas fa-file"></i>
                Adjuntar archivo
                <label for="logo"></label>
                <input type="hidden" id="logobase64" name="logobase64" value="" />
                <input type="file" id="logo" name="logo" onchange="LeerDocumento(this)">
            </button>

            <div class="mt-2 ms-2 text-success" id="contenido-file"></div>
        </div>


        <div class="form-grpuo mb-3 text-center">
            <button type="submit" onclick="Usuario()" class="btn btn-success bg-dark text-success"><i class="fa-solid fa-floppy-disk"></i> Registrar</button>
        </div>
    </form>
</div>