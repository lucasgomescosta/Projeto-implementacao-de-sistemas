<?php
session_start();
if(!isset($_SESSION['user']))
    header("Location: login.php");

if($_SESSION['perm'] != 'adm')
    header("Location: 403.php");


$pdo = new PDO('mysql:host=localhost;dbname=mydb', 'root', '');

$id = isset($_GET['id']) ? $_GET['id'] : ''; 

if(!empty($id) && is_numeric($id)):
  //captura os dados da empresa soilicitada
   $sql = 'SELECT id, cnpj, razao_social, contato, inscricao_estadual, inscricao_municipal, inscricao_suframa, senha_estadual, senha_municipal, senha_suframa, receita_federal, caixa_economica, cndt, sefaz, concordata, pmbv, alvara, suframa, digital, bombeiro, rua, bairro, cep, cidade, estado, pais FROM empresas WHERE id = :id';
   $stm = $pdo->prepare($sql);
   $stm->bindValue(':id', $id);
   $stm->execute();
   $empresa = $stm->fetch(PDO::FETCH_OBJ);
endif;

// Recebe o id do cliente do cliente via GET
?>

<html>
<header>
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css"/>
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-theme.min.css"/>
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
    <title>Edição da Empresa</title>
</header>
<body>
<body>
<header>
    <div class="nav-bar navbar-fixed-top">
        <a href="index.php"><img src="img/logo.png" class="logo"></a>
        <ul class="menu">
            <li style="<?php if($_SESSION['perm'] != 'adm'){ echo 'display:none;';}?>"><a href="companies.php">Companies</a></li>
            <li><a href="reports.php">Reports</a></li>
            <li style="<?php if($_SESSION['perm'] != 'adm'){ echo 'display:none;';}?>"><a href="users.php">Users</a></li>
            <li><a href="#"><?php echo $_SESSION['user']?></a></li>
            <li><a href="login.php">Logout</a></li>
        </ul>
    </div>
</header>
</body>
<div align="center" style="text-align: center">
    <br/>
    <br/>
    <br/>
    <br/>
    
  <div class="table-responsive">
  
    <div align="center" class="formulario">
      <?php if(empty($empresa)):?>
        <h3 class="text-center text-danger">Empresa não encontrado!</h3>
      <?php else: ?>
        <form name="formCadEmpresa" action="empresa.php" method="post">
          <table align="center" >
              <input type="hidden" name="id" value="<?php echo $id; ?>"  disabled />
            <tr>
              <td class="formTittle" colspan="4">Dados da Empresa</td>
            </tr>
            <tr>
              <td class="text-primary">Razao Social:</td>
              <td><input type="text" class="form-control" name="razao_social" id="razao_social" value="<?=$empresa->razao_social?>"  disabled required></td>

              <td class="text-primary">CNPJ:</td>
              <td><input type="text" class="form-control" name="cnpj" maxlength="14" value="<?=$empresa->cnpj?>" placeholder="Só números" id="cnpj" required  disabled></td>
            </tr>

            <tr>
              <td class="text-primary">Contato:</td>
              <td><input type="text" class="form-control" name="contato" id="contato" value="<?=$empresa->contato?>" required  disabled></td>
            </tr>

            <tr>
              <td class="text-primary">Rua:</td>
              <td><input type="text" class="form-control" name="rua" id="rua" value="<?=$empresa->rua?>" required  disabled></td>
              <td class="text-primary">Barrio:</td>
              <td><input type="text" class="form-control" name="bairro" id="bairro" value="<?=$empresa->bairro?>" required  disabled></td>
            </tr>

            <tr>
              <td class="text-primary">CEP:</td>
              <td><input type="text" class="form-control" name="cep" maxlength="8" placeholder="Só números" value="<?=$empresa->cep?>" id="cep" required  disabled></td>
              <td class="text-primary">Cidade:</td>
              <td><input type="text" class="form-control" name="cidade" value="<?=$empresa->cidade?>" id="cidade" required  disabled></td>
            </tr>

            <tr>
              <td class="text-primary">Estado:</td>
              <td><input type="text" class="form-control" name="estado" id="estado" value="<?=$empresa->estado?>" required  disabled></td>
              <td class="text-primary">Pais:</td>
              <td><input type="text" class="form-control" name="pais" id="pais" value="<?=$empresa->pais?>" required  disabled></td>
            </tr>

            <tr>
              <td class="separador" colspan="4">  </td>
            </tr>
            <tr>
              <td class="text-primary">Inscricao Estadual:</td>
              <td class="text-primary"><input type="text" class="form-control" name="inscricao_estadual" maxlength="8" placeholder="Só números" id="inscricao_estadual" value="<?=$empresa->inscricao_estadual?>" required disabled></td>
              <td class="text-primary">Senha IE:</td>
              <td><input type="text" class="form-control" name="senha_estadual" value="<?=$empresa->senha_estadual?>" id="senha_estadual" required disabled></td>
            </tr>
            <tr>
              <td class="text-primary">Inscricao Municipal:</td>
              <td><input type="text" class="form-control" name="inscricao_municipal" value="<?=$empresa->inscricao_municipal?>" maxlength="8" placeholder="Só números" id="inscricao_municipal" required disabled></td>
              <td class="text-primary">Senha IM:</td>
              <td><input type="text" class="form-control" name="senha_municipal" id="senha_municipal" value="<?=$empresa->senha_municipal?>" required disabled></td>
            </tr>
            <tr>
              <td class="text-primary">Inscricao Suframa</td>
              <td><input type="text" class="form-control" name="inscricao_suframa" maxlength="8" placeholder="Só números" id="inscricao_suframa" value="<?=$empresa->inscricao_suframa?>" required disabled></td>
              <td class="text-primary">Senha Suf:</td>
              <td><input type="text" class="form-control" name="senha_suframa" value="<?=$empresa->senha_suframa?>" id="senha_suframa" required disabled></td>
            </tr>
            <tr>
              <td class="separador" colspan="4">  </td>
            </tr>
            <tr>
              <td class="separador" colspan="4">  </td>
            </tr>

          </table>
          <table align="center">
            <tr>
              <td class="formTittle" colspan="2">Centidoes Federais</td>
            </tr>
            <tr>
              <td class="text-primary">Receita Federal:</td>
              <td><input type="date"  name="receita_federal" id="receita_federal" placeholder="<?php echo date('d/m/Y',strtotime($data["congestart"])) ?>" value="<?=$empresa->receita_federal?>" required></td>
            </tr>
            <tr>
              <td class="text-primary">Caixa Economica:</td>
              <td><input type="date" name="caixa_economica" id="caixa_economica" value="<?=$empresa->caixa_economica?>" placeholder="<?php echo date('d/m/Y',strtotime($data["congestart"])) ?>" required></td>
            </tr>
            <tr>
              <td class="separador" colspan="4">  </td>
            </tr>
            <tr>
              <td class="formTittle" colspan="2">Centidoes Estaduais</td>
            </tr>

            <tr>
              <td class="text-primary">Sefaz:</td>
              <td><input type="date" name="sefaz" id="sefaz" value="<?=$empresa->sefaz?>" placeholder="<?php echo date('d/m/Y',strtotime($data["congestart"])) ?>" required></td>
            </tr>

            <tr>
              <td class="text-primary">Falência Concordata:</td>
              <td><input type="date" name="concordata" value="<?=$empresa->concordata?>" id="concordata" placeholder="<?php echo date('d/m/Y',strtotime($data["congestart"])) ?>" required></td>
            </tr>
            <tr>
              <td class="separador" colspan="4">  </td>
            </tr>
            <tr>
              <td class="formTittle" colspan="2">Centidoes Municipais</td>
            </tr>

            <tr>
              <td class="text-primary">PMBV:</td>
              <td><input type="date" name="pmbv" id="pmbv" value="<?=$empresa->pmbv?>" placeholder="<?php echo date('d/m/Y',strtotime($data["congestart"])) ?>" required></td>
            </tr>

            <tr>
              <td class="text-primary">Alvará de funcionamiento:</td>
              <td><input type="date" name="alvara" value="<?=$empresa->alvara?>" id="alvara" placeholder="<?php echo date('d/m/Y',strtotime($data["congestart"])) ?>" required></td>
            </tr>
            <tr>
              <td class="separador" colspan="4">  </td>
            </tr>
            <tr>
              <td class="formTittle">Suframa:</td>
              <td><input type="date" name="suframa" value="<?=$empresa->suframa?>" id="suframa" placeholder="<?php echo date('d/m/Y',strtotime($data["congestart"])) ?>" required></td>
            </tr>
            <tr>
              <td class="separador" colspan="4">  </td>
            </tr>
            <tr>
              <td class="formTittle">Certificado Digital:</td>
              <td><input type="date" name="digital" value="<?=$empresa->digital?>" id="digital" placeholder="<?php echo date('d/m/Y',strtotime($data["congestart"])) ?>" required></td>
            </tr>
            <tr>
              <td class="separador" colspan="4">  </td>
            </tr>
            <tr>
              <td class="formTittle">Laudo Bombeiro:</td>
              <td><input type="date" name="bombeiro" value="<?=$empresa->bombeiro?>" id="bombeiro" placeholder="<?php echo date('d/m/Y',strtotime($data["congestart"])) ?>" required></td>
            </tr>

            <tr>
              <td class="separador" colspan="4">  </td>
            </tr>

            <tr align="center">
                        <td width="50%">
                           <a href='reports.php' class="btn btn-danger" target="_parent">Cancelar</a>
                        </td>  
                        <input type="hidden" name="acao" value="editar">
                        <input type="hidden" name="id" value="<?=$empresa->id?>">
                        <td width="50%"><input value="Enviar" id="Enviar" target="_parent" type="submit"/></td>

            </tr>

          </table>
        </form>
        <?php endif; ?>
    </div>
  </div>
  
  <div class="col-md-6>
    <div align="center" class="help">
        <br/>
        <input type="image" src="img/info.png" onClick="#"> 
        
      </div>
  </div>   

</div>
</body>
</html>

