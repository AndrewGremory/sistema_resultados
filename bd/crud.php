<?php
include_once '../bd/conexionn.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

// usuario
$nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : '';
$apellido = (isset($_POST['apellido'])) ? $_POST['apellido'] : '';
$usuario = (isset($_POST['usuario'])) ? $_POST['usuario'] : '';
$pw = (isset($_POST['pw'])) ? $_POST['pw'] : '';
$rol = (isset($_POST['rol'])) ? $_POST['rol'] : '';
$correo = (isset($_POST['correo'])) ? $_POST['correo'] : '';
$telefono = (isset($_POST['telefono'])) ? $_POST['telefono'] : '';


$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$id_usuario = (isset($_POST['id_usuario'])) ? $_POST['id_usuario'] : '';

// Ficha

$id_ficha = (isset($_POST['id_ficha'])) ? $_POST['id_ficha'] : '';
$tipo_programa = (isset($_POST['tipo_programa'])) ? $_POST['tipo_programa'] : '';
$pro_nombre = (isset($_POST['pro_nombre'])) ? $_POST['pro_nombre'] : '';
$lider_ficha = (isset($_POST['lider_ficha'])) ? $_POST['lider_ficha'] : '';
$nombreprograma = (isset($_POST['nombreprograma'])) ? $_POST['nombreprograma'] : '';




$fichaconsulta = (isset($_POST['ficha'])) ? $_POST['ficha'] : '';
$nombre_programa = (isset($_POST['programa'])) ? $_POST['programa'] : '';


// seguimiento
$rap_id= (isset($_POST['rap_id'])) ? $_POST['rap_id'] : '';
$ficha= (isset($_POST['ficha'])) ? $_POST['ficha'] : '';
$competencia= (isset($_POST['competencia'])) ? $_POST['competencia'] : '';
$resultado= (isset($_POST['resultado'])) ? $_POST['resultado'] : '';
$tipo_resultado= (isset($_POST['tipo_resultado'])) ? $_POST['tipo_resultado'] : '';
$fecha_inicio= (isset($_POST['fecha_inicio'])) ? $_POST['fecha_inicio'] : '';
$fecha_fin= (isset($_POST['fecha_fin'])) ? $_POST['fecha_fin'] : '';
$estado_resultado= (isset($_POST['estado_resultado'])) ? $_POST['estado_resultado'] : '';
$observacion= (isset($_POST['observacion'])) ? $_POST['observacion'] : '';

// $fichaconsulta = $_REQUEST['ficha'];
// $nombre_programa = $_REQUEST['programa'];






// Ficha
// $ficha = $_POST['ficha'];
// $tipoprograma = $_POST['tipo_programa'];
// $nombreprograma = $_POST['nombre_programa'];
// $liderficha = $_POST['lider_ficha'];


switch($opcion){
    case 1:
        $consulta = "INSERT INTO usuarios (nombre, apellido, usuario, pw, rol, correo, telefono) VALUES('$nombre', '$apellido', '$usuario', '$pw', '$rol', '$correo', '$telefono') ";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 
        
        $consulta = "SELECT * FROM usuarios ORDER BY id_usuario DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);       
        break;    
    case 2:        
        $consulta = "UPDATE usuarios SET nombre='$nombre', apellido='$apellido', usuario='$usuario', pw='$pw', rol='$rol', correo='$correo', telefono='$telefono' WHERE id_usuario='$id_usuario' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        
        $consulta = "SELECT * FROM usuarios WHERE id_usuario='$id_usuario' ";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 3:        
        $consulta = "DELETE FROM usuarios WHERE id_usuario='$id_usuario' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();                           
        break;
    case 4:    
        $consulta = "SELECT * FROM usuarios";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;


        // FICHAS 
    case 5: //INSERT
        $consulta = "INSERT INTO fichas (id_ficha, tipo_programa, nombre_programa, lider_ficha) VALUES ('$id_ficha', '$tipo_programa', '$pro_nombre', '$lider_ficha')";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

        $ingesta="INSERT into rap (ficha_id, rcp_id) SELECT id_ficha, rcp.id from fichas f 
        JOIN resultado_competencia_programa rcp ON f.nombre_programa = rcp.programa_id
        JOIN programa p ON rcp.programa_id = p.id_programa
        WHERE id_ficha = '$id_ficha' AND nombre_programa= '$pro_nombre\n'\n";

        $resultado = $conexion->prepare($ingesta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;

    case 6:
        $consulta = "UPDATE fichas SET lider_ficha = '$lider_ficha' WHERE id_ficha = '$id_ficha'";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        
        $consulta = "SELECT * FROM fichas";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

        break;

    case 7:        
        $consulta = "DELETE FROM fichas WHERE id_ficha='$id_ficha' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();                           
        break;
    
    case 8: 
        $consulta = "SELECT id_ficha, tipo_programa, pro_nombre, concat(usuarios.nombre,' ',usuarios.apellido) as lider, count(estado) as totalestados, (SELECT COUNT(estado) from rap where estado = 'Evaluado') evaluados
        FROM fichas 
                join programa on nombre_programa=id_programa 
                join usuarios on id_usuario=lider_ficha
                join rap on id_ficha = rap.ficha_id
                GROUP BY id_ficha";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;

        // SEGUIMIENTO

    case 9: //INSERT
        $consulta = "INSERT INTO fichas (id_ficha, tipo_programa, nombre_programa, lider_ficha) VALUES ('$id_ficha', '$tipo_programa', '$pro_nombre', '$lider_ficha')";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

        $ingesta="INSERT into rap (ficha_id, rcp_id) SELECT id_ficha, rcp.id from fichas f 
        JOIN resultado_competencia_programa rcp ON f.nombre_programa = rcp.programa_id
        JOIN programa p ON rcp.programa_id = p.id_programa
        WHERE id_ficha = '$id_ficha' AND nombre_programa= '$pro_nombre\n'\n";

        $resultado = $conexion->prepare($ingesta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;

    case 10:
        $consulta = "UPDATE rap SET fecha_inicio = '$fecha_inicio', fecha_fin = '$fecha_fin', estado='$estado_resultado', observacion='$observacion' WHERE id = '$rap_id'";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        
        $consulta = "SELECT * FROM rap";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

        echo '<script language="javascript">alert("juas");</script>';
        break;

    case 11:        
        $consulta = "DELETE FROM rap WHERE id='$rap_id' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();                           
        break;
    
    case 12: 
        $consulta = "SELECT rap.id as rap_id, ficha_id, rcp.id, tipo_resultado, fecha_inicio, fecha_fin, resultado, comp_nombre as competencia, estado, pro_nombre, observacion FROM `fichas` f
        JOIN programa p ON f.nombre_programa = p.id_programa
        JOIN resultado_competencia_programa rcp ON p.id_programa = rcp.programa_id
        JOIN competencia c ON rcp.comp_id = c.comp_id
        JOIN resultados r ON rcp.resultado_id = r.id
        JOIN rap ON rcp.id = rap.rcp_id and f.id_ficha = rap.ficha_id
        WHERE p.pro_nombre = '$nombre_programa' and f.id_ficha = '$fichaconsulta'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        

        break;

    case 13: //Pagina agregar ficha 
        $consulta = "INSERT INTO fichas (id_ficha, tipo_programa, nombre_programa, lider_ficha) VALUES ('$id_ficha', '$tipo_programa', '$pro_nombre', '$lider_ficha')";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

        $ingesta="INSERT into rap (ficha_id, rcp_id) SELECT id_ficha, rcp.id from fichas f 
        JOIN resultado_competencia_programa rcp ON f.nombre_programa = rcp.programa_id
        JOIN programa p ON rcp.programa_id = p.id_programa
        WHERE id_ficha = '$id_ficha' AND nombre_programa= '$pro_nombre\n'\n";

        $resultado = $conexion->prepare($ingesta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        header('Location: ../sistema/consultar_ficha.php');

        break;

    case 14: //Agregar programa
        $consulta = "INSERT into programa  values (NULL, '{$nombreprograma}')";
        $resultado = $conexion->prepare($consulta);
        $resultado ->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        header("Location: ../sistema/agregar_ficha.php");

        break;

    case 15:
        $consulta = "INSERT INTO usuarios (nombre, apellido, usuario, pw, rol, correo, telefono) VALUES('$nombre', '$apellido', '$usuario', '$pw', '$rol', '$correo', '$telefono') ";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 
        
        $consulta = "SELECT * FROM usuarios ORDER BY id_usuario DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);      
        header("Location: ../sistema/consultar_user.php");
 
        break;    




}

print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
$conexion=null;