<?php
session_start();
if(!isset($_SESSION['user']) || !isset($_SESSION['perm']))
    header("Location: login.php");
if($_SESSION['perm'] != 'adm')
    header("Location: 403.php");


$error_message = "nothing to show";
$show_error_message = false;
$data_is_set = false;

if(isset($_POST['user']) && isset($_POST['email']) && isset($_POST['pass']) && isset($_POST['pass2']) && isset($_POST['perm']))
{
    $data_is_set = true;
    echo "A LOT IS SET<br/>";
    if($_POST['user'] == "" || $_POST['email'] == "" || $_POST['pass'] == "" || $_POST['pass2'] == "" || $_POST['perm'] == "")
    {
        $error_message = "Please fill all the fields";
        $show_error_message = true;
    }
    else if($_POST['pass'] != $_POST['pass2'])
    {
        $error_message = "Passwords don't match";
        echo "PASS ISSUE<br/>";
        $show_error_message = true;
    }
    else
    {

        $dbh = new PDO('mysql:host=localhost;dbname=mydb', 'root', '');
        $sql = 'SELECT * FROM usuario WHERE email="'  . $_POST['email'] .  '"';
        foreach($dbh->query($sql) as $row)
        {
            echo "EMAIL ISSUE<br/>";
            $error_message = "E-mail already taken";
            $show_error_message = true;
        }

        if(!$show_error_message)
        {
            echo "SAVE ALL<br/>";
            echo $_POST['user'] . "<br/>";
            $sql = "INSERT INTO usuario (nome,
			email,
			senha,
			permissao) VALUES (
			:nome, 
			:email, 
			:senha, 
			:permission)";

            $stmt = $dbh->prepare($sql);
            $stmt->bindParam(':nome', $_POST['user'], PDO::PARAM_STR);
            $stmt->bindParam(':email', $_POST['email'], PDO::PARAM_STR);
            $stmt->bindParam(':senha', $_POST['pass'], PDO::PARAM_STR);
            $stmt->bindParam(':permission', $_POST['perm'], PDO::PARAM_STR);
            $stmt->execute();

            echo "FOI?<br/>";
        }
    }
}


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
<br/>
<br/>
<br/>
<br/>
<br/>
    <div class="row">
        <div class="col-lg-6 col-sm-12" align="right">
            <div class="cadastroUsuario" align="left">
                <form method="post">
                    <h1>Create User</h1>
                    <p>Username</p>
                    <input type="text" name="user" value="<?php if($data_is_set) echo $_POST['user'];?>" placeholder="Enter the username">
                    <p>password</p>
                    <input type="password" name="pass" value="<?php if($data_is_set) echo $_POST['pass'];?>" placeholder="Enter the password">
                    <p>Password Verification</p>
                    <input type="password" name="pass2" value="<?php if($data_is_set) echo $_POST['pass2'];?>" placeholder="Repeat the password">
                    <p>E-mail</p>
                    <input type="email" name="email"  value="<?php if($data_is_set) echo $_POST['email'];?>"  placeholder="Enter the e-mail">
                    <p>Permission</p>
                    <select name="perm" >
                        <option value="adm" <?php if($data_is_set) if($_POST['perm'] == "adm") echo "selected"?> style="color: #03d0cf;"><b>Administrator</b></option>
                        <option value="sem" <?php if($data_is_set) if($_POST['perm'] == "sem") echo "selected"?> style="color: #1d6876;"><b>Semi Basic</b></option>
                        <option value="bas" <?php if($data_is_set) if($_POST['perm'] == "bas") echo "selected"?> style="color: #000;"><b>Basic</b></option>
                    </select>
                    <div style="<?php if(!$show_error_message){ echo 'display:none';}?>">
                        <p class="alert alert-danger"><?php echo $error_message;?></p><br/>
                    </div>
                    <input type="submit" name="cadastrar" value="Save" href="#">

                </form>
            </div>
        </div>

        <div class="col-lg-6 col-sm-12  tableUsuario">

            <?php

            $dbh = new PDO('mysql:host=localhost;dbname=mydb', 'root', '');

            $sql = 'SELECT * FROM usuario ORDER BY nome';
            ?>
            <table>
                <tbody>
                <tr>
                    <th scope="col">&nbsp;&nbsp;&nbsp;Username&nbsp;&nbsp;&nbsp;</th>
                    <th scope="col">Email</th>
                    <th scope="col">&nbsp;&nbsp;&nbsp;Permission&nbsp;&nbsp;&nbsp;</th>
                    <th scope="col">&nbsp;&nbsp;&nbsp;Manage&nbsp;&nbsp;&nbsp;</th>
                </tr>

                <?php

                foreach($dbh->query($sql) as $row) {
                    $row['email'];
                    if($row['permissao'] == 'adm')
                    {
                        $color = "#03d0cf";
                        $permissao = "Administrator";
                    }
                    else if($row['permissao'] == 'sem')
                    {
                        $color = "#1d6876";
                        $permissao = "Semi Basic";
                    }
                    else
                    {
                        $color = "#FFF";
                        $permissao = "Basic";
                    }
                    echo "
                    <tr>
                        <td>" . $row['nome'] . "</td>
                        <td>" . $row['email'] . "</td>
                        <td><div style='color: ".$color. "'><b>" . $permissao . "</b></div></td>
                        <td style='text-align: center' class='register_options' align='center'><a href='#'><img src='img/edit.png' width='20px' height='20px' ></a>
                            <a href='#' ><img src='img/delete.png' width='20px' height='20px' ></a></td>
                    </tr>";

                }
                ?>
                </tbody>
            </table>

        </div>

    </div>
</body>
</html>

