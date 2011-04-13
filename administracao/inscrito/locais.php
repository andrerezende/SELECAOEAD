<?php
include ("../classes/DB.php");
include ("../classes/Campus.php");
/* Acesso ao banco de dados */
$banco   = DB::getInstance();
$conexao = $banco->ConectarDB();

$campus = $_POST['campus'];

$sql = "SELECT * FROM localprova WHERE campus = '$campus' ORDER BY nome ASC";
$qr = $banco->ExecutaQueryGenerica($sql);

if (mysql_num_rows($qr) == 0) {
	echo '<option value="0">'.htmlentities('Nao existem locais de prova para esse Campus').'</option>';
} else {
	while($ln = mysql_fetch_assoc($qr)){
		echo '<option value="'.$ln['id'].'">'.$ln['nome'].'</option>';
	}
}