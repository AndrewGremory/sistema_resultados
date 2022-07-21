<?php
class Conexion{
    public static function Conectar(){
        define('servidor','bpcfcrfah5nwhfqhcnxk-mysql.services.clever-cloud.com');
        define('nombre_bd','bpcfcrfah5nwhfqhcnxk');
        define('usuario','u0xsso8pckydedin');
        define('password','4XyI7CrQq3dBjlJhD5CI');
        

        
        $opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
        try{
            $conexion = new PDO("mysql:host=".servidor."; dbname=".nombre_bd, usuario, password, $opciones);
            return $conexion;
        }catch(Exception $error){
            die("El error en la conexion es: ". $error->getMessage());
        }
    }
}