<?php 
 $query = $PDO->prepare("SELECT * FROM login WHERE login='$login'");
 $query->execute();
  $row = $query->fetch();
  $NomeUserLogado = $row['Nome'];			//NOME DO USUÁRIO
  $Nick = $NomeUserLogado;
  $PMontagem = $row['P2Mon'];			//PRIVILÉGIOS DE MONTAGEM
  $PReteste = $row['P2Ret'];			//PRIVILÉGIOS DE RETESTE
  $PermAdm = $row['pAdm'];			//PRIVILÉGIOS DE RETESTE
  $MeuIP = $row['P2IP'];			//PRIVILÉGIOS DE RETESTE
  $WIEGAND = $row['CartaoWiegand'];
  $ABATRACK = $row['CartaoAba'];
  $SMARTCARD = $row['CartaoSmart'];
?>