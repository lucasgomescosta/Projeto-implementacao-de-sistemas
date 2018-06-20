<?php
session_start();
if(!isset($_SESSION['user']))
    header("Location: login.php");

if($_SESSION['perm'] != 'adm')
    header("Location: 403.php");


$pdo = new PDO('mysql:host=localhost;dbname=mydb', 'root', '');

$id = isset($_GET["id"]) ? $_GET["id"] : null;        
            
$razao_social = isset($_GET["razao_social"]) ? $_GET["razao_social"] : null;
$cnpj = isset($_GET["cnpj"]) ? $_GET["cnpj"] : null;
$contato = isset($_GET['contato']) ? $_GET["contato"] : null;
$rua = isset($_GET['rua']) ? $_GET["rua"] : null;
$bairro = isset($_GET['bairro']) ? $_GET["bairro"] : null;
$cep = isset($_GET['cep']) ? $_GET["cep"] : null;
$cidade = isset($_GET['cidade']) ? $_GET["cidade"] : null;
$estado = isset($_GET['estado']) ? $_GET["estado"] : null;
$pais = isset($_GET['pais']) ? $_GET["pais"] : null;
$inscricao_estadual = isset($_GET['inscricao_estadual']) ? $_GET["inscricao_estadual"] : null;
$inscricao_municipal = isset($_GET['inscricao_municipal']) ? $_GET["inscricao_municipal"] : null;
$inscricao_suframa = isset($_GET['inscricao_suframa']) ? $_GET["inscricao_suframa"] : null;
$senha_estadual = isset($_GET['senha_estadual']) ? $_GET["senha_estadual"] : null;
$senha_municipal = isset($_GET['senha_municipal']) ? $_GET["senha_municipal"] : null;
$senha_suframa = isset($_GET['senha_suframa']) ? $_GET["senha_suframa"] : null;
$receita_federal = isset($_GET['receita_federal']) ? $_GET["receita_federal"] : null;
$caixa_economica = isset($_GET['caixa_economica']) ? $_GET["caixa_economica"] : null;
$sefaz = isset($_GET['sefaz']) ? $_GET["sefaz"] : null;
$concordata = isset($_GET['concordata']) ? $_GET["concordata"] : null;
$pmbv = isset($_GET['pmbv']) ? $_GET["pmbv"] : null;
$alvara = isset($_GET['alvara']) ? $_GET["alvara"] : null;
$suframa = isset($_GET['suframa']) ? $_GET["suframa"] : null;
$digital = isset($_GET['digital']) ? $_GET["digital"] : null;
$bombeiro = isset($_GET['bombeiro']) ? $_GET["bombeiro"] : null;
?>

<html>
<header>
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css"/>
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-theme.min.css"/>
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
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
      <form name="formCadEmpresa" action="empresa.php" method="post">
        <table align="center" >
            <input type="hidden" name="id" value="<?php echo $id; ?>" />
          <tr>
            <td class="formTittle" colspan="4">Dados da Empresa</td>
          </tr>
          <tr>
            <td class="text-primary">Razao Social:</td>
            <td><input type="text" class="form-control" name="razao_social" id="razao_social" value="<?php echo $razao_social; ?>" required></td>

            <td class="text-primary">CNPJ:</td>
            <td><input type="text" class="form-control" name="cnpj" maxlength="14" value="<?php echo $cnpj; ?>" placeholder="Só números" id="cnpj" required></td>
          </tr>

          <tr>
            <td class="text-primary">Contato:</td>
            <td><input type="text" class="form-control" name="contato" id="contato" value="<?php echo $contato; ?>" required></td>
          </tr>

          <tr>
            <td class="text-primary">Rua:</td>
            <td><input type="text" class="form-control" name="rua" id="rua" value="<?php echo $rua; ?>" required></td>
            <td class="text-primary">Barrio:</td>
            <td><input type="text" class="form-control" name="bairro" id="bairro" value="<?php echo $bairro; ?>" required></td>
          </tr>

          <tr>
            <td class="text-primary">CEP:</td>
            <td><input type="text" class="form-control" name="cep" maxlength="8" placeholder="Só números" value="<?php echo $cep; ?>" id="cep" required></td>
            <td class="text-primary">Cidade:</td>
            <td><input type="text" class="form-control" name="cidade" value="<?php echo $cidade; ?>" id="cidade" required></td>
          </tr>

          <tr>
            <td class="text-primary">Estado:</td>
            <td><input type="text" class="form-control" name="estado" id="estado" value="<?php echo $estado; ?>" required></td>
            <td class="text-primary">Pais:</td>
            <td><input type="text" class="form-control" name="pais" id="pais" value="<?php echo $pais; ?>" required></td>
          </tr>

          <tr>
            <td class="separador" colspan="4">  </td>
          </tr>
          <tr>
            <td class="text-primary">Inscricao Estadual:</td>
            <td class="text-primary"><input type="text" class="form-control" name="inscricao_estadual" maxlength="8" placeholder="Só números" id="inscricao_estadual" value="<?php echo $inscricao_estadual; ?>" required></td>
            <td class="text-primary">Senha IE:</td>
            <td><input type="text" class="form-control" name="senha_estadual" id="senha_estadual" required></td>
          </tr>
          <tr>
            <td class="text-primary">Inscricao Municipal:</td>
            <td><input type="text" class="form-control" name="inscricao_municipal" value="<?php echo $inscricao_municipal; ?>" maxlength="8" placeholder="Só números" id="inscricao_municipal" required></td>
            <td class="text-primary">Senha IM:</td>
            <td><input type="text" class="form-control" name="senha_municipal" id="senha_municipal" value="<?php echo $senha_municipal; ?>" required></td>
          </tr>
          <tr>
            <td class="text-primary">Inscricao Suframa</td>
            <td><input type="text" class="form-control" name="inscricao_suframa" maxlength="8" placeholder="Só números" id="inscricao_suframa" value="<?php echo $inscricao_suframa; ?>" required></td>
            <td class="text-primary">Senha Suf:</td>
            <td><input type="text" class="form-control" name="senha_suframa" value="<?php echo $senha_suframa; ?>" id="senha_suframa" required></td>
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
            <td><input type="date"  name="receita_federal" id="receita_federal" placeholder="<?php echo date('d/m/Y',strtotime($data["congestart"])) ?>" required></td>
          </tr>
          <tr>
            <td class="text-primary">Caixa Economica:</td>
            <td><input type="date" name="caixa_economica" id="caixa_economica" placeholder="<?php echo date('d/m/Y',strtotime($data["congestart"])) ?>" required></td>
          </tr>
          <tr>
            <td class="separador" colspan="4">  </td>
          </tr>
          <tr>
            <td class="formTittle" colspan="2">Centidoes Estaduais</td>
          </tr>

          <tr>
            <td class="text-primary">Sefaz:</td>
            <td><input type="date" name="sefaz" id="sefaz" placeholder="<?php echo date('d/m/Y',strtotime($data["congestart"])) ?>" required></td>
          </tr>

          <tr>
            <td class="text-primary">Falência Concordata:</td>
            <td><input type="date" name="concordata" id="concordata" placeholder="<?php echo date('d/m/Y',strtotime($data["congestart"])) ?>" required></td>
          </tr>
          <tr>
            <td class="separador" colspan="4">  </td>
          </tr>
          <tr>
            <td class="formTittle" colspan="2">Centidoes Municipais</td>
          </tr>

          <tr>
            <td class="text-primary">PMBV:</td>
            <td><input type="date" name="pmbv" id="pmbv" placeholder="<?php echo date('d/m/Y',strtotime($data["congestart"])) ?>" required></td>
          </tr>

          <tr>
            <td class="text-primary">Alvará de funcionamiento:</td>
            <td><input type="date" name="alvara" id="alvara" placeholder="<?php echo date('d/m/Y',strtotime($data["congestart"])) ?>" required></td>
          </tr>
          <tr>
            <td class="separador" colspan="4">  </td>
          </tr>
          <tr>
            <td class="formTittle">Suframa:</td>
            <td><input type="date" name="suframa" id="suframa" placeholder="<?php echo date('d/m/Y',strtotime($data["congestart"])) ?>" required></td>
          </tr>
          <tr>
            <td class="separador" colspan="4">  </td>
          </tr>
          <tr>
            <td class="formTittle">Certificado Digital:</td>
            <td><input type="date" name="digital" id="digital" placeholder="<?php echo date('d/m/Y',strtotime($data["congestart"])) ?>" required></td>
          </tr>
          <tr>
            <td class="separador" colspan="4">  </td>
          </tr>
          <tr>
            <td class="formTittle">Laudo Bombeiro:</td>
            <td><input type="date" name="bombeiro" id="bombeiro" placeholder="<?php echo date('d/m/Y',strtotime($data["congestart"])) ?>" required></td>
          </tr>

          <tr>
            <td class="separador" colspan="4">  </td>
          </tr>

          <tr align="center">
                      
                      <td width="50%"><input type="reset" name="limpar" value="Limpar"></td>
                      
                      <td width="50%"><input value="Enviar" id="Enviar" target="_parent" onclick="inicio.html" type="submit"/></td>

          </tr>

        </table>
      </form>
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

