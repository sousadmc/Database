<html>
    <body>
<?php
    $numero = $_REQUEST['numprocesso'];
    $nmeio = $_REQUEST['nummeio'];
    $nentidade = $_REQUEST['nomeentidade'];
    $option =  $_REQUEST['processo'];
    $evento = explode(",", $_POST['evento']);
    $ntelefone = $evento[0];
    $ninstante = $evento[1];
    $nome = $evento[2];
    $nlocal = $evento[3];

    try
    {
        $host = "db.ist.utl.pt";
        $user ="ist187651";
        $password = "leet7654";
        $dbname = $user;
        $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db->BeginTransaction();
        if($option == 0){
          echo("<h3>Sistema de Gestao de Incendios Florestais</h3>");
          $sql = "SELECT * FROM processoSocorro WHERE numProcessoSocorro = :numero;";
          $result = $db->prepare($sql);
          $result->execute([':numero' => $numero]);
          if($result->rowCount() == 0){
            $sql = "INSERT INTO  processoSocorro (numProcessoSocorro) VALUES (:numero);";
            $result = $db->prepare($sql);
            $result->execute([':numero' => $numero ]);
            echo("<p>Processo de Socorro $numero adicionado com sucesso.</p>");
          }
          else{
            echo("<p>Processo de Socorro $numero ja existente. Tente inserir outro numero de Processo.</p>");
            echo("<a href= \"addProcesso.php\">Back</a>\n");
          }
          $db->commit();
          $db = null;
        }
        else if ($option == 1){
          echo("<h3>Sistema de Gestao de Incendios Florestais</h3>");
          $sql = "SELECT * FROM processoSocorro WHERE numProcessoSocorro = :numero;";
          $result = $db->prepare($sql);
          $result->execute([':numero' => $numero]);
          if($result->rowCount() != 0){
            $sql = "DELETE FROM  processoSocorro WHERE numProcessoSocorro = :numero;";
            $result = $db->prepare($sql);
            $result->execute([':numero' => $numero ]);
            echo("<p>Processo de Socorro $numero removido com sucesso.</p>");
          }
          else{
            echo("<p>Processo de Socorro $numero nao existente. Tente inserir outro numero de Processo.</p>");
            echo("<a href= \"addProcesso.php\">Back</a>\n");
          }
          $db->commit();
          $db = null;
        }

        else if ($option == 2){
          echo("<h3>Sistema de Gestao de Incendios Florestais</h3>");
          echo("<p>Listar Processos</hp>");
          $sql = "SELECT numProcessoSocorro FROM  processoSocorro;";
          $result = $db->prepare($sql);
          $result->execute();

          echo("<table border=\"1\" cellspacing=\"20\">\n");
          echo("<tr>\n");
          echo("<td>numProcessoSocorro</td>\n");
          echo("</tr>\n");
          foreach($result as $row)
          {
              echo("<tr>\n");
              echo("<td>{$row['numprocessosocorro']}</td>\n");
              echo("</tr>\n");
          }
          echo("</table>\n");
          $db->commit();
          $db = null;
        }
        else if ($option == 3){
          echo("<h3>Sistema de Gestao de Incendios Florestais</h3>");
          $sql = "SELECT * FROM processoSocorro WHERE numProcessoSocorro = :numero;";
          $result = $db->prepare($sql);
          $result->execute([':numero' => $numero]);
          if($result->rowCount() != 0){
            $sql = "SELECT * FROM meio WHERE numMeio = :nmeio AND nomeEntidade = :nentidade;";
            $result = $db->prepare($sql);
            $result->execute([':nmeio' => $nmeio, ':nentidade' => $nentidade]);
            if($result->rowCount() != 0){
              $sql = "INSERT INTO  aciona (numMeio, nomeEntidade, numProcessoSocorro) VALUES (:nmeio, :nentidade, :numero);";
              $result = $db->prepare($sql);
              $result->execute([':nmeio' => $nmeio, ':nentidade' => $nentidade, ':numero' => $numero ]);
              echo("<p>Processo de Socorro $numero associado ao Meio $nmeio da $nentidade com sucesso.</p>");
            }
            else{
              echo("<p>Meio nao existente. Tente inserir outro meio.</p>");
              echo("<a href= \"assProcMeio.php\">Back</a>\n");
            }
          }
          else{
            echo("<p>Processo de Socorro $numero nao existente. Tente inserir outro numero de Processo.</p>");
            echo("<a href= \"assProcMeio.php\">Back</a>\n");
          }
          $db->commit();
          $db = null;

        }
        else if ($option == 4){
          echo("<h3>Sistema de Gestao de Incendios Florestais</h3>");
          $sql = "SELECT * FROM processoSocorro WHERE numProcessoSocorro = :numero;";
          $result = $db->prepare($sql);
          $result->execute([':numero' => $numero]);
          if($result->rowCount() != 0){
            $sql = "UPDATE eventoEmergencia SET numProcessoSocorro = :numero WHERE numTelefone = :ntelefone AND instanteChamada = :ninstante;";
            $result = $db->prepare($sql);
            $result->execute([':ntelefone' => $ntelefone, ':ninstante' => $ninstante, ':numero' => $numero]);
            echo("<p>Processo de Socorro numero $numero associado a Evento de Emergencia com sucesso.</p>");
          }
          else{
            echo("<p>Processo de Socorro $numero nao existente. Tente inserir outro numero de Processo.</p>");
            echo("<a href= \"assProcEvento.php\">Back</a>\n");
          }
          $db->commit();
          $db = null;
        }




    }
    catch (PDOException $e)
    {
        echo("<p>ERROR: Operacao Invalida</p>");
    }
    echo("<a href= \"index.html\">Home</a>");
?>
    </body>
</html>
