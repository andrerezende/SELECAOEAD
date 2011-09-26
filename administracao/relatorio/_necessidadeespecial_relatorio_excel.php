<?php
ob_start();
session_start();

if(!$_SESSION['validacao']) {
    header("Location: ../login/login.php");
} else {
	include("../classes/DB.php");
	include("../classes/Inscrito.php");
	include("../classes/RelatorioInscrito.php");

    $necessidade_filtro       = addslashes($_POST['necessidade_filtro']);
 /* Acesso ao banco de dados */
    $banco   = DB::getInstance();
    $conexao = $banco->ConectarDB();
    $relatoriosInscrito = new RelatorioInscrito($conexao);
   
    

    
    header('Content-type: application/vnd.ms-excel');
    header('Content-type: application/force-download');
    header('Content-Disposition: attachment; filename=relatorio_alunos_necessidades.xls');
    header('Pragma: no-cache');
    
    $relatoriosInscrito->mostrarAlunosPorNecessidade($necessidade_filtro);
}
