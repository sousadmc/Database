<html>
    <body>
    <h3>Sistema de Gestao de Incendios Florestais</h3>
    <h2>Adicionar Local</h2>
<?php

        echo("<form action=\"updateLocal.php\" method=\"post\" autocomplete=\"off\">");
        echo("<p><input type=\"hidden\" name=\"moradaLocal\" value=\"0\"</p>");
        echo("<p>Novo Local: <input type=\"text\" name=\"morada\" required/></p>");
        echo("<p><input type=\"submit\" value=\"Submit\"/></p></form>\n");
        clearstatcache();
?>
    </body>
</html>
