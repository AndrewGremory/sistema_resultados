
</div>
<footer class="footer">
  <div class="footer__block block no-margin-bottom">
    <div class="container-fluid text-center">
      <!-- Please do not remove the backlink to us unless you support us at https://bootstrapious.com/donate. It is part of the license conditions. Thank you for understanding :)-->
      <p class="no-margin-bottom"><?php echo fechaColombia(); ?> &copy; Sistema de gestion de resultados <a href="https://sena.com">Sena Cbc</a>.</p>
    </div>
  </div>
</footer>
</div>
</div>
<!-- JavaScript files-->
<script> var rol= '<?php echo $_SESSION['rol_name'] ?>'</script>
<script> var nombrecompleto= '<?php echo ucwords( $_SESSION['nombre'])." ".ucwords($_SESSION['apellido']); ?>'</script>
<script> var fichaConsulta= '<?php echo $fichaconsulta; ?>'</script>
<script> var programaConsulta= '<?php echo $nombre_programa; ?>'</script>



<script src="vendor/jquery/jquery-3.6.0.min.js"></script>
<script src="vendor/popper.js/umd/popper.min.js"> </script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!-- <script src="vendor/jquery.cookie/jquery.cookie.js"> </script> -->



<!-- <script src="vendor/jquery-validation/jquery.validate.min.js"></script> -->

<!-- datatables js  -->

<script type="text/javascript" src="vendor/datatables/datatables.min.js"></script>    
<script type="text/javascript" src="main.js"></script>  
<script type="text/javascript" src="js/all.min.js"></script>
<script src="js/scripts.js"></script>


<!-- importar excel -->

<!-- <script src="datatables/buttons.html5.min.js"></script>
<script src="datatables/buttons.print.min.js"></script> -->
<!-- <script src="datatables/dataTables.buttons.min.js"></script> -->
<!-- <script src="datatables/jquery.dataTables.min.js"></script> -->
<!-- <script src="datatables/jszip.min.js"></script>
<script src="datatables/pdfmake.min.js"></script>
<script src="datatables/vfs_fonts.js"></script> -->

<!-- <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
<script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>


<!-- <script src="js/jquery.dataTables.min.js"></script>
<script src="js/front.js"></script> 
<script src="js/Chart.bundle.min.js"></script>
<script src="js/dataTables.bootstrap4.min.js"></script>
<script src="js/sweetalert2@10.js"></script>

<script src="main.js"></script>

<script src="assets/demo/chart-area-demo.js"></script>
<script src="assets/demo/chart-bar-demo.js"></script>
<script src="assets/demo/datatables-demo.js"></script>



</body>

</html>