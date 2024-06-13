<?php

namespace bd\model;

//Incluinos las clases necesarias para el codigo
use bd\model\BumBum;

//Requerimos del archivo de conexion y de los de la libreria para el envio del email
require_once 'conexion.php';


use PDOException;
use PDO;

class Mensajes
{

    public static function InsertarMensajes($pdo, $idUsuarioEnvia, $idUsuarioRecibe, $textoMensaje)
    {
        try {
            // Preparamos la consulta para insertar un nuevo registro en la tabla usuariossuperlike
            $query = "INSERT INTO usuariosmensajes (idUsuarioEnvia, idUsuarioRecibe, textMensaje, fechaMensaje) VALUES (:idUsuarioEnvia, :idUsuarioRecibe, :textMensaje,  NOW())";

            // Preparamos la consulta
            $statement = $pdo->prepare($query);

            // Asignamos los valores de los parámetros a los marcadores de posición
            $statement->bindParam(':idUsuarioEnvia', $idUsuarioEnvia);
            $statement->bindParam(':idUsuarioRecibe', $idUsuarioRecibe);
            $statement->bindParam(':textMensaje', $textoMensaje);


            // Ejecutamos la consulta
            $statement->execute();

            return true;

        } catch (PDOException $e) {
            // En caso de error, mostramos el mensaje
            print "¡Error!: " . $e->getMessage() . "<br/>";
            return false;
        }
    }

    public static function getMensajes($pdo, $idUsuario, $idUsuarioRecibe)
    {
        try {
            //Preparamos la consulta con un marcador de posición para el email
            $query = "SELECT * FROM usuariosMensajes WHERE (idUsuarioEnvia = :idUsuario OR idUsuarioRecibe= :idUsuario) AND (idUsuarioRecibe=:idUsuarioRecibe OR idUsuarioEnvia=:idUsuarioRecibe)";

            //Preparamos la consulta
            $statement = $pdo->prepare($query);

            $statement->bindParam(':idUsuario', $idUsuario);
            $statement->bindParam(':idUsuarioRecibe', $idUsuarioRecibe);


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

    public static function InsertarCita($pdo, $idUsuarioPropone, $idUsuarioAcepta, $fechaCita, $ubicacionCita)
    {
        try {
            // Preparamos la consulta para insertar un nuevo registro en la tabla usuariossuperlike
            $query = "INSERT INTO usuarioscitas(idUsuarioPropone, idUsuarioAcepta, fechaCita, ubicacionCita) VALUES (:idUsuarioPropone, :idUsuarioAcepta, :fechaCita, :ubicacionCita )";

            // Preparamos la consulta
            $statement = $pdo->prepare($query);

            // Asignamos los valores de los parámetros a los marcadores de posición
            $statement->bindParam(':idUsuarioPropone', $idUsuarioPropone);
            $statement->bindParam(':idUsuarioAcepta', $idUsuarioAcepta);
            $statement->bindParam(':ubicacionCita', $ubicacionCita);
            $statement->bindParam(':fechaCita', $fechaCita);



            // Ejecutamos la consulta
            $statement->execute();

            return true;

        } catch (PDOException $e) {
            // En caso de error, mostramos el mensaje
            print "¡Error!: " . $e->getMessage() . "<br/>";
            return false;
        }
    }

    public static function getCitas($pdo, $idUsuario, $fechainicio, $fechafin)
    {
        try {
            $query = "SELECT * FROM usuarioscitas WHERE idUsuarioPropone = :idUsuario AND (fechaCita BETWEEN :fechainicio AND :fechafin)";
            $statement = $pdo->prepare($query);
            $statement->bindParam(':idUsuario', $idUsuario);
            $statement->bindParam(':fechainicio', $fechainicio);
            $statement->bindParam(':fechafin', $fechafin);
            $statement->execute();
            return $statement->fetchAll();
        } catch (PDOException $e) {
            die("¡Error!: " . $e->getMessage());
        }
    }

    public static function getCitasTodas($pdo, $idUsuarioPropone)
    {
        try {
            $query = "SELECT * FROM usuarioscitas WHERE idUsuarioPropone = :idUsuario";
            $statement = $pdo->prepare($query);
            $statement->bindParam(':idUsuario', $idUsuarioPropone);
            $statement->execute();
            return $statement->fetchAll();
        } catch (PDOException $e) {
            die("¡Error!: " . $e->getMessage());
        }
    }

    public static function deleteCita($pdo, $idCita)
    {
        try {
            $query = "DELETE FROM usuarioscitas WHERE idCita = :idCita";
            $statement = $pdo->prepare($query);
            $statement->bindParam(':idCita', $idCita);
            $statement->execute();
            return true;
        } catch (PDOException $e) {
            die("¡Error!: " . $e->getMessage());
        }
    }

    public static function insertReviewCita($pdo, $idCita, $reviewCita, $idUsuario)
    {
        try {
            // Preparamos la consulta para insertar un nuevo registro en la tabla usuariossuperlike
            $query = "INSERT INTO usuariosreviewcita(idCita, idUsuario, fecha, reviewtexto) VALUES (:idCita, :idUsuario, NOW(), :reviewCita )";

            // Preparamos la consulta
            $statement = $pdo->prepare($query);

            // Asignamos los valores de los parámetros a los marcadores de posición
            $statement->bindParam(':idCita', $idCita);
            $statement->bindParam(':idUsuario', $idUsuario);
            $statement->bindParam(':reviewCita', $reviewCita);



            // Ejecutamos la consulta
            $statement->execute();

            return true;

        } catch (PDOException $e) {
            // En caso de error, mostramos el mensaje
            print "¡Error!: " . $e->getMessage() . "<br/>";
            return false;
        }
    }


}