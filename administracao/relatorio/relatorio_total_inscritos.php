<?php
ini_set('display_errors', 1);

include_once '../classes/DB.php';
include_once '../classes/PHPExcel/PHPExcel.php';
include_once '../classes/PHPExcel/PHPExcel/Writer/Excel5.php';


$banco = DB::getInstance();
$conexao = $banco->ConectarDB();

if ($_POST['tipo'] == 'inscritos_por_campus') {
	$colunas = array(
		'A' => 'QUANTIDADE DE INSCRITOS',
		'B' => 'CAMPUS',
	);
	$sql = <<<SQL
SELECT
	COUNT(inscrito.id) AS qtd_inscrito,
	campus.nome
SQL;
	if ($_POST['filtro_pagamento'] === '1') {
		$sql .= <<<SQL
		, pagamentos.datapagamento
		FROM campus
			INNER JOIN inscrito ON campus.id = inscrito.campus
			INNER JOIN pagamentos ON ABS(pagamentos.id_inscrito) = ABS(inscrito.numinscricao)
SQL;
	} elseif ($_POST['filtro_pagamento'] === "0") {
		$sql .= <<<SQL
		FROM campus
			INNER JOIN inscrito ON campus.id = inscrito.campus
		WHERE
			ABS(inscrito.numinscricao) NOT IN (SELECT ABS(id_inscrito) FROM pagamentos)
SQL;
	} else {
		$sql .= <<<SQL
		FROM campus
			INNER JOIN inscrito ON campus.id = inscrito.campus
SQL;
	}
	$sql .= <<<SQL
 GROUP BY
	campus.id
ORDER BY
	campus.id
LIMIT 2000
SQL;
} elseif ($_POST['tipo'] == 'inscritos_por_curso') {
	$colunas = array(
		'A' => 'CAMPUS',
		'B' => 'CURSO',
		'C' => 'QUANTIDADE DE INSCRITOS',
	);
	$sql = <<<SQL
SELECT
	campus.nome AS campus,
	curso.nome AS curso,
	COUNT(inscrito.id) AS qtd_inscrito
SQL;
	if ($_POST['filtro_pagamento'] === '1') {
		$sql .= <<<SQL
		, pagamentos.datapagamento
		FROM curso
			INNER JOIN campus ON campus.id = curso.campus
			LEFT JOIN inscrito ON curso.cod_curso = inscrito.curso
			INNER JOIN pagamentos ON ABS(pagamentos.id_inscrito) = ABS(inscrito.numinscricao)
SQL;
	} elseif ($_POST['filtro_pagamento'] === "0") {
		$sql .= <<<SQL
		FROM curso
			LEFT JOIN inscrito ON curso.cod_curso = inscrito.curso
			INNER JOIN campus ON campus.id = curso.campus
		WHERE
			ABS(inscrito.numinscricao) NOT IN (SELECT ABS(id_inscrito) FROM pagamentos)
SQL;
	} else {
		$sql .= <<<SQL
		FROM curso
			INNER JOIN campus ON campus.id = curso.campus
			LEFT JOIN inscrito ON curso.cod_curso = inscrito.curso
SQL;
	}
	$sql .= <<<SQL
 GROUP BY
	curso.cod_curso
ORDER BY
	curso.cod_curso
LIMIT 2000
SQL;
}

$objPHPExcel = new PHPExcel();

function setCabecalho($objPHPExcel, $colunas) {
	foreach ($colunas as $coluna => $valor) {
		$objPHPExcel->getActiveSheet()->SetCellValue($coluna.'1', $valor);
		$objPHPExcel->getActiveSheet()->getColumnDimension($coluna)->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getStyle($coluna.'1')->getFont()->setBold(true);
	}
}

$query = $banco->ExecutaQueryGenerica($sql);
$linha = 2;
$campus_id = null;
while ($row = mysql_fetch_assoc($query)) {
	$val = array_values($row);
	setCabecalho($objPHPExcel, $colunas);
	$col = 0;
	foreach ($colunas as $coluna => $valor) {
		$objPHPExcel->getActiveSheet()->SetCellValue($coluna.$linha, utf8_encode($val[$col]));
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