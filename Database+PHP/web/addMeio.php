<html>
    <body>
    <h3>Sistema de Gestao de Incendios Florestais</h3>
    <h2>Adicionar Meio</h2>
<?php
        echo("<form action=\"updateMeio.php\" method=\"post\">");
        echo("<p>Novo Meio<input type=\"hidden\" name=\"meio\" value=\"0\"</p>");
        echo("<p>Numero:<input type=\"text\" name=\"nummeio\" required/></p>");
        echo("<p>Nome:<input type=\"text\" name=\"nomemeio\" required/></p>");
        echo("<p>Nome Entidade:<input type=\"text\" name=\"nentidade\" required/></p>");
        echo("<p><input type=\"submit\" value=\"Submit\"/></p></form>\n");

?>
    </body>
</html>
