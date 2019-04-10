<html>
    <body>
    <h3>Sistema de Gestao de Incendios Florestais</h3>
    <h2>Associar Processo de Socorro a Meio</h2>
<?php

        echo("<form action=\"updateProcesso.php\" method=\"post\">");
        echo("<p><input type=\"hidden\" name=\"processo\" value=\"3\"</p>");
        echo("<p>Numero Processo: <input type=\"text\" name=\"numprocesso\" required/></p>");
        echo("<p>Numero Meio: <input type=\"text\" name=\"nummeio\" required/></p>");
        echo("<p>Nome Entidade: <input type=\"text\" name=\"nomeentidade\" required/></p>");
        echo("<p><input type=\"submit\" value=\"Submit\"/></p></form>\n");
?>
    </body>
</html>
