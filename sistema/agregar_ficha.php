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
        <h1 class="mt-1">Ingrese los datos de la ficha </h1>
        <div class="card-body">
            <form id="formulario" role="form" method="post" action="../bd/crud.php">
                <div class="form-row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="small mb-1" for="numeroFicha">Número ficha</label>
                            <input class="form-control" name="id_ficha" max="6" id="id" type="text" placeholder="Ingrese número de ficha" required maxlength="8" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" placeholder="Ingrese número de ficha" required /><i>(Máximo 8 dígitos)</i>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="small mb-1" for="TipoPrograma">Tipo de programa</label>
                            <select class="form-control" name="tipo_programa" id="TipoPrograma" required>
                                <option selected disabled value="">Selecciona una opción</option>
                                <option value="1">Especialización Tecnológica</option>
                                <option value="2">Tecnólogo </option>
                                <option value="3">Técnico</option>

                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="small mb-1" for="NombrePrograma">Nombre programa</label>
                    <select class="form-control" name="pro_nombre" id="pro_nombre" required>
                        <option selected disabled value="">Selecciona una opción</option>

                        <?php
                        $programa = "SELECT * from programa";
                        $resultado = $conexion->prepare($programa);
                        $resultado->execute();
                        $progra = $resultado->fetchAll(PDO::FETCH_ASSOC);

                        foreach ($progra as $dat) {
                        ?>
                            <option value="<?php echo $dat["id_programa"] ?>"><?php echo $dat["pro_nombre"] ?></option>
                        <?php }
                        ?>

                    </select>
                </div>

                <div class="form-group">
                    <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#AgregarPrograma">Agregar Programa</button>

                </div>

                <div class="form-group">

                    <label class="small mb-1" for="lider_ficha">Lider de ficha</label>
                    <select class="form-control" name="lider_ficha" id="lider_ficha" required>
                        <option selected disabled value="">Selecciona una opción</option>

                        <?php
                        $instructor = "SELECT * FROM usuarios where rol = 'instructor'";
                        $resultado = $conexion->prepare($instructor);
                        $resultado->execute();
                        $instructor = $resultado->fetchAll(PDO::FETCH_ASSOC);

                        foreach ($instructor as $dat) {
                        ?>
                            <option value="<?php echo $dat['id_usuario'] ?>"><?php echo $dat['nombre'] . " " . $dat['apellido'] ?></option>

                        <?php }
                        ?>

                    </select>

                    <input type="hidden" name="opcion" id="opcion" value="13">

                    <!-- <div class="form-group mt-4 mb-0"><a class="btn btn-primary btn-block" href="inicio.php">Agregar ficha</a> -->
                    <input type="submit" class="btn btn-primary btn-block orm-group mt-4 mb-0" value="Agregar Ficha">
                </div>
            </form>

            <div class="form-group">
                <div class="modal" tabindex="-1" id="AgregarPrograma">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                Agregar Programa
                                <button class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <form action="../bd/crud.php" id="Modal" method="POST">
                                    <div class="form-row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="small mb" for="InsertarNombre">Nombre de programa</label>
                                                <input class="form-control py-4" name="nombreprograma" id="nombreprograma" type="text" placeholder="Ingrese nombre de programa" />
                                            </div>
                                        </div>
                                        <input type="hidden" name="opcion" value="14">
                                        <input type="submit" class="btn btn-primary btn-block" value="Guardar">

                                </form>
                            </div>
                            <div class="modal-footer">

                            </div>
                        </div>
                    </div>

                </div>
            </div>


        </div>


        <?php include_once "includes/footer.php"; ?>