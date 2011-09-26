<?php
ini_set('display_errors', 1);

include_once '../classes/DB.php';
include_once '../classes/PHPExcel/PHPExcel.php';
include_once '../classes/PHPExcel/PHPExcel/Writer/Excel5.php';

$banco = DB::getInstance();
$conexao = $banco->ConectarDB();

/**
 * Remove os acentos de uma string.
 *
 * @param String String a ser tratada $str
 * @param String Encoding da string $enc
 *
 * @return String string
 */
function removeAcentos($str, $enc = "ISO-8859-1") {
	$acentos = array(
		'A' => '/&Agrave;|&Aacute;|&Acirc;|&Atilde;|&Auml;|&Aring;/',
		'a' => '/&agrave;|&aacute;|&acirc;|&atilde;|&auml;|&aring;/',
		'C' => '/&Ccedil;/',
		'c' => '/&ccedil;/',
		'E' => '/&Egrave;|&Eacute;|&Ecirc;|&Euml;/',
		'e' => '/&egrave;|&eacute;|&ecirc;|&euml;/',
		'I' => '/&Igrave;|&Iacute;|&Icirc;|&Iuml;/',
		'i' => '/&igrave;|&iacute;|&icirc;|&iuml;/',
		'N' => '/&Ntilde;/',
		'n' => '/&ntilde;/',
		'O' => '/&Ograve;|&Oacute;|&Ocirc;|&Otilde;|&Ouml;/',
		'o' => '/&ograve;|&oacute;|&ocirc;|&otilde;|&ouml;/',
		'U' => '/&Ugrave;|&Uacute;|&Ucirc;|&Uuml;/',
		'u' => '/&ugrave;|&uacute;|&ucirc;|&uuml;/',
		'Y' => '/&Yacute;/',
		'y' => '/&yacute;|&yuml;/',
		'a.' => '/&ordf;/',
		'o.' => '/&ordm;/',
	);
	return preg_replace($acentos, array_keys($acentos), htmlentities($str, ENT_NOQUOTES, $enc));
}

if ($_POST['cotas_filtro'] == 'todos') {
	include_once 'relatorio_cotas_todos.php';
	die();
}

$where = array(
	'necessidade_especial' => ' WHERE inscrito.vaga_especial = \'SIM\'',
	'escola_publica' => ' WHERE inscrito.vaga_especial = \'SIM\' OR inscrito.vaga_rede_publica = \'SIM\'',
);

if ($_POST['cotas_filtro'] == 'necessidade_especial') {
	$where = ' WHERE inscrito.vaga_especial = \'SIM\'';
} elseif ($_POST['cotas_filtro'] == 'escola_publica') {
	$where = ' WHERE inscrito.vaga_rede_publica = \'SIM\'';
} else {
	$where = ' WHERE inscrito.vaga_especial = \'SIM\' OR inscrito.vaga_rede_publica = \'SIM\'';
}

$sql = <<<SQL
SELECT
	campus.id AS campus_id,
	campus.nome AS campus_nome,
	curso.nome AS curso_nome,
	inscrito.nome AS inscrito_nome,
	inscrito.numinscricao AS inscrito_numinscricao,
	inscrito.cpf AS inscrito_cpf,
	inscrito.rg AS inscrito_rg,
	inscrito.orgaoexpedidor AS inscrito_orgaoexpedidor,
	inscrito.uf AS inscrito_uf,
	inscrito.dataexpedicao AS inscrito_dataexpedicao,
	inscrito.nacionalidade AS inscrito_nacionalidade,
	inscrito.datanascimento AS inscrito_datanascimento,
	inscrito.sexo AS inscrito_sexo,
	inscrito.endereco AS inscrito_endereco,
	inscrito.cep AS inscrito_cep,
	inscrito.cidade AS inscrito_cidade,
	inscrito.estado AS inscrito_estado,
	inscrito.telefone AS inscrito_telefone,
	inscrito.celular AS inscrito_celular,
	inscrito.email AS inscrito_email,
	inscrito.estadocivil AS inscrito_estadocivil,
	inscrito.especial AS inscrito_especial,
	inscrito.vaga_rede_publica AS inscrito_vaga_rede_publica,
	inscrito.especial_descricao AS inscrito_descricao_especial,
	inscrito.isencao AS inscrito_isencao,
	inscrito.especial_prova AS inscrito_especial_prova,
	inscrito.especial_prova_descricao AS inscrito_especial_prova_descricao,
	inscrito.vaga_especial AS inscrito_vaga_especial
FROM
	inscrito
		LEFT JOIN campus ON campus.id = inscrito.campus
		LEFT JOIN curso ON curso.cod_curso = inscrito.curso
		INNER JOIN pagamentos ON ABS(pagamentos.id_inscrito) = ABS(inscrito.numinscricao)
SQL;
if (!is_array($where)) {
	$sql .= $where;
}
$sql .= <<<SQL
 ORDER BY campus.id, curso.cod_curso
SQL;

$objPHPExcel = new PHPExcel();

function setCabecalho($objPHPExcel, $colunas) {
	foreach ($colunas as $coluna => $valor) {
		$objPHPExcel->getActiveSheet()->SetCellValue($coluna.'1', $valor);
		$objPHPExcel->getActiveSheet()->getColumnDimension($coluna)->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getStyle($coluna.'1')->getFont()->setBold(true);
	}
}

$colunas = array(
	'A' => 'CAMPUS',
	'B' => 'CURSO',
	'C' => 'INSCRITO',
	'D' => 'N. INSCRICAO',
	'E' => 'CPF',
	'F' => 'RG',
	'G' => 'ORGAO EXPEDIDOR',
	'H' => 'UF',
	'I' => 'DATA DE EXPEDICAO',
	'J' => 'NACIONALIDADE',
	'K' => 'DATA DE NASCIMENTO',
	'L' => 'SEXO',
	'M' => 'ENDERECO',
	'N' => 'CEP',
	'O' => 'CIDADE',
	'P' => 'ESTADO',
	'Q' => 'TELEFONE',
	'R' => 'CELULAR',
	'S' => 'EMAIL',
	'T' => 'ESTADO CIVIL',
	'U' => 'NECESSIDADE ESPECIAL',
	'V' => 'VAGA REDE PUBLICA',
	'W' => 'DESCRICAO NECESSIDADE ESPECIAL',
	'X' => 'ISENCAO DE TAXA',
	'Y' => 'CONDICOES ESPECIAIS PARA REALIZACAO DA PROVA',
	'Z' => 'DESCRICAO CONDICOES ESPECIAIS PARA REALIZACAO DA PROVA',
	'AA' => 'CONCORRE AS VAGAS DESTINADAS A CANDIDATOS COM NECESSIDADES ESPECIAIS',
);
//var_dump($sql);exit;
//echo '<pre>';
$query = $banco->ExecutaQueryGenerica($sql);
$numResults = mysql_num_rows($query);
//var_dump($numResults);
$linha = 2;
$campus_id = null;
$teste = true;
while ($row = mysql_fetch_assoc($query)) {
	//var_dump($row);
	$val = array_values($row);
	if ($campus_id != $val[22] && $teste) {
		$teste = false;
		//var_dump('1');
		$campus_id = $val[22];
		if ($campus_id > 1 && $numResults > 1) {
			var_dump('2');
			$objPHPExcel->createSheet();
			$objPHPExcel->setActiveSheetIndex($objPHPExcel->getActiveSheetIndex() + 1);
		}
		$objPHPExcel->getActiveSheet()->setTitle("Relatorio por Cotas");
		setCabecalho($objPHPExcel, $colunas);
		$linha = 2;
	}
	$col = 1;
	foreach ($colunas as $coluna => $valor) {
		if ($val[$col] == null) {
			$objPHPExcel->getActiveSheet()->SetCellValue($coluna.$linha, '---');
		} else {
			$objPHPExcel->getActiveSheet()->SetCellValue($coluna.$linha, utf8_encode($val[$col]));
		}
		$col++;
	}
	$linha++;
}

//$objPHPExcel->setActiveSheetIndex(0);
//$objWriter = new PHPExcel_Writer_Excel5($objPHPExcel);
//$objWriter->save(str_replace('.php', '.xls', __FILE__));

header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="relatorio_por_cotas.xls"');
header('Cache-Control: max-age=0');

$objPHPExcel->setActiveSheetIndex(0);
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;
