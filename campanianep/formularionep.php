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
$fono=$_POST['fono'];
$email=$_POST['email'];
$prestador=$_POST['prestador'];
$comentarios=$_POST['comentarios'];



//Se recogen los datos del formulario para montar el cuerpo del mensaje.
         $mensaje ="ESCRITO DESDE: Formulario NEP\n";
         $mensaje .="Nombre: ".$nombre."\n";
         $mensaje .="Fono: ".$fono."\n";
		 $mensaje .="Email: ".$email."\n";
		 $mensaje .="Prestador: ".$prestador."\n";
		 $mensaje .="Comentarios: ".$comentarios."\n";
		 
         
         
// Se monta la cabecera del mensaje.
         $cabeceras = "From: felipe.urrea@acepta.com\n";
	 $cabeceras .= "Reply-To: $email \n";
         $cabeceras .= "MIME-version: 1.0\n";

         $cuerpo = $mensaje;
            $nombref="";

/*Se establece el destino del mensaje. Aqui pondrás
tu propia dirección de correo electrónico*/
         $destino = "felipe.urrea@acepta.com";

         if (@mail($destino,'Formulario NEP',$cuerpo,$cabeceras))
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

