<html>
    <body>
    <h3>Sistema de Gestao de Incendios Florestais</h3>
    <h2>Remover Processo de Socorro</h2>
<?php
        echo("<form action=\"updateProcesso.php\" method=\"post\">");
        echo("<p><input type=\"hidden\" name=\"processo\" value=\"1\"</p>");
        echo("<p>Numero Processo: <input type=\"text\" name=\"numprocesso\" required/></p>");
        echo("<p><input type=\"submit\" value=\"Submit\"/></p></form>\n");
?>
    </body>
</html>
