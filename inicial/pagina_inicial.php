<?php
session_start("SELECAO"); //sempre session_start antes de usar sessions
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title> <?php echo ($_SESSION["Gnomeprocessoseletivo"]);?> </title>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
        <link href="estilo_selecao.css" rel="stylesheet" type="text/css" />
</head>
<body>

<p>

<?php

	echo ("Bem-vindo(a) ao Sistema de Inscri&ccedil;&atilde;o para o <b> ".$_SESSION["Gnomeprocessoseletivo"]. "</b>. Escolha uma op&ccedil;&atilde;o no menu ao lado."); 
?>

</p>
</body>
</html>
