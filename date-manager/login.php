<?php
session_start();
session_destroy();

$error_msg = "nothing to show";
$show_error_msg = false;
?>

<?php
    session_start();
    session_destroy();
    if(isset($_POST['email']) && isset($_POST['pass']))
    {
        $dbh = new PDO('mysql:host=localhost;dbname=mydb', 'root', '');

        $sql = 'SELECT * FROM usuario WHERE email="' . $_POST['email'] . '" AND senha=MD5(' . $_POST['pass'] . ')';

        foreach($dbh->query($sql) as $row) {
            print_r($row);
            unset($_POST['email']);
            unset($_POST['pass']);
            session_start();
            $_SESSION['user'] = $row['nome'];
            $_SESSION['perm'] = $row['permissao'];
            $_SESSION['email'] = $row['email'];
            header("Location: index.php");
        }
        echo "ERROU";
        $error_msg = "incorrect e-mail or password";
        $show_error_msg = true;
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
    <div class="login">
        <img src="img/user_icon.png" class="avatar">
        <h1>Login</h1>
        <form method="post">
            <p>E-mail</p>
            <input type="email" name="email" placeholder="Enter your email">
            <p>Password</p>
            <input type="password" name="pass" placeholder="Enter your password">


            <div style="<?php if(!$show_error_msg){ echo 'display:none';}?>">
                <p class="alert alert-danger"><?php echo $error_msg;?></p><br/>
            </div>

            <table align="center" width="100%">
                <tr>
                    <td width="50%"><input value="Login" target="_parent" onclick="inicio.html" type="submit"/></td>
                </tr>
            </table>

            <h2>cannot sign in? Contact the administrator.</h2>

        </form>
    </div>
</body>
</html>