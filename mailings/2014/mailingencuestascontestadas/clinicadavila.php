<?

$nota=$_POST['nota'];

//Se recogen los datos del formulario para montar el cuerpo del mensaje.
        $mensaje ="ESCRITO DESDE: Nota CLINICA DAVILA\n";
$mensaje .="Nota a Ejecutivo:".$nota."\n";
        
// Se monta la cabecera del mensaje.
        $cabeceras = "From: felipe.urrea@acepta.com\n";
$cabeceras .= "Reply-To: $email \n";
        $cabeceras .= "MIME-version: 1.0\n";

        $cuerpo = $mensaje;
           $nombref="";

/*Se establece el destino del mensaje. Aqui pondr?s
tu propia direcci?n de correo electr?nico*/
        $destino = "felipe.urrea@acepta.com";

        if (@mail($destino,'Nota a CLINICA DAVILA',$cuerpo,$cabeceras))
        {

           /*echo ("REALIZADO CON &Eacute;XITO.");*/
           echo "<meta http-equiv=\"refresh\" content=\"0;url=enviado.html\">";
        } else {
           /*echo ("SE HA PRODUCIDO UN ERROR");*/
           echo "<meta http-equiv=\"refresh\" content=\"0;url=http://www.i-med.cl/formulario-inscripcion-agosto-noenviado.html\">";
        }

     ?>