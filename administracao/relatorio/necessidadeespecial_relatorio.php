<?php
ob_start();
session_start();
if (!$_SESSION['validacao']) {
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
   
    

    echo("<form id='necessidadeform' name='necessidadeform' action='necessidadeespecial_relatorio_excel.php' method='post'>");
    echo("<input type='hidden'name='necessidade_filtro' id='necessidade_filtro' value= '".$necessidade_filtro."'/>");

    $relatoriosInscrito->mostrarAlunosPorNecessidade($_POST['necessidade_filtro']);
       
   echo(" <div align='center'><input name='visualizar_curso' type='submit' id='visualizar_curso' tabindex=14 value='Exportar para Excel'></div>");
   echo("</form>");
}
