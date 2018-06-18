<?php
session_start();
if(!isset($_SESSION['user']))
    header("Location: login.php");

if($_SESSION['perm'] != 'adm')
    header("Location: 403.php");
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
    <h1>Companies here</h1>
</div>
</body>
</html>

