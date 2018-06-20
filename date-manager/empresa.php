<?php
	session_start();
	if(!isset($_SESSION['user']))
	    header("Location: login.php");

	if($_SESSION['perm'] != 'adm')
	    header("Location: 403.php");
	
	$id = $_POST['id'];
	$razao_social = (string) $_POST['razao_social'];
	$cnpj = (string) $_POST['cnpj'];
	$contato = (string) $_POST['contato'];
	$rua = (string) $_POST['rua'];
	$bairro = (string) $_POST['bairro'];
	$cep = (string) $_POST['cep'];
	$cidade = (string) $_POST['cidade'];
	$estado = (string) $_POST['estado'];
	$pais = (string) $_POST['pais'];
	$inscricao_estadual = (string) $_POST['inscricao_estadual'];
	$inscricao_municipal = (string) $_POST['inscricao_municipal'];
	$inscricao_suframa = (string) $_POST['inscricao_suframa'];
	$senha_estadual = (string) $_POST['senha_estadual'];
	$senha_municipal = (string) $_POST['senha_municipal'];
	$senha_suframa = (string) $_POST['senha_suframa'];
	$receita_federal =  $_POST['receita_federal'];
	$caixa_economica =  $_POST['caixa_economica'];
	$sefaz =  $_POST['sefaz'];
	$concordata =  $_POST['concordata'];
	$pmbv =  $_POST['pmbv'];
	$alvara =  $_POST['alvara'];
	$suframa =  $_POST['suframa'];
	$digital =  $_POST['digital'];
	$bombeiro =  $_POST['bombeiro'];
	
	$pdo = new PDO('mysql:host=localhost;dbname=mydb', 'root', '');
	
	if(!$pdo)
	{
		print "erro ao conectar";
	}
	
	if($id == ""){
		$executa = $pdo->query("INSERT  INTO empresas(cnpj,razao_social,contato,inscricao_estadual,inscricao_municipal,inscricao_suframa,senha_estadual,senha_municipal,senha_suframa,receita_federal,caixa_economica,sefaz,concordata,pmbv,alvara,suframa,digital,bombeiro,rua,bairro,cep,cidade,estado,pais) VALUES ('$cnpj','$razao_social','$contato','$inscricao_estadual','$inscricao_municipal','$inscricao_suframa','$senha_estadual','$senha_municipal','$senha_suframa','$receita_federal','$caixa_economica','$sefaz','$concordata','$pmbv','$alvara','$suframa','$digital','$bombeiro','$rua','$bairro','$cep','$cidade','$estado','$pais')");
		header("Location: index.php");
	}
	else{
		$executa = $pdo->prepare("UPDATE empresas SET receita_federal=? , caixa_economica=? , sefaz=? , concordata=? , pmbv=? , alvara=? , suframa=? , digital=? , bombeiro=? WHERE id=?");
		$executa->execute(array($receita_federal,$caixa_economica, $sefaz, $concordata,$pmbv,$alvara,$suframa, $digital, $bombeiro, $id));
		$affected_rows = $executa->rowCount();
		echo 'Dados atualizado com sucesso';
	}

	
	
	
	

?>