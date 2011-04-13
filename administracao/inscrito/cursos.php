<?php
header("Content-Type: text/html; charset=ISO-8859-1", true);
/* Acesso ao banco de dados */

include ("../classes/DB.php");
include ("../classes/Campus.php");

$banco   = DB::getInstance();
$conexao = $banco->ConectarDB();

$campus = addslashes($_POST['campus']);;

$sql = "SELECT * FROM curso WHERE campus = '$campus' ORDER BY nome ASC";
$qr = $banco->ExecutaQueryGenerica($sql);

if (mysql_num_rows($qr) == 0) {
	echo '<option value="0">'.htmlentities('Nao existem cursos nesse Campus').'</option>';
} else {
	while($ln = mysql_fetch_assoc($qr)){
		echo '<option value="'.$ln['cod_curso'].'">'.$ln['nome'].'</option>';
	}
}
?>
