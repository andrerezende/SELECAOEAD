<?php
ini_set('display_errors', 1);

include_once '../classes/DB.php';
include_once '../classes/PHPExcel/PHPExcel.php';
include_once '../classes/PHPExcel/PHPExcel/Writer/Excel5.php';


	$banco    = DB::getInstance();
	$conexao  = $banco->ConectarDB();

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
	inscrito.especial_descricao AS inscrito_descricao_especial,
	inscrito.isencao AS inscrito_isencao,
	inscrito.cadastro_unico AS inscrito_nis,
	inscrito.especial_prova AS inscrito_especial_prova,
	inscrito.especial_prova_descricao AS inscrito_especial_prova_descricao,
	inscrito.vaga_especial AS inscrito_vaga_especial

SQL;
if ($_POST['tipo'] == 'candidatos_por_necessidade') {
	if ($_POST['necessidade_filtro']) {
		$sql .= <<<SQL
		, inscrito.especial
		FROM
			inscrito
				INNER JOIN campus ON campus.id = inscrito.campus
				INNER JOIN inscrito_curso ON inscrito_curso.id_inscrito = inscrito.id
				INNER JOIN curso ON curso.cod_curso = inscrito_curso.cod_curso
		WHERE especial <> 'NÃO'
SQL;
	} else {
		$sql .= <<<SQL
		 FROM
			inscrito
				INNER JOIN campus ON campus.id = inscrito.campus
				INNER JOIN inscrito_curso ON inscrito_curso.id_inscrito = inscrito.id
				INNER JOIN curso ON curso.cod_curso = inscrito_curso.cod_curso
		WHERE especial = 'NÃO'
SQL;
	}
} elseif ($_POST['tipo'] == 'relacao_cadidatos2') {
	if ($_POST['filtro_pagamento']) {
		$sql .= <<<SQL
		, pagamentos.datapagamento
		FROM
			inscrito
				INNER JOIN campus ON campus.id = inscrito.campus
				INNER JOIN inscrito_curso ON inscrito_curso.id_inscrito = inscrito.id
				INNER JOIN curso ON curso.cod_curso = inscrito_curso.cod_curso
				INNER JOIN pagamentos ON pagamentos.id_inscrito = inscrito.id
SQL;
	} elseif ($_POST['filtro_pagamento'] === 0) {
		$sql .= <<<SQL
		 FROM
			inscrito
				INNER JOIN campus ON campus.id = inscrito.campus
				INNER JOIN inscrito_curso ON inscrito_curso.id_inscrito = inscrito.id
				INNER JOIN curso ON curso.cod_curso = inscrito_curso.cod_curso
				LEFT JOIN pagamentos ON pagamentos.id_inscrito = inscrito.id
		WHERE pagamentos.id IS NULL
SQL;
	} else {
		$sql .= <<<SQL
		 FROM
			inscrito
				INNER JOIN campus ON campus.id = inscrito.campus
				INNER JOIN inscrito_curso ON inscrito_curso.id_inscrito = inscrito.id
				INNER JOIN curso ON curso.cod_curso = inscrito_curso.cod_curso
SQL;
	}
}
$sql .= <<<SQL
 GROUP BY
	campus.id,
	campus.nome,
	curso.nome,
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
	inscrito.cadastro_unico,
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
	'C' => 'INSCRITO',
	'D' => utf8_encode('Nº INSCRIÇÃO'),
	'E' => 'CPF',
	'F' => 'RG',
	'G' => utf8_encode('ORGÃO EXPEDIDOR'),
	'H' => 'UF',
	'I' => utf8_encode('DATA DE EXPEDIÇÃO'),
	'J' => 'NACIONALIDADE',
	'K' => 'DATA DE NASCIMENTO',
	'L' => 'SEXO',
	'M' => utf8_encode('ENDEREÇO'),
	'N' => 'CEP',
	'O' => 'CIDADE',
	'P' => 'ESTADO',
	'Q' => 'TELEFONE',
	'R' => 'CELULAR',
	'S' => 'EMAIL',
	'T' => 'ESTADO CIVIL',
	'U' => utf8_encode('NECESSIDADE ESPECIAL?'),
	'V' => utf8_encode('DESCRIÇÃO NECESSIDADE ESPECIAL'),
	'W' => utf8_encode('ISENÇÃO DE TAXA'),
	'X' => utf8_encode('CADASTRO ÚNICO (NIS)'),
	'Y' => utf8_encode('CONDIÇÕES ESPECIAIS PARA REALIZAÇÃO DA PROVA'),
	'Z' => utf8_encode('DESCRIÇÃO CONDIÇÕES ESPECIAIS PARA REALIZAÇÃO DA PROVA'),
	'AA' => utf8_encode('CONCORRE AS VAGAS DESTINADAS A CANDIDATOS COM NECESSIDADES ESPECIAIS'),
);


$query = $banco->ExecutaQueryGenerica($sql);
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
		$objPHPExcel->getActiveSheet()->setTitle($val[1]);
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
header('Content-Disposition: attachment;filename="relatorio_completo.xls"');
header('Cache-Control: max-age=0');

$objPHPExcel->setActiveSheetIndex(0);
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;
