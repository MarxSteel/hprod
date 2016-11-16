<?php 
 $query = $PDO->prepare("SELECT * FROM login WHERE login='$login'");
 $query->execute();
  $row = $query->fetch();
  $NomeUserLogado = $row['Nome'];			//NOME DO USUÁRIO
  $PMontagem = $row['P2Mon'];			//PRIVILÉGIOS DE MONTAGEM
  $PReteste = $row['P2Mon'];			//PRIVILÉGIOS DE RETESTE

?>
