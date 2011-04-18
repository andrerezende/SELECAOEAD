<?php
ini_set('display_errors', 1);

include_once '../classes/DB.php';
include_once '../classes/PHPExcel/PHPExcel.php';
include_once '../classes/PHPExcel/PHPExcel/Writer/Excel5.php';

$banco = DB::getInstance();
$conexao = $banco->ConectarDB();

$data = explode('/', $_POST[data_final_isencao]);
$data = date('Y-m-d', mktime(0, 0, 0, $data[1], $data[0], $data[2]));

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

$sql = <<<SQL
SELECT
	campus.id AS campus_id,
	campus.nome AS campus_nome,
	curso.nome AS curso_nome,
	localprova.nome AS localprova,
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
	inscrito.especial_descricao AS inscrito_descricao_especial,
	inscrito.isencao AS inscrito_isencao,
	inscrito.especial_prova AS inscrito_especial_prova,
	inscrito.especial_prova_descricao AS inscrito_especial_prova_descricao,
	inscrito.vaga_especial AS inscrito_vaga_especial,
	inscrito.especial
		FROM
			inscrito
				INNER JOIN localprova ON inscrito.localprova = localprova.id
				INNER JOIN campus ON campus.id = inscrito.campus
				INNER JOIN inscrito_curso ON inscrito_curso.id_inscrito = inscrito.id
				INNER JOIN curso ON curso.cod_curso = inscrito_curso.cod_curso
		WHERE cast(ultima_alteracao as DATE) <= cast('{$data}' as DATE)
				AND isencao = 'SIM'
 GROUP BY
	campus.id,
	campus.nome,
	curso.nome,
	localprova.nome,
	inscrito.nome,
	inscrito.numinscricao,
	inscrito.cpf,
	inscrito.rg,
	inscrito.orgaoexpedidor,
	inscrito.uf,
	inscrito.dataexpedicao,
	inscrito.nacionalidade,
	inscrito.datanascimento,
	inscrito.sexo,
	inscrito.endereco,
	inscrito.cep,
	inscrito.cidade,
	inscrito.estado,
	inscrito.telefone,
	inscrito.celular,
	inscrito.email,
	inscrito.estadocivil,
	inscrito.especial,
	inscrito.especial_descricao,
	inscrito.isencao,
	inscrito.especial_prova,
	inscrito.especial_prova_descricao,
	inscrito.vaga_especial
ORDER BY campus.id, inscrito.id
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
	'C' => 'LOCAL DE PROVA',
	'D' => 'INSCRITO',
	'E' => 'N. INSCRICAO',
	'F' => 'CPF',
	'G' => 'RG',
	'H' => 'ORGAO EXPEDIDOR',
	'I' => 'UF',
	'J' => 'DATA DE EXPEDICAO',
	'K' => 'NACIONALIDADE',
	'L' => 'DATA DE NASCIMENTO',
	'M' => 'SEXO',
	'N' => 'ENDERECO',
	'O' => 'CEP',
	'P' => 'CIDADE',
	'Q' => 'ESTADO',
	'R' => 'TELEFONE',
	'S' => 'CELULAR',
	'T' => 'EMAIL',
	'U' => 'ESTADO CIVIL',
	'V' => 'NECESSIDADE ESPECIAL',
	'W' => 'DESCRICAO NECESSIDADE ESPECIAL',
	'X' => 'ISENCAO DE TAXA',
	'Y' => 'CONDICOES ESPECIAIS PARA REALIZACAO DA PROVA',
	'Z' => 'DESCRICAO CONDICOES ESPECIAIS PARA REALIZACAO DA PROVA',
	'AA' => 'CONCORRE AS VAGAS DESTINADAS A CANDIDATOS COM NECESSIDADES ESPECIAIS',
);

$query = $banco->ExecutaQueryGenerica($sql);
//echo '<pre>';var_dump($sql);exit;
$linha = 2;
$campus_id = null;
while ($row = mysql_fetch_assoc($query)) {
	$val = array_values($row);
	if ($campus_id != $val[0]) {
		$campus_id = $val[0];
		if ($campus_id > 1) {
			$objPHPExcel->createSheet();
			$objPHPExcel->setActiveSheetIndex($objPHPExcel->getActiveSheetIndex() + 1);
		}
		$objPHPExcel->getActiveSheet()->setTitle(removeAcentos($val[1]));
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
header('Content-Disposition: attachment;filename="relatorio_isentos.xls"');
header('Cache-Control: max-age=0');

$objPHPExcel->setActiveSheetIndex(0);
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;
