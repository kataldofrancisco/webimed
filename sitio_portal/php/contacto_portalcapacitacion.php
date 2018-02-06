<html>
   <head>
      <title>Envío de Correo</title>
<script>
/*function nueva()
{
 window.location="../menu.php"; 
}*/
</script>
   </head>

   <body>

<?
$nombre=$_POST['nombre'];
$email=$_POST['email'];
$fono=$_POST['fono'];
$comentario=$_POST['comentario'];

//Se recogen los datos del formulario para montar el cuerpo del mensaje.
         $mensaje ="ESCRITO DESDE: Contacto Portal de Capacitaciones I-Med\n";
         $mensaje .="Nombre: ".$nombre."\n";
         $mensaje .="Email: ".$email."\n";
         $mensaje .="Fono: ".$fono."\n";
         $mensaje .="COMENTARIO:".$comentario;

// Se monta la cabecera del mensaje.
         $cabeceras = "From: comercial@i-med.cl\n";
	 $cabeceras .= "Reply-To: $email \n";
         $cabeceras .= "MIME-version: 1.0\n";

         $cuerpo = $mensaje;
            $nombref="";

/*Se establece el destino del mensaje. Aqui pondrás
tu propia dirección de correo electrónico*/
         $destino = "comercial@i-med.cl";

         if (@mail($destino,'Contacto Portal de Capacitaciones I-Med',$cuerpo,$cabeceras))
         {
				 
            /*echo ("REALIZADO CON &Eacute;XITO.");*/
            echo "<meta http-equiv=\"refresh\" content=\"0;url=https://www.i-med.cl/sitio_portal/contactenos_enviado.html\">";
         } else {
            /*echo ("SE HA PRODUCIDO UN ERROR");*/
            echo "<meta http-equiv=\"refresh\" content=\"0;url=http://www.i-med.cl/noenviado.html\">";
         }

      ?>
   </body>
</html>

