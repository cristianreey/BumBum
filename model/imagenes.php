<?php

namespace bd\model;

//Incluinos las clases necesarias para el codigo
use bd\model\BumBum;

//Requerimos del archivo de conexion y de los de la libreria para el envio del email
require_once 'conexion.php';


use PDOException;
use PDO;

class Imagenes
{

    public static function getImagenesUsuario($pdo, $idUsuario)
    {
        try {
            // Preparamos la consulta SQL
            $query = "SELECT * FROM usuariosimagenes WHERE idUsuario != :idUsuario";

            // Preparamos y ejecutamos la consulta
            $statement = $pdo->prepare($query);
            $statement->execute(array(':idUsuario' => $idUsuario));

            // Obtenemos los resultados
            $resulSet = $statement->fetchAll(PDO::FETCH_ASSOC);

            // Devolvemos los datos
            return $resulSet;
        } catch (PDOException $e) {
            // En caso de error, mostramos el mensaje
            print "¡Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }










}