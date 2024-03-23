<div class="card bg-dark text-success" style="border-radius: 20px;">
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <div class="d-flex justify-content-start">
                <div class="image me-4">
                    <img src="<?php echo $_SESSION['usuario'][4] == '' ? '../../img/photo/users.jpg' : $_SESSION['usuario'][4]  ?>" class="rounded-circle" id="img_users" alt="">
                </div>
                <div class="text-success me-5">
                    <spam id="name_users"><?php echo $_SESSION['usuario'][1] . ' ' . $_SESSION['usuario'][2]  ?></spam>
                    <p id="status_users" class="text-success"><?php echo $_SESSION['usuario'][5] == 1 ? 'Activo' : 'Inactivo' ?></p>
                </div>
            </div>
            <div class="d-flex justify-content-end d-lg-block d-md-block d-sm-none d-none">
                <a href="/logout" class="text-success"><i class="fa-solid fa-right-from-bracket"></i></a>
            </div>
        </div>
    </div>
</div>