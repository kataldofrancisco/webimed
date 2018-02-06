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
$rut=$_POST['rut'];
$centromedico=$_POST['centromedico'];
$telefono=$_POST['telefono'];
$correo=$_POST['correo'];
$producto=$_POST['producto'];
$perfil=$_POST['perfil'];

//Se recogen los datos del formulario para montar el cuerpo del mensaje.
         $mensaje ="ESCRITO DESDE: Formulario Bono Electronico Mayo\n";
         $mensaje .="Nombre: ".$nombre."\n";
		 $mensaje .="Rut: ".$rut."\n";
         $mensaje .="Centro Médico: ".$centromedico."\n";
         $mensaje .="Teléfono: ".$telefono."\n";
		 $mensaje .="Correo: ".$correo."\n";
		 $mensaje .="Producto: ".$producto."\n";
		 $mensaje .="Perfil: ".$perfil."\n";
         
// Se monta la cabecera del mensaje.
         $cabeceras = "From: furrea@i-med.cl\n";
	 $cabeceras .= "Reply-To: $email \n";
         $cabeceras .= "MIME-version: 1.0\n";

         $cuerpo = $mensaje;
            $nombref="";

/*Se establece el destino del mensaje. Aqui pondrás
tu propia dirección de correo electrónico*/
         $destino = "furrea@i-med.cl";

         if (@mail($destino,'Contacto Bono Electrónico',$cuerpo,$cabeceras))
         {
				 
            /*echo ("REALIZADO CON &Eacute;XITO.");*/
            echo "<meta http-equiv=\"refresh\" content=\"0;url=http://www.i-med.cl/formulario-inscripcion-enviado.html\">";
         } else {
            /*echo ("SE HA PRODUCIDO UN ERROR");*/
            echo "<meta http-equiv=\"refresh\" content=\"0;url=http://www.i-med.cl/landind/formulario-inscripcion-noenviado.html\">";
         }

      ?>
   </body>
</html>

