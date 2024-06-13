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
            //Preparamos la consulta con un marcador de posición para el email
            $query = "SELECT * FROM usuariosimagenes WHERE idUsuario != :idUsuario";

            //Preparamos la consulta
            $statement = $pdo->prepare($query);

            //Asignamos el valor del email al marcador de posición
            $statement->bindParam(':idUsuario', $idUsuario);

            //Ejecutamos la consulta
            $statement->execute();

            //Obtenemos el resultado
            $resultSet = $statement->fetchAll();
        } catch (PDOException $e) {
            //En caso de error, mostramos el mensaje
            print "¡Error!: " . $e->getMessage() . "<br/>";
            die();
        }
        //Devolvemos los datos
        return $resultSet;
    }

    public static function getImagenesUsuarioPerfil($pdo, $idUsuario)
    {
        try {
            //Preparamos la consulta con un marcador de posición para el email
            $query = "SELECT * FROM usuariosimagenes WHERE idUsuario = :idUsuario";

            //Preparamos la consulta
            $statement = $pdo->prepare($query);

            //Asignamos el valor del email al marcador de posición
            $statement->bindParam(':idUsuario', $idUsuario);

            //Ejecutamos la consulta
            $statement->execute();

            //Obtenemos el resultado
            $resultSet = $statement->fetchAll();
        } catch (PDOException $e) {
            //En caso de error, mostramos el mensaje
            print "¡Error!: " . $e->getMessage() . "<br/>";
            die();
        }
        //Devolvemos los datos
        return $resultSet;
    }











}