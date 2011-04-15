<?php


/**
 * Description of Boleto
 *
 * @author Rodrigo Lima
 */
class Boleto {


	protected $data_vencimento;
	protected $data_documento;
	protected $data_processamento;
	protected $valor_boleto;
	protected $quantidade;
	protected $valor_unitario;
	protected $aceite;
	protected $uso_banco;
	protected $especie;
	protected $especie_doc;
	protected $agencia;
	protected $conta;
	protected $convenio;
	protected $contrato;
	protected $formatacao_nosso_numero;
	protected $nosso_numero;
	protected $numero_documento;
	protected $carteira;
	protected $variacao_carteira;
	protected $cpf_cnpj;
	protected $endereco;
	protected $cidade;
	protected $cedente;
	protected $sacado;
	protected $endereco1;
	protected $endereco2;
	protected $instrucoes;
	protected $instrucoes1;
	protected $instrucoes2;
	protected $instrucoes3;
	protected $instrucoes4;


	public function Boleto($data_vencimento,$data_documento,$data_processamento,$valor_boleto,
							$quantidade,$valor_unitario,$aceite,$uso_banco,$especie,$especie_doc,
							$agencia,$conta,$convenio,$contrato,$formatacao_nosso_numero,$nosso_numero,
							$numero_documento,$carteira,$variacao_carteira,$cpf_cnpj,$endereco,$cidade,
							$cedente,$sacado,$endereco1,$endereco2,$instrucoes,$instrucoes1,
							$instrucoes2,$instrucoes3,$instrucoes4) {

		$this->data_vencimento = $data_vencimento;
		$this->data_documento = $data_documento;
		$this->data_processamento = $data_processamento;
		$this->valor_boleto = $valor_boleto;
		$this->quantidade = $quantidade;
		$this->valor_unitario = $valor_unitario;
		$this->aceite = $aceite;
		$this->uso_banco = $uso_banco;
		$this->especie = $especie;
		$this->especie_doc = $especie_doc;
		$this->agencia = $agencia;
		$this->conta = $conta;
		$this->convenio = $convenio;
		$this->contrato = $contrato;
		$this->formatacao_nosso_numero = $formatacao_nosso_numero;
		$this->nosso_numero = $nosso_numero;
		$this->numero_documento = $numero_documento;
		$this->carteira = $carteira;
		$this->variacao_carteira = $variacao_carteira;
		$this->cpf_cnpj = $cpf_cnpj;
		$this->endereco = $endereco;
		$this->cidade = $cidade;
		$this->cedente = $cedente;
		$this->sacado = $sacado;
		$this->endereco1 = $endereco1;
		$this->endereco2 = $endereco2;
		$this->instrucoes = $instrucoes;
		$this->instrucoes1 = $instrucoes1;
		$this->instrucoes2 = $instrucoes2;
		$this->instrucoes3 = $instrucoes3 ;
		$this->instrucoes4 = $instrucoes4;
	}

	public function getData_vencimento() {
		return $this->data_vencimento;
	}

	public function getData_documento() {
		return $this->data_documento;
	}

	public function getData_processamento() {
		return $this->data_processamento;
	}

	public function getValor_boleto() {
		return $this->valor_boleto;
	}

	public function getQuantidade() {
		return $this->quantidade;
	}

	public function getValor_unitario() {
		return $this->valor_unitario;
	}

	public function getAceite() {
		return $this->aceite;
	}

	public function getUso_banco() {
		return $this->uso_banco;
	}

	public function getEspecie() {
		return $this->especie;
	}

	public function getEspecie_doc() {
		return $this->especie_doc;
	}

	public function getAgencia() {
		return $this->agencia;
	}

	public function getConta() {
		return $this->conta;
	}

	public function getConvenio() {
		return $this->convenio;
	}

	public function getContrato() {
		return $this->contrato;
	}

	public function getFormatacao_nosso_numero() {
		return $this->formatacao_nosso_numero;
	}

	public function getNosso_numero() {
		return $this->nosso_numero;
	}

	public function getNumero_documento() {
		return $this->numero_documento;
	}

	public function getCarteira() {
		return $this->carteira;
	}

	public function getVariacao_carteira() {
		return $this->variacao_carteira;
	}

	public function getCpf_cnpj() {
		return $this->cpf_cnpj;
	}

	public function getEndereco() {
		return $this->endereco;
	}

	public function getCidade() {
		return $this->cidade;
	}

	public function getCedente() {
		return $this->cedente;
	}

	public function getSacado() {
		return $this->sacado;
	}

	public function getEndereco1() {
		return $this->endereco1;
	}

	public function getEndereco2() {
		return $this->endereco2;
	}

	public function getInstrucoes() {
		return $this->instrucoes;
	}

	public function getInstrucoes1() {
		return $this->instrucoes1;
	}

	public function getInstrucoes2() {
		return $this->instrucoes2;
	}

	public function getInstrucoes3() {
		return $this->instrucoes3;
	}

	public function getInstrucoes4() {
		return $this->instrucoes4;
	}

	public function setData_documento($data_documento) {
		$this->data_documento = $data_documento;
	}

	public function setData_processamento($data_processamento) {
		$this->data_processamento = $data_processamento;
	}

	public function setSacado($sacado) {
		$this->sacado = $sacado;
	}

	public function setEndereco1($endereco1) {
		$this->endereco1 = $endereco1;
	}

	public function setEndereco2($endereco2) {
		$this->endereco2 = $endereco2;
	}



	public static  function SelectBoleto($sock){
		$ssql = "SELECT * ";
		$ssql .= "FROM BOLETO " ;

		$rs = mysql_query($ssql, $sock);
		echo(mysql_error());
		unset($ar);

		while ($linha = mysql_fetch_row($rs)){
			$obj = new Boleto($linha[0],null,
			null,$linha[1],
			$linha[2],$linha[3],
			$linha[4],$linha[5],
			$linha[6],$linha[7],
			$linha[8],$linha[9],
			$linha[10],$linha[11],
			$linha[12],$linha[13],
			$linha[14],$linha[15],
			$linha[16],$linha[17],
			$linha[18],$linha[19],
			$linha[20],null,
			null,null,
			$linha[21],$linha[22],
			$linha[23],$linha[24],
			$linha[25]);
			$ar[] = $obj;
		}
		return ($ar);
	}

}