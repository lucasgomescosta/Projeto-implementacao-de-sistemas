<?php
include 'color-table.php';
session_start();
if(!isset($_SESSION['user']))
    header("Location: login.php");

 $pdo = new PDO('mysql:host=localhost;dbname=mydb', 'root', '');

  $sql = 'SELECT * FROM empresas LIMIT 10';
  $sql_pg = $pdo->query("SELECT * FROM empresas");
  $stm = $pdo->prepare($sql);
  $stm->execute();
  $count = $sql_pg->rowCount();
  $calculate = ceil(($count/100)*10);
  $i =1;


  if(isset($_GET['page'])==$i){
    $url = $_GET['page'];
    $mod = $url * 10 -10;
    $sql = "SELECT * FROM empresas LIMIT 10 OFFSET $mod";
    $stm = $pdo->prepare($sql);
    $stm->execute();

  }
$empresas = $stm->fetchAll(PDO::FETCH_OBJ);

$stm1= $pdo->prepare("SELECT * FROM empresas");
$stm1->execute();
$empresaFil= $stm1->fetchAll(PDO::FETCH_OBJ);

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
                
              <form id="filtroEmpresa" action="">
                <p>Filtrar por Empresas</p>
                <select name="filtrarEmpresas" class="form-control" align="center" style="background:rgba(0,0,0,0.80); color: white;">
                   <option title="Todas Empresas" value="1" style="color: white; background-color: rgba(0,0,0,0.80);">Todas Empresas</option>
                   <?php foreach($empresaFil as $empresa): ?> 
                      <option style="color: white; background-color: rgba(0,0,0,0.80)" title="<?=$empresa->razao_social?>" value="<?=$empresa->razao_social?>"><?=$empresa->razao_social?></option>
                   <?php endforeach;?> 
                </select>
              <button type="submit"class="btn" form="filtroEmpresa" value="" style="background-color: black; box-sizing: border-box; padding: 10px 20px; 
                color: #fff">Filtrar</button> <?php 
                    if(isset($_GET['filtrarEmpresas'])){
                       $aux = $_GET['filtrarEmpresas'];
                       if($aux != 1){
                        $sql = "SELECT * FROM empresas WHERE razao_social = '$aux'";
                        $fil = $pdo->prepare($sql);
                        $fil->execute();
                        $empresas = $fil->fetchAll(PDO::FETCH_OBJ);
                      }
                      else{
                        $stm1= $pdo->prepare("SELECT * FROM empresas");
                        $stm1->execute();
                        $empresaFil= $stm1->fetchAll(PDO::FETCH_OBJ);


                      }
                    }
                    
              ?>  
              </form>
              
          </div>
          <div class="col-sm-6 col-md-6 col-lg-6" align="center" >
            <form  id="filtroDatas">    <p>Filtrar por Datas</p>
                <select style="color: white; background-color: rgba(0,0,0,0.80)" name="filtrarDatas" class="form-control" align="center" style="background-color: transparent;  background: transparent;  color: #000; box-sizing: border-box; padding: 20px 30px; 
                color: #fff">
                  <option value="1"style="color: white; background-color: rgba(0,0,0,0.80);">Todas as datas</option>
                  <option value="2"style="color: white; background-color: rgba(0,0,0,0.80);">Datas vencidas</option>
                  <option value="3"style="color: white; background-color: rgba(0,0,0,0.80);">Datas a vencer</option>
                </select>
             <button class="btn" type="submit" form="filtroDatas" value="" style="background-color: black; box-sizing: border-box; padding: 10px 20px; 
                color: #fff">Filtrar</button>   
             </form>
             <?php 
             if(isset($_GET['filtrarDatas'])){
              $aux1= $_GET['filtrarDatas'];
              switch ($aux1) {
                case 2:
                  # code...
                  $sql = "SELECT * FROM `empresas` WHERE (receita_federal < CURRENT_DATE) OR ( caixa_economica < CURRENT_DATE) OR (cndt < CURRENT_DATE) OR (sefaz < CURRENT_DATE) OR (concordata < CURRENT_DATE) OR (pmbv < CURRENT_DATE) OR (alvara < CURRENT_DATE) OR (suframa < CURRENT_DATE) OR (digital < CURRENT_DATE) OR (bombeiro < CURRENT_DATE)";
                  $fil = $pdo->prepare($sql);
                  $fil->execute();
                  $empresas = $fil->fetchAll(PDO::FETCH_OBJ);
                  break;
                case 3:
                $sql = "SELECT * FROM `empresas` WHERE (receita_federal >= CURRENT_DATE AND receita_federal < CURRENT_DATE + INTERVAL 11 DAY) OR ( caixa_economica >= CURRENT_DATE AND caixa_economica < CURRENT_DATE + INTERVAL 11 DAY) OR (cndt >= CURRENT_DATE AND cndt < CURRENT_DATE + INTERVAL 11 DAY ) OR (sefaz >= CURRENT_DATE AND sefaz < CURRENT_DATE + INTERVAL 11 DAY) OR (concordata >= CURRENT_DATE AND concordata < CURRENT_DATE + INTERVAL 11 DAY) OR (pmbv >= CURRENT_DATE AND pmbv < CURRENT_DATE + INTERVAL 11 DAY) OR (alvara >= CURRENT_DATE AND alvara < CURRENT_DATE + INTERVAL 11 DAY) OR (suframa >= CURRENT_DATE AND suframa < CURRENT_DATE + INTERVAL 11 DAY ) OR (digital >= CURRENT_DATE AND digital < CURRENT_DATE + INTERVAL 11 DAY) OR (bombeiro >= CURRENT_DATE AND bombeiro < CURRENT_DATE + INTERVAL 11 DAY)";
                $fil = $pdo->prepare($sql);
                $fil->execute();
                $empresas = $fil->fetchAll(PDO::FETCH_OBJ);

                  break;
                default:
                  # code...
                  $fil = $pdo->prepare($sql);
                  $fil->execute();
                  $empresas = $fil->fetchAll(PDO::FETCH_OBJ);
                  break;
              }
             }
             ?>
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
                       
                       <td style="color:white; background-color:<?=paint_table($empresa->receita_federal)?>"  class='text-info'><?=$empresa->receita_federal?></td>
                       
                       <td style="color:white; background-color:<?=paint_table($empresa->caixa_economica)?>" class="text-info"><?=$empresa->caixa_economica?></td>
                       
                       <td style="color:white; background-color:<?=paint_table($empresa->sefaz)?>" class="text-info"><?=$empresa->sefaz?> </td>
                       
                          <td style="color:white; background-color:<?=paint_table($empresa->concordata)?>" class="text-info"><?=$empresa->concordata?></td>
                       
                          <td style="color:white; background-color:<?=paint_table($empresa->pmbv)?>" class="text-info"><?=$empresa->pmbv?></td>
                       
                          <td style="color:white; background-color:<?=paint_table($empresa->alvara)?>" class="text-info"><?=$empresa->alvara?></td>
                       
                          <td style="color:white; background-color:<?=paint_table($empresa->suframa)?>" class="text-info"><?=$empresa->suframa?></td>
                       
                          <td style="color:white; background-color:<?=paint_table($empresa->digital)?>" class="text-info"><?=$empresa->digital?></td>
                       
                          <td style="color:white; background-color:<?=paint_table($empresa->bombeiro)?>" class="text-info"><?=$empresa->bombeiro?></td>
                       
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
          <p>Páginas: </p>
          <?php

            /* if(@$_GET['page'] !=1){
                $page_back = $_GET['page']  -1;
                echo "<a href='?page=$page_back'>&laquo;</a>";
              }*/
              while($i <= $calculate){
                echo "<a href='?page=$i'>$i </a>";  
                $i++;
              }
          ?> 
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

