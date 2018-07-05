<?php
include 'color-table.php';
session_start();
if(!isset($_SESSION['user']))
    header("Location: login.php");

 $pdo = new PDO('mysql:host=localhost;dbname=mydb', 'root', '');

  $sql = 'SELECT id, cnpj, razao_social, contato, inscricao_estadual, inscricao_municipal, inscricao_suframa, senha_estadual, senha_municipal, senha_suframa, receita_federal, caixa_economica, cndt, sefaz, concordata, pmbv, alvara, suframa, digital, bombeiro, rua, bairro, cep, cidade, estado, pais FROM empresas';
  $stm = $pdo->prepare($sql);
  $stm->execute();
  $empresas = $stm->fetchAll(PDO::FETCH_OBJ);


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
    <div class="formulario2">
    
    <div class="row" align="center">
          <div class="col-sm-6 col-md-6 col-lg-6" align="center">
                <p>Filtar Empresas</p>
                <select name="filtrarEmpresas" class="sele" align="center">
                  <option value="1">Todas Empresas</option>
                  <option value="2">Empresa1</option>
                  <option value="3">Empresa2</option>
                </select>
          </div>
          <div class="col-sm-6 col-md-6 col-lg-6" align="center">
                <p>Filtar Datas</p>
                <select name="filtrarDatas" align="center">
                  <option value="1">Todas as datas</option>
                  <option value="2">Datas vencidas</option>
                  <option value="3">Datas a vencer</option>
                </select>
          </div>
      </div>
    <br/>
    <br/>
    
      <div class="table-responsive">
        <?php if(!empty($empresas)): ?>

          <div class="tabledata" align="center" style="overflow-x:auto;">
            <table width="60%" border="1" >
                <tbody border>
                <tr class="tittle_col">
                  <th scope="col">&nbsp;&nbsp;&nbsp;Empresa&nbsp;&nbsp;&nbsp;</th>
                  <th scope="col">&nbsp;&nbsp;&nbsp;Receita&nbsp;&nbsp;&nbsp;</th>
                  <th scope="col">&nbsp;&nbsp;&nbsp;Caixa&nbsp;&nbsp;&nbsp;</th>
                  <th scope="col">&nbsp;&nbsp;&nbsp;Sefaz&nbsp;&nbsp;&nbsp;</th>
                  <th scope="col">&nbsp;&nbsp;&nbsp;Concordata&nbsp;&nbsp;&nbsp;</th>
                  <th scope="col">&nbsp;&nbsp;&nbsp;PMBV&nbsp;&nbsp;&nbsp;</th>
                  <th scope="col">&nbsp;&nbsp;&nbsp;Alvara&nbsp;&nbsp;&nbsp;</th>
                  <th scope="col">&nbsp;&nbsp;&nbsp;Suframa&nbsp;&nbsp;&nbsp;</th>
                  <th scope="col">&nbsp;&nbsp;&nbsp;Digital&nbsp;&nbsp;&nbsp;</th>
                  <th scope="col">&nbsp;&nbsp;&nbsp;Bombeiro&nbsp;&nbsp;&nbsp;</th>
                  <th style="<?php if($_SESSION['perm'] == 'bas'){ echo 'display:none;';} else ?>" scope="col">&nbsp;&nbsp;&nbsp;Gerencia&nbsp;&nbsp;&nbsp;</th>
                </tr>

          <?php foreach($empresas as $empresa): ?> 
                  <tr class="table_content">
                      <th nowrap scope="row"><?=$empresa->razao_social?></th>
                     echo "<script>console.log( 'Debug Objects: " . paint_table(<?=$empresa->receita_federal?>). "' );</script>"; 
                       <td style='background-color:".paint_table(<?=$empresa->receita_federal?>)."'  class='text-info'><?=$empresa->receita_federal?></td>"
                          <td style="background-color:paint_table(<?=$empresa->caixa_economica?>)" class="text-info"><?=$empresa->caixa_economica?></td>
                          <td style="background-color:"paint_table(<?=$empresa->sefaz?>)"" class="text-info"><?=$empresa->sefaz?></td>
                          <td style="background-color:"paint_table(<?=$empresa->concordata?>)"" class="text-info"><?=$empresa->concordata?></td>
                          <td style="background-color:"paint_table(<?=$empresa->pmbv?>)"" class="text-info"><?=$empresa->pmbv?></td>
                          <td style="background-color:"paint_table(<?=$empresa->alvara?>)"" class="text-info"><?=$empresa->alvara?></td>
                          <td style="background-color:"paint_table(<?=$empresa->suframa?>)"" class="text-info"><?=$empresa->suframa?></td>
                          <td style="background-color:"paint_table(<?=$empresa->digital?>)"" class="text-info"><?=$empresa->digital?></td>
                          <td style="background-color:"paint_table(<?=$empresa->bombeiro?>)"" class="text-info"><?=$empresa->bombeiro?></td>
                          <td class="register_options" align="center" style="<?php if($_SESSION['perm'] == 'bas'){ echo 'display:none;';} else?>">
                            <a href="editar.php?id=<?=$empresa->id?>" class="ls-btn ls-ico-cog"> <img src="../img/edit.png" width="20px" height="20px" >
                            </a> 
                            <a style="<?php if($_SESSION['perm'] != 'adm'){ echo 'display:none;';}?>"  href="javascript:void(0)" class="btn btn-danger link_exclusao" rel="<?=$empresa->id?>"><img src="../img/delete.png" width="20px" height="20px">
                            </a>
                          </td>
                    
                    </tr>
                  <?php endforeach;?>
                </tbody>
              </table>
              <?php else: ?>
 
                <h3 class="text-center text-primary">Não existem empresas cadastradas!</h3>
              <?php endif; ?>
            </div>
          <br/>
          <br/>
          
          <div>
            <table width="100%" border="0">
              <tbody>
                <col width="55%">
                <col width="15%">
                <col width="15%">
                <col width="15%">
              <tr>
                <td><img src="../img/pdf.png"><a href="relatorio-geral.php" title="RELATÓRIO GERAL" target="_parent">Relatório Geral</a></td>
                <td class="text-danger"><img src="../img/vermelho.png" width="20px" height="20px"> Data vencida</td>
                <td class="text-warning"><img src="../img/laranja.png" width="20px" height="20px"> Data a vencer</td>
                <td class="text-success"><img src="../img/verde.png" width="20px" height="20px"> Data valida</td>
              </tr>
              </tbody>
            </table>

          </div>
        
        <div align="center" class="pagination">
          <a href="#">&laquo;</a>
          <a href="#">1</a>
          <a href="#">2</a>
          <a href="#">3</a>
          <a href="#">4</a>
          <a href="#">5</a>
          <a href="#">6</a>
          <a href="#">&raquo;</a>
        </div>
  </div>
  
  </div>
    
  <div class="col-md-6>
        <div align="center" class="help">
            <br/>
            <input type="image" src="img/info.png" onClick="#">   
        </div>
  </div> 

</div>
<script type="text/javascript" src="confirm.js"></script>
</body>
</html>

