<?php
session_start();
if(!isset($_SESSION['user']) || !isset($_SESSION['perm']))
    header("Location: login.php");
if($_SESSION['perm'] != 'adm')
    header("Location: 403.php");

if(!isset($_GET['user']) || !isset($_GET['id']))
    header("Location: users.php");










?>

<html>
<header>
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css"/>
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-theme.min.css"/>
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
</header>
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
<br/>
<br/>
<br/>
<br/>
<br/>

<div class="login">
    <img src="img/user_icon.png" class="avatar">
    <h1>Are you sure?</h1>
    <form method="get" action="deleteUser.php?id=<?php echo $_GET['id']?>">

        <br/>
        <br/>
        <br/>
        <input style="visibility: hidden" name="id" value="<?php echo $_GET['id']?>">
        <br/>
        <p>Tem certeza que deseja deletar os dados de <?php echo $_GET['user']?>?</p>
        <br/>
        <br/>
        <br/>
        <br/>


       <table align="center" width="100%">
            <tr>
                <td width="50%"><input value="CONFIRM" type="submit"/></td>
            </tr>
        </table>

    </form>
</div>



</body>
</body>
</html>

