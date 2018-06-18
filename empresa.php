<?php
	
	$id = $_POST['id'];
	$razao_social = $_POST['razao_social'];
	$cnpj = (string) $_POST['cnpj'];
	$contato = (string) $_POST['contato'];
	$rua = (string) $_POST['rua'];
	$barrio = (string) $_POST['barrio'];
	$cep = (string) $_POST['cep'];
	$cidade = (string) $_POST['cidade'];
	$estado = (string) $_POST['estado'];
	$pais = (string) $_POST['pais'];
	$inscricao_estadual = (string) $_POST['inscricao_estadual'];
	$senha_estadual = (string) $_POST['senha_estadual'];
	$inscricao_municipal = (string) $_POST['inscricao_municipal'];
	$senha_municipal = (string) $_POST['senha_municipal'];
	$inscricao_suframa = (string) $_POST['inscricao_suframa'];
	$senha_suframa = (string) $_POST['senha_suframa'];
	$receita_federal = (string) $_POST['receita_federal'];
	$caixa_economica = (string) $_POST['caixa_economica'];
	$sefaz = (string) $_POST['sefaz'];
	$concordata = (string) $_POST['concordata'];
	$pmbv = (string) $_POST['pmbv'];
	$alvara = (string) $_POST['alvara'];
	$suframa = (string) $_POST['suframa'];
	$digital = (string) $_POST['digital'];
	$bombeiro = (string) $_POST['bombeiro'];
	$digital = (string) $_POST['digital'];
	
	
	$pdo = new PDO("mysql:host=localhost;dbname=certidoes","root","");
	
	if(!$pdo)
	{
		print "erro ao conectar";
	}
	
	if($id == ""){
		$executa = $pdo->query("INSERT  INTO empresa(id,cnpj,razao_social,contato,inscricao_estadual,inscricao_municipal,inscricao_suframa,senha_estadual,senha_municipal,senha_suframa,receita_federal,caixa_economica,cndt,sefaz,concordata,pmbv,alvara,suframa,digital,bombeiro,rua,bairro,cep,cidade,estado,pais) VALUES ('$razao_social','$cnpj','$contato','$inscricao_estadual','$inscricao_municipal','$inscricao_suframa','$senha_estadual','$senha_municipal','$senha_suframa','$receita_federal','$caixa_economica','$cndt','$sefaz','$concordata','$pmbv','$alvara','$suframa','$digital','$bombeiro','$rua','$barrio','$cep','$cidade','$estado','$pais')");
		echo 'Dados inserido com sucesso';
	}
	else{
		$executa = $pdo->prepare("UPDATE cliente SET nome_cliente=? , cpf=? WHERE cod_cliente=?");
		$executa->execute(array($nome_cliente,$cpf, $cod_cliente));
		$affected_rows = $executa->rowCount();
		//$executa = $pdo->query("UPDATE cliente SET nome_cliente=$nome_cliente,cpf=$cpf where cod_cliente=$cod_cliente");
		echo 'Dados atualizado com sucesso';
	}

	
	
	
	

?>
