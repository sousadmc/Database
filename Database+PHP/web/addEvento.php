<html>
    <body>
    <h3>Sistema de Gestao de Incendios Florestais</h3>
    <h2>Adicionar Evento Emergencia</h2>
<?php
        echo("<form action=\"updateEvento.php\" method=\"post\">");
        echo("<p><input type=\"hidden\" name=\"evento\" value=\"0\"</p>");
        echo("<p>Nome: <input type=\"text\" name=\"nomepessoa\" required/></p>");
        echo("<p>Numero Telefone: <input type=\"text\" name=\"numtelefone\" required/></p>");
        echo("<p>Instante Chamada: <input type=\"text\" name=\"instantechamada\" required/></p>");
        echo("<p>Morada: <input type=\"text\" name=\"morada\" required/></p>");
        echo("<p>Numero Processo Socorro: <input type=\"text\" name=\"numprocesso\"/></p>");
        echo("<p><input type=\"submit\" value=\"Submit\"/></p></form>\n");

?>
    </body>
</html>
