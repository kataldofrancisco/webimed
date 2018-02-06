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
$select=$_POST['select'];


//Se recogen los datos del formulario para montar el cuerpo del mensaje.
         $mensaje ="ESCRITO DESDE: Contacto LME\n";
         $mensaje .="Nombre: ".$nombre."\n";
         $mensaje .="Email: ".$email."\n";
         $mensaje .="Fono: ".$fono."\n";
	     $mensaje .="Asunto: ".$select."\n";


// Se monta la cabecera del mensaje.
         $cabeceras = "From: comercial@i-med.cl\n";
	 $cabeceras .= "Reply-To: $email \n";
         $cabeceras .= "MIME-version: 1.0\n";

         $cuerpo = $mensaje;
            $nombref="";

/*Se establece el destino del mensaje. Aqui pondrás
tu propia dirección de correo electrónico*/
         $destino = "comercial@i-med.cl";

         if (@mail($destino,'Contacto LME',$cuerpo,$cabeceras))
         {
				 
            /*echo ("REALIZADO CON &Eacute;XITO.");*/
            echo "<meta http-equiv=\"refresh\" content=\"0;url=../licencia_medica_enviado.html\">";
         } else {
            /*echo ("SE HA PRODUCIDO UN ERROR");*/
            echo "<meta http-equiv=\"refresh\" content=\"0;url=http://www.i-med.cl/noenviado.html\">";
         }

      ?>
   </body>
</html>

