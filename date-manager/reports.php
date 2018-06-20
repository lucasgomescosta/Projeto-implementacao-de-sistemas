<?php
session_start();
if(!isset($_SESSION['user']))
    header("Location: login.php");

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
    <div class="formulario2">
    
      <div class="col-md-6" align="center">
        <p>Filtar Empresas</p>
        <select name="filtrarEmpresas" class="sele">
          <option value="1">Todas Empresas</option>
          <option value="2">Empresa1</option>
          <option value="3">Empresa2</option>
        </select>
      
        <p>Filtar Datas</p>
        <select name="filtrarDatas">
          <option value="1">Todas as datas</option>
          <option value="2">Datas vencidas</option>
          <option value="3">Datas a vencer</option>
        </select>
      </div>
      
    <br/>
    <br/>
    
      <div class="table-responsive">
            <?php
                $dbh = new PDO('mysql:host=localhost;dbname=mydb', 'root', '');

                $sql = 'SELECT * FROM empresas ORDER BY razao_social';
            ?>
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
                  <th scope="col">&nbsp;&nbsp;&nbsp;Gerencia&nbsp;&nbsp;&nbsp;</th>
                </tr>

                <?php 

                foreach($dbh->query($sql) as $row) 
                {

                    echo "
                        <tr class='table_content'>
                          <th nowrap scope='row'>".$row['razao_social']."</th>
                          <td>".$row['receita_federal']."</td>
                          <td>".$row['caixa_economica']."</td>
                          <td>".$row['sefaz']."</td>
                          <td>".$row['concordata']."</td>
                          <td>".$row['pmbv']."</td>
                          <td>".$row['alvara']."</td>
                          <td>".$row['suframa']."</td>
                          <td>".$row['digital']."</td>
                          <td>".$row['bombeiro']."</td>
                          <td class='register_options' align='center'><a href='../empresa.html' ><img src='../img/edit.png' width='20px' height='20px' ></a>
                          <a href='#'' ><img src='../img/delete.png' width='20px' height='20px' ></a></td>
                        </tr>";
                }
                ?>
                </tbody>
              </table>
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
                <td><img src="../img/pdf.png"><input value="Gerar PDF" target="_parent" onclick="#" type="buttom"/></td>
                <td><img src="../img/vermelho.png" width="20px" height="20px">Data vencida</td>
                <td><img src="../img/laranja.png" width="20px" height="20px">Data a vencer</td>
                <td><img src="../img/verde.png" width="20px" height="20px">Data valida</td>
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
</body>
</html>

