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
  $Almoxarifado = $row['Almox'];
   if ($Almoxarifado == "1") {
     $RecebePeca = "0";
     $CadastraPeca = "1";
   }
   elseif ($Almoxarifado === "2") {
     $RecebePeca = "1";
     $CadastraPeca = "0";
   }
   elseif ($Almoxarifado === "3") {
     $RecebePeca = "1";
     $CadastraPeca = "1";
   }
?>