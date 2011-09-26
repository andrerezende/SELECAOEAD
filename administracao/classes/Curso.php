<?php
class Curso {
	protected $cod_curso;
	protected $nome;
	protected $id_campus;

	public function Curso($pcod_curso = null, $pnome = null, $pid_campus = null) {
		$this->cod_curso = $pcod_curso;
		$this->nome = $pnome;
		$this->id_campus = $pid_campus;
	}

	public function getcodcurso() {
		return $this->cod_curso;
	}

	public function setCodcurso($a) {
		$this->cod_curso = $a;
	}

	public function getnome() {
		return $this->nome;
	}

	public function setnome($a) {
		$this->nome = $a;
	}

	public function getIdCampus() {
		return $this->id_campus;
	}

	public function setIdCampus($a) {
		$this->id_campus = $a;
	}


	public function Inserir($sock) {
		$ssql = "insert into curso (nome, campus) values ";
		$ssql .= " ('".$this->nome."', " . $this->id_campus . ")";

		$rs = mysql_query($ssql, $sock);

		$linha = mysql_affected_rows();

		if ($linha >0) {
			return true;
		} else {
			return false;
		}
	}

	public function apagar($sock,$id) {
		$ssql = "delete from curso";
		$ssql .= " WHERE cod_curso = ".$id;

		$rs = mysql_query($ssql, $sock);

		$linha = mysql_affected_rows();

		if ($linha >0) {
			return true;
		} else {
			return false;
		}
	}

	public function existeCursoAssociadoAcandidato($sock,$id) {
		$ssql = "select * from inscrito_curso";
		$ssql .= " WHERE cod_curso = ".$id;

		$rs = mysql_query($ssql, $sock);

		$linha = mysql_affected_rows();

		if ($linha >0) {
			return true;
		} else {
			return false;
		}
	}

	public function inativar($sock,$id) {
		$ssql = "update curso set";
		$ssql .= " ativo = 'N'";
		$ssql .= " WHERE cod_curso = ".$id;

		$rs = mysql_query($ssql, $sock);

		$linha = mysql_affected_rows();

		if ($linha >0) {
			return true;
		} else {
			return false;
		}
	}

	public function SelectByAll($sock) {
		$ssql = "SELECT cod_curso, nome, campus FROM curso A " ;
		$ssql .= " WHERE ativo is null";
		$ssql .= " ORDER BY nome ASC";
		$rs = mysql_query($ssql, $sock);

		$ar = array();

		while ($linha = mysql_fetch_row($rs)) {
			$obj = new Curso($linha[0], $linha[1], $linha[2]);
			$ar[] = $obj;
		}
		return ($ar);
	}

	public function SelectByPrimaryKey($sock,$codigo) {
		$ssql = "SELECT cod_curso, nome, campus FROM curso A " ;
		$ssql .= " WHERE cod_curso = " . $codigo;
		$ssql .= " ORDER BY cod_curso ASC";

		$rs = mysql_query($ssql, $sock);

		unset($ar);

		while ($linha = mysql_fetch_row($rs)) {
			$obj = new Curso($linha[0], $linha[1], $linha[2]);
			$ar[] = $obj;
		}
		return ($ar);
	}

	public function SelectCursoPorCampus($sock, $codigo) {
		$ssql = "SELECT cod_curso, nome, campus FROM curso A " ;
		$ssql .= " WHERE campus  =" .$codigo;
		$ssql .= " ORDER BY nome ASC";

		$rs = mysql_query($ssql, $sock);

		$ar = array();

		while ($linha = mysql_fetch_row($rs)) {
			$obj = new Curso($linha[0], $linha[1], $linha[2]);
			$ar[] = $obj;
		}
		return ($ar);
	}

	public function SelectCampusPorCurso($sock) {
		$ssql = "SELECT curso.cod_curso, curso.nome as nome_curso, campus.nome as nome_campus FROM curso";
		$ssql .= " INNER JOIN campus ON curso.campus = campus.id";
		$ssql .= " WHERE cod_curso = '$this->cod_curso'";

		$rs = mysql_query($ssql, $sock);

		return $rs;
	}

}
