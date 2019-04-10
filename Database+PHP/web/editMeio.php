<html>
    <body>
    <h3>Sistema de Gestao de Incendios Florestais</h3>
    <h2>Editar Meio</h2>
<?php

        echo("<form action=\"updateMeio.php\" method=\"post\">");
        echo("<p><input type=\"hidden\" name=\"meio\" value=\"1\"</p>");
        echo("<p>Numero Meio: <input type=\"text\" name=\"nummeio\"/></p>");
        echo("<p>Nome Entidade: <input type=\"text\" name=\"nentidade\"/></p>");
        echo("<p>Novo Nome Meio: <input type=\"text\" name=\"nomemeio\"/></p>");
        echo("<select name='tipo'>");
        echo("<option>-- Select Item --</option>");
        echo("<option name='apoio'>Meio Apoio</option>");
        echo("<option name='combate'>Meio Combate</option>");
        echo("<option name='socorro'>Meio Socorro</option>");
        echo("</select>");
        echo("<p><input type=\"submit\" value=\"Submit\"/></p></form>\n");
?>
    </body>
</html>
