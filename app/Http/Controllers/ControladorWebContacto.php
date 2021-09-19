<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\Entidades\Sistema\Usuario;
    use App\Entidades\Sistema\Patente;
    use PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    
    require app_path() . '/start/constants.php';

    class ControladorWebContacto extends Controller
    {
        public function index()
        {
           return view('web.contacto');
        }

        public function enviar(Request $request){
            $email = $request->input("txtCorreo");
            $asunto = $request->input("txtAsunto");
            $mensaje = $request->input("txtMensaje");
            $nombre = $request->input("txtNombre");

            //Instancia y configuraciones de PHPMailer
            $mail = new PHPMailer(true);
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host = env('MAIL_HOST');
            $mail->SMTPAuth = true;
            $mail->Username = env('MAIL_USERNAME');
            $mail->Password = env('MAIL_PASSWORD');
            $mail->SMTPSecure = env('MAIL_ENCRYPTION');
            $mail->Port = env('MAIL_PORT');

                        //Destinatarios
            $mail->setFrom(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME')); //Dirección desde
            $mail->addAddress($email); //Dirección para
            //$mail->addReplyTo($replyTo); //Dirección de reply no-reply
            //$mail->addBCC($copiaOculta); //Dirección de CCO

            //Contenido del mail
            $mail->isHTML(true);
            $mail->Subject = $asunto;
            $mail->Body = $mensaje;
            $mail->send();


        }
    }
?>
