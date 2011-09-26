<?php
ob_start();
session_start();

if(!$_SESSION['validacao']) {
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
	header('Content-Disposition: attachment; filename=inscritos_por_curso.xls');
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
	campus.nome AS campus,
	curso.nome AS curso,
	COUNT( inscrito_curso.id_inscrito ) AS qtd_inscrito
FROM curso
	INNER JOIN inscrito_curso ON curso.cod_curso = inscrito_curso.cod_curso
	INNER JOIN campus ON campus.id = curso.campus
GROUP BY
	curso.cod_curso
ORDER BY
	curso.cod_curso
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
		echo("    <th>CAMPUS</th>");
		echo("    <th>CURSO</th>");
		echo("    <th>QUANTIDADE DE INSCRITOS</th>");
		echo("  </tr>");
		while ($curso = mysql_fetch_assoc($resultado)) {
			echo("  <tr>");
			echo("    <td>".$curso['campus']."</td>");
			echo("    <td>".$curso['curso']."</td>");
			echo("    <td>".$curso['qtd_inscrito']."</td>");
			echo("  </tr>");
		}
		echo("</table>");
	}
echo ("</div>");
}
