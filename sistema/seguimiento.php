<?php include_once "includes/header.php";



// <!-- // $fichaconsulta= "<script>document.writeIn(ficha);</script>"; -->
// <!-- // $nombre_programa = "<script>document.writeIn(programa);</script>"; -->

// $fichaconsulta = (isset($_POST['ficha_consulta'])) ? $_POST['ficha_consulta'] : '';
// $nombre_programa = (isset($_POST['programa_consulta'])) ? $_POST['programa_consulta'] : '';









// $consulta = "SELECT rap.id as rap_id, ficha_id, rcp.id, tipo_resultado, fecha_inicio, fecha_fin, resultado, comp_nombre as competencia, estado, pro_nombre, observacion FROM `fichas` f
// JOIN programa p ON f.nombre_programa = p.id_programa
// JOIN resultado_competencia_programa rcp ON p.id_programa = rcp.programa_id
// JOIN competencia c ON rcp.comp_id = c.comp_id
// JOIN resultados r ON rcp.resultado_id = r.id
// JOIN rap ON rcp.id = rap.rcp_id and f.id_ficha = rap.ficha_id
// WHERE p.pro_nombre = '$nombre_programa' and f.id_ficha = '$fichaconsulta'";

// $resultado = $conexion->prepare($consulta);
// $resultado->execute();
// $queryData=$resultado->fetchAll(PDO::FETCH_ASSOC);

// $queryData   = mysqli_query($conexion, $consulta);

?>

<div id="layoutSidenav_content">
    <main class="container">
        <br>
        <input type="button" class="btn btn-outline-dark" onclick="history.back()" name="volver atrás" value="volver">
        <hr>
        <div class="col-lg">
            <h3 class="mt-1">
                <?php
                $fichaconsulta = $_REQUEST['ficha'];
                $nombre_programa = $_REQUEST['programa'];
                ?>
                <div class="font-italic ">Seguimiento de ficha:</div><div class="font-weight-bold" id="fichaconsulta"><?php echo $fichaconsulta; ?></div>

                <div class="font-italic">Programa:</div><div class="font-weight-bold" id="programa_consulta"><?php echo $nombre_programa; ?></div>

            </h3>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered" id="tablaSeguimiento" width="100%" cellspacing="0">
                <br>
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Competencia</th>
                        <th>Resultado de <br> aprendizaje</th>
                        <th>Tipo de <br> resultado</th>
                        <th>Fecha inicio</th>
                        <th>Fecha fin</th>
                        <th>Estado de resultado</th>
                        <th>Observaciones</th>
                        <th>Opciones</th>

                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>id</th>
                        <th>Competencia</th>
                        <th>Resultado de <br> aprendizaje</th>
                        <th>Tipo de <br> resultado</th>
                        <th>Fecha inicio</th>
                        <th>Fecha fin</th>
                        <th>Estado de resultado</th>
                        <th>Observaciones</th>
                        <th>Opciones</th>

                    </tr>
                </tfoot>
                <tbody>

                </tbody>
            </table>
        </div>
</div>


<!-- MODAL EDITAR  -->

<div class="modal fade" id="modalCrudSeguimiento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="actualizar">
                    <div class="form-group">
                        <!-- <input type="text" style="border: none;" name="ficha" id="ficha" value="<?php echo $fichaconsulta; ?>"> -->
                    </div>
                    <div class="form-group">
                        <input type="text" style="border: none;" name="rap_id" id="rap_id" readonly required>
                    </div>
                    <!-- <div class="form-group">
                                    <label for="fase">Fase</label>
                                    <input type="text" class="form-control" name="fase" id="fase"  required>
                                </div> -->
                    <div class="form-group">
                        <label for="competencia">Competencia</label>
                        <textarea class="form-control" name="competencia" id="competencia" readonly required></textarea>
                    </div>
                    <!-- <div class="form-group">
                                    <label for="actividad">Actvidad de proyecto</label>
                                    <textarea class="form-control" id="actividad" name="actividad"  required></textarea>
                                </div> -->
                    <div class="form-group">
                        <label for="resultado">Resultado de Aprendizaje</label>
                        <textarea class="form-control" name="resultado" id="resultado" rows="2" readonly required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="tipo_resultado">Tipo de resultado</label>
                        <select class="form-control" readonly name="tipo_resultado" id="tipo_resultado">
                            <option selected, disabled>Seleccione tipo de resultado</option>
                            <option disabled value="Específico">Específico</option>
                            <option disabled value="Institucional">Institucional</option>
                            <option disabled value="Clave">Clave</option>
                            <option disabled value="Transversal">Transversal</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="fecha_inicio">Fecha de inicio </label>
                        <input type="date" class="form-control" name="fecha_inicio" id="fecha_inicio" required placeholder="Fecha de inicio">
                    </div>
                    <div class="form-group">
                        <label for="fecha_fin">Fecha de fin </label>
                        <input type="date" class="form-control" name="fecha_fin" id="fecha_fin" required placeholder="Fecha de fin">
                    </div>
                    <div class="form-group">
                        <label for="estado_resultado">Estado de resultado</label>
                        <select name="estado" id="estado_resultado" class="form-control">
                            <option selected, disabled>Seleccione tipo de resultado</option>
                            <option>Evaluado</option>
                            <option>Pendiente</option>
                            <option>En ejecución</option>

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="observacion">Observaciones</label>
                        <textarea name="observacion" id="observacion" class="form-control" placeholder="¿Alguna observacion?" rows="10">''</textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-primary" name="editar" id="btn_editar" value="Editar"></input>
                    </div>
                </form>

            </div>
        </div>
    </div>


</div>
</div>

</div>



<?php include_once "includes/footer.php"; ?>