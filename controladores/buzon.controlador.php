<?php
//Estas son las variables que vienen de los input que están en vistas/paginas/inicio.php
//para obtener la información que los usuarios ingresen en esos inputs, se agregó a cada etiqueta
//de input, la propiedad name="", y el formulario que encierra los elementos se hizo método POST
$nombre = $_POST["nombre_buzon"];
$correo = $_POST["mail_buzon"];
$asunto = $_POST["asunto_buzon"];
$mensaje = $_POST["mensaje_buzon"];

$nombre = filter_var($nombre, FILTER_SANITIZE_STRING);
$correo = filter_var($correo, FILTER_SANITIZE_EMAIL);
$asunto = filter_var($asunto, FILTER_SANITIZE_STRING);
$mensaje = filter_var($mensaje, FILTER_SANITIZE_STRING);

$body = "Nombre: " . $nombre . "<br><br>Correo: " . $correo . "<br><br>Asunto: " . $asunto . "<br>Mensaje: " . $mensaje;
$result = [];

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Lectura del autoload
//Antes, autoload.php venía dentro de la carpeta de descarga de PHPMailer, en versiones modernas
//autoload no existe y se debe configurar de la manera que está en vendor
require '../vendor/autoload.php';

$mail = new PHPMailer(true);

try {
        //Configuración del Servidor
        $mail->SMTPOptions = array( 'ssl' => array( 'verify_peer' => false, 'verify_peer_name' => false, 'allow_self_signed' => true ));

        $mail->SMTPDebug = 4;              
        $mail->isSMTP();                                            
        $mail->Host       = 'mail.economiafamiliar.gob.ni';                     
        $mail->SMTPAuth   = true;                                   
        $mail->Username   = 'printer@economiafamiliar.gob.ni';                     
        $mail->Password   = 'Temporal*';                               
        $mail->SMTPSecure = 'ssl';        
        $mail->Port       = 465;          
    
        //Correo de envío y recepción desde buzón
        $mail->setFrom('divulgacion@economiafamiliar.gob.ni', 'Enviado por un Usuario');
        $mail->addAddress('divulgacion@economiafamiliar.gob.ni', 'MEFCCA'); 



    //Contenido del Buzón
    $mail->isHTML(true);                                  
    $mail->Subject = $nombre;
    $mail->Body    = "<b>Asunto: </b><br>" . $asunto . "<br><br><b>Mensaje: </b><br>" . $mensaje . "<br><br><b>Contacto: </b><br>" . $correo;
    $mail->AltBody = $correo;

    $mail->send();

    $result[0]='Enviado';

} catch (Exception $e) {
    $result[0]='No enviado';
}

die(json_encode($result));





