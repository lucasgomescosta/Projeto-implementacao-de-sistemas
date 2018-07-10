<?php
	session_start();
	if(!isset($_SESSION['user']))
	    header("Location: login.php");

$teste = $_SESSION['perm'];
if($teste == 'bas'){
    header("Location: 403.php");
}
else if($teste == 'adm' || $teste == 'sem')
	
	// Recebe os dados enviados pela submissão
	$acao  = (isset($_POST['acao'])) ? $_POST['acao'] : '';
	$id = (isset($_POST['id'])) ? $_POST['id'] : '';
	$razao_social = (string) (isset($_POST['razao_social'])) ? $_POST['razao_social'] : '';
	$cnpj = (string) (isset($_POST['cnpj'])) ? $_POST['cnpj'] : '';
	$contato = (string) (isset($_POST['contato'])) ? $_POST['contato'] : '';
	$rua = (string) (isset($_POST['rua'])) ? $_POST['rua'] : '';
	$bairro = (string) (isset($_POST['bairro'])) ? $_POST['bairro'] : '';
	$cep = (string) (isset($_POST['cep'])) ? $_POST['cep'] : '';
	$cidade = (string) (isset($_POST['cidade'])) ? $_POST['cidade'] : '';
	$estado = (string) (isset($_POST['estado'])) ? $_POST['estado'] : '';
	$pais = (string) (isset($_POST['pais'])) ? $_POST['pais'] : '';
	$inscricao_estadual = (string) (isset($_POST['inscricao_estadual'])) ? $_POST['inscricao_estadual'] : '';
	$inscricao_municipal = (string) (isset($_POST['inscricao_municipal'])) ? $_POST['inscricao_municipal'] : '';
	$inscricao_suframa = (string) (isset($_POST['inscricao_suframa'])) ? $_POST['inscricao_suframa'] : '';
	$senha_estadual = (string) (isset($_POST['senha_estadual'])) ? $_POST['senha_estadual'] : '';
	$senha_municipal = (string) (isset($_POST['senha_municipal'])) ? $_POST['senha_municipal'] : '';
	$senha_suframa = (string) (isset($_POST['senha_suframa'])) ? $_POST['senha_suframa'] : '';
	$receita_federal =  (isset($_POST['receita_federal'])) ? $_POST['receita_federal'] : '';
	$caixa_economica =  (isset($_POST['caixa_economica'])) ? $_POST['caixa_economica'] : '';
	$sefaz =  (isset($_POST['sefaz'])) ? $_POST['sefaz'] : '';
	$concordata =  (isset($_POST['concordata'])) ? $_POST['concordata'] : '';
	$pmbv =  (isset($_POST['pmbv'])) ? $_POST['pmbv'] : '';
	$alvara =  (isset($_POST['alvara'])) ? $_POST['alvara'] : '';
	$suframa =  (isset($_POST['suframa'])) ? $_POST['suframa'] : '';
	$digital =  (isset($_POST['digital'])) ? $_POST['digital'] : '';
	$bombeiro =  (isset($_POST['bombeiro'])) ? $_POST['bombeiro'] : '';
	
	$pdo = new PDO('mysql:host=localhost;dbname=mydb', 'root', '');
	
	if(!$pdo)
	{
		print "erro ao conectar";
	}
	
	if($acao == 'incluir'):
		$executa = $pdo->query("INSERT  INTO empresas(cnpj,razao_social,contato,inscricao_estadual,inscricao_municipal,inscricao_suframa,senha_estadual,senha_municipal,senha_suframa,receita_federal,caixa_economica,sefaz,concordata,pmbv,alvara,suframa,digital,bombeiro,rua,bairro,cep,cidade,estado,pais) VALUES ('$cnpj','$razao_social','$contato','$inscricao_estadual','$inscricao_municipal','$inscricao_suframa','$senha_estadual','$senha_municipal','$senha_suframa','$receita_federal','$caixa_economica','$sefaz','$concordata','$pmbv','$alvara','$suframa','$digital','$bombeiro','$rua','$bairro','$cep','$cidade','$estado','$pais')");
		$retorno = $executa->execute();

		if ($retorno):
				echo "<div class='alert alert-success' role='alert'>Registro inserido com sucesso, aguarde você está sendo redirecionado ...</div> ";
		else:
		    	echo "<div class='alert alert-danger' role='alert'>Erro ao inserir registro!</div> ";
		endif;

			echo "<meta http-equiv=refresh content='3;URL=reports.php'>";
	endif;

	// Verifica se foi solicitada a edição de dados
	if ($acao == 'editar'):
		$executa = $pdo->prepare("UPDATE empresas SET receita_federal=? , caixa_economica=? , sefaz=? , concordata=? , pmbv=? , alvara=? , suframa=? , digital=? , bombeiro=? WHERE id=?");
		$executa->execute(array($receita_federal,$caixa_economica, $sefaz, $concordata,$pmbv,$alvara,$suframa, $digital, $bombeiro, $id));
		$affected_rows = $executa->rowCount();
		$retorno = $executa->execute();

			if ($retorno):
				echo "<div class='alert alert-success' role='alert'>Registro editado com sucesso, aguarde você está sendo redirecionado ...</div> ";
		    else:
		    	echo "<div class='alert alert-danger' role='alert'>Erro ao editar registro!</div> ";
			endif;

			echo "<meta http-equiv=refresh content='3;URL=reports.php'>";
	endif;
	// Verifica se foi solicitada a exclusão dos dados
	if ($acao == 'excluir'):
			// Exclui o registro do banco de dados
			$sql = 'DELETE FROM empresas WHERE id = :id';
			$stm = $pdo->prepare($sql);
			$stm->bindValue(':id', $id);
			$retorno = $stm->execute();
 
			if ($retorno):
				echo "<div class='alert alert-success' role='alert'>Registro excluído com sucesso, aguarde você está sendo redirecionado ...</div> ";
		    else:
		    	echo "<div class='alert alert-danger' role='alert'>Erro ao excluir registro!</div> ";
			endif;
 
			echo "<meta http-equiv=refresh content='3;URL=reports.php'>";
	endif;
?>