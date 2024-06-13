<?php

namespace bd\model;


//Incluinos las clases necesarias para el codigo
use bd\model\BumBum;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

//Requerimos del archivo de conexion y de los de la libreria para el envio del email
require_once 'conexion.php';
require '..\PHPMailer-master\PHPMailer-master\src\PHPMailer.php';
require '..\PHPMailer-master\PHPMailer-master\src\Exception.php';
require '..\PHPMailer-master\PHPMailer-master\src\SMTP.php';


use PDOException;
use PDO;

class Usuario
{
    public static function registrarCliente($nombre, $apellido1, $apellido2, $email, $password, $fechaNacimiento)
    {
        $pdo = BumBum::conectar();

        // Validar los datos
        if (empty($nombre) || empty($apellido1) || empty($apellido2) || empty($email) || empty($password) || empty($fechaNacimiento)) {
            return "Por favor, complete todos los campos.";
        } else {
            try {
                // Generar código de activación
                $codigoActivacion = bin2hex(random_bytes(10));

                $salt = bin2hex(random_bytes(16));

                // Hash de la contraseña
                $hashedPassword = hash('sha256', $password . $salt);

                // Definir el valor predeterminado para el campo activo como false
                $activo = false;

                // Utilizar prepared statements para evitar inyección SQL
                $stmt = $pdo->prepare("INSERT INTO usuarios (nombre, email, contrasena, apellido1, apellido2, fechaNacimiento, activo, codigo_activacion, salt) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->bindParam(1, $nombre);
                $stmt->bindParam(2, $email);
                $stmt->bindParam(3, $hashedPassword);
                $stmt->bindParam(4, $apellido1);
                $stmt->bindParam(5, $apellido2);
                $stmt->bindParam(6, $fechaNacimiento);
                $stmt->bindParam(7, $activo, PDO::PARAM_BOOL);
                $stmt->bindParam(8, $codigoActivacion);
                $stmt->bindParam(9, $salt);

                if ($stmt->execute()) {
                    // Enviar el código de activación por correo electrónico usando PHPMailer
                    $mail = new PHPMailer(true);

                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'bum511bum@gmail.com';
                    $mail->Password = 'yfdwvemtnurcaxop';
                    $mail->SMTPSecure = 'tls';
                    $mail->Port = 587;
                    $mail->SMTPDebug = 0;

                    $mail->CharSet = 'UTF-8';
                    $mail->Encoding = 'base64';

                    $mail->setFrom('bum511bum@gmail.com', 'BumBum');
                    $mail->addAddress($email);

                    $mail->isHTML(true);
                    $mail->Subject = mb_encode_mimeheader('Código de Activación', 'UTF-8');
                    $mail->Body = "
    <html>
    <head>
        <style>
            /* Estilos CSS en línea */
            body {
                font-family: 'Arial', sans-serif;
                background-color: #f5f5f5;
                margin: 0;
                padding: 0;
            }
            .container {
                width: 100%;
                max-width: 600px;
                margin: 0 auto;
                padding: 20px;
                background-color: #ffffff;
                border-radius: 8px;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            }
            .logo {
                display: block;
                margin: 0 auto 20px;
                max-width: 200px;
            }
            .verification-code {
                display: flex;
                justify-content: center;
                align-items: center;
            }
            .verification-code-digit {
                width: 40px;
                height: 40px;
                line-height: 40px;
                border: 1px solid #ccc;
                border-radius: 4px;
                background-color: #f9f9f9;
                font-size: 18px;
                color: #333333;
                margin-right: 5px;
                text-align: center;
            }
        </style>
    </head>
    <body>
        <div class='container'>
            <h1>Hola,</h1>
            <p>Este es su código de activación para registrarse en la página web de BumBum:</p>
            <div class='verification-code'>
                ";
                    for ($i = 0; $i < 20; $i++) {
                        $mail->Body .= "<div class='verification-code-digit'>$codigoActivacion[$i]</div>";
                    }
                    $mail->Body .= "
            </div>
            <p>¡Gracias por unirte a nosotros!</p>
            <p>Atentamente,<br>El equipo de BumBum</p>
            <p class='footer'>Por favor, no responda a este correo electrónico. Este es un mensaje generado automáticamente.</p>
        </div>
    </body>
    </html>
";
                    $mail->send();

                    return true;
                } else {
                    return "Error al registrar: " . $stmt->errorInfo()[2];
                }
            } catch (PDOException $e) {
                return "Error al registrar: " . $e->getMessage();
            } catch (Exception $e) {
                return "Error al enviar el correo: " . $e->getMessage();
            }
        }
    }

    public static function iniciarSesion($email, $password)
    {
        // Realizar la conexión a la base de datos
        $pdo = BumBum::conectar();

        // Iniciar o reanudar la sesión
        session_start();

        if (empty($email) || empty($password)) {
            return "Por favor, complete todos los campos.";
        } else {
            try {

                // Obtener el usuario de la base de datos
                $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
                $stmt->execute([$email]);

                $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($usuario) {
                    // Verificar si la contraseña hash coincide con la almacenada en la base de datos
                    $salt = $usuario['salt'];
                    $hashedPassword = hash('sha256', $password . $salt);

                    //Verificar si el usuario esta o no activo
                    $esActivo = $usuario['activo'];


                    if ($hashedPassword === $usuario['contrasena']) {
                        // Verificar si el usuario está activo
                        if ($esActivo) {
                            return true;
                        } else {
                            // Redireccionar al usuario a otra página si no está activo
                            header("Location: ../view/verificacion_view.php");
                            exit;
                        }
                    } else {
                        return false;
                    }

                }
            } catch (PDOException $e) {
                return "Error al iniciar sesión: " . $e->getMessage();
            }
        }
    }

    public static function compararCodigoVerificacion($codigoVerificacion)
    {
        // Realizar la conexión a la base de datos
        $pdo = BumBum::conectar();


        try {
            // Consultar el usuario utilizando el código de activación
            $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE codigo_activacion = ?");
            $stmt->execute([$codigoVerificacion]);

            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            // Verificar si se encontró un usuario con el código de activación proporcionado
            if ($usuario) {
                // Actualizar el estado de activación del usuario a activo
                $stmt = $pdo->prepare("UPDATE usuarios SET activo = 1 WHERE codigo_activacion = ?");
                $stmt->execute([$codigoVerificacion]);

                // Devolver verdadero para indicar que el código de activación es válido
                return true;
            } else {
                // Devolver falso si no se encontró ningún usuario con el código de activación proporcionado
                return false;
            }
        } catch (PDOException $e) {
            return "Error al comparar el código de verificación: " . $e->getMessage();
        }
    }


    public static function getDatosUsuarioDetalles($pdo, $idUsuario)
    {

        try {


            //Realizamos la query
            $query = "SELECT * FROM usuariosdetalles WHERE idUsuario = :idUsuario";


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

    public static function getDatosUsuario($pdo, $idUsuario)
    {
        try {
            //Preparamos la consulta con un marcador de posición para el email
            $query = "SELECT * FROM usuarios WHERE idUsuario = :idUsuario";

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

    public static function getDatosUsuarioPorEmail($pdo, $email)
    {
        try {
            //Preparamos la consulta con un marcador de posición para el email
            $query = "SELECT * FROM usuarios WHERE email = :email";

            //Preparamos la consulta
            $statement = $pdo->prepare($query);

            //Asignamos el valor del email al marcador de posición
            $statement->bindParam(':email', $email);

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

    public static function insertarUsuarioSuperlike($pdo, $idUsuarioManda, $idUsuarioRecibe)
    {
        try {
            // Preparamos la consulta para insertar un nuevo registro en la tabla usuariossuperlike
            $query = "INSERT INTO usuariossuperlike (idUsuarioManda, idUsuarioRecibe, fechaSuperLike) VALUES (:idUsuarioManda, :idUsuarioRecibe, NOW())";

            // Preparamos la consulta
            $statement = $pdo->prepare($query);

            // Asignamos los valores de los parámetros a los marcadores de posición
            $statement->bindParam(':idUsuarioManda', $idUsuarioManda);
            $statement->bindParam(':idUsuarioRecibe', $idUsuarioRecibe);

            // Ejecutamos la consulta
            $statement->execute();



        } catch (PDOException $e) {
            // En caso de error, mostramos el mensaje
            print "¡Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    public static function insertarUsuarioRechazados($pdo, $idUsuarioManda, $idUsuarioRecibe)
    {
        try {
            // Preparamos la consulta para insertar un nuevo registro en la tabla usuariossuperlike
            $query = "INSERT INTO usuariosdenegados (idUsuarioDenegado, idUsuarioDenegador, fecha) VALUES (:idUsuarioRecibe, :idUsuarioManda, NOW())";

            // Preparamos la consulta
            $statement = $pdo->prepare($query);

            // Asignamos los valores de los parámetros a los marcadores de posición
            $statement->bindParam(':idUsuarioManda', $idUsuarioManda);
            $statement->bindParam(':idUsuarioRecibe', $idUsuarioRecibe);

            // Ejecutamos la consulta
            $statement->execute();



        } catch (PDOException $e) {
            // En caso de error, mostramos el mensaje
            print "¡Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    public static function insertarUsuarioBloquear($pdo, $idUsuarioManda, $idUsuarioRecibe, $motivo)
    {
        try {
            // Preparamos la consulta para insertar un nuevo registro en la tabla usuariossuperlike
            $query = "INSERT INTO usuariosbloqueados (idUsuarioBloqueador, idUsuarioBloqueado, fechaBloqueo, motivo) VALUES (:idUsuarioBloqueador, :idUsuarioBloqueado, NOW(), :motivo)";

            // Preparamos la consulta
            $statement = $pdo->prepare($query);

            // Asignamos los valores de los parámetros a los marcadores de posición
            $statement->bindParam(':idUsuarioBloqueador', $idUsuarioManda);
            $statement->bindParam(':idUsuarioBloqueado', $idUsuarioRecibe);
            $statement->bindParam(':motivo', $motivo);


            // Ejecutamos la consulta
            $statement->execute();



        } catch (PDOException $e) {
            // En caso de error, mostramos el mensaje
            print "¡Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    public static function contarUsuariosSuperlike($pdo, $idUsuario)
    {
        try {
            //Preparamos la consulta con un marcador de posición para el idUsuario
            $query = "SELECT COUNT(*) AS total FROM usuariossuperlike WHERE idusuarioManda = :idUsuario";

            //Preparamos la consulta
            $statement = $pdo->prepare($query);

            //Asignamos el valor del idUsuario al marcador de posición
            $statement->bindParam(':idUsuario', $idUsuario);

            //Ejecutamos la consulta
            $statement->execute();

            //Obtenemos el resultado
            $resultado = $statement->fetch(PDO::FETCH_ASSOC);

            //Extraemos el total de la consulta
            $total = $resultado['total'];

        } catch (PDOException $e) {
            //En caso de error, mostramos el mensaje
            print "¡Error!: " . $e->getMessage() . "<br/>";
            die();
        }
        //Devolvemos el total
        return $total;
    }


    public static function getUsuariosDenegados($pdo, $idUsuario)
    {
        try {
            //Preparamos la consulta con un marcador de posición para el idUsuario
            $query = "SELECT COUNT(*) AS total FROM usuariosdenegados WHERE idUsuarioDenegador = :idUsuario";

            //Preparamos la consulta
            $statement = $pdo->prepare($query);

            //Asignamos el valor del idUsuario al marcador de posición
            $statement->bindParam(':idUsuario', $idUsuario);

            //Ejecutamos la consulta
            $statement->execute();

            //Obtenemos el resultado
            $resultado = $statement->fetch(PDO::FETCH_ASSOC);

            //Extraemos el total de la consulta
            $total = $resultado['total'];

        } catch (PDOException $e) {
            //En caso de error, mostramos el mensaje
            print "¡Error!: " . $e->getMessage() . "<br/>";
            die();
        }
        //Devolvemos el total
        return $total;
    }
    public static function getUsuariosBloqueados($pdo, $idUsuario)
    {
        try {
            //Preparamos la consulta con un marcador de posición para el idUsuario
            $query = "SELECT COUNT(*) AS total FROM usuariosbloqueados WHERE idUsuarioBloqueador = :idUsuario";

            //Preparamos la consulta
            $statement = $pdo->prepare($query);

            //Asignamos el valor del idUsuario al marcador de posición
            $statement->bindParam(':idUsuario', $idUsuario);

            //Ejecutamos la consulta
            $statement->execute();

            //Obtenemos el resultado
            $resultado = $statement->fetch(PDO::FETCH_ASSOC);

            //Extraemos el total de la consulta
            $total = $resultado['total'];

        } catch (PDOException $e) {
            //En caso de error, mostramos el mensaje
            print "¡Error!: " . $e->getMessage() . "<br/>";
            die();
        }
        //Devolvemos el total
        return $total;
    }

    public static function modificarUsuarioDetalles($pdo, $idUsuario, $provincia, $pais, $domicilio, $codigoPostal, $ciudad, $colorFavorito, $comidaFavorita, $deporteFavorito, $hobbie, $colorPiel, $altura, $colorPelo, $tatuajes, $colorOjos)
    {
        try {
            // Preparamos la consulta de actualización
            $query = "UPDATE usuariosdetalles SET provincia = :provincia, pais = :pais, domicilio = :domicilio, codigoPostal = :codigoPostal, ciudad = :ciudad, colorFavorito = :colorFavorito, comidaFavorita = :comidaFavorita, deporteFavorito = :deporteFavorito, hobbie = :hobbie, colorPiel = :colorPiel, altura = :altura, colorPelo = :colorPelo, tatuajes = :tatuajes, colorOjos = :colorOjos WHERE idUsuario = :idUsuario";

            // Preparamos la consulta
            $statement = $pdo->prepare($query);

            // Asignamos los valores a los marcadores de posición
            $statement->bindParam(':idUsuario', $idUsuario);
            $statement->bindParam(':provincia', $provincia);
            $statement->bindParam(':pais', $pais);
            $statement->bindParam(':domicilio', $domicilio);
            $statement->bindParam(':codigoPostal', $codigoPostal);
            $statement->bindParam(':ciudad', $ciudad);
            $statement->bindParam(':colorFavorito', $colorFavorito);
            $statement->bindParam(':comidaFavorita', $comidaFavorita);
            $statement->bindParam(':deporteFavorito', $deporteFavorito);
            $statement->bindParam(':hobbie', $hobbie);
            $statement->bindParam(':colorPiel', $colorPiel);
            $statement->bindParam(':altura', $altura);
            $statement->bindParam(':colorPelo', $colorPelo);
            $statement->bindParam(':tatuajes', $tatuajes);
            $statement->bindParam(':colorOjos', $colorOjos);

            // Ejecutamos la consulta
            $statement->execute();

            // Devolvemos true si la actualización fue exitosa
            return true;
        } catch (PDOException $e) {
            // En caso de error, mostramos el mensaje y devolvemos false
            echo "¡Error!: " . $e->getMessage();
            return false;
        }
    }

    public static function modificarContraseña($pdo, $password, $idUsuario)
    {
        try {



            // Obtener el usuario de la base de datos
            $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE idUsuario = ?");
            $stmt->execute([$idUsuario]);

            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($usuario) {

                $salt = $usuario['salt'];

                // Hash de la contraseña
                $hashedPassword = hash('sha256', $password . $salt);

                // Preparamos la consulta de actualización
                $query = "UPDATE usuarios SET contrasena = :contrasena WHERE idUsuario = :idUsuario";

                // Preparamos la consulta
                $statement = $pdo->prepare($query);

                // Asignamos los valores a los marcadores de posición
                $statement->bindParam(':contrasena', $hashedPassword);
                $statement->bindParam(':idUsuario', $idUsuario);


                // Ejecutamos la consulta
                $statement->execute();
            }



            // Devolvemos true si la actualización fue exitosa
            return true;
        } catch (PDOException $e) {
            // En caso de error, mostramos el mensaje y devolvemos false
            echo "¡Error!: " . $e->getMessage();
            return false;
        }
    }

    public static function eliminarCuenta($pdo, $idUsuario)
    {
        try {
            // Preparar la consulta SQL para eliminar el usuario
            $stmt = $pdo->prepare("DELETE FROM usuarios WHERE idUsuario = :idUsuario");

            // Asignar el valor del idUsuario al parámetro de la consulta
            $stmt->bindParam(':idUsuario', $idUsuario, PDO::PARAM_INT);

            // Ejecutar la consulta
            $stmt->execute();

            // Devolvemos true si la eliminación fue exitosa
            return true;
        } catch (PDOException $e) {
            // En caso de error, mostramos el mensaje y devolvemos false
            echo "¡Error!: " . $e->getMessage();
            return false;
        }
    }

    public static function eliminarCuentaDetalles($pdo, $idUsuario)
    {
        try {
            // Preparar la consulta SQL para eliminar el usuario
            $stmt = $pdo->prepare("DELETE FROM usuariosdetalles WHERE idUsuario = :idUsuario");

            // Asignar el valor del idUsuario al parámetro de la consulta
            $stmt->bindParam(':idUsuario', $idUsuario, PDO::PARAM_INT);

            // Ejecutar la consulta
            $stmt->execute();

            // Devolvemos true si la eliminación fue exitosa
            return true;
        } catch (PDOException $e) {
            // En caso de error, mostramos el mensaje y devolvemos false
            echo "¡Error!: " . $e->getMessage();
            return false;
        }
    }

    public static function obtenerTiempoSesion()
    {
        if (isset($_SESSION['login_time'])) {
            $tiempoInicio = $_SESSION['login_time'];
            $tiempoActual = time();
            $tiempoTranscurrido = $tiempoActual - $tiempoInicio;

            // Calcular días, horas, minutos y segundos
            $dias = floor($tiempoTranscurrido / (60 * 60 * 24));
            $horas = floor(($tiempoTranscurrido % (60 * 60 * 24)) / (60 * 60));
            $minutos = floor(($tiempoTranscurrido % (60 * 60)) / 60);
            $segundos = $tiempoTranscurrido % 60;

            // Formatear el tiempo transcurrido
            $tiempoFormateado = '';
            if ($dias > 0) {
                $tiempoFormateado .= "$dias días, ";
            }
            $tiempoFormateado .= sprintf("%02d:%02d:%02d", $horas, $minutos, $segundos);

            return $tiempoFormateado;
        } else {
            return '0';
        }
    }


    public static function getDatosUsuarioSuperlike($pdo, $idUsuario)
    {
        try {
            //Preparamos la consulta con un marcador de posición para el email
            $query = "SELECT * FROM usuariossuperlike WHERE idUsuarioManda = :idUsuario";

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

    public static function encrypt($data, $key)
    {
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
        $encrypted = openssl_encrypt($data, 'aes-256-cbc', $key, 0, $iv);
        // Convertir a hexadecimal para evitar caracteres especiales
        return bin2hex($iv . $encrypted);
    }

    public static function decrypt($data, $key)
    {
        // Convertir de hexadecimal a binario
        $data = hex2bin($data);
        $iv = substr($data, 0, openssl_cipher_iv_length('aes-256-cbc'));
        $encrypted = substr($data, openssl_cipher_iv_length('aes-256-cbc'));
        return openssl_decrypt($encrypted, 'aes-256-cbc', $key, 0, $iv);
    }

    // Función para verificar si existe una relación de Superlike entre dos usuarios
    public static function existeRelacionSuperlike($pdo, $idUsuario, $idUsuarioImagen) {

    $stmt = $pdo->prepare("SELECT COUNT(*) AS count FROM usuariossuperlike WHERE idUsuarioManda = :idUsuario AND idUsuarioRecibe = :idUsuarioImagen");

    $stmt->execute(['idUsuario' => $idUsuario, 'idUsuarioImagen' => $idUsuarioImagen]);

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result['count'] > 0;
}

// Función para verificar si un usuario está denegado por el usuario actual
public static function existeRelacionDenegada($pdo, $idUsuario, $idUsuarioImagen) {
    $stmt = $pdo->prepare("SELECT COUNT(*) AS count FROM usuariosdenegados WHERE idUsuarioDenegador = :idUsuario AND idUsuarioDenegado = :idUsuarioImagen");
    $stmt->execute(['idUsuario' => $idUsuario, 'idUsuarioImagen' => $idUsuarioImagen]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['count'] > 0;
}

// Función para verificar si un usuario está bloqueado por el usuario actual
public static function existeRelacionBloqueada($pdo, $idUsuario, $idUsuarioImagen) {
    $stmt = $pdo->prepare("SELECT COUNT(*) AS count FROM usuariosbloqueados WHERE idUsuarioBloqueador = :idUsuario AND idUsuarioBloqueado = :idUsuarioImagen");
    $stmt->execute(['idUsuario' => $idUsuario, 'idUsuarioImagen' => $idUsuarioImagen]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['count'] > 0;
}

public static function insertarUsuarioDetalles($pdo, $idUsuario, $provincia, $pais, $domicilio, $codigoPostal, $ciudad, $colorFavorito, $comidaFavorita, $deporteFavorito, $hobbie, $colorPiel, $altura, $colorPelo, $tatuajes, $colorOjos)
{
    try {
        // Preparamos la consulta de inserción
        $query = "INSERT INTO usuariosdetalles (idUsuario, provincia, pais, domicilio, codigoPostal, ciudad, colorFavorito, comidaFavorita, deporteFavorito, hobbie, colorPiel, altura, colorPelo, tatuajes, colorOjos) 
                  VALUES (:idUsuario, :provincia, :pais, :domicilio, :codigoPostal, :ciudad, :colorFavorito, :comidaFavorita, :deporteFavorito, :hobbie, :colorPiel, :altura, :colorPelo, :tatuajes, :colorOjos)";

        // Preparamos la consulta
        $statement = $pdo->prepare($query);

        // Asignamos los valores a los marcadores de posición
        $statement->bindParam(':idUsuario', $idUsuario);
        $statement->bindParam(':provincia', $provincia);
        $statement->bindParam(':pais', $pais);
        $statement->bindParam(':domicilio', $domicilio);
        $statement->bindParam(':codigoPostal', $codigoPostal);
        $statement->bindParam(':ciudad', $ciudad);
        $statement->bindParam(':colorFavorito', $colorFavorito);
        $statement->bindParam(':comidaFavorita', $comidaFavorita);
        $statement->bindParam(':deporteFavorito', $deporteFavorito);
        $statement->bindParam(':hobbie', $hobbie);
        $statement->bindParam(':colorPiel', $colorPiel);
        $statement->bindParam(':altura', $altura);
        $statement->bindParam(':colorPelo', $colorPelo);
        $statement->bindParam(':tatuajes', $tatuajes);
        $statement->bindParam(':colorOjos', $colorOjos);

        // Ejecutamos la consulta
        $statement->execute();

        // Devolvemos true si la inserción fue exitosa
        return true;
    } catch (PDOException $e) {
        // En caso de error, mostramos el mensaje y devolvemos false
        echo "¡Error!: " . $e->getMessage();
        return false;
    }
}


}