<html>
    <body>
<?php
    $nlocal = $_REQUEST['morada'];
    $option =  $_REQUEST['moradaLocal'];
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
          $sql = "SELECT * FROM local WHERE moradaLocal = :nlocal;";
          $result = $db->prepare($sql);
          $result->execute([':nlocal' => $nlocal]);
          if($result->rowCount() == 0){
            $sql = "INSERT INTO  local (moradaLocal) VALUES (:nlocal);";
            echo("<p>Local $nlocal adicionado com sucesso.</p>");
            $result = $db->prepare($sql);
            $result->execute([':nlocal' => $nlocal ]);
          }
          else{
            echo("<p>Local $nlocal ja existente. Tente inserir outro local.</p>");
            echo("<a href= \"addlocal.php\">Back</a>\n");
          }
          $db->commit();
          $db = null;
        }
        else{
          echo("<h3>Sistema de Gestao de Incendios Florestais</h3>");
          $sql = "SELECT * FROM local WHERE moradaLocal = :nlocal;";
          $result = $db->prepare($sql);
          $result->execute([':nlocal' => $nlocal]);
          if($result->rowCount() != 0){
            $sql = "DELETE FROM  local WHERE moradaLocal = :nlocal;";
            $result = $db->prepare($sql);
            $result->execute([':nlocal' => $nlocal ]);
            echo("<p>Local $nlocal removido com sucesso.</p>");
          }
          else{
            echo("<p>Local $nlocal nao existente. Tente inserir outro local.</p>");
            echo("<a href= \"remlocal.php\">Back</a>\n");
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
