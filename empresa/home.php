<?php
    include "langsettings.php";

    list($partwampp, $directorwampp) = preg_split('|\\\htdocs\\\trabalhodebd|', dirname(__FILE__));
    $mypasswdtxt = "mysqlrootpasswd.txt";
    $mypasswdtxtdir = $partwampp."\security\\".$mypasswdtxt;

    if (file_exists($mypasswdtxtdir)) {
        $mypasswd = file_get_contents($mypasswdtxtdir);
        preg_match('/mysql password = (.*)/', $mypasswd, $mypasswd);
        $mypasswd = trim($mypasswd[1]);
    } else {
        $mypasswd = "";
    }

    if ($_REQUEST['action'] == "getpdf") {
        mysql_connect("localhost", "root", $mypasswd);
        mysql_select_db("teste");

        include ('fpdf/fpdf.php');
        $pdf = new FPDF();
        $pdf->AddPage();

        $pdf->SetFont('Helvetica', '', 14);
        $pdf->Write(5, 'Trabalho de BD');
        $pdf->Ln();

        $pdf->SetFontSize(10);
        $pdf->Write(5, 'Clientes');
        $pdf->Ln();

        $pdf->Ln(5);


        $pdf->SetFont('Helvetica', 'B', 10);
        $pdf->Cell(33 ,7, $TEXT['tbd-attrib3'], 1);
        $pdf->Cell(30 ,7, $TEXT['tbd-attrib2'], 1);
        $pdf->Cell(100 ,7, $TEXT['tbd-attrib1'], 1);
        $pdf->Ln();

        $pdf->SetFont('Helvetica', '', 10);

        $result=mysql_query("SELECT nome_cliente, cpf, cod_cliente FROM cliente ORDER BY cod_cliente");

        while ($row = mysql_fetch_array($result)) {
            $pdf->Cell(33, 7, $row['cod_cliente'], 1);
            $pdf->Cell(30, 7, $row['cpf'], 1);
            $pdf->Cell(100, 7, $row['nome_cliente'], 1);
            $pdf->Ln();
        }
        $pdf->Output();
        exit;
    }
?>
<html>
    <head>
        <meta name="author" content="Kayo Fernando, Adam Gurita, Lucas Gomes">
        <link href="home.css" rel="stylesheet" type="text/css">
        <title><?php echo $TEXT['tbd-head-fpdf']; ?></title>
    </head>

    <body>
<center>
        

        <br><h1><?php echo $TEXT['tbd-head-fpdf']; ?></h1>

        <p><?php echo $TEXT['tbd-text1']; ?></p>
        <p><?php echo $TEXT['tbd-text2']; ?></p>

        <?php
                if(!@mysql_connect("localhost", "root", $mypasswd)) {
                echo "<h2>".$TEXT['tbd-error']."</h2>";
                die();
            }
            mysql_select_db("teste");
        ?>

        <h2><?php echo $TEXT['tbd-head1']; ?></h2>

        <table border="0" cellpadding="0" cellspacing="0">
            <tr bgcolor="#0000CD">
                <td><img src="img/blank.gif" alt="" width="10" height="25"></td>
                <td class=tabhead><img src="img/blank.gif" alt="" width="200" height="6"><br><b><?php echo $TEXT['tbd-attrib1']; ?></b></td>
                <td class=tabhead><img src="img/blank.gif" alt="" width="200" height="6"><br><b><?php echo $TEXT['tbd-attrib2']; ?></b></td>
                <td class=tabhead><img src="img/blank.gif" alt="" width="50" height="6"><br><b><?php echo $TEXT['tbd-attrib3']; ?></b></td>
                <td class=tabhead><img src="img/blank.gif" alt="" width="50" height="6"><br><b><?php echo $TEXT['tbd-attrib4']; ?></b></td>
                <td><img src="img/blank.gif" alt="" width="10" height="25"></td>
            </tr>

            <?php
                if ($_REQUEST['nome_cliente'] != "") {
                    if ($_REQUEST['cpf'] == "") {
                        $cpf = "NULL";
                    } else {
                        $cpf = mysql_real_escape_string($_REQUEST['cpf']);
                    }
                    $cod_cliente = intval($_REQUEST['cod_cliente']);
                    $nome_cliente = mysql_real_escape_string($_REQUEST['nome_cliente']);
                    mysql_query("INSERT INTO cliente (cpf,cod_cliente,nome_cliente) VALUES('$cpf','$cod_cliente','$nome_cliente')");
                }

                if ($_REQUEST['action'] == "del") {
                    $cod_cliente = intval($_REQUEST['cod_cliente']);
                    mysql_query("DELETE FROM cliente WHERE cod_cliente=$cod_cliente");
                }

                $result = mysql_query("SELECT cod_cliente, cpf, nome_cliente FROM cliente ORDER BY cod_cliente");

                $i = 0;
                while ($row = mysql_fetch_array($result)) {
                    if ($i > 0) {
                        echo "<tr valign='bottom'>";
                        echo "<td bgcolor='#ffffff' colspan='6' style='background-image:url(img/strichel.gif)'><img src='img/blank.gif' alt='' width='1' height='1'></td>";
                        echo "</tr>";
                    }
                    echo "<tr valign='middle'>";
                    echo "<td class='tabval'><img src='img/blank.gif' alt='' width='10' height='20'></td>";
                    echo "<td class='tabval'><b>".htmlspecialchars($row['nome_cliente'])."</b>&nbsp;</td>";
                    echo "<td class='tabval'>".htmlspecialchars($row['cpf'])."&nbsp;</td>";
                    echo "<td class='tabval'>".htmlspecialchars($row['cod_cliente'])."&nbsp;</td>";

                    echo "<td class='tabval'><a onclick=\"return confirm('".$TEXT['tbd-sure']."');\" href='home.php?action=del&amp;cod_cliente=".$row['cod_cliente']."'><span class='red'>[".$TEXT['tbd-button1']."]</span></a></td>";
                    echo "<td class='tabval'><a onclick=\"return confirm('".$TEXT['tbd-sure']."');\" href='home.php?action=del&amp;cod_cliente=".$row['cod_cliente']."'><span class='red'>[".$TEXT['tbd-button1']."]</span></a></td>";
                    echo "<td class='tabval'></td>";
                    echo "</tr>";
                    $i++;
                }

                echo "<tr valign='bottom'>";
                echo "<td bgcolor='##0000CD' colspan='6'><img src='img/blank.gif' alt='' width='1' height='8'></td>";
                echo "</tr>";


            ?>
        </table>

        <h2><?php echo $TEXT['tbd-head2']; ?></h2>

        <form action="<?php echo basename($_SERVER['PHP_SELF']); ?>" method="get">
            <table border="0" cellpadding="0" cellspacing="0">
                <tr><td><?php echo $TEXT['tbd-attrib1']; ?>:</td><td><input type="text" size="30" name="nome_cliente"></td></tr>
                <tr><td><?php echo $TEXT['tbd-attrib2']; ?>:</td><td> <input type="text" size="30" name="cpf"></td></tr>
                
                <tr><td>&nbsp;</td><td><input type="submit" value="<?php echo $TEXT['tbd-button2']; ?>"></td></tr>
            </table>
        </form>
       
    </body>
</html>