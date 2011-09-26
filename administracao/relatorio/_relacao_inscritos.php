<?php
ob_start();
session_start();
if (!$_SESSION['validacao']) {
    header("Location: ../login/login.php");
} else {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns:o="urn:schemas-microsoft-com:office:office"
	xmlns:x="urn:schemas-microsoft-com:office:excel"
	xmlns="http://www.w3.org/TR/REC-html40">
<head>
<?php
	header('Content-type: application/vnd.ms-excel');
	header('Content-type: application/force-download');
	header('Content-Disposition: attachment; filename=relacao_inscritos.xls');
	header('Pragma: no-cache');
?>
	<meta name=ProgId content=Excel.Sheet>
		<!--[if gte mso 9]><xml>
			<o:DocumentProperties>
				<o:LastAuthor>Sriram</o:LastAuthor>
				<o:LastSaved>2005-01-02T07:46:23Z</o:LastSaved>
				<o:Version>10.2625</o:Version>
			</o:DocumentProperties>
			<o:OfficeDocumentSettings>
				<o:DownloadComponents/>
			</o:OfficeDocumentSettings>
		</xml><![endif]-->
		<style>
			<!--table
				{mso-displayed-decimal-separator:"\,";
				mso-displayed-thousand-separator:"\.";}
			@page
				{margin:1.0in .75in 1.0in .75in;
				mso-header-margin:.5in;
				mso-footer-margin:.5in;}
			tr
				{mso-height-source:auto;}
			col
				{mso-width-source:auto;}
			br
				{mso-data-placement:same-cell;}
			.style0
				{mso-number-format:General;
				text-align:general;
				vertical-align:bottom;
				white-space:nowrap;
				mso-rotate:0;
				mso-background-source:auto;
				mso-pattern:auto;
				color:windowtext;
				font-size:10.0pt;
				font-weight:400;
				font-style:normal;
				text-decoration:none;
				font-family:Arial;
				mso-generic-font-family:auto;
				mso-font-charset:0;
				border:none;
				mso-protection:locked visible;
				mso-style-name:Normal;
				mso-style-id:0;}
			td
				{mso-style-parent:style0;
				padding-top:1px;
				padding-right:1px;
				padding-left:1px;
				mso-ignore:padding;
				color:windowtext;
				font-size:10.0pt;
				font-weight:400;
				font-style:normal;
				text-decoration:none;
				font-family:Arial;
				mso-generic-font-family:auto;
				mso-font-charset:0;
				mso-number-format:General;
				text-align:general;
				vertical-align:bottom;
				border:none;
				mso-background-source:auto;
				mso-pattern:auto;
				mso-protection:locked visible;
				white-space:nowrap;
				mso-rotate:0;}
			.xl24
				{mso-style-parent:style0;
				white-space:normal;}
			-->
		</style>
		<!--[if gte mso 9]><xml>
			<x:ExcelWorkbook>
				<x:ExcelWorksheets>
					<x:ExcelWorksheet>
						<x:Name>NOME_PLANILHA</x:Name>
						<x:WorksheetOptions>
							<x:Selected/>
							<x:ProtectContents>False</x:ProtectContents>
							<x:ProtectObjects>False</x:ProtectObjects>
							<x:ProtectScenarios>False</x:ProtectScenarios>
						</x:WorksheetOptions>
					</x:ExcelWorksheet>
				</x:ExcelWorksheets>
				<x:WindowHeight>10005</x:WindowHeight>
				<x:WindowWidth>10005</x:WindowWidth>
				<x:WindowTopX>120</x:WindowTopX>
				<x:WindowTopY>135</x:WindowTopY>
				<x:ProtectStructure>False</x:ProtectStructure>
				<x:ProtectWindows>False</x:ProtectWindows>
			</x:ExcelWorkbook>
		</xml><![endif]-->
	</meta>
</head>
<?php
	include_once("../classes/DB.php");
	$banco    = DB::getInstance();
	$conexao  = $banco->ConectarDB();

	$sql = <<<TEMP
SELECT
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
FROM
	inscrito
		INNER JOIN campus ON campus.id = inscrito.campus
		INNER JOIN inscrito_curso ON inscrito_curso.id_inscrito = inscrito.id
		INNER JOIN curso ON curso.cod_curso = inscrito_curso.cod_curso
ORDER BY inscrito.id, campus.id, curso.cod_curso
TEMP;

$resultado = $banco->ExecutaQueryGenerica($sql);
echo ("<div class='relatorio'>");
	if (mysql_num_rows($resultado) == 0) {
		echo("<table width='90%' border='0' class='mensagem'>");
		echo("  <tr>");
		echo("    <td height='280'><div align='center'><font size='5'>Nenhum registro foi encontrado.</font></div></td>");
		echo("  </tr>");
		echo("</table>");
	} else {
		echo("<table>");
		echo("  <tr>");
		echo("    <td colspan='25' width='6500px'>RELA&Ccedil;&Atilde;O DE INSCRITOS POR ".strtoupper($opcao)."</td>");
		echo("</tb>");
		echo("  <tr>");
		echo("    <th>CAMPUS</th>");
		echo("    <th>CURSO</th>");
		echo("    <th>INSCRITO</th>");
		echo("    <th>Nº INSCRI&Ccedil;&Atilde;O</th>");
		echo("    <th>CPF</th>");
		echo("    <th>RG</th>");
		echo("    <th>ORG&Atilde;O EXPEDIDOR</th>");
		echo("    <th>UF</th>");
		echo("    <th>DATA DE EXPEDI&Ccedil;&Atilde;O</th>");
		echo("    <th>NACIONALIDADE</th>");
		echo("    <th>DATA DE NASCIMENTO</th>");
		echo("    <th>SEXO</th>");
		echo("    <th>ENDERE&Ccedil;O</th>");
		echo("    <th>CEP</th>");
		echo("    <th>CIDADE</th>");
		echo("    <th>ESTADO</th>");
		echo("    <th>TELEFONE</th>");
		echo("    <th>CELULAR</th>");
		echo("    <th>EMAIL</th>");
		echo("    <th>ESTADO CIVIL</th>");
		echo("    <th>NECESSIDADE ESPECIAL?</th>");
		echo("    <th>DESCRI&Ccedil;&Atilde;O NECESSIDADE ESPECIAL</th>");
		echo("    <th>ISEN&Ccedil;&Atilde;O DE TAXA</th>");
		echo("    <th>CADASTRO &Uacute;NICO (NIS)</th>");
		echo("    <th>CONDI&Ccedil;&Otilde;ES ESPECIAIS PARA REALIZA&Ccedil;&Atilde;O DA PROVA</th>");
		echo("    <th>DESCRI&Ccedil;&Atilde;O CONDI&Ccedil;&Otilde;ES ESPECIAIS PARA REALIZA&Ccedil;&Atilde;O DA PROVA</th>");
		echo("    <th>CONCORRE ÀS VAGAS DESTINADAS A CANDIDATOS COM NECESSIDADES ESPECIAIS</th>");
		echo("  </tr>");
		while ($inscrito = mysql_fetch_assoc($resultado)) {
			echo("  <tr>");
			foreach ($inscrito as $key => $valor) {
				if (($key == 'inscrito_datanascimento') || ($key == 'inscrito_dataexpedicao')) {
					echo("    <td>".$valor."</td>");
				} else {
					echo("    <td>".$valor."</td>");
				}
			}
			echo("  </tr>");
		}
		echo("</table>");
	}
echo ("</div>");
}
