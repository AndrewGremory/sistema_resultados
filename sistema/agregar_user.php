<?php include_once "includes/header.php"; ?>

<script>
    if ('<?php echo $_SESSION['rol_name'] ?>' == 'administrador') {} else {
        alert("No tienes permisos");
        location.href = "javascript:history.back()"
    };
</script>
<div id="layoutSidenav_content">
    <div class="container-fluid">
        <br>
        <input type="button" class="btn btn-outline-dark" onclick="history.back()" name="volver atrás" value="volver">
        <hr>
        <h1 class="mt-1">Ingrese los datos del usuario </h1>
        <div class="card-body">
            <form id="agregarUsuario" role="form" method="post" action="../bd/crud.php">
                <div class="form-row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="small mb-1" for="InsertarNombre" required>Nombres</label>
                            <input class="form-control py-4" name="nombre" type="text" placeholder="Ingrese nombres" required />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="small mb-1" for="InsertarApellido">Apellidos</label>
                            <input class="form-control py-4" name="apellido" type="text" placeholder="Ingrese apellidos" required />
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="small mb-1" for="InsertarUsuario">Usuario</label>
                    <input class="form-control py-4" name="usuario" type="text" aria-describedby="emailHelp" placeholder="Ingresar nombre de usuario" required />
                </div>
                <div class="form-row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="small mb-1" for="InsertarContraseña">Contraseña</label>
                            <input class="form-control py-4" name="pw" type="password" placeholder="Ingresar contraseña" required />
                        </div>
                    </div>


                </div>
                <div class="form-row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="small mb-1" for="Rol">Rol </label>
                            <select name="rol" class="form-control" name="rol" required>
                                <option selected disabled value="">Seleccione un tipo de usuario</option>
                                <option value="1">administrador</option>
                                <option value="2">instructor</option>
                                <option value="3">coordinador</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="small mb-1" for="InsertarUsuario">Correo electronico</label>
                            <input class="form-control py-4" name="correo" type="email" placeholder="Ingresar su correo electronico" required />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="small mb-1" for="InsertarUsuario">telefono</label>
                            <input class="form-control py-4" name="telefono" type="int" placeholder="Ingresar su correo electronico" required />
                        </div>
                    </div>
                </div>

                <input type="hidden" name="opcion" value="15">

                <input type="submit" class="btn btn-primary btn-block" name="Guardar" value="Guardar">

            </form>
        </div>
    </div>
</div>

</div>



<?php include_once "includes/footer.php"; ?>