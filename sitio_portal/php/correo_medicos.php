<html>
   <head>
      <title>Env�o de Correo</title>
<script>
/*function nueva()
{
 window.location="../menu.php"; 
}*/
</script>
   </head>

   <body>

<?
$comentario=$_POST['comentario'];

//Se recogen los datos del formulario para montar el cuerpo del mensaje.
         $mensaje ="ESCRITO DESDE: Sitio Web I-Med M�dicos\n";
         $mensaje .="COMENTARIO:".$comentario;

// Se monta la cabecera del mensaje.
         $cabeceras = "From: comercial@i-med.cl\n";
	 $cabeceras .= "Reply-To: $email \n";
         $cabeceras .= "MIME-version: 1.0\n";

         $cuerpo = $mensaje;
            $nombref="";

/*Se establece el destino del mensaje. Aqui pondr�s
tu propia direcci�n de correo electr�nico*/
         $destino = "comercial@i-med.cl";

         if (@mail($destino,'Contacto Web I-Med M�dicos',$cuerpo,$cabeceras))
         {
				 
            /*echo ("REALIZADO CON &Eacute;XITO.");*/
            echo "<meta http-equiv=\"refresh\" content=\"0;url=../medicosenviado.html\">";
         } else {
            /*echo ("SE HA PRODUCIDO UN ERROR");*/
            echo "<meta http-equiv=\"refresh\" content=\"0;url=http://www.i-med.cl/noenviado.html\">";
         }

      ?>
   </body>
</html>

