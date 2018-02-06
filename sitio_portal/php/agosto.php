<?
$nombre=$_POST['nombre'];
$rut=$_POST['rut'];
$centromedico=$_POST['centromedico'];
$fono=$_POST['fono'];
$email=$_POST['email'];
$perfil=$_POST['perfil'];
$fecha=$_POST['fecha'];

//Se recogen los datos del formulario para montar el cuerpo del mensaje.
        $mensaje ="ESCRITO DESDE: Inscripción de Capacitación Agosto\n";
        $mensaje .="Nombre: ".$nombre."\n";
$mensaje .="Rut: ".$rut."\n";
        $mensaje .="Centro Médico o Empresa: ".$centromedico."\n";
        $mensaje .="Teléfono: ".$fono."\n";
$mensaje .="Correo: ".$email."\n";
$mensaje .="Perfil: ".$perfil."\n";
$mensaje .="Fecha de Capacitación requerida: ".$fecha."\n";

// Se monta la cabecera del mensaje.
        $cabeceras = "From: felipe.urrea@acepta.com\n";
$cabeceras .= "Reply-To: $email \n";
        $cabeceras .= "MIME-version: 1.0\n";

        $cuerpo = $mensaje;
           $nombref="";

/*Se establece el destino del mensaje. Aqui pondr?s
tu propia direcci?n de correo electr?nico*/
        $destino = "felipe.urrea@acepta.com";

        if (@mail($destino,'Inscripción de Capacitación Agosto',$cuerpo,$cabeceras))
        {

           /*echo ("REALIZADO CON &Eacute;XITO.");*/
           echo "<meta http-equiv=\"refresh\" content=\"0;url=https://www.i-med.cl/sitio_portal/ins_agosto_enviado.html\">";
        } else {
           /*echo ("SE HA PRODUCIDO UN ERROR");*/
           echo "<meta http-equiv=\"refresh\" content=\"0;url=https://www.i-med.cl/sitio_portal/ins_agosto_noenviado.html\">";
        }

     ?>