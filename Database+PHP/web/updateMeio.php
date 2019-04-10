<html>
    <body>
<?php
    $nomemeio = $_REQUEST['nomemeio'];
    $nummeio = $_REQUEST['nummeio'];
    $nentidade = $_REQUEST['nentidade'];
    $nprocesso = $_REQUEST['numprocessosocorro'];
    $morada =  $_REQUEST['morada'];
    $tipo =  $_POST['tipo'];
    $option =  $_REQUEST['meio'];
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
          $sql = "SELECT * FROM meio WHERE numMeio = :nummeio AND nomeEntidade = :nentidade;";
          $result = $db->prepare($sql);
          $result->execute([':nummeio' => $nummeio, ':nentidade' => $nentidade ]);
          if($result->rowCount() == 0){
            $sql = "INSERT INTO  meio (numMeio,nomeMeio, nomeEntidade) VALUES (:nummeio, :nomemeio, :nentidade);";
            $result = $db->prepare($sql);
            $result->execute([':nomemeio' => $nomemeio, ':nummeio' => $nummeio, ':nentidade' => $nentidade ]);
            echo("<p>$nomemeio adicionado com sucesso.</p>");
          }
          else{
            echo("<p>Meio ja existente. Tente inserir outro meio.</p>");
            echo("<a href= \"addMeio.php\">Back</a>\n");
          }
          $db->commit();
          $db = null;
        }
        else if ($option == 1){
          echo("<h3>Sistema de Gestao de Incendios Florestais</h3>");
          if($tipo == 'Meio Apoio'){
            $sql = "SELECT * FROM meioApoio WHERE numMeio = :nummeio AND nomeEntidade = :nentidade;";
            $result = $db->prepare($sql);
            $result->execute([':nummeio' => $nummeio, ':nentidade' => $nentidade ]);
            if($result->rowCount() != 0){
              $sql = "UPDATE  meio SET nomeMeio = :nomemeio WHERE numMeio = :nummeio AND nomeEntidade = :nentidade;";
              $result = $db->prepare($sql);
              $result->execute([':nomemeio' => $nomemeio, ':nummeio' => $nummeio, ':nentidade' => $nentidade]);
              echo("<p>Meio $nomemeio editado com sucesso.</p>");
            }
            else{
              echo("<p>Meio de Apoio nao existente. Tente inserir outro meio.</p>");
              echo("<a href= \"editMeio.php\">Back</a>\n");
            }

          }
          else if($tipo == 'Meio Combate'){
            $sql = "SELECT * FROM meioCombate WHERE numMeio = :nummeio AND nomeEntidade = :nentidade;";
            $result = $db->prepare($sql);
            $result->execute([':nummeio' => $nummeio, ':nentidade' => $nentidade ]);
            if($result->rowCount() != 0){
              $sql = "UPDATE  meio SET nomeMeio = :nomemeio WHERE numMeio = :nummeio AND nomeEntidade = :nentidade;";
              $result = $db->prepare($sql);
              $result->execute([':nomemeio' => $nomemeio, ':nummeio' => $nummeio, ':nentidade' => $nentidade]);
              echo("<p>Meio $nomemeio editado com sucesso.</p>");
            }
            else{
              echo("<p>Meio de Combate nao existente. Tente inserir outro meio.</p>");
              echo("<a href= \"editMeio.php\">Back</a>\n");
            }
          }
          else {
            $sql = "SELECT * FROM meioSocorro WHERE numMeio = :nummeio AND nomeEntidade = :nentidade;";
            $result = $db->prepare($sql);
            $result->execute([':nummeio' => $nummeio, ':nentidade' => $nentidade ]);
            if($result->rowCount() != 0){
              $sql = "UPDATE  meio SET nomeMeio = :nomemeio WHERE numMeio = :nummeio AND nomeEntidade = :nentidade;";
              $result = $db->prepare($sql);
              $result->execute([':nomemeio' => $nomemeio, ':nummeio' => $nummeio, ':nentidade' => $nentidade]);
              echo("<p>Meio $nomemeio editado com sucesso.</p>");
            }
            else{
              echo("<p>Meio de Socorro nao existente. Tente inserir outro meio.</p>");
              echo("<a href= \"editMeio.php\">Back</a>\n");
            }
          }

          $db->commit();
          $db = null;
        }
        else if ($option == 2){
          echo("<h3>Sistema de Gestao de Incendios Florestais</h3>");
          $sql = "SELECT * FROM meio WHERE numMeio = :nummeio AND nomeEntidade = :nentidade;";
          $result = $db->prepare($sql);
          $result->execute([':nummeio' => $nummeio, ':nentidade' => $nentidade ]);

          if($result->rowCount() != 0){
            $sql = "DELETE FROM  meio WHERE nomeMeio = :nomemeio;";
            $result = $db->prepare($sql);
            $result->execute([':nomemeio' => $nomemeio ]);
            echo("<p>$nomemeio removido com sucesso.</p>");
          }
          else{
            echo("<p>Meio nao existente. Tente inserir outro meio.</p>");
            echo("<a href= \"remMeio.php\">Back</a>\n");
          }
          $db->commit();
          $db = null;
        }
        else if ($option == 3){
          echo("<h3>Sistema de Gestao de Incendios Florestais</h3>");
          echo("<p>Listar Meios</p>");
          $sql = "SELECT numMeio, nomeMeio, nomeEntidade FROM  meio ORDER BY nomeEntidade ASC;";
          $result = $db->prepare($sql);
          $result->execute();

          echo("<table border=\"1\" cellspacing=\"20\">\n");
          echo("<tr>\n");
          echo("<td>numMeio</td>\n");
          echo("<td>nomeMeio</td>\n");
          echo("<td>nomeEntidade</td>\n");
          echo("</tr>\n");
          foreach($result as $row)
          {
              echo("<tr>\n");
              echo("<td>{$row['nummeio']}</td>\n");
              echo("<td>{$row['nomemeio']}</td>\n");
              echo("<td>{$row['nomeentidade']}</td>\n");
              echo("</tr>\n");
          }
          echo("</table>\n");
          $db->commit();
          $db = null;
        }
        else if ($option == 4){
          echo("<h3>Sistema de Gestao de Incendios Florestais</h3>");
          $sql = "SELECT * FROM processoSocorro WHERE numProcessoSocorro = :nprocesso;";
          $result = $db->prepare($sql);
          $result->execute([':nprocesso' => $nprocesso]);

          if($result->rowCount() != 0){
            echo("<p>Listar Meios Associados ao Processo $nprocesso</p>");
            $sql = "SELECT nummeio, nomemeio, nomeentidade FROM meio NATURAL JOIN aciona WHERE numprocessosocorro = :numeroprocessosocorro;";
            $result = $db->prepare($sql);
            $result->execute([':numeroprocessosocorro' => $nprocesso]);

            echo("<table border=\"1\" cellspacing=\"20\">\n");
            echo("<tr>\n");
            echo("<td>numMeio</td>\n");
            echo("<td>nomeMeio</td>\n");
            echo("<td>nomeEntidade</td>\n");
            echo("</tr>\n");
            foreach($result as $row)
            {
                echo("<tr>\n");
                echo("<td>{$row['nummeio']}</td>\n");
                echo("<td>{$row['nomemeio']}</td>\n");
                echo("<td>{$row['nomeentidade']}</td>\n");
                echo("</tr>\n");
            }
            echo("</table>\n");
          }
          else{
            echo("<p>Processo de Socorro $nprocesso nao existente. Tente inserir outro numero de Processo</p>");
            echo("<a href= \"listmeioProc.php\">Back</a>\n");
          }
          $db->commit();
          $db = null;
        }
        else if ($option == 5){
          echo("<h3>Sistema de Gestao de Incendios Florestais</h3>");
          $sql = "SELECT * FROM local WHERE moradaLocal = :morada;";
          $result = $db->prepare($sql);
          $result->execute([':morada' => $morada]);
          if($result->rowCount() != 0){
            echo("<h3>Listar Meios Socorro Associados a Processo no local $morada</h3>");
            $sql = "SELECT numMeio, nomeEntidade, numProcessoSocorro FROM  transporta NATURAL JOIN eventoEmergencia WHERE moradaLocal = :morada;";
            $result = $db->prepare($sql);
            $result->execute([':morada' => $morada ]);


            echo("<table border=\"1\" cellspacing=\"20\">\n");
            echo("<tr>\n");
            echo("<td>numMeio</td>\n");
            echo("<td>nomeEntidade</td>\n");
            echo("<td>numProcessoSocorro</td>\n");
            echo("</tr>\n");
            foreach($result as $row)
            {
                echo("<tr>\n");
                echo("<td>{$row['nummeio']}</td>\n");
                echo("<td>{$row['nomeentidade']}</td>\n");
                echo("<td>{$row['numprocessosocorro']}</td>\n");
                echo("</tr>\n");
            }
            echo("</table>\n");
          }
          else{
            echo("<p>Local $morada nao existente. Tente inserir outro local</p>");
            echo("<a href= \"listmeioSocorro.php\">Back</a>\n");
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
