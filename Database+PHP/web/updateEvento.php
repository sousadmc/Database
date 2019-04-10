<html>
    <body>
<?php
    $nlocal = $_REQUEST['morada'];
    $ntelefone = $_REQUEST['numtelefone'];
    $ninstante = $_REQUEST['instantechamada'];
    $nome = $_REQUEST['nomepessoa'];
    $numero= $_REQUEST['numprocesso'];
    $option =  $_REQUEST['evento'];
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
          $sql = "SELECT * FROM eventoEmergencia WHERE numTelefone = :ntelefone AND instanteChamada = :ninstante;";
          $result = $db->prepare($sql);
          $result->execute([':ntelefone' => $ntelefone, ':ninstante' => $ninstante ]);
          if($result->rowCount() == 0){
            $sql = "SELECT * FROM processoSocorro WHERE numProcessoSocorro = :numero;";
            $result = $db->prepare($sql);
            $result->execute([':numero' => $numero]);
            if($result->rowCount() != 0){
              $sql = "SELECT * FROM local WHERE moradaLocal = :nlocal;";
              $result = $db->prepare($sql);
              $result->execute([':nlocal' => $nlocal]);
              if($result->rowCount() != 0){
                $sql = "INSERT INTO  eventoEmergencia (numTelefone, instanteChamada, nomePessoa, moradaLocal, numProcessoSocorro) VALUES (:ntelefone, :ninstante, :nome, :nlocal, :numero);";
                echo("<p>Evento adicionado com sucesso.</p>");
                $result = $db->prepare($sql);
                $result->execute([':ntelefone' => $ntelefone, ':ninstante' => $ninstante,':nome' => $nome, ':nlocal' => $nlocal,  ':numero' => $numero]);
              }
              else {
                echo("<p>Local $nlocal nao existente. Tente inserir outro local.</p>");
                echo("<a href= \"addEvento.php\">Back</a>\n");
              }
            }
            else {
              echo("<p>Processo de Socorro $numero nao existente. Tente inserir outro numero de Processo.</p>");
              echo("<a href= \"addEvento.php\">Back</a>\n");
            }
          }
          else{
            echo("<p>Evento ja existente. Tente inserir outro evento.</p>");
            echo("<a href= \"addEvento.php\">Back</a>\n");
          }
          $db->commit();
          $db = null;
        }
        else{
          echo("<h3>Sistema de Gestao de Incendios Florestais</h3>");
          $sql = "SELECT * FROM eventoEmergencia WHERE numTelefone = :ntelefone AND instanteChamada = :ninstante;";
          $result = $db->prepare($sql);
          $result->execute([':ntelefone' => $ntelefone, ':ninstante' => $ninstante ]);
          if($result->rowCount() != 0){
            $sql = "DELETE FROM  eventoEmergencia WHERE numTelefone = :ntelefone and instanteChamada = :ninstante;";
            $result = $db->prepare($sql);
            $result->execute([':ninstante' => $ninstante, ':ntelefone' => $ntelefone ]);
            echo("<p>Evento removido com sucesso.</p>");
          }
          else{
            echo("<p>Evento nao existente. Tente inserir outro evento.</p>");
            echo("<a href= \"remEvento.php\">Back</a>\n");
          }
          $db->commit();
          $db = null;
        }

        echo("<a href= \"index.html\">Home</a>");
    }
    catch (PDOException $e)
    {
        echo("<p>ERROR: {$e->getMessage()}</p>");
    }
?>
    </body>
</html>
