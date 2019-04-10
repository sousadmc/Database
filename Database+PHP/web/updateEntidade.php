<html>
    <body>
<?php
    $nentidade = $_REQUEST['entidade'];
    $option =  $_REQUEST['nomeEntidade'];
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
          $sql = "SELECT * FROM entidadeMeio WHERE nomeEntidade = :nentidade;";
          $result = $db->prepare($sql);
          $result->execute([':nentidade' => $nentidade]);
          if($result->rowCount() == 0){
            $sql = "INSERT INTO  entidadeMeio (nomeEntidade) VALUES (:nentidade);";
            $result = $db->prepare($sql);
            $result->execute([':nentidade' => $nentidade ]);
            echo("<p>$nentidade adicionado com sucesso.</p>");
          }
          else{
            echo("<p>$nentidade ja existente. Tente inserir outra Entidade.</p>");
            echo("<a href= \"addEntidade.php\">Back</a>\n");
          }

          $db->commit();
          $db = null;
        }
        else{
          echo("<h3>Sistema de Gestao de Incendios Florestais</h3>");
          $sql = "SELECT * FROM entidadeMeio WHERE nomeEntidade = :nentidade;";
          $result = $db->prepare($sql);
          $result->execute([':nentidade' => $nentidade]);
          if($result->rowCount() != 0){
            $sql = "DELETE FROM  entidadeMeio WHERE nomeEntidade = :nentidade;";
            $result = $db->prepare($sql);
            $result->execute([':nentidade' => $nentidade ]);
            echo("<p>$nentidade removido com sucesso.</p>");
          }
          else{
            echo("<p>$nentidade nao existente. Tente inserir outra Entidade.</p>");
            echo("<a href= \"remEntidade.php\">Back</a>\n");
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
