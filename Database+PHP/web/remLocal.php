<html>
    <body>
    <h3>Sistema de Gestao de Incendios Florestais</h3>
    <h2>Remover Local</h2>
<?php
        echo("<form action=\"updateLocal.php\" method=\"post\" autocomplete=\"off\">");
        echo("<p><input type=\"hidden\" name=\"moradaLocal\" value=\"1\"</p>");
        echo("<p>Local a Remover: <input type=\"text\" name=\"morada\" required/></p>");
        echo("<p><input type=\"submit\" value=\"Submit\"/></p></form>\n");

?>
    </body>
</html>
