<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<body>
<p>
<? 
if (!$HTTP_POST_VARS){ 
?>
</p>
<blockquote>
<form action="contacto.php" method=post onSubmit="return form_Validator(this)">
<table width="584" height="320" border="0" cellpadding="0" cellspacing="0">
<tr>
<td width="86" height="29" class="style15"><span class="style15">Nombre:</span></td>
<td width="498"><input 
name=nombre class=imputbox id=usuario 
style="WIDTH: 300px; HEIGHT: 20px" size=49></td>
</tr>
<tr>
<td height="28" class="style15"><span class="style15">Apellido:</span></td>
<td><input 
name=apellido class=imputbox id=usuario2 
style="WIDTH: 300px; HEIGHT: 20px" size=33></td>
</tr>
<tr>
<td height="27" class="style15"><span class="style15">Empresa:</span></td>
<td><input 
name=empresa class=imputbox id=usuario3 
style="WIDTH: 300px; HEIGHT: 20px" size=33></td>
</tr>
<tr>
<td height="28" class="style15"><span class="style15">Mail:</span></td>
<td><input 
name=email class=imputbox id=usuario5 
style="WIDTH: 300px; HEIGHT: 20px" size=33></td>
</tr>
<tr>
<td height="28" class="style15"><span class="style15">Telefono:</span></td>
<td><input 
name=pais class=imputbox id=usuario7 
style="WIDTH: 300px; HEIGHT: 20px" size=33></td>
</tr>
<tr>
<td><span class="style15">Mensaje:</span></td>
<td><textarea name="mensaje" cols="33" class="imputbox" id="usuario8" style="WIDTH: 300px; HEIGHT: 100px"></textarea></td>
</tr>
<tr>
<td><span class="style16"></span></td>
<td><input name="Submit" type="submit" class="botones " value="Enviar">
<input name="reset" type="reset" id="reset" value="Borrar"></td>
</tr>
</table>
<? 
}else{ 
//Estoy recibiendo el formulario, compongo el cuerpo 
$cuerpo = "Enviado desde quercuslegal.com:\n";
$cuerpo = "Mensaje enviado desde quercuslegal.com .- \n"; 
$cuerpo .= "Nombre: " . $HTTP_POST_VARS["nombre"] . "\n"; 
$cuerpo .= "Empresa: " . $HTTP_POST_VARS["empresa"] . "\n";
$cuerpo .= "E-mail: " . $HTTP_POST_VARS["email"] . "\n";
$cuerpo .= "Telefono: " . $HTTP_POST_VARS["telefono"] . "\n";
$cuerpo .= "Mensaje: " . $HTTP_POST_VARS["mensaje"] . "\n";

//mando el correo... 
mail("info@quercuslegal.com","Mensaje desde Quercus Legal",$cuerpo,"From: quercuslegal.com"); 

//doy las gracias por el env&iacute;o 
echo  '<script>
window.location.href=\'http://www.quercuslegal.com/contacto_gracias.html\';
</script>';
} 
?>
&nbsp;
</form>
</blockquote>
</body> 
</html>
