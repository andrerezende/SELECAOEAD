<?php
ob_start();
session_start();
if (!$_SESSION['validacao']) {
    header("Location: ../login/login.php");
} else {
    include("../classes/DB.php");
    include("../classes/Inscrito.php");  
    include("../classes/Localprova.php");
    include("../classes/Inscrito_Curso.php");
    include("../classes/RelatorioInscrito.php");

    $aluno_filtro       = addslashes($_POST['aluno_filtro']);
    
    /* Acesso ao banco de dados */
    $banco   = DB::getInstance();
    $conexao = $banco->ConectarDB();
    
    $relatoriosInscrito = new RelatorioInscrito();
   
    echo("<form id='alunoform' name='formincricao' action='aluno_relatorio_excel.php' method='post'>");
    echo("<input type='hidden'name='aluno_filtro' id='aluno_filtro' value= '".$aluno_filtro."'/>");
    
    if($aluno_filtro == 'T'){

       $relatoriosInscrito->mostrarTodosAlunos($conexao);
       
    }else if ($aluno_filtro == 'L'){

       $relatoriosInscrito->mostrarAlunosPorLocalidades();
        
    }else if ($aluno_filtro == 'C'){

       $relatoriosInscrito->mostrarAlunosPorCursos();
    
    }else if($aluno_filtro == 'LC'){
       
	$relatoriosInscrito->mostrarAlunosPorLocalidadeCurso();
    
    }
  
    echo(" <div align='center'><input name='visualizar_curso' type='submit' id='visualizar_curso' tabindex=14 value='Exportar para Excel'></div>");
    echo("</form>");
}
?>
