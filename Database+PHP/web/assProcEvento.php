<html>
    <body>
    <h3>Sistema de Gestao de Incendios Florestais</h3>
    <h2>Associar Processo de Socorro a Evento de Emergencia</h2>
<?php
    try
    {
        $host = "db.ist.utl.pt";
        $user ="ist187651";
        $password = "leet7654";
        $dbname = $user;

        $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT * FROM  eventoEmergencia WHERE numProcessoSocorro IS NULL;";
        $result = $db->prepare($sql);
        $result->execute();



        echo("<form action=\"updateProcesso.php\" method=\"post\">");
        echo("<p><input type=\"hidden\" name=\"processo\" value=\"4\"</p>");
        echo("<p>Numero Processo: <input type=\"text\" name=\"numprocesso\" required/></p>");
        echo("<p>Escolher Evento <input type=\"hidden\"/></p>");
        echo("<select name='evento'>");
        echo("<option>-- Select Item --</option>");
        foreach($result as $row)
        {
          echo("<option name='numtelefone'>$row[numtelefone], $row[instantechamada], $row[nomepessoa], $row[moradalocal]</option>");
        }
        echo("</select>");
        echo("<p><input type=\"submit\" value=\"Submit\"/></p></form>\n");

    }
    catch (PDOException $e)
    {
        echo("<p>ERROR: {$e->getMessage()}</p>");
    }
?>
    </body>
</html>
