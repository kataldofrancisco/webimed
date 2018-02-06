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
$servicio=$_POST['servicio'];

//Se recogen los datos del formulario para montar el cuerpo del mensaje.
         $mensaje ="ESCRITO DESDE: Formulario POS A HUELLA\n";
         $mensaje .="Nombre: ".$nombre."\n";
         $mensaje .="Email: ".$email."\n";
         $mensaje .="Fono: ".$fono."\n";
		 $mensaje .="Servicio Requerido: ".$servicio."\n";
         
// Se monta la cabecera del mensaje.
         $cabeceras = "From: furrea@i-med.cl\n";
	 $cabeceras .= "Reply-To: $email \n";
         $cabeceras .= "MIME-version: 1.0\n";

         $cuerpo = $mensaje;
            $nombref="";

/*Se establece el destino del mensaje. Aqui pondrás
tu propia dirección de correo electrónico*/
         $destino = "furrea@i-med.cl";

         if (@mail($destino,'Contacto POS A HUELLA',$cuerpo,$cabeceras))
         {
				 
            /*echo ("REALIZADO CON &Eacute;XITO.");*/
            echo "<meta http-equiv=\"refresh\" content=\"0;url=enviado.html\">";
         } else {
            /*echo ("SE HA PRODUCIDO UN ERROR");*/
            echo "<meta http-equiv=\"refresh\" content=\"0;url=noenviado.html\">";
         }

      ?>
   </body>
</html>

