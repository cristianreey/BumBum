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

        // Restablecer el tiempo de inactividad cuando se inicia sesión
        $_SESSION['ultimoAcceso'] = time();

        if (empty($email) || empty($password)) {
            return "Por favor, complete todos los campos.";
        } else {
            try {
                // Obtener el usuario de la base de datos
                $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE gmail = ?");
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
                            return "Inicio de sesión exitoso.";
                        } else {
                            // Redireccionar al usuario a otra página si no está activo
                            header("Location: ../view/verificacion_view.php");
                            exit;
                        }
                    } else {
                        return "El usuario o la contraseña no es correcto.";
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


    public static function getDatosUsuario($pdo)
    {

        try {
            //Realizamos la query
            $query = "SELECT * FROM usuariosdetalles ";

            //ejecutsmos la consulta 
            $resultado = $pdo->query($query);

            //sacamos todos los registros de los productos
            $resulSet = $resultado->fetchAll();
        } catch (PDOException $e) {
            //en caso de error mostramos el mensaje
            print "¡Error!: " . $e->getMessage() . "<br/>";
            die();
        }
        //Devolvemos los datos
        return $resulSet;
    }


}