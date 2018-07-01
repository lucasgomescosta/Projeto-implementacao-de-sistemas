<?php
session_start();
if(!isset($_SESSION['user']))
    header("Location: login.php");

if($_SESSION['perm'] != 'adm')
    header("Location: 403.php");


$pdo = new PDO('mysql:host=localhost;dbname=mydb', 'root', '');

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
            <input type="hidden" name="id"  />
          <tr>
            <td class="formTittle" colspan="4">Dados da Empresa</td>
          </tr>
          <tr>
            <td class="text-primary">Razao Social:</td>
            <td><input type="text" class="form-control" name="razao_social" id="razao_social"  required></td>

            <td class="text-primary">CNPJ:</td>
            <td><input type="text" class="form-control" name="cnpj" maxlength="14"  placeholder="Só números" id="cnpj" required></td>
          </tr>

          <tr>
            <td class="text-primary">Contato:</td>
            <td><input type="text" class="form-control" name="contato" id="contato" required></td>
          </tr>

          <tr>
            <td class="text-primary">Rua:</td>
            <td><input type="text" class="form-control" name="rua" id="rua"  required></td>
            <td class="text-primary">Barrio:</td>
            <td><input type="text" class="form-control" name="bairro" id="bairro"  required></td>
          </tr>

          <tr>
            <td class="text-primary">CEP:</td>
            <td><input type="text" class="form-control" name="cep" maxlength="8" placeholder="Só números"  id="cep" required></td>
            <td class="text-primary">Cidade:</td>
            <td><input type="text" class="form-control" name="cidade" id="cidade" required></td>
          </tr>

          <tr>
            <td class="text-primary">Estado:</td>
            <td><input type="text" class="form-control" name="estado" id="estado"  required></td>
            <td class="text-primary">Pais:</td>
            <td><input type="text" class="form-control" name="pais" id="pais"  required></td>
          </tr>

          <tr>
            <td class="separador" colspan="4">  </td>
          </tr>
          <tr>
            <td class="text-primary">Inscricao Estadual:</td>
            <td class="text-primary"><input type="text" class="form-control" name="inscricao_estadual" maxlength="8" placeholder="Só números" id="inscricao_estadual"  required></td>
            <td class="text-primary">Senha IE:</td>
            <td><input type="text" class="form-control" name="senha_estadual" id="senha_estadual" required></td>
          </tr>
          <tr>
            <td class="text-primary">Inscricao Municipal:</td>
            <td><input type="text" class="form-control" name="inscricao_municipal"  maxlength="8" placeholder="Só números" id="inscricao_municipal" required></td>
            <td class="text-primary">Senha IM:</td>
            <td><input type="text" class="form-control" name="senha_municipal" id="senha_municipal"  required></td>
          </tr>
          <tr>
            <td class="text-primary">Inscricao Suframa</td>
            <td><input type="text" class="form-control" name="inscricao_suframa" maxlength="8" placeholder="Só números" id="inscricao_suframa"  required></td>
            <td class="text-primary">Senha Suf:</td>
            <td><input type="text" class="form-control" name="senha_suframa"  id="senha_suframa" required></td>
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
                      
                      <input type="hidden" name="acao" value="incluir">
                      <td width="50%"><input value="Enviar" id="Enviar" target="_parent" type="submit"/></td>

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

