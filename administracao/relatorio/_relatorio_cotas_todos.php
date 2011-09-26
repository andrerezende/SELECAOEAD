<?php
ini_set('display_errors', 1);

include_once '../classes/DB.php';
include_once '../classes/PHPExcel/PHPExcel.php';
include_once '../classes/PHPExcel/PHPExcel/Writer/Excel5.php';

$banco = DB::getInstance();
$conexao = $banco->ConectarDB();

$where = array(
	'necessidade_especial' => 'WHERE inscrito.vaga_especial = \'SIM\'',
	'escola_publica' => 'WHERE inscrito.vaga_rede_publica = \'SIM\'',
);

foreach ($where as $value) {
	$ssql[] = <<<SQL
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
{$value}
 ORDER BY inscrito.vaga_especial, inscrito.vaga_rede_publica, campus.id, curso.cod_curso
SQL;
}

$objPHPExcel = new PHPExcel();

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

$i = 0;

foreach ($ssql as $sql) {
	$querys[] = $banco->ExecutaQueryGenerica($sql);
	$numResults[] = mysql_num_rows($querys[$i]);
	$i++;
}

$linha = 2;
$sheet = 0;
foreach ($querys as $query) {
	$objPHPExcel->getActiveSheet()->setTitle("Necessidades Especiais");
	if ($query == $querys[1]) {
		$objPHPExcel->createSheet();
		$objPHPExcel->setActiveSheetIndex($objPHPExcel->getActiveSheetIndex() + 1);
		$objPHPExcel->getActiveSheet()->setTitle("Vagas Rede Publica");
	}
	setCabecalho($objPHPExcel, $colunas);
	$linha = 2;

	while ($row = mysql_fetch_assoc($query)) {
		$val = array_values($row);
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
	$sheet++;
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
